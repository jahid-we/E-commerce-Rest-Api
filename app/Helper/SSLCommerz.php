<?php

namespace App\Helper;

use App\Models\Invoice;
use App\Models\SslcommerzAccount;
use Exception;
use Illuminate\Support\Facades\Http;

class SSLCommerz
{
    public static function InitiatePayment($cusProfile, $payable, $tran_id, $userEmail): array
    {
        try {
            $ssl = SslcommerzAccount::first();
            $response = Http::asForm()->post($ssl->init_url, [
                'store_id' => $ssl->store_id,
                'store_passwd' => $ssl->store_passwd,
                'total_amount' => $payable,
                'currency' => $ssl->currency,
                'tran_id' => $tran_id,
                'success_url' => "$ssl->success_url?tran_id=$tran_id",
                'fail_url' => "$ssl->fail_url?tran_id=$tran_id",
                'cancel_url' => "$ssl->cancel_url?tran_id=$tran_id",
                'ipn_url' => $ssl->ipn_url,
                'cus_name' => $cusProfile->cus_name,
                'cus_email' => $userEmail,
                'cus_add1' => $cusProfile->cus_add,
                'cus_add2' => $cusProfile->cus_add,
                'cus_city' => $cusProfile->cus_city,
                'cus_state' => $cusProfile->cus_city,
                'cus_postcode' => $cusProfile->cus_postcode,
                'cus_country' => $cusProfile->cus_country,
                'cus_phone' => $cusProfile->cus_phone,
                'cus_fax' => $cusProfile->cus_phone,
                'shipping_method' => 'YES',
                'ship_name' => $cusProfile->ship_name,
                'ship_add1' => $cusProfile->ship_add,
                'ship_add2' => $cusProfile->ship_add,
                'ship_city' => $cusProfile->ship_city,
                'ship_state' => $cusProfile->ship_city,
                'ship_country' => $cusProfile->ship_country,
                'ship_postcode' => $cusProfile->ship_postcode,
                'product_name' => 'Apple Shop Product',
                'product_category' => 'Apple Shop Category',
                'product_profile' => 'Apple Shop cusProfile',
                'product_amount' => $payable,
            ]);

            return $response->json('desc');
        } catch (Exception $e) {
            return $ssl;
        }

    }

    public static function InitiateSuccess($tran_id): int
    {
        Invoice::where(['tran_id' => $tran_id, 'val_id' => 0])->update(['payment_status' => 'Success']);

        return 1;
    }

    public static function InitiateFail($tran_id): int
    {
        Invoice::where(['tran_id' => $tran_id, 'val_id' => 0])->update(['payment_status' => 'Fail']);

        return 1;
    }

    public static function InitiateCancel($tran_id): int
    {
        Invoice::where(['tran_id' => $tran_id, 'val_id' => 0])->update(['payment_status' => 'Cancel']);

        return 1;
    }

    public static function InitiateIPN($tran_id, $status, $val_id): int
    {
        Invoice::where(['tran_id' => $tran_id, 'val_id' => 0])->update(['payment_status' => $status, 'val_id' => $val_id]);

        return 1;
    }
}
