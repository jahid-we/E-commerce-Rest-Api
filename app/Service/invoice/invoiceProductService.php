<?php

namespace App\Service\invoice;

use App\Helper\ResponseHelper;
use App\Models\InvoiceProduct;
use Exception;

class invoiceProductService
{
    // Get invoiceProduct By Id Method Start **********************************
    public function getInvoiceProduct($request)
    {
        try {
            $userId = $request->header('id');
            $invoice_id = $request->invoice_id;
            $invoiceProduct = InvoiceProduct::where(['user_id' => $userId, 'invoice_id' => $invoice_id])->with('product')->get();

            // Return response
            return ResponseHelper::Out(true, $invoiceProduct, 200);
        } catch (Exception $e) {
            // Return response
            return ResponseHelper::Out(false, 'Failed to get invoice product', 500);
        }
    }
}
