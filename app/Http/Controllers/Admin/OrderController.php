<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\ShippingChargeModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    static public function list()
    {
        $data['getRecord']      = OrderModel::getRecord();
        $data['header_title']   = 'Danh Sách Đơn Hàng';
        return view('admin.order.list', $data);
    }
    static public function detail($id)
    {
        $data['getRecord']      = OrderModel::getSingle($id);
        $data['header_title']   = 'Chi Tiết Đơn Hàng';
        return view('admin.order.detail', $data);
    }

    
}
