<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;


class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    //use 
    static public function getTotalOrderUser($user_id)
    {
        return self::select('id')
            ->where('user_id', '=', $user_id)
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->count();
    }

    static public function getTotalTodayOrderUser($user_id)
    {
        return self::select('id')
            ->where('user_id', '=', $user_id)
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->count();
    }

    static public function getTotalAmountUser($user_id)
    {
        return self::select('id')
            ->where('user_id', '=', $user_id)
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->sum('total_amount');
    }

    static public function getTotalTodayAmountUser($user_id)
    {
        return self::select('id')
            ->where('user_id', '=', $user_id)
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->sum('total_amount');
    }

    static public function getTotalStatusUser($user_id, $status)
    {
        return self::select('id')
            ->where('status', '=', $status)
            ->where('user_id', '=', $user_id)
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->count();
    }

    static public function getRecordUser($user_id)
    {
        return OrderModel::select('orders.*')
            ->where('user_id', '=', $user_id)
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'desc')
            ->paginate(20);
    }

    static public function getSingleUser($user_id, $id)
    {
        return OrderModel::select('orders.*')
            ->where('user_id', '=', $user_id)
            ->where('id', '=', $id)
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'desc')
            ->first();
    }
    //end

    static public function getTotalOrder()
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->count();
    }

    static public function getTotalTodayOrder()
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->count();
    }

    static public function getLatestOrder()
    {
        return OrderModel::select('orders.*')
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->where('status', '=', 0)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
    }

    static public function getTotalAmount()
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->sum('total_amount');
    }

    static public function getTotalTodayAmount()
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->sum('total_amount');
    }

    static public function getTotalOrderMonth($start_date, $end_date)
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->count();
    }

    static public function getTotalOrderAmountMonth($start_date, $end_date)
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->sum('total_amount');
    }

    static public function getRecord()
    {
        $return = OrderModel::select('orders.*');

        $filters = [
            'id' => '=',
            'first_name' => 'like',
            'last_name' => 'like',
            'email' => 'like',
            'country' => 'like',
            'state' => 'like',
            'city' => 'like',
            'phone' => 'like',
        ];

        foreach ($filters as $field => $item) {
            if (!empty(Request::get($field))) {
                $value = Request::get($field);
                $return = $return->where($field, $item, $item === 'like' ? '%' . $value . '%' : $value);
            }
        }

        if (!empty(Request::get('form_date'))) {
            $return = $return->whereDate('created_at', '>=', Request::get('form_date'));
        }

        if (!empty(Request::get('to_date'))) {
            $return = $return->whereDate('created_at', '<=', Request::get('to_date'));
        }

        $return = $return
            // ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'desc')
            ->paginate(20);

        return $return;
    }

    public function getShipping()
    {
        return $this->belongsTo(ShippingChargeModel::class, 'shipping_id');
    }

    public function getItem()
    {
        return $this->hasMany(OrderItemModel::class, 'order_id');
    }
}
