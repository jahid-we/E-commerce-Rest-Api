<?php

namespace App\Service\brand;

use App\Helper\ResponseHelper;
use App\Models\Brand;
use Exception;

class brandService
{
    // Get all brands from the database Start ********************************
    public function getBrands($request)
    {
        try {

            $brandList = Brand::all();

            return ResponseHelper::Out(true, $brandList, 200);

        } catch (Exception) {

            return ResponseHelper::Out(false, 'Failed to get brands', 500);
        }
    }
    // Get all brands from the database End ********************************

    // Add new brand to the database Start ********************************
    public function addBrand($request)
    {
        try {
            $userRole = $request->header('role');

            if ($userRole === 'admin' || $userRole === 'superadmin') {
                Brand::updateOrCreate(
                    ['brandName' => $request->input('brandName')], // Condition to check existing record
                    ['brandImg' => $request->input('brandImg')] // Data to update or insert
                );

                return ResponseHelper::Out(true, 'Brand Created/Updated Successfully', 200);
            }

            return ResponseHelper::Out(false, 'Unauthorized', 403);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Brand Creation Failed', 500);
        }
    }
    // Add new brand to the database End ********************************

    // Update brand to the database Start ********************************
    public function updateBrand($request)
    {
        try {
            $userRole = $request->header('role');
            $brandId = $request->brandId;
            $brandName = $request->input('brandName');
            $brandImg = $request->input('brandImg');
            if ($userRole === 'admin' || $userRole === 'superadmin') {
                Brand::where('id', $brandId)->update(['brandName' => $brandName, 'brandImg' => $brandImg]);

                return ResponseHelper::Out(true, 'Brand Updated Successfully', 200);
            }
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Brand Update Failed', 500);
        }
    }
    // Update brand to the database End ********************************

    // Delete brand from the database Start ********************************
    public function deleteBrand($request)
    {
        try {
            $userRole = $request->header('role');
            $brandId = $request->brandId;
            if ($userRole === 'admin' || $userRole === 'superadmin') {
                Brand::where('id', $brandId)->delete();

                return ResponseHelper::Out(true, 'Brand Deleted Successfully', 200);
            }
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Brand Deletion Failed', 500);
        }
    }
    // Delete brand from the database End ********************************

}
