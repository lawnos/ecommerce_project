<?php

use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AccountController;
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
    Route::get('admin/dashboard',             [DashboardController::class, 'dashboard']);

    //account
    Route::get('admin/account/list',          [AccountController::class, 'list']);
    Route::get('admin/account/add',           [AccountController::class, 'add']);
    Route::post('admin/account/add',          [AccountController::class, 'insert']);
    Route::get('admin/account/edit/{id}',     [AccountController::class, 'edit']);
    Route::post('admin/account/edit/{id}',    [AccountController::class, 'update']);
    Route::get('admin/account/delete/{id}',   [AccountController::class, 'delete']);
    //end account

    //category
    Route::get('admin/category/list',          [CategoryController::class, 'list']);
    Route::get('admin/category/add',           [CategoryController::class, 'add']);
    Route::post('admin/category/add',          [CategoryController::class, 'insert']);
    Route::get('admin/category/edit/{id}',     [CategoryController::class, 'edit']);
    Route::post('admin/category/edit/{id}',    [CategoryController::class, 'update']);
    Route::get('admin/category/delete/{id}',   [CategoryController::class, 'delete']);
    //end category

    //sub category
    Route::get('admin/sub_category/list',           [SubCategoryController::class, 'list']);
    Route::get('admin/sub_category/add',            [SubCategoryController::class, 'add']);
    Route::post('admin/sub_category/add',           [SubCategoryController::class, 'insert']);
    Route::get('admin/sub_category/edit/{id}',      [SubCategoryController::class, 'edit']);
    Route::post('admin/sub_category/edit/{id}',     [SubCategoryController::class, 'update']);
    Route::get('admin/sub_category/delete/{id}',    [SubCategoryController::class, 'delete']);
    //end sub category
});



Route::get('/', [HomeController::class, 'home']);
