<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function list()
    {
        $data['getRecord']      = BrandModel::getRecord();
        $data['header_title']   = 'Thương Hiệu';
        return view('admin.brand.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Thêm Thương Hiệu';
        return view('admin.brand.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate(
            [
                'slug' => 'required|unique:brand'
            ],
            [
                'slug.unique' => 'Slug này đã tồn tại.',
            ]
        );

        $brand                   = new BrandModel;
        $brand->name             = trim($request->name);
        $brand->slug             = trim($request->slug);
        $brand->status           = trim($request->status);
        $brand->meta_title       = trim($request->meta_title);
        $brand->meta_description = trim($request->meta_description);
        $brand->meta_keywords    = trim($request->meta_keywords);
        $brand->created_by       = Auth::user()->id;
        $brand->save();

        return redirect('admin/brand/list')->with('success', "Thương hiệu đã được thêm thành công");
    }

    public function edit($id)
    {
        $data['getRecord']      = BrandModel::getSingle($id);
        $data['header_title']   = "Sửa Thương Hiệu";
        return view('admin.brand.edit', $data);
    }

    public function update($id, Request $request)
    {
        request()->validate(
            [
                'slug' => 'required|unique:brand,slug,' . $id
            ],
            [
                'slug.unique' => 'Slug này đã tồn tại.',
            ]
        );

        $brand                   = BrandModel::getSingle($id);
        $brand->name             = trim($request->name);
        $brand->slug             = trim($request->slug);
        $brand->status           = trim($request->status);
        $brand->meta_title       = trim($request->meta_title);
        $brand->meta_description = trim($request->meta_description);
        $brand->meta_keywords    = trim($request->meta_keywords);
        $brand->save();

        return redirect('admin/brand/list')->with('success', "Thương hiệu đã được sửa thành công");
    }

    public function delete($id)
    {
        $category = BrandModel::getSingle($id);
        $category->is_delete = 1;
        $category->save();
        return redirect('admin/brand/list')->with('success', "Thương hiệu đã được xóa thành công");
    }
}
