<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('admin',             [AuthController::class, 'login_admin']);
Route::post('admin',            [AuthController::class, 'auth_login_admin']);
Route::get('admin/logout',      [AuthController::class, 'logout_admin']);

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('admin/dashboard/list', function () {
        $data['header_title'] = "User";
        return view('admin.dashboard.list', $data);
    });
});





Route::get('/', [HomeController::class, 'home']);
