<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Claim;
use App\Comment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
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
            $date=date('Ym');
            $program=Program::all();
            $entitlement=DB::select(DB::raw('SELECT * FROM programs'));
            $regno=DB::select(DB::raw("SELECT LPAD(SUBSTRING_INDEX(id_claim,'-',-1)+1, 5, '0') as number FROM claims WHERE id_claim LIKE '$date%'"));
            return view('user/newclaim')->with('program',$program)->with('regno',$regno);
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

    public function saveclaim(Request $request)
    {
        //
        $input = Input::all();
        dd($input);

        $file1 = $input['file1'];
        $file2 = $input['file2'];
        $file3 = $input['file3'];
        $another = $input['another'];

        $destinationPath = public_path() . '/' . $input['regno'];

        $extension1 = $file1->getClientOriginalExtension();
        $fileName1 = $file1->getClientOriginalName();
        $file1->move($destinationPath, $fileName1);

        $extension2 = $file2->getClientOriginalExtension();
        $fileName2 = $file2->getClientOriginalName();
        $file2->move($destinationPath, $fileName2);

        $extension3 = $file3->getClientOriginalExtension();
        $fileName3 = $file3->getClientOriginalName();
        $file3->move($destinationPath, $fileName3);

        $claim = new Claim();
        $claim->id_claim = $input['regno'];
        $claim->nama_category = 
        $claim->category_type = 
        $claim->nama_program = 
        $claim->value = 
        $claim->entitlement = 
        $claim->programforyear = 
        $claim->pr_number = 
        $claim->invoice_number = 
        $claim->airwaybill = 
        $claim->payment_form = 
        $claim->original_tax = 
        $claim->nama_distributor = 
        $claim->kode_flow = 
        $claim->level_flow = 
        $claim->status = 
        $claim->courier = 
        $claim->doc_check1 = 
        $claim->doc_check2 = 
        $claim->doc_check3 = 
        $claim->doc_check4 = 
        $claim->doc_check5 = 
        $claim->doc_check6 = 
        $claim->doc_check7 = 
        $claim->doc_check8 = 
        $claim->doc_check9 = 
        $claim->save();

    }

    public function editclaim()
    {
        //
        $photo=$input['photo'];
        $destinationPath = public_path() . '/uploads';
        $extension = $photo->getClientOriginalExtension();
        $fileName = $photo->getClientOriginalName();
        $photo->move($destinationPath, $fileName);
    }
}
