<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claim;
use App\Comment;
use App\Marketing;
use Session;
use DB;

class ReportController extends Controller
{
    public function monitoringreport()
    {
        //
        if (!(Session::has('email')))
        {
            return redirect('login');
        }
        else
        {
            $monitoring=DB::select(DB::raw("SELECT A.id_claim, A.created_at, A.nama_distributor, A.category_type, A.nama_program, A.value,  A.status, GROUP_CONCAT(DISTINCT B.comment SEPARATOR ' ') as comment, A.pr_number,A.invoice_number,A.nama_category,A.entitlement FROM claims A, comments B WHERE A.id_claim=B.id_claim GROUP BY A.id_claim, A.created_at, A.nama_distributor, A.category_type, A.nama_program, A.value,  A.status,A.pr_number,A.invoice_number,A.nama_category,A.entitlement"));
            return view('user/monitoringreport')->with('monitoring',$monitoring);
        }
    }

    public function resolutionreport()
    {
        //
        if (!(Session::has('email')))
        {
            return redirect('login');
        }
        else
        {
            return view('user/resolutionreport');
        }
    }

    public function summaryclaimreport()
    {
        //
        if (!(Session::has('email')))
        {
            return redirect('login');
        }
        else
        {
            $marketing=DB::select(DB::raw("SELECT A.id_marketing, A.id_dist, B.nama_distributor, A.id_program, C.nama_program, A.entitlement,  A.maxclaim_date, D.nama_category, D.id_category FROM marketings A, distributors B, programs C, categories D WHERE A.id_dist=B.id_dist and A.id_program=C.id_program and A.id_category=D.id_category"));
            return view('user/summaryclaimreport')->with('marketing',$marketing);
        }
    }
}
