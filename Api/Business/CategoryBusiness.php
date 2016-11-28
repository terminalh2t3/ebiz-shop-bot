<?php

namespace Api\Business;
use Api\Model\Category;
use Api\Model\Product;

class CategoryBusiness extends Business
{
    public static function getAllCategories($length = null, $page = null){
        new static;

        $categories = Category::select('*');
        if ($length > 0) {
            $categories->limit($length);
        }

        if ($length > 0 && $page > 0) {
            $offset = $length * $page;
            $categories->offset($offset);
        }
        return $categories->get()->toArray();
    }

    public static function getCategoryById($categoryId) {
        new static;

        $category = Category::find($categoryId);
        if ($category)
            return $category->toArray();
        else
            return null;
    }

    public static function getProducts($categoryId, $length = null, $page = null){
        new static;

        $category = Category::find($categoryId);

        if ($category) {
            $product = Product::select('*')
                        ->where('category__c',$category->sfid);

            if($length > 0) {
                $product->limit($length);
            }

            if($length > 0 && $page > 0) {
                $offset = $length * $page;
                $product->offset($offset);
            }

            return $product->get()->toArray();
        } else {
            return null;
        }
    }
}