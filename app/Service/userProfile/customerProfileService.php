<?php

namespace App\Service\userProfile;

use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;
use Exception;

class customerProfileService
{
    // Method to get customer profile Start ***********************
    public function getCustomerProfile($request)
    {
        try {
            $userRole = $request->header('role');
            $userId = $request->userId;
            if ($userRole === 'admin' || $userRole === 'superadmin') {

                $user = CustomerProfile::with('user')->where('user_id', $userId)->first();
                if ($user) {
                    return ResponseHelper::Out(true, $user, 200);
                }

                return ResponseHelper::Out(false, 'Customer Profile Not Found', 404);
            }

            return ResponseHelper::Out(false, 'Unauthorized', 403);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to get customer or user profile', 500);
        }

    }
    // Method to get customer profile End ***********************

    // Method to Get customer Profile By Id Start ***********************
    public function getCustomerProfileById($request)
    {
        try {
            $userRole = $request->header('role');
            $userId = $request->header('id');
            if ($userRole === 'admin' || $userRole === 'superadmin' || $userRole === 'user') {

                $customerProfile = CustomerProfile::where('user_id', $userId)->first();
                if ($customerProfile) {
                    return ResponseHelper::Out(true, $customerProfile, 200);
                }

                return ResponseHelper::Out(false, 'Customer Profile Not Found', 404);
            }

            return ResponseHelper::Out(false, 'Unauthorized', 403);

        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to load customer profile', 500);

        }
    }
    // Method to Get customer Profile By Id End ***********************

    // Method to update customer profile Start ***********************

    public function updateOrCreateCustomerProfile($request)
    {
        try {
            $userRole = $request->header('role');
            $userId = $request->header('id');

            if (! in_array($userRole, ['admin', 'superadmin', 'user'])) {
                return ResponseHelper::Out(false, 'Unauthorized', 403);
            }

            CustomerProfile::updateOrCreate(
                ['user_id' => $userId],
                $request->only([
                    'cus_name', 'cus_add', 'cus_city', 'cus_state', 'cus_postcode',
                    'cus_country', 'cus_phone', 'cus_fax', 'ship_name', 'ship_add',
                    'ship_city', 'ship_state', 'ship_postcode', 'ship_country', 'ship_phone',
                ])
            );

            return ResponseHelper::Out(true, 'Customer Profile Updated Successfully', 200);

        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to update customer profile', 500);
        }
    }

    // Method to update customer profile End *************************

    // Method to delete customer profile Start ***********************
    public function deleteCustomerProfile($request)
    {
        try {
            $userRole = $request->header('role');
            $userId = $request->header('id');

            if (! in_array($userRole, ['admin', 'superadmin', 'user'])) {
                return ResponseHelper::Out(false, 'Unauthorized', 0);
            }

            $customerProfile = CustomerProfile::where('user_id', $userId)->first();

            if (! $customerProfile) {
                return ResponseHelper::Out(false, 'Customer Profile Not Found', 404);
            }

            CustomerProfile::where('user_id', $userId)->update([
                'cus_name' => '',
                'cus_add' => '',
                'cus_city' => '',
                'cus_state' => '',
                'cus_postcode' => '',
                'cus_country' => '',
                'cus_phone' => '',
                'cus_fax' => '',
                'ship_name' => '',
                'ship_add' => '',
                'ship_city' => '',
                'ship_state' => '',
                'ship_postcode' => '',
                'ship_country' => '',
                'ship_phone' => '',
            ]);

            return ResponseHelper::Out(true, 'Customer Profile Deleted Successfully', 200);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to delete customer profile', 500);
        }
    }

    // Method to delete customer profile End ***********************
}
