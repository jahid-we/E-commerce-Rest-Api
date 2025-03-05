<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Service\product\productReviewService;
use Illuminate\Http\Request;

class productReviewController extends Controller
{
    // productReviewService instance
    protected $productReview;

    // Constructor to bind productReviewService instance
    public function __construct(productReviewService $productReview)
    {
        $this->productReview = $productReview;
    }

    // Get product review by product id Start ***********************
    public function getProductReviewByProductId(Request $request)
    {
        return $this->productReview->getProductReviewByProductId($request);
    }
    // Get product review by product id End *************************

    // Method to add product review Start ***********************
    public function addProductReview(Request $request)
    {
        return $this->productReview->addProductReview($request);
    }
    // Method to add product review End *************************

    // Method to update product review Start ***********************
    public function updateProductReview(Request $request)
    {
        return $this->productReview->updateProductReview($request);
    }
    // Method to update product review End *************************

    // Method to delete product review Start ***********************
    public function deleteProductReview(Request $request)
    {
        return $this->productReview->deleteProductReview($request);
    }
    // Method to delete product review End *************************
}
