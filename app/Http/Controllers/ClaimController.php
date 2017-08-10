<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Claim;
use App\Comment;
use App\Log_claim;
use App\Claim_attachment;
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
            $category = Session::get('categories');
            $program=DB::select(DB::raw("SELECT B.nama_program FROM  marketings A, programs B, categories C WHERE C.nama_category='$category' and A.id_category=C.id_category and A.id_program=B.id_program"));
            $iduser=Session::get('id_user');
            $email=Session::get('email');
            $queryvalue=DB::select(DB::raw("SELECT SUM(A.value) FROM  claims A,categories B, distributors C, programs D, user_distributors E, marketings F WHERE  A.nama_distributor='$email' AND E.id_user='$iduser' AND E.id_dist=C.id_dist AND F.id_dist=C.id_dist AND F.id_program=D.id_program AND B.id_category=F.id_category and A.status='Closed' GROUP BY E.id_user, d.nama_program, f.entitlement, f.maxclaim_date"));
            
            if(isset($queryvalue))
            {
                $value=0;
            }
            else
            {
                $value=json_encode($queryvalue);
            }
            $query=DB::select(DB::raw("SELECT d.nama_program, (f.entitlement-$value) as entitlement, f.maxclaim_date FROM  categories B, distributors C, programs D, user_distributors E, marketings F WHERE  E.id_user='$iduser' AND E.id_dist=C.id_dist AND F.id_dist=C.id_dist AND F.id_program=D.id_program AND B.id_category=F.id_category  GROUP BY E.id_user, d.nama_program, f.entitlement, f.maxclaim_date"));
            $categorytype=DB::select(DB::raw("SELECT nama_category, category_type FROM category_details where nama_category LIKE '%$category%'"));
            
           
            return view('user/newclaim')->with('program',$program)->with('query',$query)->with('categorytype',$categorytype);
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
            $monitoring=DB::select(DB::raw("SELECT A.id_claim, A.created_at, A.nama_distributor ,A.nama_category, A.category_type, A.nama_program, A.value,  A.status, GROUP_CONCAT(DISTINCT B.comment SEPARATOR ' ') as comment, A.pr_number,A.invoice_number,A.entitlement, A.payment_form, A.original_tax, A.airwaybill, A.courier FROM claims A, comments B WHERE A.id_claim=B.id_claim and A.status NOT LIKE '%approved%' GROUP BY A.id_claim, A.created_at, A.nama_distributor, A.category_type, A.nama_program, A.value,  A.status, A.pr_number, A.invoice_number, A.nama_category, A.entitlement, A.payment_form, A.original_tax, A.airwaybill, A.courier"));
            $comment=DB::select(DB::raw("SELECT A.id_claim, A.comment, B.nama_user as id_user, A.created_at FROM comments A, users B WHERE A.id_user=B.id_user"));
            $status=DB::select(DB::raw("SELECT B.nama_user as id_user, A.id_claim, A.id_activity, C.nama_activity as id_activity, A.created_at FROM log_claims A, users B, activities C WHERE A.id_user=B.id_user AND A.id_activity=C.id_activity"));
            $attachment=DB::select(DB::raw("SELECT * FROM Claim_attachments"));
            // dd($monitoring);
            return view('user/listclaim')->with('monitoring',$monitoring)->with('comment',$comment)->with('status',$status)->with('attachment',$attachment);            
        }
    }

    public function saveclaim(Request $request)
    {
        //
        $input = Input::all();
        // dd($input);
        if($input['programyear']=='#'||$input['programname']=='#'||$input['categorytype']=='#')
        {
            return redirect('newclaim');
        }
        elseif($input['value']>$input['entitlement'])
        {
            return redirect('newclaim');
        }
        else
        {
            $date=date('Ym');
            $query=DB::select(DB::raw("SELECT LPAD(SUBSTRING_INDEX(id_claim,'-',-1)+1, 5, '0') as number FROM claims WHERE id_claim LIKE '$date%'"));
            if($query==NULL)
            {
                $regno='00001';
                $id_claim=$date.'-'.$regno;
            }
            else 
            {
                $length = sizeof($query);
                $regno=$query[$length-1]->number;
                $id_claim=$date.'-'.$regno;
            }

            $destinationPath = public_path() . '/attachment/' . $id_claim;

            $file1 = $input['file1'];
            $file2 = $input['file2'];
            // $file3 = $input['file3'];
            $another = $input['another'];
            $numberattachment = sizeof($input['another']);

            for($i=0;$i<$numberattachment;$i++)
            {
                $extensions[$i] = $another[$i]->getClientOriginalExtension();
                $attachs[$i]=$another[$i]->getClientOriginalName();
                $another[$i]->move($destinationPath, $attachs[$i]);
            }

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
            $claim->nama_distributor = Session::get('email');
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

            for($i=0;$i<$numberattachment;$i++)
            {
                $attachment = new Claim_attachment();
                $attachment->id_claim = $id_claim;
                $attachment->nama_attachment = $attachs[$i];
                $attachment->save();
            }       

            if($input['comment']!=NULL)
            {
                $comment = new Comment();
                $comment->id_claim = $id_claim;
                $comment->comment = $input['comment'];
                $comment->id_user = Session::get('id_user');
                $comment->save();
            }

            $log = new Log_claim();
            $log->id_user=Session::get('id_user');
            $log->id_claim=$id_claim;
            $log->id_activity='6';
            $log->save();

            if($file1!=NULL&&$file2!=NULL)
            {
                $log = new Log_claim();
                $log->id_user=Session::get('id_user');
                $log->id_claim=$id_claim;
                $log->id_activity='5';
                $log->save();
            }

            if($input['comment']!=NULL)
            {
                $log = new Log_claim();
                $log->id_user=Session::get('id_user');
                $log->id_claim=$id_claim;
                $log->id_activity='4';
                $log->save();
            }

            return redirect('listclaim');
        }
    }

    public function editclaim(Request $request)
    {
        //
        $result=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));            
        // dd($result);
        return view('user/editclaim')->with('result',$result); 
    }

    public function cancelclaim(Request $request)
    {
        //
        $cancel = Claim::where('id_claim', $request->id_claim)->update(['status'=>'Canceled']);
        $log = new Log_claim();
        $log->id_user=Session::get('id_user');
        $log->id_claim=$request->id_claim;
        $log->id_activity='9';
        $log->save();

        return redirect('listclaim');
    }

    public function addcomment(Request $request)
    {
        //
        $input = Input::all();

        $comment = new Comment();
        $comment->id_claim = $request->id_claim;
        $comment->comment = $input['comment'];
        $comment->id_user = Session::get('id_user');
        $comment->save();

        $log = new Log_claim();
        $log->id_user=Session::get('id_user');
        $log->id_claim=$request->id_claim;
        $log->id_activity='4';
        $log->save();

        return redirect('listclaim');
    }
}
