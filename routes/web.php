<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShippingChargeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as ProductFront;
use App\Http\Controllers\UserController;
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

Route::get('admin', [AuthController::class, 'login_admin'])->name('login_admin');
Route::post('admin', [AuthController::class, 'auth_login_admin'])->name('auth_login_admin');
Route::get('admin/logout', [AuthController::class, 'logout_admin'])->name('logout_admin');

Route::group(['middleware' => 'user'], function () {
    Route::get('user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('user/order', [UserController::class, 'order'])->name('user.order');
    Route::get('user/order/detail/{id}', [UserController::class, 'order_detail'])->name('user.order_detail');
    Route::get('user/edit-profile', [UserController::class, 'edit_profile'])->name('user.edit_profile');
    Route::get('user/change-password', [UserController::class, 'change_password'])->name('user.change_password');
    Route::post('user/edit-profile', [UserController::class, 'update_profile'])->name('user.update_profile');
    Route::post('user/change-password', [UserController::class, 'update_password'])->name('user.update_password');
    Route::post('add-to-wishlist', [UserController::class, 'add_to_wishlist'])->name('add_to_wishlist');
    Route::post('user/make-review', [UserController::class, 'make_review'])->name('user.make_review');

    Route::get('my-wishlist', [ProductFront::class, 'my_wishlist'])->name('my_wishlist');
});

Route::group(['middleware' => 'admin'], function () {

    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    //contact
    Route::get('admin/contact', [DashboardController::class, 'list_contact'])->name('admin.list_contact');
    Route::get('admin/contact/delete/{id}', [DashboardController::class, 'delete_contact']);

    //end contact

    //account admin
    Route::get('admin/account/list', [AccountController::class, 'list'])->name('admin.account.list');
    Route::get('admin/account/add', [AccountController::class, 'add'])->name('admin.account.add');
    Route::post('admin/account/add', [AccountController::class, 'insert'])->name('admin.account.insert');
    Route::get('admin/account/edit/{id}', [AccountController::class, 'edit'])->name('admin.account.edit');
    Route::post('admin/account/edit/{id}', [AccountController::class, 'update'])->name('admin.account.update');
    Route::get('admin/account/delete/{id}', [AccountController::class, 'delete'])->name('admin.account.delete');
    //end account admin

    //account customer
    Route::get('admin/customer/list', [AccountController::class, 'customer_list'])->name('admin.customer.list');
    Route::get('admin/customer/delete/{id}', [AccountController::class, 'customer_delete'])->name('admin.customer.delete');
    //end account customer

    //category
    Route::get('admin/category/list', [CategoryController::class, 'list'])->name('admin.category.list');
    Route::get('admin/category/add', [CategoryController::class, 'add'])->name('admin.category.add');
    Route::post('admin/category/add', [CategoryController::class, 'insert'])->name('admin.category.insert');
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('admin/category/edit/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
    Route::get('admin/category/trash', [CategoryController::class, 'trash'])->name('admin.category.trash');
    Route::get('restore/{id}', [CategoryController::class, 'restore'])->name('admin.category.restore');
    Route::get('force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('admin.category.forceDelete');
    Route::post('category/change-status', [CategoryController::class, 'changeStatusAjax'])->name('admin.category.changeStatusAjax');

    //end category

    //sub category
    Route::get('admin/sub_category/list', [SubCategoryController::class, 'list'])->name('admin.sub_category.list');
    Route::get('admin/sub_category/add', [SubCategoryController::class, 'add'])->name('admin.sub_category.add');
    Route::post('admin/sub_category/add', [SubCategoryController::class, 'insert'])->name('admin.sub_category.insert');
    Route::get('admin/sub_category/edit/{id}', [SubCategoryController::class, 'edit'])->name('admin.sub_category.edit');
    Route::post('admin/sub_category/edit/{id}', [SubCategoryController::class, 'update'])->name('admin.sub_category.update');
    Route::get('admin/sub_category/delete/{id}', [SubCategoryController::class, 'delete'])->name('admin.sub_category.delete');

    Route::post('admin/get_sub_category', [SubCategoryController::class, 'get_sub_category'])->name('admin.get_sub_category');
    //end sub category

    //product
    Route::get('admin/product/list', [ProductController::class, 'list'])->name('admin.product.list');
    Route::get('admin/product/add', [ProductController::class, 'add'])->name('admin.product.add');
    Route::post('admin/product/add', [ProductController::class, 'insert'])->name('admin.product.insert');
    Route::get('admin/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('admin/product/edit/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::get('admin/product/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');

    Route::get('admin/product/image_delete/{id}', [ProductController::class, 'image_delete'])->name('admin.product.image_delete');
    Route::post('admin/product_image_sortable', [ProductController::class, 'product_image_sortable'])->name('admin.product_image_sortable');
    //end product

    //brand
    Route::get('admin/brand/list', [BrandController::class, 'list'])->name('admin.brand.list');
    Route::get('admin/brand/add', [BrandController::class, 'add'])->name('admin.brand.add');
    Route::post('admin/brand/add', [BrandController::class, 'insert'])->name('admin.brand.insert');
    Route::get('admin/brand/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::post('admin/brand/edit/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::get('admin/brand/delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete');
    //end brand

    //color
    Route::get('admin/color/list', [ColorController::class, 'list'])->name('admin.color.list');
    Route::get('admin/color/add', [ColorController::class, 'add'])->name('admin.color.add');
    Route::post('admin/color/add', [ColorController::class, 'insert'])->name('admin.color.insert');
    Route::get('admin/color/edit/{id}', [ColorController::class, 'edit'])->name('admin.color.edit');
    Route::post('admin/color/edit/{id}', [ColorController::class, 'update'])->name('admin.color.update');
    Route::get('admin/color/delete/{id}', [ColorController::class, 'delete'])->name('admin.color.delete');;
    //end color

    //discount_code
    Route::get('admin/discount_code/list', [DiscountCodeController::class, 'list'])->name('admin.discount_code.list');
    Route::get('admin/discount_code/add', [DiscountCodeController::class, 'add'])->name('admin.discount_code.add');
    Route::post('admin/discount_code/add', [DiscountCodeController::class, 'insert'])->name('admin.discount_code.insert');
    Route::get('admin/discount_code/edit/{id}', [DiscountCodeController::class, 'edit'])->name('admin.discount_code.edit');
    Route::post('admin/discount_code/edit/{id}', [DiscountCodeController::class, 'update'])->name('admin.discount_code.update');
    Route::get('admin/discount_code/delete/{id}', [DiscountCodeController::class, 'delete'])->name('admin.discount_code.delete');
    //end discount_code

    //shipping_charge
    Route::get('admin/shipping_charge/list', [ShippingChargeController::class, 'list'])->name('admin.shipping_charge.list');
    Route::get('admin/shipping_charge/add', [ShippingChargeController::class, 'add'])->name('admin.shipping_charge.add');
    Route::post('admin/shipping_charge/add', [ShippingChargeController::class, 'insert'])->name('admin.shipping_charge.insert');
    Route::get('admin/shipping_charge/edit/{id}', [ShippingChargeController::class, 'edit'])->name('admin.shipping_charge.edit');
    Route::post('admin/shipping_charge/edit/{id}', [ShippingChargeController::class, 'update'])->name('admin.shipping_charge.update');
    Route::get('admin/shipping_charge/delete/{id}', [ShippingChargeController::class, 'delete'])->name('admin.shipping_charge.delete');
    //end shipping_charge

    //order
    Route::get('admin/order/list', [OrderController::class, 'list'])->name('admin.order.list');
    Route::get('admin/order/detail/{id}', [OrderController::class, 'detail'])->name('admin.order.detail');
    Route::get('admin/order_status', [OrderController::class, 'order_status'])->name('admin.order_status');
    //end order

    //slider
    Route::get('admin/slider/list', [SliderController::class, 'list'])->name('admin.slider.list');
    Route::get('admin/slider/add', [SliderController::class, 'add'])->name('admin.slider.add');
    Route::post('admin/slider/add', [SliderController::class, 'insert'])->name('admin.slider.insert');
    Route::get('admin/slider/edit/{id}', [SliderController::class, 'edit'])->name('admin.slider.edit');
    Route::post('admin/slider/edit/{id}', [SliderController::class, 'update'])->name('admin.slider.update');
    Route::get('admin/slider/delete/{id}', [SliderController::class, 'delete'])->name('admin.slider.delete');
    //end slider

});

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::post('contact', [HomeController::class, 'submit_contact'])->name('submit_contact');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('faq', [HomeController::class, 'faq'])->name('faq');

Route::get('logout', [AuthController::class, 'logout_client'])->name('logout_client');
Route::post('auth_register', [AuthController::class, 'auth_register'])->name('auth_register');
Route::post('auth_login', [AuthController::class, 'auth_login'])->name('auth_login');
Route::get('forgot-password', [AuthController::class, 'forgot_password'])->name('forgot_password');
Route::post('forgot-password', [AuthController::class, 'auth_forgot_password'])->name('auth_forgot_password');
Route::get('reset/{token}', [AuthController::class, 'reset'])->name('reset');
Route::post('reset/{token}', [AuthController::class, 'auth_reset'])->name('auth_reset');
Route::get('activate/{id}', [AuthController::class, 'activate_email'])->name('activate_email');;

Route::get('cart', [PaymentController::class, 'cart'])->name('cart');
Route::get('checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('checkout/apply_discount_code', [PaymentController::class, 'apply_discount_code'])->name('apply_discount_code');

Route::post('update_cart', [PaymentController::class, 'update_cart'])->name('update_cart');
Route::get('cart/delete/{id}', [PaymentController::class, 'cart_delete'])->name('cart_delete');
Route::post('product/add-to-cart', [PaymentController::class, 'add_to_cart'])->name('add_to_cart');
Route::post('checkout/place_order', [PaymentController::class, 'place_order'])->name('place_order');

Route::get('checkout/payment', [PaymentController::class, 'payment'])->name('payment');;
Route::get('paypal/success-payment', [PaymentController::class, 'paypal_success_payment'])->name('paypal_success_payment');
Route::get('vnpay/success-payment', [PaymentController::class, 'vnpay_success_payment'])->name('vnpay_success_payment');
Route::get('stripe/payment-success', [PaymentController::class, 'stripe_payment_success'])->name('stripe_payment_success');;

Route::get('search', [ProductFront::class, 'getProductSearch'])->name('getProductSearch');
Route::post('get_filter_product_ajax', [ProductFront::class, 'getFilterProductAjax'])->name('getFilterProductAjax');
Route::get('{category?}/{subcategory?}', [ProductFront::class, 'getCategory'])->name('getCategory');
