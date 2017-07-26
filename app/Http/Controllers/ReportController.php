<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class ReportController extends Controller
{
    public function monitoringreport()
    {
        //
        if (!(Session::has('email')))
        {
            return view('auth/login'); 
        }
        else
        {
            return view('user/monitoringreport');
        }
    }

    public function resolutionreport()
    {
        //
        if (!(Session::has('email')))
        {
            return view('auth/login'); 
        }
        else
        {
            return view('user/resolutionreport');
        }
    }
}
