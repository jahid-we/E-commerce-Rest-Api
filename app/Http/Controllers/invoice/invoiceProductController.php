<?php

namespace App\Http\Controllers\invoice;

use App\Http\Controllers\Controller;
use App\Service\invoice\invoiceProductService;
use Illuminate\Http\Request;

class invoiceProductController extends Controller
{
    // invoiceProductService instance
    protected $invoiceProduct;

    // Constructor to bind invoiceProductService instance
    public function __construct(invoiceProductService $invoiceProduct)
    {
        $this->invoiceProduct = $invoiceProduct;
    }

    // Get all invoiceProduct By Id Method Start **********************************
    public function getInvoiceProduct(Request $request)
    {
        return $this->invoiceProduct->getInvoiceProduct($request);
    }
    // Get all invoiceProduct By Id Method End **********************************
}
