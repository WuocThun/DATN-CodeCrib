<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Utility;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\RoomsClassification;
use App\Models\VIPPurchase;
use App\Models\VIPPackage;
use App\Models\Rooms;
use Illuminate\Support\Str;
use App\Providers\VietMapProviders;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class RoomController extends Controller
{

    /**
     * Display a listing of the resource.
     */

    public function __construct(VietMapProviders $vietnamMapService)
    {
        $this->VietMapProviders = $vietnamMapService;
    }
public function report()
{
    $totalRooms = DB::table('rooms')->count();
    $provinceIds = Rooms::pluck('province')->unique();
    $allProvinceData = [];
    foreach ($provinceIds as $provinceId) {
        try {
            // Gọi đến VietMapProvider để lấy dữ liệu
            $vietMapProvider = app(VietMapProviders::class);
            $getProvince = $vietMapProvider->getProvinceData($provinceId);

            // Giải mã JSON trả về từ API
            $provinceData = json_decode($getProvince->getContent(), true);

            // Kiểm tra nếu dữ liệu trả về hợp lệ
            if (is_array($provinceData)) {
                $allProvinceData[] = $provinceData;
            } else {
                $allProvinceData[] = ['province_id' => $provinceId, 'province_name' => 'Không xác định'];
            }
        } catch (\Exception $e) {
            // Xử lý lỗi khi gọi API
            $allProvinceData[] = ['province_id' => $provinceId, 'province_name' => 'Không lấy được thông tin'];
        }
    }
    $roomsByStatus = DB::table('rooms')
                       ->select('status', DB::raw('COUNT(*) as count'))
                       ->groupBy('status')
                       ->get();

    $roomsByProvince = DB::table('rooms')
                         ->select('province', DB::raw('COUNT(*) as count'))
                         ->groupBy('province')
                         ->get();

    $roomsByVipPackage = DB::table('rooms')
                           ->select('vip_package_id', DB::raw('COUNT(*) as count'))
                           ->groupBy('vip_package_id')
                           ->get();

    return view('admin_core.content.rooms.thongke', [
        'totalRooms' => $totalRooms,
        'provinceData' => $allProvinceData,
        'roomsByStatus' => $roomsByStatus,
        'roomsByProvince' => $roomsByProvince,
        'roomsByVipPackage' => $roomsByVipPackage,
    ]);}
    public function getPaymentRoom()
    {
        $getIdUser = auth()->id();
        $getVipPur = VIPPurchase::where('user_id', $getIdUser)
                                ->orderBy('vip_package_id', 'desc')
                                ->distinct('package_id')
                                ->get();
        //            $pack = VIPPackage::where('id',$getPackId)->get();

        //        dd($getVipPur);
        return view('admin_core.lich-su-thanh-toan', compact('getVipPur'));
    }

    public function myRoomsCore()
    {
        $user_id = auth()->id();
        $rooms   = Rooms::where('user_id', $user_id)->get();

        //dd($room);
        return view('admin_core.content.rooms.index', compact('rooms'));
    }

    public function createCore()
    {
        $utilities       = Utility::all();
        $getAllClassRoom = RoomsClassification::all();
        //        dd($getAllClassRoom);
        $getIdUser = \auth()->id();
        $userData  = User::find($getIdUser);
        $provinces = $this->VietMapProviders->getProvinces();

        return view('admin_core.content.rooms.them',
            compact('provinces', 'userData', 'getAllClassRoom', 'utilities'));
    }

    public function storeCore(Request $request
    ): \Illuminate\Http\RedirectResponse {
        $data = $request->validate([
            'title'          => 'required|unique:rooms|max:255',
            'description'    => 'required|',
            'image'          => 'required|array|min:2',
            // yêu cầu tối thiểu 2 ảnh
            'price'          => 'required|numeric',
            'area'           => 'required|string',
            'slug'           => 'required|string',
            'status'         => 'required|integer',
            'full_address'   => 'required|string',
            'rooms_class_id' => 'required|integer',
            'gender_rental'  => 'required|integer',
            'utilities'      => 'required',
            'video'          => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
            'video_url'      => 'nullable|url',
        ], [
                'title.required'          => 'Vui lòng nhập tên tiêu đề',
                'description.required'    => 'Vui lòng nhập mô tả phòng',
                'price.required'          => 'Vui lòng giá phòng ',
                'area.required'           => 'Vui lòng nhập diện tích phòng ',
                'image.required'          => 'Vui lòng thêm hình ảnh',
                'image.min'               => 'Vui lòng tải lên ít nhất 2 hình ảnh',
                'rooms_class_id.required' => 'Vui lòng chọn kiểu phòng ',

            ]
        );
        //
        $room          = new Rooms();
        $room->user_id = \auth()->id();

        $room->title      = $data['title'];
        $room->slug       = Str::slug($data['title']);
        $data['province'] = $request->input('province');
        $room->province   = $data['province'];
        $data['district'] = $request->input('district');
        $room->district   = $data['district'];
        $room->status         = $data['status'];
        $room->full_address   = $data['full_address'];
        $room->description    = $data['description'];
        $room->price          = $data['price'];
        $room->rooms_class_id = $data['rooms_class_id'];
        $room->gender_rental  = $data['gender_rental'];
        $room->area           = $data['area'];
        $room->video          = $data['video'] ?? null;
        $room->video_url      = $data['video_url'] ?? null;
        // Handle image upload
        $images = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $img) {
                $path           = 'uploads/rooms/';
                $get_name_image = $img->getClientOriginalName();
                $name_image     = current(explode('.', $get_name_image));
                $new_image      = $name_image . rand(0, 99) . '.'
                                  . $img->getClientOriginalExtension();
                $img->move($path, $new_image);
                $images[] = $new_image;  // Add each image to the array
            }
            $room->image = json_encode($images);  // Save images as JSON
        }
        //        dd();
        $room->save();
        if ($request->has('utilities')) {
            $utilities = $request->input('utilities');  // Mảng các utility_id được chọn
            foreach ($utilities as $utility_id) {
                $room->utilities()->attach($utility_id);  // Lưu vào bảng room_utilities
            }
        }

        //        // Save the room to the database

        return redirect()->route('admin.rooms.myRooms')
                         ->with('status', 'Thêm thành công');
    }

    public function index()
    {
        $provinces = $this->VietMapProviders->getProvinces();

        return view('admin.content.rooms.index', compact('provinces'));
    }

    public function myRooms()
    {

        $provincesIds = Rooms::select('province',
            DB::raw('count(*) as room_count'))
                             ->groupBy('province')  // Group by tỉnh thành
                             ->orderByDesc('room_count')  // Sắp xếp theo số lượng phòng giảm dần
                             ->limit(3)  // Lấy 3 tỉnh thành có số phòng cao nhất
                             ->get();
        foreach ($provincesIds as $provinceId) {
            // Gọi API để lấy thông tin tỉnh
            $vietMapProvider = app(VietMapProviders::class);
            $getProvince = $vietMapProvider->getProvinceData($provinceId->province);
            // Giải mã JSON trả về
            $provinceData = json_decode($getProvince->getContent(), true);

            // Kiểm tra nếu dữ liệu trả về là mảng, nếu không thì tạo thành mảng
            if (is_array($provinceData)) {
                $allProvinceData[] = $provinceData; // Thêm vào mảng kết quả
            } else {
                $allProvinceData[]
                    = [$provinceData]; // Đảm bảo dữ liệu luôn là mảng
            }
        }


        $currentVIPPackageId = $room->vip_package_id ?? 0;
        $vipPackages = VIPPackage::where('id', '>', $currentVIPPackageId)->get();
        $user_id = auth()->id();
        $room = Rooms::where('user_id', $user_id)->orderBy('id', 'desc')->get();


        return view('admin.content.rooms.my_room', compact('room','vipPackages'));
    }

    public function allRooms()
    {
        $room = Rooms::orderBy('id','desc')->get();

        return view('admin.content.rooms.all_rooms', compact('room'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function viewPendingRooms(string $id)
    {
        $room         = Rooms::find($id);
        $getUserId    = $room->user_id;
        $getClassRoom = $room->rooms_class_id;
        $ClassRoom    = RoomsClassification::find($getClassRoom);
        $getUser      = User::find($getUserId);
        // Tính khoảng thời gian từ khi bài được đăng
        $createdDate = Carbon::parse($room->created_at);
        $now         = Carbon::now();

        // Kiểm tra và tính toán để hiển thị theo giờ hoặc ngày
        if ($createdDate->diffInHours($now) < 24) {
            // Nếu dưới 24 giờ, hiển thị số giờ
            $timePosted = (int)$createdDate->diffInHours($now) . ' giờ trước';
        } else {
            // Nếu trên 24 giờ, hiển thị số ngày
            $timePosted = (int)$createdDate->diffInDays($now) . ' ngày trước';
        }
        //trả du lieu kieu json ve mang 48 -> da nang
        $getProvince
            = $this->VietMapProviders->getProvinceData($room->province);
        $getDistrict
            = $this->VietMapProviders->getDistrictData($room->province);
        //        $districtData = json_encode($getDistrict->getContent(),true);
        $provinceData = json_decode($getProvince->getContent(), true);

        return view('admin.content.rooms.view_room',
            compact('room', 'getUser', 'timePosted', 'ClassRoom',
                'provinceData', 'getDistrict'));
    }
    public function accpectRoom(Request $request, $id)
    {
        $room = Rooms::find($id);
        if ($room) {
            $room->status = 1;
            $room->save();
            return redirect()->back()->with('success', 'Đã duyệt bài viết.');
        }
        return redirect()->back()->with('error', 'Không tìm thấy bài viết.');

    }
    public function denialRoom(Request $request, $id)
    {
        $room = Rooms::find($id);
        if ($room) {
            $room->status = 3;
            $room->save();
            return redirect()->back()->with('success', 'Đã từ chối bài viết.');
        }
        return redirect()->back()->with('error', 'Không tìm thấy bài viết.');

    }

    public function getPendingRooms()
    {

        $room = Rooms::where('status', '=', '0')->get();

        return view('admin.content.rooms.pending_rooms', compact('room'));

    }

    public function create()
    {
        $getAllClassRoom = RoomsClassification::all();
        //        dd($getAllClassRoom);
        $getIdUser = \auth()->id();
        $userData  = User::find($getIdUser);
        $provinces = $this->VietMapProviders->getProvinces();

        return view('admin.content.rooms.create',
            compact('provinces', 'userData', 'getAllClassRoom'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'title'          => 'required|unique:rooms|max:255',
            'description'    => 'required|',
            'image'          => 'required|array|min:2',
            // yêu cầu tối thiểu 2 ảnh
            'price'          => 'required|numeric',
            'area'           => 'required|string',
            'slug'           => 'required|string',
            'status'         => 'required|integer',
            'full_address'   => 'required|string',
            'rooms_class_id' => 'required|integer',
            'gender_rental'  => 'required|integer',
            'video'          => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
            'video_url'      => 'nullable|url',
        ], [
                'title.required'       => 'Vui lòng nhập tên tiêu đề',
                'description.required' => 'Vui lòng nhập mô tả phòng',
                'price.required'       => 'Vui lòng giá phòng ',
                'area.required'        => 'Vui lòng nhập diện tích phòng ',
                'image.required'       => 'Vui lòng thêm hình ảnh',
                'image.array'          => 'Vui lòng thêm 2 ảnh để cho ADMIN duyệt nhanh hơn nhé',

                'image.min'               => 'Vui lòng tải lên ít nhất 2 hình ảnh',
                'rooms_class_id.required' => 'Vui lòng chọn kiểu phòng ',

            ]
        );
        //
        $room             = new Rooms();
        $room->user_id    = \auth()->id();
        $room->title      = $data['title'];
        $data['province'] = $request->input('province');
        $room->province   = $data['province'];
        $data['district'] = $request->input('district');
        $room->district   = $data['district'];
        //        $room->district          = $data['district'];
        $room->slug           = $data['slug'];
        $room->status         = $data['status'];
        $room->full_address   = $data['full_address'];
        $room->description    = $data['description'];
        $room->price          = $data['price'];
        $room->rooms_class_id = $data['rooms_class_id'];
        $room->gender_rental  = $data['gender_rental'];
        $room->area           = $data['area'];
        $room->video          = $data['video'] ?? null;
        $room->video_url      = $data['video_url'] ?? null;
        // Handle image upload
        $images = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $img) {
                $path           = 'uploads/rooms/';
                $get_name_image = $img->getClientOriginalName();
                $name_image     = current(explode('.', $get_name_image));
                $new_image      = $name_image . rand(0, 99) . '.'
                                  . $img->getClientOriginalExtension();
                $img->move($path, $new_image);
                $images[] = $new_image;  // Add each image to the array
            }
            $room->image = json_encode($images);  // Save images as JSON
        }

        //        // Save the room to the database
        $room->save();

        return redirect()->route('admin.rooms.myRooms')
                         ->with('status', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $utilities       = Utility::all();
        $provinces       = $this->VietMapProviders->getProvinces();
        $getAllClassRoom = RoomsClassification::all();
        $room            = Rooms::find($id);
        $getIdUser       =  $room->user_id;

        $userData = User::find($getIdUser);

        return view('admin_core.content.rooms.edit',
            compact('room', 'provinces', 'getAllClassRoom', 'userData','utilities'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate input
        $data = $request->validate([
            'title'          => 'required|max:255|unique:rooms,title,' . $id,
            'description'    => 'required',
            'image'          => 'nullable|array|min:1',
            'price'          => 'required|numeric',
            'area'           => 'required|string',
            'slug'           => 'required|string',
            'status'         => 'required|integer',
            'full_address'   => 'required|string',
            'rooms_class_id' => 'required|integer',
            'gender_rental'  => 'required|integer',
            'utilities'      => 'required|array',
            'video'          => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
            'video_url'      => 'nullable|url',
        ], [
            'title.required'          => 'Vui lòng nhập tên tiêu đề',
            'description.required'    => 'Vui lòng nhập mô tả phòng',
            'price.required'          => 'Vui lòng nhập giá phòng',
            'area.required'           => 'Vui lòng nhập diện tích phòng',
            'rooms_class_id.required' => 'Vui lòng chọn kiểu phòng',
            'utilities.required'      => 'Vui lòng chọn ít nhất một tiện ích',
        ]);

        // Tìm phòng cần cập nhật
        $room = Rooms::findOrFail($id);

        // Cập nhật các thuộc tính cơ bản
        $room->user_id        = auth()->id();
        $room->title          = $data['title'];
        $room->slug           = Str::slug($data['title']);
        $room->status         = $data['status'];
        $room->full_address   = $data['full_address'];
        $room->description    = $data['description'];
        $room->price          = $data['price'];
        $room->rooms_class_id = $data['rooms_class_id'];
        $room->gender_rental  = $data['gender_rental'];
        $room->area           = $data['area'];
        $room->video          = $data['video'] ?? null;
        $room->video_url      = $data['video_url'] ?? null;

        // Xử lý cập nhật hình ảnh
        if ($request->hasFile('image')) {
            $images = [];
            foreach ($request->file('image') as $img) {
                $path           = 'uploads/rooms/';
                $get_name_image = $img->getClientOriginalName();
                $name_image     = current(explode('.', $get_name_image));
                $new_image      = $name_image . rand(0, 99) . '.' . $img->getClientOriginalExtension();
                $img->move($path, $new_image);
                $images[] = $new_image;
            }
            $room->image = json_encode($images);  // Cập nhật danh sách ảnh mới
        }

        // Cập nhật tiện ích (utilities)
        if ($request->has('utilities')) {
            $utilities = $request->input('utilities'); // Mảng utilities được chọn
            $room->utilities()->sync($utilities);     // Sử dụng sync để cập nhật bảng trung gian
        }

        // Lưu thay đổi vào cơ sở dữ liệu
        $room->save();

        return redirect()->route('admin.rooms.myRooms')
                         ->with('status', 'Cập nhật phòng thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Rooms::find($id);

        if ( ! $room) {
            return redirect()->back()
                             ->with('error', 'Không tìm thấy phòng trọ!');
        }

        // Xóa dữ liệu
        $room->delete();

        return redirect()->back()
                         ->with('success', 'Xóa phòng trọ thành công!');
    }

    public function getDistricts($provinceId)
    {
        $districts = $this->vietnamMapService->getDistricts($provinceId);

        return response()->json($districts);
    }

    public function getWards($districtId)
    {
        $wards = $this->vietnamMapService->getWards($districtId);

        return response()->json($wards);
    }

}
