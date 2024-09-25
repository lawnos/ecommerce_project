<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SliderModel;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function list()
    {
        $data['getRecord']      = SliderModel::getRecord();
        $data['header_title']   = 'Slider';
        return view('admin.slider.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Thêm Slider';
        return view('admin.slider.add', $data);
    }

    public function insert(Request $request)
    {
        $slider                      = new SliderModel;
        $slider->name                = trim($request->name);
        $slider->price               = trim($request->price);
        $slider->status              = trim($request->status);
        $slider->save();

        return redirect('admin/slider/list')->with('success', "Slider đã được thêm thành công");
    }

    public function edit($id)
    {
        $data['getRecord']      = SliderModel::getSingle($id);
        $data['header_title']   = "Sửa Slider";
        return view('admin.slider.edit', $data);
    }

    public function update($id, Request $request)
    {
        $slider                      = SliderModel::getSingle($id);
        $slider->name                = trim($request->name);
        $slider->price               = trim($request->price);
        $slider->status              = trim($request->status);
        $slider->save();

        return redirect('admin/slider/list')->with('success', "Slider đã được sửa thành công");
    }

    public function delete($id)
    {
        $slider = SliderModel::getSingle($id);
        $slider->is_delete = 1;
        $slider->save();
        return redirect('admin/slider/list')->with('success', "Slider đã được xóa thành công");
    }
}
