<?php

namespace App\Service\product;

use App\Helper\ResponseHelper;
use App\Models\ProductWish;
use Exception;

class productWishService
{
    /**
     * Retrieve all wishlist items for the authenticated user.
     *
     * @param  object  $request
     * @return object
     */
    public function getProductWish($request)
    {
        try {
            $userId = $request->header('id');

            // Fetch wishlist items along with associated product details
            $productWishList = ProductWish::with('product')->where('user_id', $userId)->get();

            return ResponseHelper::Out(true, $productWishList, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to retrieve wishlist items', 500);
        }
    }

    /**
     * Add a product to the wishlist or update an existing entry.
     *
     * @param  object  $request
     * @return object
     */
    public function addProductWish($request)
    {
        try {
            $user_id = $request->header('id');

            // Add or update the wishlist entry
            ProductWish::updateOrCreate(
                ['user_id' => $user_id, 'product_id' => $request->productId]
            );

            return ResponseHelper::Out(true, 'Product added to wishlist', 200);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to add product to wishlist', 500);
        }
    }

    /**
     * Remove a product from the wishlist.
     *
     * @param  object  $request
     * @return object
     */
    public function deleteProductWish($request)
    {
        try {
            $user_id = $request->header('id');

            // Locate the wishlist item
            $ProductWish = ProductWish::where('user_id', $user_id)
                ->where('product_id', $request->productId)
                ->first();

            if (! $ProductWish) {
                return ResponseHelper::Out(false, 'Product not found in wishlist', 404);
            }

            // Delete the wishlist item
            $ProductWish->delete();

            return ResponseHelper::Out(true, 'Product removed from wishlist', 200);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to remove product from wishlist', 500);
        }
    }
}
