<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Service\product\productWishService;
use Illuminate\Http\Request;

class productWishController extends Controller
{
    // productWishService instance
    protected $productWish;

    // Constructor to bind productWishService instance
    public function __construct(productWishService $productWish)
    {
        $this->productWish = $productWish;
    }

    // Get all productWish Start ***********************
    public function getProductWish(Request $request)
    {
        return $this->productWish->getProductWish($request);
    }
    // Get all productWish End *************************

    // Add productWish Start ***********************
    public function addProductWish(Request $request)
    {
        return $this->productWish->addProductWish($request);
    }
    // Add productWish End *************************

    // Delete productWish Start ***********************
    public function deleteProductWish(Request $request)
    {
        return $this->productWish->deleteProductWish($request);
    }
    // Delete productWish End *************************
}
