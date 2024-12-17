<?php

namespace App\Providers;

use App\Models\User;
use App\Models\UserRequest;
use App\Providers\VietMapProviders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\RoomsClassification;
use App\Models\Rooms;
use App\Models\Blogs;
use Illuminate\Support\Facades\DB;
use App\Models\Motel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(VietMapProviders::class, function ($app) {
            return new VietMapProviders();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        View::composer([
            'fe.inc.header',
            'fe.inc.search_bar',
            'fe.inc.fitler_blogs_right',
        ], function ($view) {
            // Lấy tất cả các tỉnh (province) từ bảng Rooms
            $provincesIds = Rooms::pluck('province')->unique();
            // Mảng để chứa tất cả dữ liệu tỉnh
            $randomRooms     = Rooms::inRandomOrder()->take(5)->get();
            $allProvinceData = [];

            // Duyệt qua các ID tỉnh
            foreach ($provincesIds as $provinceId) {
                // Gọi API để lấy thông tin tỉnh
                $vietMapProvider = app(VietMapProviders::class);
                $getProvince = $vietMapProvider->getProvinceData($provinceId);

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


            // Lấy danh sách phòng để truyền vào navbar
            $clasRoom    = RoomsClassification::take(3)->get();
            $randomBlogs = Blogs::inRandomOrder()->take(2)->get();

            // Truyền các dữ liệu vào view
            $view->with([
                'clasRoom'     => $clasRoom,
                'provinceData' => $allProvinceData,
                'randomRooms'  => $randomRooms,
                'randomBlogs'  => $randomBlogs,
            ]);
        });
//        View::composer([
//            'fe.inc.hot_zone',
//        ], function ($view) {
//
//            $provincesIds = Rooms::select('province',
//                DB::raw('count(*) as room_count'))
//                                 ->groupBy('province')  // Group by tỉnh thành
//                                 ->orderByDesc('room_count')  // Sắp xếp theo số lượng phòng giảm dần
//                                 ->limit(3)  // Lấy 3 tỉnh thành có số phòng cao nhất
//                                 ->get();
//            foreach ($provincesIds as $provinceId) {
//                // Gọi API để lấy thông tin tỉnh
//                $vietMapProvider = app(VietMapProviders::class);
//                $getProvince = $vietMapProvider->getProvinceData($provinceId->province);
//                // Giải mã JSON trả về
//                $provinceData = json_decode($getProvince->getContent(), true);
//
//                // Kiểm tra nếu dữ liệu trả về là mảng, nếu không thì tạo thành mảng
//                if (is_array($provinceData)) {
//                    $allProvinceData[] = $provinceData; // Thêm vào mảng kết quả
//                } else {
//                    $allProvinceData[]
//                        = [$provinceData]; // Đảm bảo dữ liệu luôn là mảng
//                }
//                $allProvinceData1= $provinceData;
//            }
////        var_dump($allProvinceData1['province_name']);
//            // Truyền các dữ liệu vào view
//            $view->with([
//                'provinceData' => $provinceData,
//            ]);
//        });
        View::composer(['fe.inc.hot_zone'], function ($view) {
            // Lấy 3 tỉnh thành có số lượng phòng cao nhất
            $provinces = Rooms::select('province', DB::raw('count(*) as room_count'))
                              ->groupBy('province')
                              ->orderByDesc('room_count')
                              ->limit(3)
                              ->get();

            $allProvinceData = [];

            foreach ($provinces as $province) {
                // Gọi API để lấy thông tin tỉnh
                $vietMapProvider = app(VietMapProviders::class);
                $response = $vietMapProvider->getProvinceData($province->province);

                // Giải mã JSON trả về
                $provinceData = json_decode($response->getContent(), true);

                // Kiểm tra và thêm dữ liệu vào mảng kết quả
                if (is_array($provinceData)) {
                    $allProvinceData[] = $provinceData;
                }
            }

            // Truyền dữ liệu vào view
            $view->with('allProvinceData', $allProvinceData);
        });
        //Bộ lọc
        View::composer('fe.fitler_price', function ($view) {
            $request     = request();
            $query       = Rooms::query();
            $randomRooms = Rooms::inRandomOrder()->take(3)->get();

            // Lọc theo giá nếu `min_price` và `max_price` có trong request
            if ($request->has('min_price') && $request->has('max_price')) {
                $query->whereBetween('price',
                    [$request->min_price, $request->max_price]);
            } elseif ($request->has('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }
            if ($request->has('orderby')) {
                $orderBy = $request->get('orderby');
                if ($orderBy == 'moi-nhat') {
                    // Nếu giá trị là 'moi-nhat', sắp xếp theo ID giảm dần (mới nhất trước)
                    $query->orderBy('id', 'desc');
                } elseif ($orderBy == 'mac-dinh') {
                    // Nếu giá trị là 'mac-dinh', sắp xếp theo ID tăng dần (theo mặc định)
                    $query->orderBy('id', 'asc');
                } else {
                    // Nếu giá trị không phải là 'moi-nhat' hoặc 'mac-dinh', bạn có thể sử dụng sắp xếp mặc định
                    $query->orderBy('id', 'asc');
                }
            }
            $rooms = $query->paginate(7);;

            // Lấy dữ liệu và truyền vào view
            $view->with('rooms', $rooms,);
        });
        View::composer('fe.inc.over_view', function ($view) {
            // Đếm tất cả người dùng
            $getAllUser = User::count();
            $getAllRooms= Rooms::count();
            $getMotel = Motel::count();
            $getUserMotel = UserRequest::count();

            // Truyền biến vào view
            $view->with([
                'getAllUser' => $getAllUser,
                'getAllRooms' => $getAllRooms,
                'getMotel' => $getMotel,
                'getUserMotel' => $getUserMotel,
            ]);
        });
    }

}
