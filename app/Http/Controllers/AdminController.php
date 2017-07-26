<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Claim;
use App\Claim_attachment;
use DB;
use Session;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (strcasecmp(Session::get('email'),'administrator@philips.com')!=0)
        {
            return view('auth/login'); 
        }
        else
        {
            return view('admin/dashboard');
        }
    }

    public function query()
    {
        if (strcasecmp(Session::get('email'),'administrator@philips.com')!=0)
        {
            return view('auth/login'); 
        }
        else
        {
            return view('admin/query');
        }
    }

    public function queryresult()
    {   

        // dd(Input::all());
            if (strcasecmp(Session::get('email'),'administrator@philips.com')!=0)
            {
                return view('auth/login'); 
            }
            else
            {
                $input=Input::all();
                $query=$input['query'];
                $result=DB::select(DB::raw($query));
                $raw=explode(" ", $query);
                if(strcasecmp($raw[0], 'select')==0)
                {
                    // dd($result[0]);
                    // $columns= array();
                    $columns = \DB::connection()->getSchemaBuilder()->getColumnListing($result[0]);
                    dd($columns);
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
    }

    public function listticket()
    {
        if (strcasecmp(Session::get('email'),'administrator@philips.com')!=0)
        {
            return view('auth/login'); 
        }
        else
        {
            return view('admin/listticket');
        }
    }

    public function listattachment()
    {
        if (strcasecmp(Session::get('email'),'administrator@philips.com')!=0)
        {
            return view('auth/login'); 
        }
        else
        {
            $listattachment=DB::select(DB::raw("SELECT A.id_claim, A.nama_distributor, A.airwaybill, A.payment_form, A.original_tax, B.nama_attachment FROM claims A, claim_attachments B WHERE A.id_claim=B.id_claim "));
            return view('admin/listattachment')->with('listattachment', $listattachment);
        }
    }

    public function listperiod()
    {
        if (strcasecmp(Session::get('email'),'administrator@philips.com')!=0)
        {
            return view('auth/login'); 
        }
        else
        {
            return view('admin/listperiod');
        }
    }
}
