<?php

namespace App\Service\invoice;

use App\Helper\ResponseHelper;
use App\Helper\SSLCommerz;
use App\Models\CustomerProfile;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\ProductCart;
use Exception;
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

            $cusProfile = CustomerProfile::where('user_id', $userId)->first();
            $cus_details = "Name: $cusProfile->cus_name, Address: $cusProfile->cus_add, City: $cusProfile->cus_city, Phone: $cusProfile->cus_phone";
            $ship_details = "Name: $cusProfile->ship_name, Address: $cusProfile->ship_add, City: $cusProfile->ship_city, Phone: $cusProfile->ship_phone";

            // Payment calculation

            $total = 0;

            $cartList = ProductCart::where('user_id', $userId)->get();

            foreach ($cartList as $cart) {
                $total += $cart->price;
            }
            $vat = ($total * 5) / 100;
            $payable = $total + $vat;

            $invoice = Invoice::create([
                'total' => $total,
                'vat' => $vat,
                'payable' => $payable,
                'cus_details' => $cus_details,
                'ship_details' => $ship_details,
                'tran_id' => $tran_id,
                'delivery_status' => $delivery_status,
                'payment_status' => $payment_status,
                'user_id' => $userId,
            ]);

            $invoiceId = $invoice->id;

            foreach ($cartList as $cart) {
                $invoiceProduct = InvoiceProduct::create([
                    'invoice_id' => $invoiceId,
                    'product_id' => $cart['product_id'],
                    'user_id' => $userId,
                    'qty' => $cart['qty'],
                    'sale_price' => $cart['price'],
                ]);
            }
            $paymentMethod = SSLCommerz::InitiatePayment($cusProfile, $payable, $tran_id, $userEmail);

            DB::commit();

            return ResponseHelper::Out('success', [['paymentMethod' => $paymentMethod, 'payable' => $payable, 'vat' => $vat, 'total' => $total]], 200);

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
