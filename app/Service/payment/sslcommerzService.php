<?php

namespace App\Service\payment;

use App\Helper\ResponseHelper;
use App\Helper\SSLCommerz;
use Exception;

class sslcommerzService
{
    // sslcommerz payment Success method Start ****************************************************

    public function PaymentSuccess($request)
    {
        try {
            SSLCommerz::InitiateSuccess($request->query('tran_id'));

            return redirect('/');

        } catch (Exception $e) {

            return ResponseHelper::Out(false, 'Payment Success Failed', 500);
        }
    }

    // sslcommerz payment Success method End ****************************************************

    // sslcommerz payment Fail method Start ****************************************************

    public function PaymentFail($request)
    {
        try {
            SSLCommerz::InitiateFail($request->query('tran_id'));

            return redirect('/');

        } catch (Exception $e) {

            return ResponseHelper::Out(false, 'Payment Failed', 500);
        }
    }
    // sslcommerz payment Fail method End ****************************************************

    // sslcommerz payment Cancel method Start ****************************************************

    public function PaymentCancel($request)
    {
        try {
            SSLCommerz::InitiateCancel($request->query('tran_id'));

            return redirect('/');

        } catch (Exception $e) {

            return ResponseHelper::Out(false, 'Payment Cancel Failed', 500);
        }
    }
    // sslcommerz payment Cancel method End ****************************************************

    // sslcommerz payment IPN method Start ****************************************************

    public function PaymentIPN($request)
    {
        try {
            return SSLCommerz::InitiateIPN($request->input('tran_id'), $request->input('status'), $request->input('val_id'));

        } catch (Exception $e) {

            return ResponseHelper::Out(false, 'Payment IPN Failed', 500);
        }

    }
    // sslcommerz payment IPN method End ****************************************************
}
