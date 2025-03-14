<?php

namespace App\Service\product;

use Exception;
use App\Models\ProductSlider;
use App\Helper\ResponseHelper;

class productSliderService {

    // get all productSlider Start ***********************

    public function getProductSlider($request){

        try{
            $data=ProductSlider::all();
            return ResponseHelper::Out(true,$data,200);

        }catch(Exception $e){
            return ResponseHelper::Out(false,'Failed to get product slider',500);
        }

    }

    // get all productSlider End *************************
}
