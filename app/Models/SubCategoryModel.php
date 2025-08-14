<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';

    static function getSingle($id)
    {
        return self::find($id);
    }

    static public function getSingleSlug($slug)
    {
        return self::where('slug', '=', $slug)
            ->where('sub_categories.status', '=', 0)
            ->where('sub_categories.is_delete', '=', 0)
            ->first();
    }

    static public function getRecord()
    {
        return self::select('sub_categories.*', 'users.name as created_by_name', 'categories.name as category_name')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->join('users', 'users.id', '=', 'sub_categories.created_by')
            ->where('sub_categories.is_delete', '=', 0)
            ->orderBy('sub_categories.id', 'asc')
            ->paginate(15);
    }

    static public function getRecordSubCategory($category_id)
    {
        return self::select('sub_categories.*')
            ->join('users', 'users.id', '=', 'sub_categories.created_by')
            ->where('sub_categories.is_delete', '=', 0)
            ->where('sub_categories.status', '=', 0)
            ->where('sub_categories.category_id', '=', $category_id)
            ->orderBy('sub_categories.name', 'asc')
            ->get();
    }

    public function TotalProduct()
    {
        return $this->hasMany(ProductModel::class, 'sub_categories')
            ->where('products.is_delete', '=', 0)
            ->where('products.status', '=', 0)
            ->count();
    }
}
