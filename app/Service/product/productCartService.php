<?php

namespace App\Service\product;

use App\Helper\ResponseHelper;
use App\Models\Product;
use App\Models\ProductCart;
use Exception;

class productCartService
{
    /**
     * Retrieve all products in the user's cart.
     *
     * @param  object  $request
     * @return object
     */
    public function getProductCart($request)
    {
        try {
            $userId = $request->header('id');

            // Fetch cart items with associated product details
            $productCartList = ProductCart::with('product')
                ->where('user_id', $userId)
                ->get();

            return ResponseHelper::Out(true, $productCartList, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to load product cart', 500);
        }
    }

    /**
     * Add a product to the cart.
     *
     * @param  object  $request
     * @return object
     */
    public function addProductCart($request)
    {
        try {
            $userId = $request->header('id');
            $product_id = $request->input('product_id');
            $color = $request->input('color');
            $size = $request->input('size');
            $qty = $request->input('qty', 1); // Default quantity to 1
            $unitPrice = 0;

            // Retrieve product details
            $productDetails = Product::find($product_id);
            if (! $productDetails) {
                return ResponseHelper::Out(false, 'Product not found', 404);
            }

            // Determine unit price based on discount availability
            $unitPrice = $productDetails->discount ? $productDetails->discount_price : $productDetails->price;

            // Calculate total price
            $totalPrice = $qty * $unitPrice;

            // Update existing cart item or create a new one
            ProductCart::updateOrCreate(
                ['user_id' => $userId, 'product_id' => $product_id],
                [
                    'user_id' => $userId,
                    'product_id' => $product_id,
                    'color' => $color,
                    'size' => $size,
                    'qty' => $qty,
                    'price' => $totalPrice,
                ]
            );

            return ResponseHelper::Out(true, 'Product added to cart', 200);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to add product to cart', 500);
        }
    }

    /**
     * Remove a product from the cart.
     *
     * @param  object  $request
     * @return object
     */
    public function deleteProductCart($request)
    {
        try {
            $userId = $request->header('id');
            $product_id = $request->productId;

            // Find the cart item for the specified user and product
            $productCart = ProductCart::where('user_id', $userId)
                ->where('product_id', $product_id)
                ->first();

            if (! $productCart) {
                return ResponseHelper::Out(false, 'Product not found in cart', 404);
            }

            // Remove the item from the cart
            $productCart->delete();

            return ResponseHelper::Out(true, 'Product removed from cart', 200);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to remove product from cart', 500);
        }
    }
}
