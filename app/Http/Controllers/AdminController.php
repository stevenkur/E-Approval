<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Claim;
use App\Claim_attachment;
use DB;


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
        $listattachment=DB::select(DB::raw("SELECT A.id_claim, A.nama_distributor, A.airwaybill, A.payment_form, A.original_tax, B.nama_attachment FROM claims A, claim_attachments B WHERE A.id_claim=B.id_claim "));
        return view('admin/listattachment')->with('listattachment', $listattachment);
    }

    public function listperiod()
    {
        return view('admin/listperiod');
    }
}
