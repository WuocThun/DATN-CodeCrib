<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\RoomsClassificationController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\VIPController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\UtilityController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\WheelController;
use App\Http\Controllers\WhishlistController;
use App\Http\Controllers\Admin\MotelController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Exports\InvoiceExport;
use App\Http\Controllers\RoomRequestController;
use App\Http\Controllers\Admin\ContractController;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\VnpayController;

Route::get('/', [IndexController::class, 'index'])->name('welcome');
Route::get('/tin-tuc', [IndexController::class, 'indexBlog'])
     ->name('indexBlog');
//Route::get('/{room-slug}',[IndexController::class,'getRoom'])->name('getRoom');
Route::get('/phong/{slug}', [IndexController::class, 'getRoom'])
     ->name('getRoom');
Route::get('/dich-vu', [IndexController::class, 'dichvu'])->name('dichvu');
Route::get('/tinh/{id}', [IndexController::class, 'getProvinderRoom'])
     ->name('getProvinderRoom');
Route::get('/quen-mat-khau', [IndexController::class, 'forgetpass'])
     ->name('forgetpass');
Route::get('/bo-loc/phong', [IndexController::class, 'fitlerPrice'])
     ->name('boloc');
Route::get('/dich-vu/{slug}', [IndexController::class, 'getClassIndex'])
     ->name('laydichvu');
Route::get('/tin-tuc/{slug}', [IndexController::class, 'getBlog'])
     ->name('getBlog');
Route::get('/tim-kiem/phong', [IndexController::class, 'searchRooms'])
     ->name('searchRooms');
Route::get('/dang-nhap', [IndexController::class, 'getLogin'])
     ->name('getLogin');
Route::get('/dang-ky', [IndexController::class, 'getRegister'])
     ->name('getReginster');
Route::get('/viewRequests', [IndexController::class, 'viewRequests'])
     ->name('viewRequests');
Route::get('/phong-tro-con-trong', [RoomRequestController::class, 'index'])
     ->name('room-requests.index');
Route::resource('xac-minh', TwoFactorController::class)->names('xac-minh');
Route::post('/gui-binh-luan', [ReviewController::class, 'store'])
     ->name('reviews.store');

Route::get('404', function () {
    return view('404');
});
Route::group(['middleware' => ['auth']], function () {

    Route::post('/comments', [CommentController::class, 'store'])
         ->name('comments.store');

    Route::post('wishlist/add', [WhishlistController::class, 'addWishlist'])
         ->name('wishlist.add');
    Route::post('/wishlist/remove',
        [WhishlistController::class, 'removeWishlist'])
         ->name('wishlist.remove');
    Route::get('/wishlist', [WhishlistController::class, 'listWish'])
         ->name('wishlist.list');
    Route::post('/room-requests', [RoomRequestController::class, 'store'])
         ->name('room-requests.store');
    Route::patch('/room-requests/{id}/accept',
        [RoomRequestController::class, 'accept'])->name('room-requests.accept');
    Route::patch('/room-requests/{id}/reject',
        [RoomRequestController::class, 'reject'])->name('room-requests.reject');
    Route::post('/search-user', [RoomRequestController::class, 'searchUser'])
         ->name('search-user');
    Route::post('/invite-user', [RoomRequestController::class, 'inviteUser'])
         ->name('invite-user');

});

// Route group với middleware 'auth' và tiền tố 'admin'
Route::middleware('auth', 'two_factor')->prefix('admin')->name('admin.')
     ->group(function () {
         Route::group(['middleware' => ['auth']], function () {
             Route::get('/tat-ca-gop-y',
                 [ReviewController::class, 'getAllReview'])
                  ->name('reviews.getAllReview');
             Route::get('/tat-ca-binh-luan',
                 [CommentController::class, 'listAllComtent'])
                  ->name('comments.listAllComtent');
              // Route cho quản lý vai trò, chỉ cho phép người dùng có quyền quản lý vai trò
             Route::get("/", [AdminController::class, 'index'])->name('index');
             Route::get("/reportSystem",
                 [AdminController::class, 'reportSystem'])
                  ->name('reportSystem');
             //Phân quyền đành cho ADMIN
             Route::get('/addRole', [PermissionController::class, 'getAssgin'])
                  ->name('addRole')->middleware('permission:create role');
             Route::get('/allUser', [PermissionController::class, 'getAllUser'])
                  ->name('allUser')->middleware('permission:create role');
             Route::get('/getAssgin/{id}',
                 [PermissionController::class, 'assgin'])
                  ->name('assgin')->middleware('permission:assign role');
             Route::post('/insert_roles/{id}',
                 [PermissionController::class, 'insert_roles'])
                  ->name('insert_roles')->middleware('permission:assign role');
             Route::get('/permission/{id}',
                 [PermissionController::class, 'permission'])
                  ->name('permission')->middleware('permission:assign role');
             Route::post('/insert_permission/{id}',
                 [PermissionController::class, 'insert_permission'])
                  ->name('insert_permission')
                  ->middleware('permission:assign role');
             Route::post('/insert_permission',
                 [PermissionController::class, 'add_permisission'])
                  ->name('add_permisission')
                  ->middleware('permission:assign role');
             Route::resource('/createUser', PermissionController::class)
                  ->names('user')->middleware('permission:create role');
             Route::post('/permissions/{user}/assign-role',
                 [PermissionController::class, 'assignRole'])
                  ->name('assignRole')
                  ->middleware('permission:assign role');
             Route::post('/permissions/{user}/revoke-role',
                 [PermissionController::class, 'revokeRole'])
                  ->name('revokeRole')
                  ->middleware('permission:revoke role');
             Route::get('blogs/get_pending_blogs',
                 [BlogsController::class, 'get_pending_blogs'])
                  ->name('get_pending_blogs')
                  ->middleware('permission:manager blogs');
             Route::get('/blog-statistics', [BlogsController::class, 'report'])
                  ->name('blog.statistics');

             Route::PUT('blogs/accept_blog/{id}',
                 [BlogsController::class, 'accept_blog'])
                  ->name('blogs.accept_blog')
                  ->middleware('permission:manager blogs');
             Route::PUT('blogs/decline_blog/{id}',
                 [BlogsController::class, 'decline_blog'])
                  ->name('blogs.decline_blog')
                  ->middleware('permission:manager blogs');
             Route::get('blogs/preview_blogs/{id}',
                 [BlogsController::class, 'preview_blogs'])
                  ->name('blogs.preview_blogs')
                  ->middleware('permission:add blogs');
         });
         //? BLOGS CONTROLLER

         // Resource route cho BlogsController, kiểm tra quyền truy cập
         Route::group(['middleware' => ['auth']], function () {

             // Route cho quyền 'add blogs' với phương thức 'GET' cho 'create' và 'POST' cho 'store'
             Route::get('/blogs/index', [BlogsController::class, 'index'])
                  ->name('blogs.index')->middleware('permission:all blogs');
             Route::get('/blogs/myblogs', [BlogsController::class, 'myblogs'])
                  ->name('blogs.myblogs')
                  ->middleware('permission:view my blogs');
             Route::get('blogs/create', [BlogsController::class, 'create'])
                  ->name('blogs.create')->middleware('permission:add blogs');

             Route::post('/admin/blogs', [BlogsController::class, 'store'])
                  ->name('blogs.store')->middleware('permission:add blogs');

             // Route cho quyền 'edit blogs' với phương thức 'GET' cho 'edit' và 'PUT/PATCH' cho 'update'
             Route::get('blogs/{blog}/edit', [BlogsController::class, 'edit'])
                  ->name('blogs.edit')->middleware('permission:edit blogs');
             Route::put('blogs/{blog}', [BlogsController::class, 'update'])
                  ->name('blogs.update')->middleware('permission:edit blogs');
             Route::patch('blogs/{blog}', [BlogsController::class, 'update'])
                  ->name('blogs.update')->middleware('permission:edit blogs');

             // Route cho quyền 'delete blogs' với phương thức 'DELETE'
             Route::delete('blogs/{blog}',
                 [BlogsController::class, 'destroy'])->name('blogs.destroy')
                  ->middleware('permission:delete blogs');

         });
         //    ROOM CORE
         Route::group(['middleware' => ['auth']], function () {
             Route::get('/core', [AdminController::class, 'adminCore'])
                  ->name('dashboardCore');
             Route::get('/phong/phong-cua-toi',
                 [RoomController::class, 'myRoomsCore'])->name('phongcuatoi');
             Route::get('/phong/dang-tin-moi',
                 [RoomController::class, 'createCore'])
                  ->name('roomsCore.createCore');
             Route::post('phong/dang-tin-moi',
                 [RoomController::class, 'storeCore'])
                  ->name('roomsCore.storeCore');
             Route::get('lich-su-thanh-toan',
                 [RoomController::class, 'getPaymentRoom'])
                  ->name('getPaymentRoom');
         });
         //
         Route::group(['middleware' => ['auth']], function () {
             Route::get('/nap-the', [PaymentController::class, 'indexPayment'])
                  ->name('trangChuNapThe');
             Route::get('/nap-the/vnpay', [PaymentController::class, 'vnpay'])
                  ->name('vnpay');
             Route::post('/nap-the/vnpay', [VnpayController::class, 'vnpayPayment'])
                  ->name('vnpay.store');
             Route::get('/nap-the/lich-su',
                 [PaymentController::class, 'getHistoryPayment'])
                  ->name('lichSuNapThe');
             Route::get('/nap-the/bao-cao',
                 [PaymentController::class, 'report'])
                  ->name('payment.report');
         });
         // Resource route cho RoomController, kiểm tra quyền truy cập
         Route::group(['middleware' => ['auth']], function () {
             Route::resource('tien-ich', UtilityController::class)
                  ->names('utilities');

         });
         Route::group(['middleware' => ['auth']], function () {
             Route::get('/rooms/index', [RoomController::class, 'index'])
                  ->name('rooms.index')->middleware('permission:all blogs');
             Route::get('/rooms/create', [RoomController::class, 'create'])
                  ->name('rooms.create')->middleware('permission:all blogs');
             Route::get('/rooms/getPendingRooms',
                 [RoomController::class, 'getPendingRooms'])
                  ->name('rooms.getPendingRooms')
                  ->middleware('permission:all blogs');
             Route::get('/rooms/viewPendingRooms/{room}',
                 [RoomController::class, 'viewPendingRooms'])
                  ->name('rooms.viewPendingRooms')
                  ->middleware('permission:all blogs');
             Route::get('/rooms/allRooms', [RoomController::class, 'allRooms'])
                  ->name('rooms.allRooms')->middleware('permission:all blogs');
             Route::get('/rooms/myRooms', [RoomController::class, 'myRooms'])
                  ->name('rooms.myRooms');
             Route::post('/rooms/store', [RoomController::class, 'store'])
                  ->name('rooms.store')->middleware('permission:all blogs');
             Route::get('rooms/{id}/edit', [RoomController::class, 'edit'])
                  ->name('rooms.edit');
             Route::put('rooms/{id}', [RoomController::class, 'update'])
                  ->name('rooms.update')->middleware('permission:edit blogs');
             Route::post('room/{id}/accecpt',
                 [RoomController::class, 'accpectRoom'])
                  ->name('room.accpectRoom');
             Route::post('room/{id}/denial',
                 [RoomController::class, 'denialRoom'])
                  ->name('room.denialRoom');
             Route::get('room/report', [RoomController::class, 'report'])
                  ->name('room.report');
             Route::delete('rooms/{blog}',
                 [RoomController::class, 'destroy'])->name('rooms.destroy')
                  ->middleware('permission:delete blogs');
             Route::resource('/rooms_classification',
                 RoomsClassificationController::class)
                  ->names('rooms_classification')
                  ->middleware('permission:manager rooms_classification');
         });
         // Resource route cho UserController, kiểm tra quyền truy cập
         Route::group(['middleware' => ['auth']], function () {
             Route::get('paymentIndex', [UserController::class, 'paymentIndex'])
                  ->name('user.paymentIndex');
             Route::get('transferPayment',
                 [UserController::class, 'transferPayment'])
                  ->name('user.transferPayment');
             Route::post('transferPayment', [UserController::class, 'store'])
                  ->name('balance.store');
             Route::get('/update-password',
                 [ProfileController::class, 'editPassword'])
                  ->name('password.edit');
             Route::post('/update-password',
                 [ProfileController::class, 'updatePassword'])
                  ->name('profile.password.update');
             Route::get('/user-report', [UserController::class, 'report'])
                  ->name('user.report');
             Route::delete('/users/{id}', [UserController::class, 'deleteUser'])
                  ->name('users.delete');

             Route::get('/users/{id}/edit', [UserController::class, 'edit'])
                  ->name('users.edit');
             Route::put('/users/{id}', [UserController::class, 'update'])
                  ->name('users.update');

             Route::get('/payment', function () {
                 return view('admin.content.payment.payment');
             })->name('payment');

             Route::prefix('payment')->group(function () {
                 Route::get('mbbank', [PaymentController::class, 'index'])
                      ->name('payment.mbbank');
                 Route::get('historyPayment',
                     [PaymentController::class, 'getHistoryPayment'])
                      ->name('payment.historyPayment');
                 Route::post('mbbank/createPaymentLink',
                     [PaymentController::class, 'createPaymentLink'])
                      ->name('payment.mbbank.createPaymentLink');
                 Route::get('mbbank/success',
                     [PaymentController::class, 'successPayment'])
                      ->name('payment.mbbank.success');
                 Route::post('mbbank/success',
                     [PaymentController::class, 'successPayment']);
                 Route::post('vnpay/success',
                     [PaymentController::class, 'vnpaySuccess'])
                      ->name('payment.vnpay.success');
                 Route::get('mbbank/cancel',
                     [PaymentController::class, 'cancelPayment'])
                      ->name('payment.mbbank.cancel');
                 Route::post('mbbank/create',
                     [PaymentController::class, 'createOrder'])
                      ->name('payment.mbbank.create');
                 Route::get('mbbank/create/{id}',
                     [PaymentController::class, 'getPaymentLinkInfoOfOrder']);
                 Route::put('mbbank/create/{id}',
                     [PaymentController::class, 'cancelPaymentLinkOfOrder']);
                 Route::put('mbbank/payos',
                     [PaymentController::class, 'handlePayOSWebhook'])
                      ->name('payment.mbbank.payos');
             });
             Route::group(['middleware' => ['auth']], function () {
                 Route::get('/rooms/{room}/vip-packages',
                     [VIPController::class, 'showVIPPackages'])
                      ->name('vip.packages');
                 Route::post('/rooms/{room}/vip-purchase/{vipPackageId}',
                     [VIPController::class, 'purchaseVIPPackage'])
                      ->name('vip.purchase');
                 Route::post('/activate-vip',
                     [VIPController::class, 'activateVip']);
                 Route::post('/deactivate-vip',
                     [VIPController::class, 'deactivateVip']);
             });
         });
         Route::resource('vong-quay-may-man', WheelController::class)
              ->names('wheel');
         Route::post('/spin-wheel/reward', [WheelController::class, 'reward'])
              ->name('spin-wheel.reward');
         Route::get('/spin-wheel/reward', [WheelController::class, 'reward'])
              ->name('spin-wheel.reward');
         Route::post('/spin-wheel', [WheelController::class, 'spin'])
              ->name('spin.wheel');
         Route::group(['middleware' => ['auth']], function () {
             Route::get('contracts/create',
                 [ContractController::class, 'create'])
                  ->name('contracts.create');
             Route::post('contracts', [ContractController::class, 'store'])
                  ->name('contracts.store');
             Route::get('contracts', [ContractController::class, 'index'])
                  ->name('contracts.index');
             Route::post('contracts/update/{id}',
                 [ContractController::class, 'update'])
                  ->name('contracts.update');
             Route::post('/contracts/{id}/cancel',
                 [ContractController::class, 'deleteContract'])
                  ->name('contracts.cancel');
             Route::get('/motel/report', [MotelController::class, 'report'])
                  ->name('statistics');
             Route::post('/requests/create',
                 [MotelController::class, 'createRequest'])
                  ->name('requests.create');

         });
         Route::group(['middleware' => ['auth']], function () {
             Route::get('/danh-sach-day-tro', [MotelController::class, 'index'])
                  ->name('motel.index');
             Route::get('/them-phong-tro', [MotelController::class, 'create'])
                  ->name('motel.create');

             Route::post('/them-phong-tro', [MotelController::class, 'store'])
                  ->name('motel.store');
             Route::get('/phong-tro/cap-nhat/{id}',
                 [MotelController::class, 'edit'])->name('motel.edit');
             Route::put('/phong-tro/cap-nhat/{id}',
                 [MotelController::class, 'update'])->name('motel.update');
             Route::delete('/phong-tro/xoa/{id}',
                 [MotelController::class, 'destroy'])->name('motel.destroy');
             Route::get('/phong/them-nguoi-dung/{id}',
                 [MotelController::class, 'addUserMotel'])
                  ->name('motel.addUserMotel');
             Route::post('/them-nguoi-dung/{id}',
                 [MotelController::class, 'storeUserMotel'])
                  ->name('motel.storeUserMotel');
             Route::post('/invoices/create',
                 [InvoiceController::class, 'createInvoice'])
                  ->name('invoices.create');
             Route::get('/invoices/pay/{id}',
                 [InvoiceController::class, 'payInvoice'])
                  ->name('invoices.pay');
             Route::get('/phong/bao-cao',
                 [InvoiceController::class, 'motelReport'])
                  ->name('invoices.motelReport');
             Route::post('/invoices/pay/{id}',
                 [InvoiceController::class, 'acceptPay'])
                  ->name('invoices.acceptPay');
             Route::post('/invoices/prepay',
                 [InvoiceController::class, 'prepay'])->name('invoices.prepay');
             Route::get('/invoices/list',
                 [InvoiceController::class, 'getIndexInvoice'])
                  ->name('invoices.getIndexInvoice');
             Route::get('/export-invoices', function () {
                 return Excel::download(new InvoiceExport(), 'invoices.xlsx');
             })->name('export.invoices');
             //             Route::get('/motel/{id}/access', [MotelController::class, 'accessRoomForm'])->name('motel.access.form');
             Route::get('/room-access', [MotelController::class, 'roomAccess'])
                  ->name('motel.access.form');
             Route::post('/motel/leave', [MotelController::class, 'leaveRoom'])
                  ->name('motel.leave');
             Route::post('/motel/{id}/access',
                 [MotelController::class, 'accessRoom'])->name('motel.access');
             Route::post('/check-passcode',
                 [MotelController::class, 'checkPasscode'])
                  ->name('check.passcode');
         });

     });

//? END BLOGS CONTROLLER
Route::get('test', function () {
    return view('admin_core.content.test');
});
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
         ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
         ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
