<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\Blogs;
use App\Models\User;
use App\Providers\VietMapProviders;
use Carbon\Carbon;
use App\Models\RoomsClassification;
use App\Models\VIPPackage;
use App\Models\UserRequest;
use Illuminate\Support\Facades\View;

class IndexController extends Controller

{
//    public function getAllClassRoom()
//    {
//        $clasRoom =RoomsClassification::take(3)->get();
//        return view ('fe.inc.header',compact('clasRoom'));
//    }
    public function getLogin()
    {
        return view('fe.login');
    }
    public function getRegister()
    {
        return view('fe.register');
    }
    public function fitlerPrice()
    {
        return view('fe.fitler_price');
    }
    public  function  dichvu()
    {
        return view('fe.dichvu');
    }
    public function forgetpass()
    {
        return view('fe.forgetpass');
    }
    public function getClassIndex($slug)
    {

//        $rooms = Rooms::where('slug',$slug)->first();
        $getClass = RoomsClassification::where('slug',$slug)->first();
        $classId = $getClass->id;
        $rooms = Rooms::where('rooms_class_id',$classId)->paginate(4);
        return view('fe.index',compact('rooms'));
    }
    public function __construct(VietMapProviders $vietnamMapService)
    {
        $this->VietMapProviders = $vietnamMapService;
    }
    public function index()
    {

        $rooms = Rooms::orderByDesc('vip_package_id')->orderByDesc('created_at')->paginate(7);
        return view('fe.index',compact('rooms'));
    }
    public function indexBlog(){
        $blogs = Blogs::paginate(5);
        return view('fe.tintuc',compact('blogs'));
    }
    public function getProvinderRoom($id)
    {
        $rooms = Rooms::where('province',$id)->orderByDesc('id')->paginate(5);
        return view('fe.getProvinderRoom',compact('rooms'));
    }
    public function viewRequests()
    {

        //        $requests = UserRequest::orderBy('id','desc')->paginate(5);
        $requests = UserRequest::with('user', 'motel')->orderBy('id','desc')->latest()->paginate(7);
        return view('fe.kiemnguoioghep', compact('requests'));
    }
    public function getRoom($slug)
    {
        $room = Rooms::where('slug',$slug)->first();
        $utilities = $room->utilities;
        $getUserId = $room->user_id;
        $getClassRoom = $room->rooms_class_id;
        $getVipPackages =$room->vip_package_id;
        $vipPackages = VIPPackage::find($getVipPackages);
        $ClassRoom = RoomsClassification::find($getClassRoom);
        $findUser = User::find($getUserId)->first();
        $createdDate = Carbon::parse($room->created_at);
        $now = Carbon::now();
        if ($createdDate->diffInHours($now) < 24) {
            // Nếu dưới 24 giờ, hiển thị số giờ
            $timePosted = (int) $createdDate->diffInHours($now) . ' giờ trước';
        } else {
            // Nếu trên 24 giờ, hiển thị số ngày
            $timePosted = (int) $createdDate->diffInDays($now) . ' ngày trước';
        }

        $getProvince = $this->VietMapProviders->getProvinceData($room->province);
        $getDistrict = $this->VietMapProviders->getDistrictData($room->province);
        $provinceData = json_decode($getProvince->getContent(), true);

        return view('fe.chitiet',compact('room','findUser','timePosted','ClassRoom','provinceData','getDistrict','vipPackages','utilities'));
    }
    public function getBlog($slug)
    {

        $blog = Blogs::where('slug',$slug)->first();
        return view('fe.baiviet',compact('blog'));
    }
    public function searchRooms(Request $request)
    {
        // Lấy các giá trị tìm kiếm
        $roomClass = $request->input('room_class');
        $provinceId = $request->input('province_id');
        $price = $request->input('price');
        $area = $request->input('area');

        // Xây dựng query để lọc kết quả
        $query = Rooms::query();
        if ($roomClass) {
            $query->where('rooms_class_id', $roomClass);
        }
        if ($provinceId) {
            $query->where('province', $provinceId);
        }
        if ($price) {
            $query->where('price', $price);
        }
        if ($area) {
            $query->where('area', $area);
        }

        // Lấy kết quả tìm kiếm
        $rooms = $query->paginate(4);
//        dd($query->get());
        // Chuyển kết quả sang dạng JSON để trả về cho AJAX
        return view('fe.index',compact('rooms'));
    }
}

