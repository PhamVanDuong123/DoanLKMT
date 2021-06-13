<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request,$next){
            session(['mod_active'=>'dashboard']);
            return $next($request);
        });
    }

    function show(){
        return view('admin.dashboard.show');
    }
}
