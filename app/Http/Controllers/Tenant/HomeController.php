<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class HomeController
{
    public function index(Tenant $tenant)
    {   
        
        return view('tenant.home');
    }
}
