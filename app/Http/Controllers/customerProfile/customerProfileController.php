<?php

namespace App\Http\Controllers\customerProfile;

use App\Http\Controllers\Controller;
use App\Service\userProfile\customerProfileService;
use Illuminate\Http\Request;

class customerProfileController extends Controller
{
    // customerProfileService instance
    protected $customerProfile;

    // Constructor to bind customerProfileService instance
    public function __construct(customerProfileService $customerProfile)
    {
        $this->customerProfile = $customerProfile;
    }

    // Method to get customer profile Start ***********************
    public function getCustomerProfile(Request $request)
    {
        return $this->customerProfile->getCustomerProfile($request);
    }
    // Method to get customer profile End *************************

    // Method to Get customer Profile By Id Start ***********************
    public function getCustomerProfileById(Request $request)
    {
        return $this->customerProfile->getCustomerProfileById($request);
    }
    // Method to Get customer Profile By Id End ***********************

    // Method to update customer profile Start ***********************
    public function updateOrCreateCustomerProfile(Request $request)
    {
        return $this->customerProfile->updateOrCreateCustomerProfile($request);
    }
    // Method to update customer profile End *************************

    // Method to delete customer profile Start ***********************
    public function deleteCustomerProfile(Request $request)
    {
        return $this->customerProfile->deleteCustomerProfile($request);
    }
    // Method to delete customer profile End *************************
}
