<?php

namespace App\Http\Controllers\payment;

use Illuminate\Http\Request;
use App\Service\payment\vatService;
use App\Http\Controllers\Controller;

class vatController extends Controller
{
    // vatService instance
    protected $vat;

    // Constructor to bind vatService instance
    public function __construct(vatService $vat)
    {
        $this->vat = $vat;
    }

    // Get Vat Method Start ****************************************************
    public function getVat(Request $request)
    {
        return $this->vat->getVat($request);
    }
    // Get Vat Method End ****************************************************
}
