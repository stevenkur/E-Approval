<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use DB;
use Session;

class ClaimController extends Controller
{
    // public function __construct(Request $request)
    // {
    //     if(!$request->session()->has('email'))
    //         return view('auth/login');
    // }
    
    public function newclaim()
    {
        //
        if (!(Session::has('email')))
        {
            return redirect('login');
        }
        else
        {
            $program=Program::all();
            return view('user/newclaim')->with('program',$program);
        }
    }

    public function listclaim()
    {
        //
        if (!(Session::has('email')))
        {
            return redirect('login');
        }
        else
        {
            $monitoring=DB::select(DB::raw("SELECT A.id_claim, A.created_at, A.nama_distributor, A.category_type, A.nama_program, A.value,  A.status, GROUP_CONCAT(DISTINCT B.comment SEPARATOR ' ') as comment, A.pr_number,A.invoice_number FROM claims A, comments B WHERE A.id_claim=B.id_claim and A.status NOT LIKE '%approved%' GROUP BY A.id_claim, A.created_at, A.nama_distributor, A.category_type, A.nama_program, A.value,  A.status,A.pr_number,A.invoice_number"));
            return view('user/listclaim')->with('monitoring',$monitoring);
            
        }
    }
}
