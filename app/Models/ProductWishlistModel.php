<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWishlistModel extends Model
{
    use HasFactory;

    protected $table = 'produc_wishlist';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function deleteRecord($product_id, $user_id)
    {
        self::where('product_id', '=', $product_id)
            ->where('user_id', '=', $user_id)
            ->delete();
    }

    static public function checkAlready($product_id, $user_id)
    {
        return self::where('product_id', '=', $product_id)
            ->where('user_id', '=', $user_id)
            ->count();
    }
}
