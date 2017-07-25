<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function newclaim()
    {
        //
        return view('user/newclaim');
    }

    public function listclaim()
    {
        //
        return view('user/listclaim');
    }
}
