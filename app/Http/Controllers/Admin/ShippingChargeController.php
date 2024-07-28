<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingChargeModel;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    public function list()
    {
        $data['getRecord']      = ShippingChargeModel::getRecord();
        $data['header_title']   = 'Phí Vận Chuyển';
        return view('admin.shipping_charge.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Thêm Phí Vận Chuyển';
        return view('admin.shipping_charge.add', $data);
    }

    public function insert(Request $request)
    {
        $shipping_charge                      = new ShippingChargeModel;
        $shipping_charge->name                = trim($request->name);
        $shipping_charge->price               = trim($request->price);
        $shipping_charge->status              = trim($request->status);
        $shipping_charge->save();

        return redirect('admin/shipping_charge/list')->with('success', "Phí Vận Chuyển đã được thêm thành công");
    }

    public function edit($id)
    {
        $data['getRecord']      = ShippingChargeModel::getSingle($id);
        $data['header_title']   = "Sửa Phí Vận Chuyển";
        return view('admin.shipping_charge.edit', $data);
    }

    public function update($id, Request $request)
    {
        $shipping_charge                      = ShippingChargeModel::getSingle($id);
        $shipping_charge->name                = trim($request->name);
        $shipping_charge->price               = trim($request->price);
        $shipping_charge->status              = trim($request->status);
        $shipping_charge->save();

        return redirect('admin/shipping_charge/list')->with('success', "Phí Vận Chuyển đã được sửa thành công");
    }

    public function delete($id)
    {
        $shipping_charge = ShippingChargeModel::getSingle($id);
        $shipping_charge->is_delete = 1;
        $shipping_charge->save();
        return redirect('admin/shipping_charge/list')->with('success', "Phí Vận Chuyển đã được xóa thành công");
    }
}
