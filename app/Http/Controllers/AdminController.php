<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function query()
    {
        return view('admin/query');
    }

    public function queryresult()
    {
        return view('admin/query');
    }

    public function listticket()
    {
        return view('admin/listticket');
    }

    public function listattachment()
    {
        return view('admin/listattachment');
    }

    public function listperiod()
    {
        return view('admin/listperiod');
    }
}
