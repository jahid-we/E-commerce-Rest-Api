<?php
namespace App\Service\payment;

class vatService {

    // Get Vat Method Start ****************************************************
    public static function getVat($request) {
        $userRole=$request->header("role");
        $userId=$request->header("id");
    }
    // Get Vat Method End ****************************************************
}
