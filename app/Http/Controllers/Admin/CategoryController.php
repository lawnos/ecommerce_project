<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function list()
    {
        $data['getRecord']      = CategoryModel::getRecord();
        $data['header_title']   = "Danh Mục";
        return view('admin.category.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Thêm Danh Mục";
        return view('admin.category.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate(
            [
                'slug' => 'required|unique:category'
            ],
            [
                'slug.unique' => 'Slug này đã tồn tại.',
            ]
        );

        $category                   = new CategoryModel;
        $category->name             = trim($request->name);
        $category->slug             = trim($request->slug);
        $category->status           = trim($request->status);
        $category->meta_title       = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords    = trim($request->meta_keywords);
        $category->created_by       = Auth::user()->id;
        $category->save();

        return redirect('admin/category/list')->with('success', "Danh mục đã được thêm thành công");
    }

    public function edit($id)
    {
        $data['getRecord']      = CategoryModel::getSingle($id);
        $data['header_title']   = "Sửa Danh Mục";
        return view('admin.category.edit', $data);
    }

    public function update($id, Request $request)
    {
        request()->validate(
            [
                'slug' => 'required|unique:category,slug,' . $id
            ],
            [
                'slug.unique' => 'Slug này đã tồn tại.',
            ]
        );

        $category                   = CategoryModel::getSingle($id);
        $category->name             = trim($request->name);
        $category->slug             = trim($request->slug);
        $category->status           = trim($request->status);
        $category->meta_title       = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords    = trim($request->meta_keywords);
        $category->save();

        return redirect('admin/category/list')->with('success', "Danh mục đã được sửa thành công");
    }

    public function delete($id)
    {
        $category = CategoryModel::getSingle($id);
        $category->is_delete = 1;
        $category->save();
        return redirect('admin/category/list')->with('success', "Danh mục đã được xóa thành công");
    }
}


