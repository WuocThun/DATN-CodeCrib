<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\RoomsClassification;
use App\Models\Rooms;
use App\Providers\VietMapProviders;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function __construct(VietMapProviders $vietnamMapService)
    {
        $this->VietMapProviders = $vietnamMapService;
    }

    public function index()
    {
        $provinces = $this->VietMapProviders->getProvinces();

        return view('admin.content.rooms.index', compact('provinces'));
    }

    public function myRooms()
    {
        $user_id = auth()->id();
        $room    = Rooms::where('user_id', $user_id)->get();

        return view('admin.content.rooms.my_room', compact('room'));
    }

    public function allRooms()
    {
        $room = Rooms::all();

        return view('admin.content.rooms.all_rooms', compact('room'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function viewPendingRooms(string $id)
    {
        $room = Rooms::find($id);
        $getUserId = $room->user_id;
        $getClassRoom = $room->rooms_class_id;
        $ClassRoom = RoomsClassification::find($getClassRoom);
        $getUser = User::find($getUserId);
        // Tính khoảng thời gian từ khi bài được đăng
        $createdDate = Carbon::parse($room->created_at);
        $now = Carbon::now();

        // Kiểm tra và tính toán để hiển thị theo giờ hoặc ngày
        if ($createdDate->diffInHours($now) < 24) {
            // Nếu dưới 24 giờ, hiển thị số giờ
            $timePosted = (int) $createdDate->diffInHours($now) . ' giờ trước';
        } else {
            // Nếu trên 24 giờ, hiển thị số ngày
            $timePosted = (int) $createdDate->diffInDays($now) . ' ngày trước';
        }
        //trả du lieu kieu json ve mang 48 -> da nang
        $getProvince = $this->VietMapProviders->getProvinceData($room->province);
        $getDistrict = $this->VietMapProviders->getDistrictData($room->province);
//        $districtData = json_encode($getDistrict->getContent(),true);
        $provinceData = json_decode($getProvince->getContent(), true);

        return view('admin.content.rooms.view_room',compact('room','getUser','timePosted','ClassRoom','provinceData','getDistrict'));
    }
    public function getPendingRooms()
    {
        $room = Rooms::where('status' ,'=', '0')->get();
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

                'image.min'               => 'Vui lòng tải lên ít nhất 2 hình ảnh',
                'rooms_class_id.required' => 'Vui lòng chọn kiểu phòng ',

            ]
        );
        //
        $room                 = new Rooms();
        $room->user_id        = \auth()->id();
        $room->title          = $data['title'];
        $data['province'] = $request->input('province');
        $room->province          = $data['province'];
        $data['district'] = $request->input('district');
        $room->district          = $data['district'];
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
        $provinces       = $this->VietMapProviders->getProvinces();
        $getAllClassRoom = RoomsClassification::all();
        $room            = Rooms::find($id);
        $getIdUser       = \auth()->id();

        $userData = User::find($getIdUser);

        return view('admin.content.rooms.edit',
            compact('room', 'provinces', 'getAllClassRoom', 'userData'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title'          => 'required|unique:rooms|max:255',
            'description'    => 'required|max:255',
            'price'          => 'required|numeric',
            'area'           => 'required|string',
            'slug'           => 'required|string',
            'status'         => 'required|integer',
            'full_address'   => 'required|string',
            'rooms_class_id' => 'required|integer',
            'gender_rental'  => 'required|integer',
            'video'          => 'nullable|mimes:mp4,mov,avi,wmv',
            'video_url'      => 'nullable|url',
        ], [
                //                'title.required'          => 'Vui lòng nhập tên tiêu đề',
                'description.required'    => 'Vui lòng nhập mô tả phòng',
                //           'image.required' => 'Vui lòng thêm hình ảnh',
                'price.required'          => 'Vui lòng giá phòng ',
                'area.required'           => 'Vui lòng nhập diện tích phòng ',
                //           'slug.required' => 'Vui lòng nhập  ',
                'rooms_class_id.required' => 'Vui lòng chọn kiểu phòng ',

            ]
        );
        //
        $room                 = Rooms::findOrFail($id);
        $room->user_id        = \auth()->id();
        $room->title          = $data['title'];
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

    public function indexCore()
        {
            return view ('admin_core.content.index');
        }
}
