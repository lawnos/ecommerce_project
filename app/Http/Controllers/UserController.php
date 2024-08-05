<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\ProductReviewModel;
use App\Models\ProductWishlistModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        $data['meta_title']         = 'Thông Tin Tài Khoản';
        $data['meta_desription']    = '';
        $data['meta_keywords']      = '';

        $data['TotalOrder']         = OrderModel::getTotalOrderUser(Auth::user()->id);
        $data['TotalTodayOrder']    = OrderModel::getTotalTodayOrderUser(Auth::user()->id);
        $data['TotalAmount']        = OrderModel::getTotalAmountUser(Auth::user()->id);
        $data['TotalTodayAmount']   = OrderModel::getTotalTodayAmountUser(Auth::user()->id);

        $data['getPending']         = OrderModel::getTotalStatusUser(Auth::user()->id, 0);
        $data['getInprogress']      = OrderModel::getTotalStatusUser(Auth::user()->id, 1);
        $data['getDelivered']       = OrderModel::getTotalStatusUser(Auth::user()->id, 2);
        $data['getCompleted']       = OrderModel::getTotalStatusUser(Auth::user()->id, 3);
        $data['getCancelled']       = OrderModel::getTotalStatusUser(Auth::user()->id, 4);


        return view('user.dashboard', $data);
    }

    public function order()
    {
        $data['getRecord'] = OrderModel::getRecordUser(Auth::user()->id);

        $data['meta_title']         = 'Đơn Hàng Của Bạn';
        $data['meta_desription']    = '';
        $data['meta_keywords']      = '';

        return view('user.order', $data);
    }
    public function edit_profile()
    {

        $data['meta_title']         = 'Chỉnh Sửa Thông Tin';
        $data['meta_desription']    = '';
        $data['meta_keywords']      = '';
        $data['getRecord']          = User::getSingle(Auth::user()->id);
        return view('user.edit_profile', $data);
    }

    public function update_profile(Request $request)
    {
        $user                   = User::getSingle(Auth::user()->id);
        $user->name             = trim($request->name);
        $user->last_name        = trim($request->last_name);
        $user->company_name     = trim($request->company_name);
        $user->country          = trim($request->country);
        $user->address_one      = trim($request->address_one);
        $user->address_two      = trim($request->address_two);
        $user->city             = trim($request->city);
        $user->district         = trim($request->district);
        $user->code_zip         = trim($request->code_zip);
        $user->phone            = trim($request->phone);
        $user->save();

        return redirect()->back()->with('success', 'Chỉnh sửa thông tin thành công');
    }

    public function change_password()
    {
        $data['meta_title']         = 'Đổi Mật Khẩu';
        $data['meta_desription']    = '';
        $data['meta_keywords']      = '';

        return view('user.change_password', $data);
    }

    public function update_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            if ($request->password == $request->cpassword) {
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->back()->with('success', 'Đổi mật khẩu thành công');
            } else {
                return redirect()->back()->with('error', 'Mật khẩu mới không khớp');
            }
        } else {
            return redirect()->back()->with('error', "Mật khẩu cũ không đúng vui lòng thử lại");
        }
    }

    public function order_detail($id)
    {
        $data['getRecord']      = OrderModel::getSingleUser(Auth::user()->id, $id);

        if (!empty($data['getRecord'])) {
            $data['meta_title']         = 'Chi Tiết Đơn Hàng';
            $data['meta_desription']    = '';
            $data['meta_keywords']      = '';

            return view('user.order_detail', $data);
        } else {
            abort(404);
        }
    }

    public function add_to_wishlist(Request $request)
    {
        $check = ProductWishlistModel::checkAlready($request->product_id, Auth::user()->id);
        if (empty($check)) {
            $save = new ProductWishlistModel;
            $save->user_id = Auth::user()->id;
            $save->product_id = $request->product_id;
            $save->save();

            $json['is_wishlist'] = 1;
        } else {
            ProductWishlistModel::deleteRecord($request->product_id, Auth::user()->id);
            $json['is_wishlist'] = 0;
        }

        $json['status'] = true;

        return response()->json($json);
    }

    public function make_review(Request $request)
    {
        $save               = new ProductReviewModel;
        $save->user_id      = Auth::user()->id;
        $save->order_id     = trim($request->order_id);
        $save->product_id   = trim($request->product_id);
        $save->rating       = trim($request->rating);
        $save->review       = trim($request->review);
        $save->save();

        return redirect()->back()->with('success', "Cảm ơn bạn đã đánh giá!");
    }
}
