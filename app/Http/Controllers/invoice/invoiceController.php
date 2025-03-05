<?php

namespace App\Http\Controllers\invoice;

use App\Http\Controllers\Controller;
use App\Service\invoice\invoiceService;
use Illuminate\Http\Request;

class invoiceController extends Controller
{
    // invoiceService instance
    protected $invoice;

    // Constructor to bind invoiceService instance
    public function __construct(invoiceService $invoice)
    {
        $this->invoice = $invoice;
    }

    // Create invoice Method Start **********************************
    public function createInvoice(Request $request)
    {
        return $this->invoice->createInvoice($request);
    }
    // Create invoice Method End **********************************

    // Get all invoices Method Start **********************************
    public function getInvoice(Request $request)
    {
        return $this->invoice->getInvoice($request);
    }
    // Get all invoices Method End **********************************
}
