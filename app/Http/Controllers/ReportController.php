<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claim;
use App\Comment;
use Session;
use DB;

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
            $monitoring=DB::select(DB::raw("SELECT A.id_claim, A.created_at, A.nama_distributor, A.category_type, A.nama_program, A.value,  A.status, GROUP_CONCAT(DISTINCT B.comment SEPARATOR ' ') as comment, A.pr_number,A.invoice_number FROM claims A, comments B WHERE A.id_claim=B.id_claim GROUP BY A.id_claim, A.created_at, A.nama_distributor, A.category_type, A.nama_program, A.value,  A.status,A.pr_number,A.invoice_number"));
            return view('user/monitoringreport')->with('monitoring',$monitoring);
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
