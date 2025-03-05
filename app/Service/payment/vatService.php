<?php

namespace App\Service\payment;

use App\Helper\ResponseHelper;
use App\Models\Vat;
use Exception;

class vatService
{
    // Get Vat Method Start ****************************************************
    public function getVat($request)
    {
        try {
            $userRole = $request->header('role');
            $userId = $request->header('id');

            if (in_array($userRole, ['admin', 'superadmin'])) {
                $vat = Vat::all();

                return ResponseHelper::Out(true, $vat, 200);
            }
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Vat Not Found', 500);
        }
    }
    // Get Vat Method End ****************************************************

    // Update Or Create Vat Method Start ****************************************************
    public function updateOrCreateVat($request)
    {
        try {
            $userRole = $request->header('role');
            $userId = $request->header('id');

            if (in_array($userRole, ['admin', 'superadmin'])) {
                $vat = Vat::first(); // Get the first record

                if ($vat) {
                    $vat->update(['vat_percentage' => $request->input('vat_percentage')]);
                } else {
                    $vat = Vat::create(['vat_percentage' => $request->input('vat_percentage')]);
                }

                return ResponseHelper::Out(true, 'Vat Created/Updated Successfully', 200);
            }
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Vat Create Or Update Failed', 500);
        }
    }

    // Update Or Create Vat Method End ****************************************************

}
