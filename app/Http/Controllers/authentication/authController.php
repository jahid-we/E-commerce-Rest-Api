<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use App\Service\authentication\authService;
use Illuminate\Http\Request;

class authController extends Controller
{
    // authService instance
    protected $authService;

    // Constructor to bind authService instance
    public function __construct(authService $authService)
    {
        $this->authService = $authService;
    }

    // User Login Part Start ********************************
    public function userLogin(Request $request)
    {
        return $this->authService->userLogin($request);
    }
    // User Login Part End **********************************

    // Verify OTP Part Start ********************************
    public function verifyOTP(Request $request)
    {
        return $this->authService->verifyOTP($request);
    }
    // Verify OTP Part End **********************************

    // Logout Part Start ********************************
    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }
    // Logout Part End **********************************
}
