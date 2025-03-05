<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Service\payment\sslcommerzService;
use Illuminate\Http\Request;

class sslcommerzController extends Controller
{
    // sslcommerzService instance
    protected $payment;

    // Constructor to bind sslcommerzService instance
    public function __construct(sslcommerzService $payment)
    {
        $this->payment = $payment;
    }

    // sslcommerz payment Success method Start ****************************************************

    public function PaymentSuccess(Request $request)
    {
        return $this->payment->PaymentSuccess($request);
    }

    // sslcommerz payment Success method End ****************************************************

    // sslcommerz payment Fail method Start ****************************************************

    public function PaymentFail(Request $request)
    {
        return $this->payment->PaymentFail($request);
    }

    // sslcommerz payment Fail method End ****************************************************

    // sslcommerz payment Cancel method Start ****************************************************

    public function PaymentCancel(Request $request)
    {
        return $this->payment->PaymentCancel($request);
    }

    // sslcommerz payment Cancel method End ****************************************************

    // sslcommerz payment IPN method Start ****************************************************

    public function PaymentIPN(Request $request)
    {
        return $this->payment->PaymentIPN($request);
    }
    // sslcommerz payment IPN method End ****************************************************
}
