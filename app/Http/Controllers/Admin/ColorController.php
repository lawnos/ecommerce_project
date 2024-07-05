<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ColorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    public function list()
    {
        $data['getRecord']      = ColorModel::getRecord();
        $data['header_title']   = 'Màu Sắc';
        return view('admin.color.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Thêm Màu Sắc';
        return view('admin.color.add', $data);
    }

    public function insert(Request $request)
    {
        $brand                   = new ColorModel;
        $brand->name             = trim($request->name);
        $brand->code             = trim($request->code);
        $brand->status           = trim($request->status);
        $brand->created_by       = Auth::user()->id;
        $brand->save();

        return redirect('admin/color/list')->with('success', "Màu sắc đã được thêm thành công");
    }

    public function edit($id)
    {
        $data['getRecord']      = ColorModel::getSingle($id);
        $data['header_title']   = "Sửa Màu Sắc";
        return view('admin.color.edit', $data);
    }

    public function update($id, Request $request)
    {
        $brand                   = ColorModel::getSingle($id);
        $brand->name             = trim($request->name);
        $brand->code             = trim($request->code);
        $brand->status           = trim($request->status);
        $brand->save();

        return redirect('admin/color/list')->with('success', "Màu sắc đã được sửa thành công");
    }

    public function delete($id)
    {
        $category = ColorModel::getSingle($id);
        $category->is_delete = 1;
        $category->save();
        return redirect('admin/color/list')->with('success', "Màu sắc đã được xóa thành công");
    }
}
