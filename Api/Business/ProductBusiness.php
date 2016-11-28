<?php

namespace Api\Business;
use Api\Model\Product;

class ProductBusiness extends Business {

    public static function getProductById($productId) {
        new static;

        $product = Product::find($productId);
        if ($product)
            return $product->toArray();
        else
            return null;
    }

    public static function getProductBySF($productSF) {
        new static;

        $product = Product::where('sfid',$productSF)->first();
        return $product;
    }
}