<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function list()
    {
        $data['getRecord']      = User::getAdmin();
        $data['header_title'] = "Tài Khoản";
        return view('admin.account.list', $data);
    }

    public function add()
    {
        $data['header_title']   = "Thêm Tài Khoản";
        return view('admin.account.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->status   = $request->status;
        $user->is_admin = 1;
        $user->save();
        return redirect('admin/account/list')->with('success', "Tài khoản quản trị viên đã được thêm thành công");
    }

    public function edit($id)
    {
        $data['getRecord']      = User::getSingle($id);
        $data['header_title']   = "Sửa Tài Khoản";
        return view('admin.account.edit', $data);
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        $user           = User::getSingle($id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->status   = $request->status;
        $user->is_admin = 1;
        $user->save();
        return redirect('admin/account/list')->with('success', "Tài khoản quản trị viên đã được sửa thành công");
    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();
        return redirect()->back()->with('success', "Tài khoản quản trị viên đã được xóa thành công");
    }
}
