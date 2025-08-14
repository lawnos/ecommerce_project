<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function list()
    {
        $data['getRecord'] = CategoryModel::getRecord();
        $data['header_title'] = "Danh Mục";
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
                'slug' => 'required|unique:categories,slug',
                'name' => 'required|unique:categories,name',
            ],
            [
                'slug.required' => 'Slug không được bỏ trống.',
                'slug.unique' => 'Slug này đã tồn tại.',
                'name.required' => 'Tên danh mục không được bỏ trống.',
                'name.unique' => 'Tên danh mục này đã tồn tại.',
            ]
        );


        $category = new CategoryModel;
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect('admin/category/list')->with('success', "Danh mục đã được thêm thành công");
    }

    public function edit($id)
    {
        $data['getRecord'] = CategoryModel::getSingle($id);
        $data['header_title'] = "Sửa Danh Mục";
        return view('admin.category.edit', $data);
    }

    public function update($id, Request $request)
    {
        request()->validate(
            [
                'name' => 'required',
                'slug' => 'required|unique:categories,slug,' . $id
            ],
            [
                'slug.unique' => 'Slug này đã tồn tại.',
                'name.required' => 'Tên danh mục không được bỏ trống.',
            ]
        );

        $category = CategoryModel::getSingle($id);
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
//        $category->status = trim($request->status);
//        $category->meta_title = trim($request->meta_title);
//        $category->meta_description = trim($request->meta_description);
//        $category->meta_keywords = trim($request->meta_keywords);
        $category->save();

        return redirect('admin/category/list')->with('success', "Đã cập nhật danh mục");
    }

    public function trash()
    {
        $data['header_title'] = "Thùng Rác";
        $data['deletedCategories'] = CategoryModel::deletedCategories();
        return view('admin.category.trash', $data);
    }

    public function restore($id)
    {
        $category = CategoryModel::find($id);
        if (!$category) {
            return redirect()->back()->with('error', "Danh mục không tồn tại");
        }
        $category->is_delete = 0;
        $category->save();
        return redirect('admin/category/trash')->with('success', "Danh mục đã được khôi phục thành công");
    }

    public function forceDelete($id)
    {
        $category = CategoryModel::find($id);
        if (!$category) {
            return redirect()->back()->with('error', "Danh mục không tồn tại");
        }
        $category->delete();
        return redirect('admin/category/trash')->with('success', "Danh mục đã được xóa vĩnh viễn");
    }

    public function delete($id)
    {
        $category = CategoryModel::getSingle($id);
        $category->is_delete = 1;
        $category->save();
        return redirect('admin/category/list')->with('success', "Danh mục đã được xóa thành công");
    }

    public function changeStatusAjax(Request $request)
    {
        $id = $request->id;
        $category = CategoryModel::find($id);
        if (!$category) {
            return response()->json(['status' => 'error', 'message' => 'Danh mục không tồn tại']);
        }
        $category->status = $category->status == 0 ? 1 : 0;
        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Đã đổi trạng thái danh mục',
            'new_status' => $category->status
        ]);
    }


}


