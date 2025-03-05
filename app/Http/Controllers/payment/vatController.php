<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Service\payment\vatService;
use Illuminate\Http\Request;

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

    // Update Or Create Vat Method Start ****************************************************
    public function updateOrCreateVat(Request $request)
    {
        return $this->vat->updateOrCreateVat($request);
    }
    // Update Or Create Vat Method End ****************************************************

}
