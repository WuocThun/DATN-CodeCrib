<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Invoice;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Motel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\UserRequest;
use App\Providers\VietMapProviders;

class MotelController extends Controller
{

    public function __construct(VietMapProviders $vietnamMapService)
    {
        $this->VietMapProviders = $vietnamMapService;
    }

    public function getMotel($slug)
    {
        $motel = Motel::where('slug',$slug)->first();
        return view('fe.chitietphhongtro',compact('motel'));
    }

    public function createRequest(Request $request)
    {
        $existingRequest = UserRequest::where('user_id', auth()->id())
                                      ->where('motel_id', $request->motel_id)
                                      ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error',
                'Bạn chỉ được đăng một bài viết cho phòng trọ này!');
        }

        // Xác thực dữ liệu
        $request->validate([
            'motel_id'    => 'required|exists:motel,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|array',
        ]);
        $data            = $request->all();
        $data['user_id'] = Auth::id();

        $images = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $img) {
                $path      = 'uploads/request/';
                $new_image = time() . '_' . uniqid() . '.'
                             . $img->getClientOriginalExtension(); // Tạo tên file unique
                $img->move(public_path($path),
                    $new_image); // Lưu ảnh vào thư mục public/uploads/room_request
                $images[] = $path . $new_image; // Lưu đường dẫn đầy đủ
            }
            $data['image'] = json_encode($images);
        }

        UserRequest::create($data);

        return redirect()->back()->with('success',
            'Bài đăng tìm người ở cùng đã được tạo!');
    }

    public function roomAccess()
    {
        $getUserId = Auth::id();
        $getUser   = User::findOrFail($getUserId);
        //        dd ($getUserId);
        $motel       = Motel::find($getUser->motel_id);


        //        dd($motels);
        return view('admin_core.content.motel.room-access',
            compact('motel', ));
    }

    public function checkPasscode(Request $request)
    {
        // Lấy phòng dựa trên motel_id
        $motel = Motel::find($request->motel_id);

        // Kiểm tra nếu không có phòng
        if ( ! $motel) {
            return back()->with('error', 'Phòng không tồn tại.');
        }

        // Kiểm tra passcode
        if ($motel && $motel->password === $request->password) {
            // Mật khẩu đúng
            session()->put("motel_unlocked_{$motel->id}", true);

            return redirect()->back()
                             ->with('success', 'Bạn đã mở khoá thành công!');
        } else {
            // Mật khẩu sai
            return redirect()->back()
                             ->with('error', 'Mật khẩu không chính xác!');
        }
    }

    public function accessRoom(Request $request, $id)
    {
        $motel = Motel::findOrFail($id);

        // Kiểm tra xem password có đúng không
        if ($motel->password !== $request->input('password')) {
            return back()->with('error', 'Mã password không đúng.');
        }

        // Kiểm tra nếu người dùng đã được chấp nhận vào phòng
        $user = auth()->user();
        if ($user->motel_id !== $motel->id) {
            return back()->with('error',
                'Bạn không có quyền truy cập phòng này.');
        }

        // Cho phép truy cập phòng nếu password đúng
        return redirect()->route('motel.details',
            $motel->id); // Bạn có thể tạo route xem chi tiết phòng ở đây
    }

    public function leaveRoom(Request $request)
    {
        // Lấy thông tin người dùng đang đăng nhập
        $user = auth()->user();

        // Kiểm tra nếu người dùng không thuộc phòng nào
        if ( ! $user->motel_id) {
            return back()->with('error',
                'Bạn không thuộc phòng nào để rời khỏi.');
        }

        // Lấy thông tin phòng của người dùng
        $motel = Motel::find($user->motel_id);

        // Nếu không tìm thấy phòng
        if ( ! $motel) {
            return back()->with('error', 'Phòng bạn muốn rời không tồn tại.');
        }

        // Xóa liên kết giữa người dùng và phòng
        $user->update(['motel_id' => null]);

        return back()->with('success', 'Bạn đã rời khỏi phòng thành công.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userId      = Auth::id();
        $getAllMotel = Motel::where('user_id', $userId)->orderBy('id', 'desc')
                            ->get();
        //        $motels = Motel::with(['contracts.tenant'])
        //                       ->withCount(['users', 'contracts'])
        //                       ->where('user_id', $userId)
        //                       ->orderBy('id', 'desc')
        //                       ->get();
        $motels = Motel::with([
            'contracts' => function ($query) {
                $query->with('tenant'); // Lấy thông tin người thuê qua quan hệ tenant
            },
        ])
                       ->withCount([
                           'users',
                           'contracts',
                       ]) // Đếm số lượng users và contracts
                       ->where('user_id', $userId)
                       ->orderBy('id', 'desc')
                       ->get();

        return view('admin_core.content.motel.index',
            compact('getAllMotel', 'motels'));
    }

    public function storeUserMotel(Request $request, string $id)
    {
        $data       = $request->validate([
            'motel_id'     => 'required|string|max:255',
            'name'         => 'required|string|max:255',
            'phone_number' => 'required|digits:10',
            'password'     => 'required',
            'email'        => 'required',
            'cardIdNumber' => 'required',
        ], [
                'phone_number.required' => 'Số điện thoại phải đủ 10 số',
                'phone_number.digits'   => 'Số điện thoại phải đủ 10 số',
            ]
        );
        $getMotelId = $id;
        $motel      = Motel::findOrFail($data['motel_id']);
        //        dd ($motel->total_member);
        $currentMemberCount = User::where('motel_id', $data['motel_id'])
                                  ->count();
        // Giới hạn số lượng thành viên tối đa là 4
        if ($currentMemberCount >= $motel->total_member) {
            return redirect()->back()->with('error',
                'Phòng này đã đầy, không thể thêm thêm thành viên.');
        }

        // Lưu thành viên vào cơ sở dữ liệu
        //        $member               = new UserMotel();
        //        $member->motel_id     = $data['motel_id'];
        //        $member->name         = $data['name'];
        //        $member->phone_number = $data['phone_number'];
        //        $member->password     = $data['password']; // Mã hóa mật khẩu
        //        $member->save();

        $user                 = new User();
        $user->password       = Hash::make($data['password']);
        $user->email          = $data['email'];
        $user->phone_number   = $data['phone_number'];
        $user->motel_id       = $data['motel_id'];
        $user->name           = $data['name'];
        $user->card_id_number = $data['cardIdNumber'];
        $user->save();
        $user->assignRole('viewer');

        // Chuyển hướng về trang trước hoặc trả về thông báo thành công
        return redirect()->back()->with('success',
            'Thành viên đã được thêm thành công');
    }

    public function report()
    {
        // Thống kê người dùng
        $totalUsers             = User::count();
        $totalVipUsers          = User::where('is_vip', 1)->count();
        $usersWithoutMotel      = User::whereNull('motel_id')->count();
        $usersWithVerifiedEmail = User::whereNotNull('email_verified_at')
                                      ->count();

        // Thống kê phòng trọ
        $totalMotels    = Motel::count();
        $motelsByStatus = Motel::select('status',
            DB::raw('count(*) as total_by_status'))
                               ->groupBy('status')
                               ->get();

        // Thống kê hợp đồng
        $totalContracts    = Contract::count();
        $contractsByStatus = Contract::select('status',
            DB::raw('count(*) as total_by_status'))
                                     ->groupBy('status')
                                     ->get();

        // Thống kê hợp đồng mới theo tháng
        $contractsPerMonth
            = Contract::select(DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as contracts_per_month'))
                      ->groupBy(DB::raw('MONTH(created_at)'))
                      ->get();

        // Truyền dữ liệu vào view
        return view('admin_core.content.motel.motel_report', compact(
            'totalUsers',
            'totalVipUsers',
            'usersWithoutMotel',
            'usersWithVerifiedEmail',
            'totalMotels',
            'motelsByStatus',
            'totalContracts',
            'contractsByStatus',
            'contractsPerMonth',
        //            'motelsPerMonth'
        ));
    }

    public function addUserMotel(Request $request, string $id)
    {
        $motelId  = $id;
        $getMotel = Motel::findOrFail($id);

        $getUserRentMotel = User::where('motel_id', $motelId)->get();

        return view('admin_core.content.motel.addUserMotel',
            compact('getMotel', 'getUserRentMotel'));

    }

    public function create()
    {
        $provinces = $this->VietMapProviders->getProvinces();

        return view('admin_core.content.motel.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'             => 'required|max:255',
            'money'            => 'required|numeric',
            'default_electric' => 'required|numeric',
            'default_water'    => 'required|numeric',
            'money_water'      => 'required|numeric',
            'province'         => 'nullable',
            'district'         => 'nullable',
            'full_address'     => 'nullable',
            'money_electric'   => 'required|numeric',
            'money_date'       => 'required|date',
            'kind_motel'       => 'required|in:0,1',
            'money_another'    => 'nullable|numeric',
            'money_wifi'       => 'nullable|numeric',
            'status'           => 'required',
            'total_member'     => 'required',

        ], [
                'name.required'             => 'Vui lòng nhập tên phòng',
                'money.required'            => 'Vui lòng nhập số tiền hàng tháng',
                'default_electric.required' => 'Vui lòng nhập số điện hiện tại',
                'default_water.required'    => 'Vui lòng nhập số nước hiện tại',
                'money_water.required'      => 'Vui lòng nhập số tiền nước trên 1 số',
                'money_electric.required'   => 'Vui lòng nhập số điên  trên 1 số',
                'money_date.required'       => 'Vui lòng nhập số ngày mà cần thu hàng tháng',
                'kind_motel.required'       => 'Vui lòng nhập số ngày mà cần thu hàng tháng',
                'money_another.required'    => 'Vui lòng nhập số ngày mà cần thu hàng tháng',
                'money_wifi.required'       => 'Vui lòng nhập số ngày mà cần thu hàng tháng',
                'status.required'           => 'Vui lòng nhập số ngày mà cần thu hàng tháng',
            ]
        );
        try {
            $motel                   = new Motel();
            $motel->user_id          = auth()->id();
            $motel->name             = $data['name'];
            $motel->slug             = Str::slug($data['name']);
            $motel->money            = $data['money'];
            $motel->default_electric = $data['default_electric'];
            $motel->province         = $data['province'];
            $motel->district         = $data['district'];
            $motel->full_address     = $data['full_address'];
            $motel->default_water    = $data['default_water'];
            $motel->money_electric   = $data['money_electric'];
            $motel->money_water      = $data['money_water'];
            $motel->money_wifi       = $data['money_wifi'];
            $motel->total_member     = $data['total_member'];
            $motel->money_another    = $data['money_another'];
            $motel->password         = rand(1111111, 99999999);
            //        $motel->money_date = $data['money_date'] ?? Carbon::now();
            $motel->money_date = isset($data['money_date'])
                ? Carbon::parse($data['money_date'])->addMonth()
                : Carbon::now()->addMonth();
            $motel->kind_motel = $data['kind_motel'];
            $motel->status     = $data['status'];
            //        dd( );
            $motel->save();

            // Gửi thông báo
            return redirect()->route('admin.motel.index')
                             ->with('success',
                                 'Phòng trọ đã được thêm thành công.');
        } catch (\Exception $e) {
            // Gửi thông báo thất bại

            return redirect()->back()
                             ->withInput($request->all()) // Trả dữ liệu cũ về form
                             ->with('error',
                    'Đã xảy ra lỗi trong quá trình thêm phòng trọ. Vui lòng thử lại!');
        }
    }

    public function show(string $id)
    {

        //        $motel->name          = $request->get('name');
        //        $motel->money          = $request->get('money');
        //        $motel->default_electric          = $request->get('default_electric');
        //        $motel->default_water          = $request->get('default_water');
        //        $motel->money_electric          = $request->get('money_electric');
        //        $motel->money_water          = $request->get('money_water');
        //        $motel->money_wifi          = $request->get('money_wifi');
        //        $motel->money_date          = $request->get('money_date');
        //        $motel->kind_motel          = $request->get('kind_motel');
        //        $motel->status          = $request->get('status');
    }

    public function edit(string $id, Request $request)
    {

        // Lấy thông tin phòng trọ dựa trên ID
        $motel = Motel::find($id);

        $invoice = Invoice::where('motel_id', $id)->first();
        if ( ! $motel) {
            return redirect()->route('admin.motel.index')
                             ->with('error', 'Không tìm thấy phòng trọ!');
        }

        // Trả về view chỉnh sửa với dữ liệu phòng trọ
        return view('admin_core.content.motel.edit',
            compact('motel', 'invoice'));
    }

    public function update(Request $request, string $id)
    {
        // Validate dữ liệu
        $invoice = Invoice::where('motel_id', $id)->first();

        $request->validate([
            'name'             => 'required|string|max:255',
            'money'            => 'required|numeric|min:0',
            'default_electric' => 'required|integer|min:0',
            'default_water'    => 'required|integer|min:0',
            'money_electric'   => 'required|numeric|min:0',
            'money_water'      => 'required|numeric|min:0',
            'money_wifi'       => 'nullable|numeric|min:0',
            'money_another'    => 'nullable|numeric|min:0',
            'money_date'       => 'required|date',
            'kind_motel'       => 'required|integer|in:0,1,2',
            'status'           => 'required|boolean',
            'old_water'        => 'integer',
            'old_electric'     => 'integer',
            'new_electric'     => '',
            'new_water'        => '',

        ]);
        if (isset($invoice)) {
            $invoice->money        = $request->money;
            $invoice->old_electric = $request->default_electric;
            $invoice->old_water    = $request->default_water;

            $water_fee = ($request->new_water - $request->default_water)
                         * $request->money_water;
            //            $water_fee = ( $request->old_water - $request->new_water) * $request->money_water;
            $electric_fee = ($request->new_electric
                             - $request->default_electric)
                            * $request->money_electric;
            //            $electric_fee = ( $request->old_electric - $request->new_electric) * $request->money_electric;
            $invoice->money_water    = $request->money_water;
            $invoice->money_electric = $request->money_electric;
            $invoice->water_fee      = $water_fee;
            $invoice->electric_fee   = $electric_fee;
            $total_amout             = $water_fee + $electric_fee
                                       + $request->money
                                       + $request->money_another
                                       + $request->money_wifi;
            $invoice->total_amount   = $total_amout;
            $invoice->money_another  = $request->money_wifi
                                       + $request->money_another;

            $invoice->all_money = $total_amout;
            //            dd($invoice);
            $invoice->save();
        }
        $motel = Motel::findOrFail($id);

        //        dd($invoice);
        $motel->name             = $request->name;
        $motel->money            = $request->money;
        $motel->default_electric = $request->default_electric;
        $motel->default_water    = $request->default_water;
        $motel->money_electric   = $request->money_electric;
        $motel->money_water      = $request->money_water;
        $motel->money_wifi       = $request->money_wifi ?? 0;
        $motel->money_another    = $request->money_another ?? 0;
        $motel->money_date       = $request->money_date;
        $motel->kind_motel       = $request->kind_motel;
        $motel->status           = $request->status;

        $motel->save();

        // Redirect với thông báo thành công
        return redirect()->route('admin.motel.index')
                         ->with('success', 'Cập nhật phòng trọ thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $motel = Motel::find($id);

        if ( ! $motel) {
            return redirect()->route('admin.motel.index')
                             ->with('error', 'Không tìm thấy phòng trọ!');
        }

        // Xóa dữ liệu
        $motel->delete();

        return redirect()->route('admin.motel.index')
                         ->with('success', 'Xóa phòng trọ thành công!');
    }

}
