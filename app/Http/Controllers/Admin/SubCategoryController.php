<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function list()
    {
        $data['getRecord']      = SubCategoryModel::getRecord();
        $data['header_title']   = "Danh Mục Phụ";
        return view('admin.subcategory.list', $data);
    }

    public function add()
    {
        $data['getCategory']    = CategoryModel::getRecord();
        $data['header_title']   = "Thêm Danh Mục Phụ";
        return view('admin.subcategory.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:sub_category'
        ]);

        $sub_category                   = new SubCategoryModel;
        $sub_category->category_id      = trim($request->category_id);
        $sub_category->name             = trim($request->name);
        $sub_category->slug             = trim($request->slug);
        $sub_category->status           = trim($request->status);
        $sub_category->meta_title       = trim($request->meta_title);
        $sub_category->meta_description = trim($request->meta_description);
        $sub_category->meta_keywords    = trim($request->meta_keywords);
        $sub_category->created_by       = Auth::user()->id;
        $sub_category->save();

        return redirect('admin/sub_category/list')->with('success', "Danh mục phụ đã được thêm thành công");
    }

    public function edit($id)
    {
        $data['getCategory']    = CategoryModel::getRecord();
        $data['getRecord']      = SubCategoryModel::getSingle($id);
        $data['header_title']   = 'Sửa Danh Mục Phụ';
        return view('admin.subcategory.edit', $data);
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:sub_category,slug,' . $id
        ]);

        $sub_category                   = SubCategoryModel::getSingle($id);
        $sub_category->category_id      = trim($request->category_id);
        $sub_category->name             = trim($request->name);
        $sub_category->slug             = trim($request->slug);
        $sub_category->status           = trim($request->status);
        $sub_category->meta_title       = trim($request->meta_title);
        $sub_category->meta_description = trim($request->meta_description);
        $sub_category->meta_keywords    = trim($request->meta_keywords);
        $sub_category->save();

        return redirect('admin/sub_category/list')->with('success', "Danh mục phụ đã được sửa thành công");
    }

    public function delete($id)
    {
        $category = SubCategoryModel::getSingle($id);
        $category->is_delete = 1;
        $category->save();
        return redirect()->back()->with('success', "Danh mục phụ đã được xóa thành công");
    }
}
