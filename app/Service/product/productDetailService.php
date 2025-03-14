<?php

namespace App\Service\product;

use Exception;
use App\Models\ProductDetail;
use App\Helper\ResponseHelper;

class productDetailService {

// Get product detail by product id Start ***********************
public function ProductDetailsById($request){

    try{

        $data=ProductDetail::where('product_id',$request->productId)->with('product','product.brand','product.category')->get();

        return ResponseHelper::Out(true,$data,200);

    }catch(Exception $e){

        return ResponseHelper::Out(false,'Failed to get product detail',500);

    }
// Get product detail by product id End ***********************

}

}
