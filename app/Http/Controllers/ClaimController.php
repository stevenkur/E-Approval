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
            $program=Program::all();
            $entitlement=DB::select(DB::raw('SELECT * FROM programs'));
            $categorytype=DB::select(DB::raw("SELECT nama_category, category_type FROM category_details"));
            
            return view('user/newclaim')->with('program',$program)->with('entitlement',$entitlement)->with('categorytype',$categorytype);
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
            $monitoring=DB::select(DB::raw("SELECT A.id_claim, A.created_at, A.nama_distributor,A.nama_category, A.category_type, A.nama_program, A.value,  A.status, GROUP_CONCAT(DISTINCT B.comment SEPARATOR ' ') as comment, A.pr_number,A.invoice_number,A.entitlement FROM claims A, comments B WHERE A.id_claim=B.id_claim and A.status NOT LIKE '%approved%' GROUP BY A.id_claim, A.created_at, A.nama_distributor, A.category_type, A.nama_program, A.value,  A.status,A.pr_number,A.invoice_number, A.nama_category,A.entitlement"));
            return view('user/listclaim')->with('monitoring',$monitoring);            
        }
    }

    public function saveclaim(Request $request)
    {
        //
        $date=date('Ym');
        $query=DB::select(DB::raw("SELECT LPAD(SUBSTRING_INDEX(id_claim,'-',-1)+1, 5, '0') as number FROM claims WHERE id_claim LIKE '$date%'"));
        if($query==NULL)
        {
            $regno='00001';
        }
        else $regno=$query[0]->number;
        $id_claim=$date.'-'.$regno;

        $input = Input::all();
        // dd($input);

        $file1 = $input['file1'];
        $file2 = $input['file2'];
        // $file3 = $input['file3'];
        $another = $input['another'];

        $destinationPath = public_path() . '/' . $id_claim;

        $extension1 = $file1->getClientOriginalExtension();
        $fileName1 = $file1->getClientOriginalName();
        $file1->move($destinationPath, $fileName1);

        $extension2 = $file2->getClientOriginalExtension();
        $fileName2 = $file2->getClientOriginalName();
        $file2->move($destinationPath, $fileName2);

        // $extension3 = $file3->getClientOriginalExtension();
        // $fileName3 = $file3->getClientOriginalName();
        // $file3->move($destinationPath, $fileName3);

        $claim = new Claim();
        $claim->id_claim = $id_claim;
        $claim->nama_category = $input['categoryclaimtype'];
        $claim->category_type = $input['categorytype'];
        $claim->nama_program = $input['programname'];
        $value = intval(preg_replace('/[^0-9]+/', '', $input['value']), 10);
        $claim->value = $value;
        $entitlement = intval(preg_replace('/[^0-9]+/', '', $input['entitlement']), 10);
        $claim->entitlement = $entitlement;
        $claim->programforyear = $input['programyear'];
        // $claim->airwaybill = $fileName3;
        $claim->payment_form = $fileName1;
        $claim->original_tax = $fileName2;
        $claim->nama_distributor = Session::get('nama_user');
        $claim->kode_flow = 
        $claim->level_flow = '0';
        $claim->status = 'Submitted';
        // $claim->courier = $input['kurir'];
        $claim->doc_check1 = $input['checkbox1'];
        $claim->doc_check2 = $input['checkbox2'];
        $claim->doc_check3 = $input['checkbox3'];
        $claim->doc_check4 = $input['checkbox4'];
        $claim->doc_check5 = $input['checkbox5'];
        $claim->doc_check6 = $input['checkbox6'];
        $claim->doc_check7 = $input['checkbox7'];
        $claim->doc_check8 = $input['checkbox8'];
        $claim->save();

        $comment = new Comment();
        $comment->id_claim = $id_claim;
        $comment->comment = $input['comment'];
        $comment->id_user = Session::get('id_user');
        $comment->save();

        return redirect('listclaim');
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
