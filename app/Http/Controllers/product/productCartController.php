<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Service\product\productCartService;
use Illuminate\Http\Request;

class productCartController extends Controller
{
    // productCartService instance
    protected $productCart;

    // Constructor to bind productCartService instance
    public function __construct(productCartService $productCart)
    {
        $this->productCart = $productCart;
    }

    // Get all productCart Start ***********************
    public function getProductCart(Request $request)
    {
        return $this->productCart->getProductCart($request);
    }
    // Get all productCart End *************************

    // Add productCart Start ***********************
    public function addProductCart(Request $request)
    {
        return $this->productCart->addProductCart($request);
    }
    // Add productCart End *************************

    // Delete productCart Start ***********************
    public function deleteProductCart(Request $request)
    {
        return $this->productCart->deleteProductCart($request);
    }
    // Delete productCart End *************************
}
