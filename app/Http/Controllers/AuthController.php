<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\RegisterMail;
use App\Mail\ForgotPasswordMail;


class AuthController extends Controller
{
    public function login_admin()
    {
        if (!empty(Auth::check()) && Auth::user()->is_admin == 1) {
            return view('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function auth_login_admin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1, 'status' => 0, 'is_delete' => 0], $remember)) {
            return redirect('admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Vui lòng nhập đúng email và mật khẩu!');
        }
    }

    public function logout_admin()
    {
        Auth::logout();
        return redirect(url(''));
    }

    public function auth_login(Request $request)
    {
        $remember = !empty($request->is_remember) ? true : false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 0, 'is_delete' => 0], $remember)) {

            if (!empty(Auth::user()->email_verified_at)) {
                $json['status'] = true;
                $json['message'] = 'Đăng nhập thành công!';
            } else {
                $save = User::getSingle(Auth::user()->id);
                Mail::to($save->email)->send(new RegisterMail($save));
                Auth::logout();

                $json['status'] = false;
                $json['message'] = 'Email của bạn chưa được đăng ký. Vui lòng đăng ký!';
            }
        } else {
            $json['status'] = false;
            $json['message'] = 'Vui lòng nhập đúng email và mật khẩu!';
        }

        return response()->json($json);
    }

    public function auth_register(Request $request)
    {
        $checkEmail = User::checkEmail($request->email);

        if (empty($checkEmail)) {
            $save           = new User;
            $save->name     = trim($request->name);
            $save->email    = trim($request->email);
            $save->password = Hash::make($request->password);
            $save->save();

            Mail::to($save->email)->send(new RegisterMail($save));

            $json['status'] = true;

            $json['message'] = 'Đăng ký tài khoản thành công. Vui lòng xác minh Email để đăng nhập!';
        } else {
            $json['status'] = false;
            $json['message'] = 'Email này đã đăng ký vui lòng sử dụng email khác!';
        }

        return response()->json($json);
    }

    public function forgot_password(Request $request)
    {
        $data['meta_title'] = "Quên Mật Khẩu";
        return view('auth.forgot_password', $data);
    }

    public function auth_forgot_password(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();

        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', "Vui lòng kiểm tra email và đặt lại mật khẩu của bạn!");
        } else {
            return redirect()->back()->with('error', "Không tìm thấy email trong hệ thống!");
        }
    }

    public function reset($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {

            $data['meta_title'] = "Đặt Lại Mật Khẩu";
            $data['user'] = $user;

            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }

    public function auth_reset($token, Request $request)
    {
        if ($request->password == $request->cpassword) {

            $user = User::where('remember_token', '=', $token)->first();
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();

            return redirect(url(''))->with('success', "Đặt lại mật khẩu thành công!");
        } else {
            return redirect()->back()->with('error', "Mật khẩu và mật khẩu xác nhận không khớp!");
        }
    }

    public function activate_email($id)
    {
        $id = base64_decode($id);
        $user = User::getSingle($id);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect(url(''))->with('success', "Đã kích hoạt Email thành công");
    }
}
