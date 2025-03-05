<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Service\product\productService;

class productController extends Controller
{
    // productService instance
    protected $product;

    // Constructor to bind productService instance
    public function __construct(productService $product)
    {
        $this->product = $product;
    }
}
