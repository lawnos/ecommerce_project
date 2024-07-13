<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\ProductModel;
use App\Models\ColorModel;
use App\Models\BrandModel;

class ProductController extends Controller
{
    public function getProductSearch(Request $request)
    {
        $data['meta_title']             = 'Tìm Kiếm';
        $data['meta_desription']        = '';
        $data['meta_keywords']          = '';

        $getProduct                     = ProductModel::getProduct();
        $page = 0;
        if (!empty($getProduct->nextPageUrl())) {
            $parse_url = parse_url($getProduct->nextPageUrl());

            if (!empty($parse_url['query'])) {
                parse_str($parse_url['query'], $get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }

        $data['page'] = $page;
        $data['getProduct'] = $getProduct;
        $data['getColor']   = ColorModel::getRecordActive();
        $data['getBrand']   = BrandModel::getRecordActive();
        return view('product.list', $data);
    }

    public function getCategory($slug, $subslug = '')
    {
        $getProductSingle   = ProductModel::getSingleSlug($slug);

        $getCategory        = CategoryModel::getSingleSlug($slug);

        $getSubCategory     = SubCategoryModel::getSingleSlug($subslug);

        $data['getColor']   = ColorModel::getRecordActive();
        $data['getBrand']   = BrandModel::getRecordActive();

        if (!empty($getProductSingle)) {

            $data['meta_title']             = $getProductSingle->title;
            $data['meta_desription']        = $getProductSingle->meta_desription;

            $data['getProduct']             = $getProductSingle;
            $data['getRelatedProduct']      = ProductModel::getRelatedProduct($getProductSingle->id, $getProductSingle->sub_category_id);

            return view('product.detail', $data);
        } else if (!empty($getCategory) && !empty($getSubCategory)) {

            $data['meta_title']             = $getSubCategory->meta_title;
            $data['meta_desription']        = $getSubCategory->meta_desription;
            $data['meta_keywords']          = $getSubCategory->meta_keywords;
            $data['getSubCategory']         = $getSubCategory;
            $data['getCategory']            = $getCategory;

            $getProduct                     = ProductModel::getProduct($getCategory->id, $getSubCategory->id);

            $page = 0;
            if (!empty($getProduct->nextPageUrl())) {
                $parse_url = parse_url($getProduct->nextPageUrl());

                if (!empty($parse_url['query'])) {
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            $data['page'] = $page;

            $data['getProduct']             = $getProduct;
            $data['getSubCategoryFilter']   = SubCategoryModel::getRecordSubCategory($getCategory->id);
            return view('product.list', $data);
        } else if (!empty($getCategory)) {

            $data['getSubCategoryFilter']   = SubCategoryModel::getRecordSubCategory($getCategory->id);

            $data['getCategory']            = $getCategory;
            $data['meta_title']             = $getCategory->meta_title;
            $data['meta_desription']        = $getCategory->meta_desription;
            $data['meta_keywords']          = $getCategory->meta_keywords;
            $getProduct                     = ProductModel::getProduct($getCategory->id);

            $page = 0;
            if (!empty($getProduct->nextPageUrl())) {
                $parse_url = parse_url($getProduct->nextPageUrl());

                if (!empty($parse_url['query'])) {
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            $data['page'] = $page;

            $data['getProduct'] = $getProduct;
            return view('product.list', $data);
        } else {
            abort(404);
        }
    }

    public function getFilterProductAjax(Request $request)
    {
        $getProduct = ProductModel::getProduct();
        $page = 0;
        if (!empty($getProduct->nextPageUrl())) {
            $parse_url = parse_url($getProduct->nextPageUrl());

            if (!empty($parse_url['query'])) {
                parse_str($parse_url['query'], $get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }

        return response()->json([
            "status"    => true,
            "page"      => $page,
            "success"   => view("product._list", [
                "getProduct" => $getProduct,
            ])->render(),
        ], 200);
    }
}
