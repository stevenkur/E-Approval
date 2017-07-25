<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function monitoringreport()
    {
        //
        return view('user/monitoringreport');
    }

    public function resolutionreport()
    {
        //
        return view('user/resolutionreport');
    }
}
