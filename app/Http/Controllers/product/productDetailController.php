<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Service\product\productDetailService;

class productDetailController extends Controller
{
    // productDetailService instance
    protected $productDetail;

    // Constructor to bind productDetailService instance
    public function __construct(productDetailService $productDetail)
    {
        $this->productDetail = $productDetail;
    }
}
