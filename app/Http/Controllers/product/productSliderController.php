<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Service\product\productSliderService;

class productSliderController extends Controller
{
    // productSliderService instance
    protected $productSlider;

    // Constructor to bind productSliderService instance
    public function __construct(productSliderService $productSlider)
    {

        $this->productSlider = $productSlider;

    }
}
