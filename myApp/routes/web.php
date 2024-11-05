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

Route::get('/', function () {
    return view('Demo.index');
});
// Route group với middleware 'auth' và tiền tố 'admin'
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::group(['middleware' => ['auth']], function () {
        // Route cho quản lý vai trò, chỉ cho phép người dùng có quyền quản lý vai trò
    Route::get("/", [AdminController::class, 'index'])->name('index');
    //Phân quyền đành cho ADMIN
    Route::get('/addRole', [PermissionController::class, 'getAssgin'])
         ->name('addRole')->middleware('permission:create role');
    Route::get('/allUser', [PermissionController::class, 'getAllUser'])
         ->name('allUser')->middleware('permission:create role');
    Route::get('/getAssgin/{id}', [PermissionController::class, 'assgin'])
         ->name('assgin')->middleware('permission:assign role');
    Route::post('/insert_roles/{id}',
        [PermissionController::class, 'insert_roles'])
         ->name('insert_roles')->middleware('permission:assign role');
    Route::get('/permission/{id}', [PermissionController::class, 'permission'])
         ->name('permission')->middleware('permission:assign role');
    Route::post('/insert_permission/{id}',
        [PermissionController::class, 'insert_permission'])
         ->name('insert_permission')->middleware('permission:assign role');
    Route::post('/insert_permission',
        [PermissionController::class, 'add_permisission'])
         ->name('add_permisission')->middleware('permission:assign role');
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
         ->name('get_pending_blogs')->middleware('permission:manager blogs');
    Route::PUT('blogs/accept_blog/{id}',
        [BlogsController::class, 'accept_blog'])
         ->name('blogs.accept_blog')->middleware('permission:manager blogs');
    Route::PUT('blogs/decline_blog/{id}',
        [BlogsController::class, 'decline_blog'])
         ->name('blogs.decline_blog')->middleware('permission:manager blogs');
    Route::get('blogs/preview_blogs/{id}',
        [BlogsController::class, 'preview_blogs'])
         ->name('blogs.preview_blogs')->middleware('permission:add blogs'); });
    //? BLOGS CONTROLLER

    // Resource route cho BlogsController, kiểm tra quyền truy cập
    Route::group(['middleware' => ['auth']], function () {
        // Route cho quyền 'add blogs' với phương thức 'GET' cho 'create' và 'POST' cho 'store'
        Route::get('/blogs/index', [BlogsController::class, 'index'])
             ->name('blogs.index')->middleware('permission:all blogs');
        Route::get('/blogs/myblogs', [BlogsController::class, 'myblogs'])
             ->name('blogs.myblogs')->middleware('permission:view my blogs');
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

        Route::get('/rooms/index', [RoomController::class, 'index'])
             ->name('rooms.index')->middleware('permission:all blogs');
    });
    // Resource route cho RoomController, kiểm tra quyền truy cập
    Route::group(['middleware' => ['auth']], function () {
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
             ->name('rooms.myRooms')->middleware('permission:all blogs');
        Route::post('/rooms/store', [RoomController::class, 'store'])
             ->name('rooms.store')->middleware('permission:all blogs');
        Route::get('rooms/{blog}/edit', [RoomController::class, 'edit'])
             ->name('rooms.edit')->middleware('permission:all blogs');
        Route::put('rooms/{blog}', [RoomController::class, 'update'])
             ->name('rooms.update')->middleware('permission:edit blogs');
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
        Route::get('/payment', function () {
            return view('admin.content.payment.payment');
        })->name('payment');


        Route::prefix('payment')->group(function () {
            Route::get('mbbank', [PaymentController::class, 'index'])->name('payment.mbbank');
            Route::get('historyPayment', [PaymentController::class, 'getHistoryPayment'])->name('payment.historyPayment');
            Route::post('mbbank/createPaymentLink', [PaymentController::class, 'createPaymentLink'])->name('payment.mbbank.createPaymentLink');
            Route::get('mbbank/success', [PaymentController::class, 'successPayment'])->name('payment.mbbank.success');
            Route::post('mbbank/success', [PaymentController::class, 'successPayment'])->name('payment.mbbank.success');
            Route::get('mbbank/cancel', [PaymentController::class, 'cancelPayment'])->name('payment.mbbank.cancel');
            Route::post('mbbank/create',[PaymentController::class,'createOrder'])->name('payment.mbbank.create');
            Route::get('mbbank/create/{id}', [PaymentController::class, 'getPaymentLinkInfoOfOrder']);
            Route::put('mbbank/create/{id}', [PaymentController::class, 'cancelPaymentLinkOfOrder']);
            Route::put('mbbank/payos', [PaymentController::class, 'handlePayOSWebhook'])->name('payment.mbbank.payos');
        });
        Route::group(['middleware' => ['auth']], function () {
            Route::get('/rooms/{room}/vip-packages', [VIPController::class, 'showVIPPackages'])->name('vip.packages');
            Route::post('/rooms/{room}/vip-purchase', [VIPController::class, 'purchaseVIPPackage'])->name('vip.purchase');

        });
    });
});

//? END BLOGS CONTROLLER

Route::get('/dashboard', function () {
    return view('Demo.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
         ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
         ->name('profile.destroy');
});
// danh update VIEW 

Route::get('/cho-thue-phong-tro',[IndexController::class,'cho-thue-phong-tro'])->name('index.chothuephongtro');
Route::get('/login-navbar',[IndexController::class,'loginNav'])->name('index.loginNav');
Route::get('/homepage',[IndexController::class,'homepage'])->name('index.homepage');
Route::get('/detail',[IndexController::class,'detail'])->name('index.detail');

// 
require __DIR__ . '/auth.php';
