<?php

namespace App\Service\invoice;

use Exception;
use App\Models\Vat;
use App\Models\Invoice;
use App\Helper\SSLCommerz;
use App\Models\ProductCart;
use App\Helper\ResponseHelper;
use App\Models\InvoiceProduct;
use App\Models\CustomerProfile;
use Illuminate\Support\Facades\DB;

class invoiceService
{
    // Create Invoice Method Start **********************************
    public function createInvoice($request)
    {
        DB::beginTransaction();
        try {
            $userId = $request->header('id');
            $userEmail = $request->header('email');
            $tran_id = uniqid();
            $payment_status = 'Pending';
            $delivery_status = 'Pending';

            $cusProfile = CustomerProfile::where('user_id', $userId)->firstOrFail();

            $cus_details = "Name: {$cusProfile->cus_name}, Address: {$cusProfile->cus_add}, City: {$cusProfile->cus_city}, Phone: {$cusProfile->cus_phone}";
            $ship_details = "Name: {$cusProfile->ship_name}, Address: {$cusProfile->ship_add}, City: {$cusProfile->ship_city}, Phone: {$cusProfile->ship_phone}";

            // Get total cart price in a single query
            $total = ProductCart::where('user_id', $userId)->sum('price');

            // Fetch VAT percentage efficiently
            $vat_percentage = Vat::value('vat_percentage'); // Directly fetch single column
            $numericVat = intval(str_replace('%', '', $vat_percentage));

            $vat = ($total * $numericVat) / 100;
            $payable = $total + $vat;

            // Create Invoice
            $invoice = Invoice::create([
                'total' => $total,
                'vat_percentage' => $vat_percentage,
                'vat_amount' => $vat,
                'payable' => $payable,
                'cus_details' => $cus_details,
                'ship_details' => $ship_details,
                'tran_id' => $tran_id,
                'delivery_status' => $delivery_status,
                'payment_status' => $payment_status,
                'user_id' => $userId,
            ]);

            $invoiceId = $invoice->id;

            // Bulk Insert for Invoice Products
            $cartList = ProductCart::where('user_id', $userId)->get(['product_id', 'qty', 'price']);
            $invoiceProducts = $cartList->map(function ($cart) use ($invoiceId, $userId) {
                return [
                    'invoice_id' => $invoiceId,
                    'product_id' => $cart->product_id,
                    'user_id' => $userId,
                    'qty' => $cart->qty,
                    'sale_price' => $cart->price,
                ];
            })->toArray();

            InvoiceProduct::insert($invoiceProducts); // Bulk insert instead of looping

            // Initiate Payment
            $paymentMethod = SSLCommerz::InitiatePayment($cusProfile, $payable, $tran_id, $userEmail);

            DB::commit();

            return ResponseHelper::Out(true, [
                ['paymentMethod' => $paymentMethod, 'payable' => $payable, 'vat' => $vat, 'total' => $total]
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();
            return ResponseHelper::Out(false, 'Failed to create invoice', 500);
        }
    }

    // Create Invoice Method End **********************************

    // Get Invoice Method Start **********************************
    public function getInvoice($request)
    {
        try {
            $userId = $request->header('id');
            $invoice = Invoice::where('user_id', $userId)->get();

            return ResponseHelper::Out('success', $invoice, 200);

        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to get invoice', 500);
        }
    }
    // Get Invoice Method End **********************************

}
