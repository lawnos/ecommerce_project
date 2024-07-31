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

    static public function getRecord()
    {
        $return = OrderModel::select('orders.*');

        // if (!empty(Request::get('id'))) {
        //     $return = $return->where('id', '=', Request::get('id'));
        // }
        // if (!empty(Request::get('first_name'))) {
        //     $return = $return->where('first_name', 'like', '%' . Request::get('first_name') . '%');
        // }
        // if (!empty(Request::get('last_name'))) {
        //     $return = $return->where('last_name', 'like', '%' . Request::get('last_name') . '%' . '%');
        // }
        // if (!empty(Request::get('email'))) {
        //     $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
        // }
        // if (!empty(Request::get('country'))) {
        //     $return = $return->where('country', 'like', '%' . Request::get('country') . '%');
        // }
        // if (!empty(Request::get('state'))) {
        //     $return = $return->where('state', 'like', '%' . Request::get('state') . '%');
        // }
        // if (!empty(Request::get('city'))) {
        //     $return = $return->where('city', 'like', '%' . Request::get('city') . '%');
        // }
        // if (!empty(Request::get('phone'))) {
        //     $return = $return->where('phone', 'like', '%' . Request::get('phone') . '%');
        // }
        // if (!empty(Request::get('form_date'))) {
        //     $return = $return->whereDate('created_at', '>=', Request::get('form_date'));
        // }
        // if (!empty(Request::get('to_date'))) {
        //     $return = $return->whereDate('created_at', '<=', Request::get('to_date'));
        // }

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

        $return = $return->where('is_payment', '=', 0)
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
