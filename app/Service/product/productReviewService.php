<?php

namespace App\Service\product;

use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;
use App\Models\ProductReview;
use Exception;

class productReviewService
{
    /**
     * Retrieve product reviews by product ID.
     *
     * @param  object  $request
     * @return object
     */
    public function getProductReviewByProductId($request)
    {
        try {
            $productId = $request->productId;

            // Fetch product reviews along with customer profile name
            $productReview = ProductReview::where('product_id', $productId)
                ->with(['customerProfile' => function ($query) {
                    $query->select('id', 'cus_name');
                }])
                ->get();

            return ResponseHelper::Out(true, $productReview, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to load product review', 500);
        }
    }

    /**
     * Add a new product review.
     *
     * @param  object  $request
     * @return object
     */
    public function addProductReview($request)
    {
        try {
            $userId = $request->header('id');
            $productId = $request->input('productId');
            $review = $request->input('review');
            $rating = $request->input('rating');
            $description = $request->input('description');

            // Retrieve customer profile
            $customerProfile = CustomerProfile::where('user_id', $userId)->first();
            if (! $customerProfile) {
                return ResponseHelper::Out(false, 'Customer Profile Not Found', 404);
            }

            // Create product review
            $productReview = ProductReview::create([
                'product_id' => $productId,
                'customer_id' => $customerProfile->id,
                'review' => $review,
                'rating' => $rating,
                'description' => $description,
            ]);

            return ResponseHelper::Out(true, $productReview, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to add product review', 500);
        }
    }

    /**
     * Update an existing product review.
     *
     * @param  object  $request
     * @return object
     */
    public function updateProductReview($request)
    {
        try {
            $userId = $request->header('id');
            $productReviewId = $request->input('productReviewId');

            // Retrieve customer profile
            $customerProfile = CustomerProfile::where('user_id', $userId)->first();
            if (! $customerProfile) {
                return ResponseHelper::Out(false, 'Customer Profile Not Found', 404);
            }

            // Verify ownership of the review
            $productReview = ProductReview::where('id', $productReviewId)
                ->where('customer_id', $customerProfile->id)
                ->first();
            if (! $productReview) {
                return ResponseHelper::Out(false, 'Product Review Not Found', 404);
            }

            // Update review fields
            $productReview->update($request->only(['review', 'rating', 'description']));

            return ResponseHelper::Out(true, 'Product Review Updated Successfully', 200);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to update product review', 500);
        }
    }

    /**
     * Delete a product review.
     *
     * @param  object  $request
     * @return object
     */
    public function deleteProductReview($request)
    {
        try {
            $userId = $request->header('id');
            $userRole = $request->header('role');
            $productReviewId = $request->input('productReviewId');

            // Retrieve customer profile
            $customerProfile = CustomerProfile::where('user_id', $userId)->first();
            if (! $customerProfile) {
                return ResponseHelper::Out(false, 'Customer Profile Not Found', 404);
            }

            // Admins can delete any review, users can delete their own
            if (in_array($userRole, ['admin', 'superadmin'])) {
                $productReview = ProductReview::where('id', $productReviewId)->first();
            } else {
                $productReview = ProductReview::where('id', $productReviewId)
                    ->where('customer_id', $customerProfile->id)
                    ->first();
            }

            if (! $productReview) {
                return ResponseHelper::Out(false, 'Product Review Not Found', 404);
            }

            // Delete review
            $productReview->delete();

            return ResponseHelper::Out(true, 'Product Review Deleted Successfully', 200);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to delete product review', 500);
        }
    }
}
