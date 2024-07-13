<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class ProductImageModel extends Model
{
    use HasFactory;

    protected $table = 'product_image';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    public function getLogo()
    {
        if (!empty($this->image_name) && Storage::exists('public/uploads/product/' . $this->image_name)) {
            return Storage::url('public/uploads/product/' . $this->image_name);
        } else {
            return "";
        }
    }
}
