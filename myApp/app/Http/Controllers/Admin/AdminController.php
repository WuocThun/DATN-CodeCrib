<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use App\Providers\VietMapProviders;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {
        return view("admin.inc.index");
    }

    public function adminCore()
    {
        return view("admin_core.content.test");
    }

    public function reportSystem(Request $request)
    {

        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $blog_count = DB::table('blogs')
                        ->whereBetween('created_at', [$start_date, $end_date])
                        ->count();

        $user_count = DB::table('users')
                        ->whereBetween('created_at', [$start_date, $end_date])
                        ->count();

        $active_room_count = DB::table('rooms')
                               ->where('status', 'active')
                               ->whereBetween('created_at',
                                   [$start_date, $end_date])
                               ->count();

        $contract_count = DB::table('contracts')
                            ->whereBetween('created_at',
                                [$start_date, $end_date])
                            ->count();

        $active_contract_count = DB::table('contracts')
                                   ->where('status', 'active')
                                   ->whereBetween('created_at',
                                       [$start_date, $end_date])
                                   ->count();

        $room_count = DB::table('rooms')
                        ->whereBetween('created_at', [$start_date, $end_date])
                        ->count();

        $invoice_count = DB::table('invoices')
                           ->whereBetween('created_at',
                               [$start_date, $end_date])
                           ->count();

        $pending_invoice_count = DB::table('invoices')
                                   ->where('status', 'pending')
                                   ->whereBetween('created_at',
                                       [$start_date, $end_date])
                                   ->count();

        $chart_data = [
            'labels' => [
                'Tháng 1',
                'Tháng 2',
                'Tháng 3',
                'Tháng 4',
                'Tháng 5',
                'Tháng 6',
            ],
            'data'   => [100, 200, 300, 400, 500, 600],
        ];

        $totalContracts       = DB::table('contracts')->count();
        $activeContractsCount = DB::table('contracts')
                                  ->where('status', 'active')->count();
        $totalRooms           = DB::table('rooms')->count();
        $totalFailedJobs      = DB::table('failed_jobs')->count();

        // Hóa đơn
        $totalInvoices    = DB::table('invoices')->count();
        $totalUsers       = DB::table('users')->count();
        $vipUsersCount    = DB::table('users')->where('is_vip', 1)->count();
        $totalIncome      = DB::table('invoices')->where('status', 'paid')
                              ->sum('total_amount');
        $pendingInvoices  = DB::table('invoices')->where('status', 'pending')
                              ->count();
        $activeRoomsCount = DB::table('rooms')->where('status', 1)->count();
        $totalBlogs       = DB::table('blogs')->count();

        // Thống kê hóa đơn hàng tháng
        $monthlyIncome = DB::table('invoices')
                           ->select(DB::raw('MONTH(created_at) as month'),
                               DB::raw('SUM(total_amount) as total'))
                           ->where('status', 'paid')
                           ->groupBy('month')
                           ->orderBy('month')
                           ->get();

        // Tạo mảng dữ liệu biểu đồ
        $chartData = [
            'labels' => $monthlyIncome->pluck('month')->map(function ($month) {
                return "Tháng $month";
            }),
            'data'   => $monthlyIncome->pluck('total'),
        ];
        // Chi tiết người dùng
        $users = DB::table('users')
                   ->select('id', 'name', 'email', 'is_vip', 'created_at')
                   ->orderBy('created_at', 'desc')
                   ->get();

        // Danh sách phòng đang hoạt động
        $activeRooms = DB::table('rooms')
                         ->where('status', 1)
                         ->select('id', 'title', 'province', 'district',
                             'price', 'created_at')
                         ->get();

        $blogCount           = $this->getBlogCount();
        $userCount           = $this->getUserCount();
        $vipUserCount        = $this->getVipUserCount();
        $contractCount       = $this->getContractCount();
        $activeContractCount = $this->getActiveContractCount();
        $roomCount           = $this->getRoomCount();
        $activeRoomCount     = $this->getActiveRoomCount();
        $failedJobCount      = $this->getFailedJobCount();
        $invoiceCount        = $this->getInvoiceCount();
        $pendingInvoiceCount = $this->getPendingInvoiceCount();
        $totalIncome         = $this->getTotalIncome();
        $blogCount           = $this->getBlogCount();

        $monthlyIncome = $this->getMonthlyIncome();
        $chartData     = $this->getChartData($monthlyIncome);

        $users       = $this->getUsers();
        $activeRooms = $this->getActiveRooms();
        // Gửi dữ liệu qua view
        $statistics = [
            'blog_count'             => $blogCount,
            'user_count'             => $userCount,
            'vip_user_count'         => $vipUserCount,
            'contract_count'         => $contractCount,
            'active_contract_count'  => $activeContractCount,
            'room_count'             => $roomCount,
            'active_room_count'      => $activeRoomCount,
            'failed_job_count'       => $failedJobCount,
            'invoice_count'          => $invoiceCount,
            'pending_invoice_count'  => $pendingInvoiceCount,
            //            'chart_data'             => $chartData,
            'total_blogs'            => $totalBlogs,
            'total_users'            => $totalUsers,
            'vip_users_count'        => $vipUsersCount,
            'total_contracts'        => $totalContracts,
            'active_contracts_count' => $activeContractsCount,
            'total_rooms'            => $totalRooms,
            'active_rooms_count'     => $activeRoomsCount,
            'total_failed_jobs'      => $totalFailedJobs,
            'total_invoices'         => $totalInvoices,
            'pending_invoices'       => $pendingInvoices,
            'total_income'           => $totalIncome,
            'users'                  => $users,
            'active_rooms'           => $activeRooms,
        ];
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
        $roomsByProvince = DB::table('rooms')
                             ->select('province', DB::raw('COUNT(*) as count'))
                             ->groupBy('province')
                             ->get();
        //dd($statistics['blog_count']);
        return view('admin_core.content.system.statistics',
            compact('statistics', 'totalUsers', 'vipUsersCount', 'totalIncome',
                'pendingInvoices', 'activeRoomsCount', 'totalBlogs',
                'chartData', 'blog_count',
                'user_count',
                'active_room_count',
                'contract_count',
                'active_contract_count',
                'roomsByProvince',
                'room_count',
                'invoice_count',
                'allProvinceData',
                'pending_invoice_count',
                'chart_data'));
    }
    //        public function reportSystem()
    //        {
    //            $blogCount           = $this->getBlogCount();
    //            $userCount           = $this->getUserCount();
    //            $vipUserCount        = $this->getVipUserCount();
    //            $contractCount       = $this->getContractCount();
    //            $activeContractCount = $this->getActiveContractCount();
    //            $roomCount           = $this->getRoomCount();
    //            $activeRoomCount     = $this->getActiveRoomCount();
    //            $failedJobCount      = $this->getFailedJobCount();
    //            $invoiceCount        = $this->getInvoiceCount();
    //            $pendingInvoiceCount = $this->getPendingInvoiceCount();
    //            $totalIncome         = $this->getTotalIncome();
    //
    //            $monthlyIncome = $this->getMonthlyIncome();
    //            $chartData     = $this->getChartData($monthlyIncome);
    //
    //            $users       = $this->getUsers();
    //            $activeRooms = $this->getActiveRooms();
    //
    //            $statistics = [
    //                'blog_count'            => $blogCount,
    //                'user_count'            => $userCount,
    //                'vip_user_count'        => $vipUserCount,
    //                'contract_count'        => $contractCount,
    //                'active_contract_count' => $activeContractCount,
    //                'room_count'            => $roomCount,
    //                'active_room_count'     => $activeRoomCount,
    //                'failed_job_count'      => $failedJobCount,
    //                'invoice_count'         => $invoiceCount,
    //                'pending_invoice_count' => $pendingInvoiceCount,
    //                'total_income'          => $totalIncome,
    //                'users'                 => $users,
    //                'active_rooms'          => $activeRooms,
    //                'chart_data'            => $chartData,
    //            ];
    //
    //            // Gửi dữ liệu qua view
    //            return view('admin_core.content.system.statistics', $statistics);
    //        }

    private function getBlogCount()
    {
        return DB::table('blogs')->count();
    }

    private function getUserCount()
    {
        return DB::table('users')->count();
    }

    private function getVipUserCount()
    {
        return DB::table('users')->where('is_vip', 1)->count();
    }

    private
    function getContractCount()
    {
        return DB::table('contracts')->count();
    }

    private
    function getActiveContractCount()
    {
        return DB::table('contracts')->where('status', 'active')->count();
    }

    private
    function getRoomCount()
    {
        return DB::table('rooms')->count();
    }

    private
    function getActiveRoomCount()
    {
        return DB::table('rooms')->where('status', 1)->count();
    }

    private
    function getFailedJobCount()
    {
        return DB::table('failed_jobs')->count();
    }

    private
    function getInvoiceCount()
    {
        return DB::table('invoices')->count();
    }

    private
    function getPendingInvoiceCount()
    {
        return DB::table('invoices')->where('status', 'pending')->count();
    }

    private
    function getTotalIncome()
    {
        return DB::table('invoices')->where('status', 'paid')
                 ->sum('total_amount');
    }

    private
    function getMonthlyIncome()
    {
        return DB::table('invoices')
                 ->select(DB::raw('MONTH(created_at) as month'),
                     DB::raw('SUM(total_amount) as total'))
                 ->where('status', 'paid')
                 ->groupBy('month')
                 ->orderBy('month')
                 ->get();
    }

    private
    function getChartData(
        $monthlyIncome
    ) {
        return [
            'labels' => $monthlyIncome->pluck('month')->map(function ($month) {
                return "Tháng $month";
            }),
            'data'   => $monthlyIncome->pluck('total'),
        ];
    }

    private
    function getUsers()
    {
        return DB::table('users')
                 ->select('id', 'name', 'email', 'is_vip', 'created_at')
                 ->orderBy('created_at', 'desc')
                 ->get();
    }

    private
    function getActiveRooms()
    {
        return DB::table('rooms')
                 ->where('status', 1)
                 ->select('id', 'title', 'province', 'district', 'price',
                     'created_at')
                 ->get();
    }

}
