<?php

use App\Http\Controllers\authentication\authController;
use App\Http\Controllers\brand\brandController;
use App\Http\Controllers\category\categoryController;
use App\Http\Controllers\customerProfile\customerProfileController;
use App\Http\Controllers\invoice\invoiceController;
use App\Http\Controllers\invoice\invoiceProductController;
use App\Http\Controllers\payment\sslcommerzController;
use App\Http\Controllers\product\productCartController;
use App\Http\Controllers\product\productReviewController;
use App\Http\Controllers\product\productWishController;
use App\Http\Middleware\TokenVerification;
use Illuminate\Support\Facades\Route;

// =====================================================
// =============== Authentication Routes ===============
// =====================================================
Route::controller(authController::class)->group(function () {
    Route::post('/user-login/{email}', 'userLogin'); // Authenticate user using email
    Route::post('/verify-otp/{email}/{otp}', 'verifyOTP'); // Verify OTP for authentication
    Route::middleware([TokenVerification::class])->get('/logout', 'logout'); // Logout user (requires authentication)
});

// =====================================================
// =============== Brand Management Routes =============
// =====================================================
Route::controller(brandController::class)->group(function () {
    Route::get('/brand-list', 'getBrands'); // Retrieve list of all available brands
    Route::middleware([TokenVerification::class])->group(function () {
        Route::post('/add-brand', 'addBrand'); // Add a new brand (Admin only)
        Route::post('/update-brand/{brandId}', 'updateBrand'); // Update an existing brand (Admin only)
        Route::delete('/delete-brand/{brandId}', 'deleteBrand'); // Delete a brand (Admin only)
    });
});

// =====================================================
// =============== Category Management Routes ==========
// =====================================================
Route::controller(categoryController::class)->group(function () {
    Route::get('/category-list', 'getCategory'); // Retrieve list of all product categories
    Route::middleware([TokenVerification::class])->group(function () {
        Route::post('/add-category', 'addCategory'); // Add a new category (Admin only)
        Route::post('/update-category/{categoryId}', 'updateCategory'); // Update an existing category (Admin only)
        Route::delete('/delete-category/{categoryId}', 'deleteCategory'); // Delete a category (Admin only)
    });
});

// =====================================================
// ============= Customer Profile Routes ==============
// =====================================================
Route::controller(customerProfileController::class)->middleware([TokenVerification::class])->group(function () {
    Route::post('/customer-profile/{userId}', 'getCustomerProfile'); // Retrieve profile details for a specific user
    Route::get('/customer-profile-by-id', 'getCustomerProfileById'); // Retrieve profile details for the authenticated user
    Route::post('/update-or-create-customerProfile', 'updateOrCreateCustomerProfile'); // Create or update customer profile
    Route::post('/delete-customer-profile', 'deleteCustomerProfile'); // Delete customer profile
});

// =====================================================
// ============== Product Review Routes ===============
// =====================================================
Route::controller(productReviewController::class)->group(function () {
    Route::post('/product-review/{productId}', 'getProductReviewByProductId'); // Retrieve product reviews by product ID
    Route::middleware([TokenVerification::class])->group(function () {
        Route::post('/add-product-review', 'addProductReview'); // Add a product review (Authenticated users only)
        Route::post('/update-product-review', 'updateProductReview'); // Update an existing review (Authenticated users only)
        Route::post('/delete-product-review', 'deleteProductReview'); // Delete a product review (Authenticated users only)
    });
});

// =====================================================
// ============== Product Wishlist Routes =============
// =====================================================
Route::controller(productWishController::class)->middleware([TokenVerification::class])->group(function () {
    Route::get('/product-wish', 'getProductWish'); // Retrieve list of products in wishlist
    Route::post('/add-product-wish/{productId}', 'addProductWish'); // Add product to wishlist
    Route::post('/delete-product-wish/{productId}', 'deleteProductWish'); // Remove product from wishlist
});

// =====================================================
// ================== Product Cart Routes =============
// =====================================================
Route::controller(productCartController::class)->middleware([TokenVerification::class])->group(function () {
    Route::get('/product-cart', 'getProductCart'); // Retrieve list of products in cart
    Route::post('/add-product-cart', 'addProductCart'); // Add product to cart
    Route::post('/delete-product-cart/{productId}', 'deleteProductCart'); // Remove product from cart
});

// =====================================================
// ==================== Invoice Routes =================
// =====================================================
Route::controller(invoiceController::class)->middleware([TokenVerification::class])->group(function () {
    Route::get('/create-invoice', 'createInvoice'); // Create an invoice for a purchase
    Route::get('/get-invoices', 'getInvoice'); // Retrieve list of invoices
});

Route::controller(invoiceProductController::class)->middleware([TokenVerification::class])->group(function () {
    Route::post('/get-invoice-product/{invoice_id}', 'getInvoiceProduct'); // Retrieve products linked to an invoice
});

// =====================================================
// ================== Payment Routes ===================
// =====================================================
Route::controller(sslcommerzController::class)->group(function () {
    Route::post('/payment-success', 'PaymentSuccess'); // Handle successful payment response
    Route::post('/payment-fail', 'PaymentFail'); // Handle failed payment response
    Route::post('/payment-cancel', 'PaymentCancel'); // Handle canceled payment response
    Route::post('/payment-ipn', 'PaymentIPN'); // Instant Payment Notification (IPN) handler
});
