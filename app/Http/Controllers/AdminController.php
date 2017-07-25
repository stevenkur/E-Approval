<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
=======
use App\Claim;
use App\Claim_attachment;
use DB;

>>>>>>> origin/master

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
        // dd(Input::all());
        $input=Input::all();
        $query=$input['query'];
        $result=DB::select(DB::raw($query));
        $raw=explode(" ", $query);
        if(strcasecmp($raw[0], 'select')==0)
        {
            // dd($result);
            return view('admin/query')->with('result', $result);

        }
        else if(strcasecmp($raw[0], 'insert')==0)
        {
            $message="Data berhasil ditambah";
            return view('admin/query', ['Message' => $message]);
        }
        else if(strcasecmp($raw[0], 'update')==0)
        {
            $message="Data berhasil diubah";
            return view('admin/query', ['Message' => $message]);
        }
        else if(strcasecmp($raw[0], 'delete')==0)
        {
            $message="Data berhasil dihapus";
            return view('admin/query', ['Message' => $message]);
        }
        else
        {
            $message="Perintah tidak diketahui";
            return view('admin/query', ['Message' => $message]);
        }
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
