<?php

namespace App\Http\Controllers\policy;

use App\Http\Controllers\Controller;
use App\Service\policy\policyService;

class policyController extends Controller
{
    // policyService instance
    protected $policies;

    // Constructor to bind policyService instance
    public function __construct(policyService $policies)
    {
        $this->policies = $policies;
    }
}
