<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\ProductModel;

class ProductController extends Controller
{
    public function getCategory($slug, $subslug = '')
    {
        $getCategory    = CategoryModel::getSingleSlug($slug);
        $getSubCategory = SubCategoryModel::getSingleSlug($subslug);

        if (!empty($getCategory) && !empty($getSubCategory)) {

            $data['meta_title']         = $getSubCategory->meta_title;
            $data['meta_desription']    = $getSubCategory->meta_desription;
            $data['meta_keywords']      = $getSubCategory->meta_keywords;
            $data['getSubCategory']     = $getSubCategory;
            $data['getCategory']        = $getCategory;
            $data['getProduct']         = ProductModel::getProduct($getCategory->id, $getSubCategory->id);
            return view('product.list', $data);
        } else if (!empty($getCategory)) {

            $data['getCategory']        = $getCategory;
            $data['meta_title']         = $getCategory->meta_title;
            $data['meta_desription']    = $getCategory->meta_desription;
            $data['meta_keywords']      = $getCategory->meta_keywords;
            $data['getProduct']         = ProductModel::getProduct($getCategory->id);
            return view('product.list', $data);
        } else {
            abort(404);
        }
    }
}
