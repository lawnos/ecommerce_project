<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUsModel;
use App\Models\OrderModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $data['TotalOrder']         = OrderModel::getTotalOrder();
        $data['TotalTodayOrder']    = OrderModel::getTotalTodayOrder();
        $data['TotalAmount']        = OrderModel::getTotalAmount();
        $data['TotalTodayAmount']   = OrderModel::getTotalTodayAmount();
        $data['getLatestOrder']     = OrderModel::getLatestOrder();
        $data['TotalCustomer']      = User::getTotalCustomer();
        $data['TotalTodayCustomer'] = User::getTotalTodayCustomer();

        if (!empty($request->year)) {
            $year = $request->year;
        } else {
            $year = date('Y');
        }

        $getTotalCustomerMonth = '';
        $getTotalOrderMonth = '';
        $getTotalOrderAmountMonth = '';
        $totalAmount = 0;

        for ($month = 1; $month <= 12; $month++) {
            $startDate = new \DateTime("$year-$month-01");
            $endDate = new \DateTime("$year-$month-01");
            $endDate->modify('last day of this month');

            $start_date = $startDate->format('Y-m-d');
            $end_date = $endDate->format('Y-m-d');

            $customer = User::getTotalCustomerMonth($start_date, $end_date);
            $getTotalCustomerMonth .= $customer . ',';

            $order = OrderModel::getTotalOrderMonth($start_date, $end_date);
            $getTotalOrderMonth .= $order . ',';

            $orderpayment = OrderModel::getTotalOrderAmountMonth($start_date, $end_date);
            $getTotalOrderAmountMonth .= $orderpayment . ',';
            $totalAmount += $orderpayment;
        }

        $data['getTotalCustomerMonth']      = rtrim($getTotalCustomerMonth, ',');
        $data['getTotalOrderMonth']         = rtrim($getTotalOrderMonth, ',');
        $data['getTotalOrderAmountMonth']   = rtrim($getTotalOrderAmountMonth, ',');
        $data['totalAmount']                = $totalAmount;
        $data['year']                       = $year;

        $data['header_title']       = "Bảng Điều Khiển";

        return view('admin.dashboard', $data);
    }

    public function list_contact()
    {
        $data['getRecord'] = ContactUsModel::getRecord();
        $data['header_title'] = "Danh Sách Liên Hệ";

        return view('admin.contact.list', $data);
    }

    public function delete_contact($id)
    {
        ContactUsModel::where('id', '=', $id)
            ->delete();
        return redirect()->back()->with('success', "Xóa liên hệ thành công");
    }
}
