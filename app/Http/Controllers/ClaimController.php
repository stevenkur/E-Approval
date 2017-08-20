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
use Carbon\Carbon;
use Session;
use Mail;
use App\Mail\RegisterClaim;
use App\Mail\ApproveClaim;
use App\Mail\RejectClaim;
use App\Mail\WaitingApproveClaim;
use App\Mail\CancelClaim;
use App\Mail\SubmitClaim;

class ClaimController extends Controller
{    
    public function newclaim()
    {
        //
        $role=Session::get('role');
        if (!(Session::has('email')))
        {
            return redirect('login');
        }
        elseif($role[0]=='Distributor')
        {
            $category = Session::get('categories');
            $program = DB::select(DB::raw("SELECT B.nama_program FROM  marketings A, programs B, categories C WHERE C.nama_category='$category' and A.id_category=C.id_category and A.id_program=B.id_program"));
            $count=sizeof($program);
            $iduser = Session::get('id_user');
            $namadistributor = DB::select(DB::raw("SELECT B.nama_distributor FROM user_distributors A, distributors B WHERE '$iduser'=A.id_user AND A.id_dist=B.id_dist limit 1"));
            $nama_distributor = $namadistributor[0]->nama_distributor;
            $queryvalue=DB::select(DB::raw("SELECT D.nama_program, SUM(A.value) as value FROM claims A, categories B, distributors C, programs D, user_distributors E, marketings F WHERE A.nama_distributor='$nama_distributor' AND E.id_user='$iduser' AND E.id_dist=C.id_dist AND F.id_dist=C.id_dist AND F.id_program=D.id_program AND B.id_category=F.id_category AND A.nama_program=D.nama_program AND A.status!='Canceled' GROUP BY E.id_user, d.nama_program, f.entitlement, f.maxclaim_date"));    
            $size = sizeof($queryvalue);
            if($count==0)
            {
                $result[]=0;
            }
            else
            {
                for($i=0;$i<$count;$i++)
                {
                    $programs[]=$program[$i]->nama_program;
                    $temp=$program[$i]->nama_program;
                    $sign=0;
                    for($j=0;$j<$size;$j++)
                    {
                        if($temp==$queryvalue[$j]->nama_program)
                        {
                            $sign=1;
                            $value[]=$queryvalue[$j]->value;
                            $query[]=DB::select(DB::raw("SELECT d.nama_program, (f.entitlement-'$value[$i]') as entitlement, f.maxclaim_date FROM  categories B, distributors C, programs D, user_distributors E, marketings F WHERE E.id_user='$iduser' AND E.id_dist=C.id_dist AND F.id_dist=C.id_dist AND F.id_program=D.id_program AND B.id_category=F.id_category AND D.nama_program='$temp' GROUP BY E.id_user, d.nama_program, f.entitlement, f.maxclaim_date"));
                            $result[]=$query[$i][0];
                            break;
                        }
                    }
                    if($sign==0)
                    {
                        $value[]=0;
                        $query[]=DB::select(DB::raw("SELECT d.nama_program, f.entitlement, f.maxclaim_date FROM  categories B, distributors C, programs D, user_distributors E, marketings F WHERE E.id_user='$iduser' AND E.id_dist=C.id_dist AND F.id_dist=C.id_dist AND F.id_program=D.id_program AND B.id_category=F.id_category AND D.nama_program='$temp' GROUP BY E.id_user, d.nama_program, f.entitlement, f.maxclaim_date"));
                        $result[]=$query[$i][0];
                        $sign=2; 
                    }
                }
            }                
            // $categorytype=DB::select(DB::raw("SELECT nama_category, category_type FROM category_details where nama_category LIKE '%$category%'"));
            
            return view('user/newclaim')->with('program',$program)->with('result',$result);
        }
        else return redirect('home');
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
            $user=Session::get('id_user');
            $role=Session::get('role');
            $category=Session::get('categories');
            $monitoring=DB::select(DB::raw("SELECT A.id_claim, A.created_at, A.nama_distributor, A.nama_category, A.category_type, A.nama_program, A.value,  A.status, A.pr_number, A.invoice_number,A.entitlement, A.payment_form, A.original_tax, A.airwaybill, A.courier, A.level_flow FROM claims A WHERE '$user'=A.id_user OR '$user'=A.id_staff AND A.status NOT LIKE '%approved%' GROUP BY A.id_claim, A.created_at, A.nama_distributor, A.nama_category, A.category_type, A.nama_program, A.value,  A.status, A.pr_number, A.invoice_number, A.entitlement, A.payment_form, A.original_tax, A.airwaybill, A.courier, A.level_flow"));
            $comment=DB::select(DB::raw("SELECT A.id_claim, A.comment, B.nama_user as id_user, A.created_at FROM comments A, users B WHERE A.id_user=B.id_user"));
            $status=DB::select(DB::raw("SELECT B.nama_user as id_user, A.id_claim, A.id_activity, C.nama_activity as id_activity, A.created_at FROM log_claims A, users B, activities C WHERE A.id_user=B.id_user AND A.id_activity=C.id_activity"));
            $attachment=DB::select(DB::raw("SELECT * FROM claim_attachments"));            
            $categorytype=DB::select(DB::raw("SELECT category_type FROM category_details WHERE nama_category='$category'"));
            
            return view('user/listclaim')->with('monitoring',$monitoring)->with('comment',$comment)->with('status',$status)->with('attachment',$attachment)->with('role',$role)->with('categorytype',$categorytype);            
        }
    }

    public function saveclaim(Request $request)
    {
        //
        $input = Input::all();
        // dd($input);
        $value = intval(preg_replace('/[^0-9]+/', '', $input['value']), 10);
        $entitlement = intval(preg_replace('/[^0-9]+/', '', $input['entitlement']), 10);
        if($input['programname']=='#')
        {
            return redirect()->back()->with('alert', 'Please choose program name!')->withInput(Input::all());
        }
        elseif($input['programyear']=='#')
        {
            return redirect('newclaim')->with('alert', 'Please choose program year!')->withInput(Input::all());
        }
        elseif($value>$entitlement)
        {
            return redirect('newclaim')->with('alert', 'Your value is bigger than entitlement')->withInput(Input::all());
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

            $extension1 = $file1->getClientOriginalExtension();
            $fileName1 = $file1->getClientOriginalName();
            $file1->move($destinationPath, $fileName1);

            $extension2 = $file2->getClientOriginalExtension();
            $fileName2 = $file2->getClientOriginalName();
            $file2->move($destinationPath, $fileName2);

            // $extension3 = $file3->getClientOriginalExtension();
            // $fileName3 = $file3->getClientOriginalName();
            // $file3->move($destinationPath, $fileName3);

            for($i=0;$i<$numberattachment;$i++)
            {
                $extensions[$i] = $another[$i]->getClientOriginalExtension();
                $attachs[$i]=$another[$i]->getClientOriginalName();
                $another[$i]->move($destinationPath, $attachs[$i]);
            }

            $iduser = Session::get('id_user');
            $programname=$input['programname'];
            $real=DB::select(DB::raw("SELECT f.entitlement FROM  categories B, distributors C, programs D, user_distributors E, marketings F WHERE E.id_user='$iduser' AND E.id_dist=C.id_dist AND F.id_dist=C.id_dist AND F.id_program=D.id_program AND B.id_category=F.id_category AND D.nama_program='$programname'"));
            $real_entitlement=$real[0]->entitlement;

            $claim = new Claim();
            $claim->id_claim = $id_claim;
            $claim->id_user = Session::get('id_user');
            $claim->nama_category = $input['categoryclaimtype'];
            // $claim->category_type = $input['categorytype'];
            $claim->nama_program = $input['programname'];
            $claim->value = $value;
            $claim->entitlement = $real_entitlement;
            $claim->programforyear = $input['programyear'];
            // $claim->airwaybill = $fileName3;
            $claim->payment_form = $fileName1;
            $claim->original_tax = $fileName2;
            $id_user = Session::get('id_user');
            $query = DB::select(DB::raw("SELECT B.nama_distributor FROM user_distributors A, distributors B WHERE '$id_user'=A.id_user AND A.id_dist=B.id_dist"));
            $claim->nama_distributor = $query[0]->nama_distributor;            
            $claim->kode_flow = $input['categoryclaimtype'].'-'.$real_entitlement;
            $claim->level_flow = '0';
            $claim->status = 'Waiting Airwaybill from ' . $query[0]->nama_distributor;
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
                $comment = new Comment();
                $comment->id_claim = $id_claim;
                $comment->comment = $input['comment'];
                $comment->id_user = Session::get('id_user');
                $comment->save();

                $log = new Log_claim();
                $log->id_user=Session::get('id_user');
                $log->id_claim=$id_claim;
                $log->id_activity='4';
                $log->save();
            }

            $log = new Log_claim();
            $log->id_user=Session::get('id_user');
            $log->id_claim=$id_claim;
            $log->id_activity='6';
            $log->save();

            $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$id_claim'"));
            $mail=$query[0];
            Mail::send(new RegisterClaim($mail));

            return redirect('listclaim')->with('alert', 'Claim number ' . $id_claim . ' has been added. Please check your email!');
        }
    }

    public function editclaim(Request $request)
    {
        //
        $result=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
        $attachment=DB::select(DB::raw("SELECT * FROM claim_attachments"));

        return view('user/editclaim')->with('result',$result)->with('attachment',$attachment); 
    }

    public function updateclaim(Request $request)
    {
        //
        $input = Input::all();
        // dd($input);

        $value = intval(preg_replace('/[^0-9]+/', '', $input['value']), 10);
        $entitlement = intval(preg_replace('/[^0-9]+/', '', $input['entitlement']), 10);
        if($value>$entitlement)
        {
            return redirect('editclaim', $request->id_claim);
        }
        else
        {
            $destinationPath = public_path() . '/attachment/' . $input['id_claim'];

            if(Input::file('file1')||Input::file('file2')||Input::file('file3')||Input::file('another'))
            {
                $log = new Log_claim();
                $log->id_user=Session::get('id_user');
                $log->id_claim=$input['id_claim'];
                $log->id_activity='5';
                $log->save();
            }

            if (Input::file('file1'))
            {
                $file1 = $input['file1'];
                $extension1 = $file1->getClientOriginalExtension();
                $fileName1 = $file1->getClientOriginalName();
                $file1->move($destinationPath, $fileName1);
            }
            else
            {
                $file1 = $input['comparefile1'];
                $fileName1 = $input['comparefile1'];
            }

            if (Input::file('file2'))
            {
                $file2 = $input['file2'];
                $extension2 = $file2->getClientOriginalExtension();
                $fileName2 = $file2->getClientOriginalName();
                $file2->move($destinationPath, $fileName2);
            }
            else
            {
                $file2 = $input['comparefile2'];
                $fileName2 = $input['comparefile2'];
            }

            if (Input::file('file3'))
            {
                $file3 = $input['file3'];
                $extension3 = $file3->getClientOriginalExtension();
                $fileName3 = $file3->getClientOriginalName();
                $file3->move($destinationPath, $fileName3);
            }
            else
            {                
                $file3 = $input['comparefile3'];
                $fileName3 = $input['comparefile3'];
            }

            if(Input::file('another'))
            {
                $another = $input['another'];
                $numberattachment = sizeof($input['another']);

                for($i=0;$i<$numberattachment;$i++)
                {
                    $extensions[$i] = $another[$i]->getClientOriginalExtension();
                    $attachs[$i] = $another[$i]->getClientOriginalName();
                    $another[$i]->move($destinationPath, $attachs[$i]);
                }

                // $delete = Claim_attachment::where('id_claim', $input['id_claim'])->delete();

                for($i=0;$i<$numberattachment;$i++)
                {
                    $attachment = new Claim_attachment();
                    $attachment->id_claim = $input['id_claim'];
                    $attachment->nama_attachment = $attachs[$i];
                    $attachment->save();
                }
            }

            $claim = Claim::where('id_claim', $input['id_claim'])->update(['value'=>$value, 'payment_form'=>$fileName1, 'original_tax'=>$fileName2, 'airwaybill'=>$fileName3, 'courier'=>$input['courier'], 'doc_check1'=>$input['checkbox1'], 'doc_check2'=>$input['checkbox2'], 'doc_check3'=>$input['checkbox3'], 'doc_check4'=>$input['checkbox4'], 'doc_check5'=>$input['checkbox5'], 'doc_check6'=>$input['checkbox6'], 'doc_check7'=>$input['checkbox7'], 'doc_check8'=>$input['checkbox8']]);

            $log = new Log_claim();
            $log->id_user=Session::get('id_user');
            $log->id_claim=$input['id_claim'];
            $log->id_activity='11';
            $log->save();

            if($file3!=NULL&&$input['courier']!=NULL)
            {
                $log = new Log_claim();
                $log->id_user=Session::get('id_user');
                $log->id_claim=$input['id_claim'];
                $log->id_activity='2';
                $log->save();
            }

            $id_claim=$input['id_claim'];
            $query=DB::select(DB::raw("SELECT level_flow FROM claims WHERE id_claim='$id_claim'"));

            if($query[0]->level_flow==0)
            {
                $claim = Claim::where('id_claim', $input['id_claim'])->update(['level_flow'=> '1']);                
            }
            
            $next=DB::select(DB::raw("SELECT C.nama_role, D.id_user, D.email FROM claims A, flows B, roles C, users D, user_roles E WHERE A.kode_flow=B.kode_flow AND B.id_role=C.id_role AND C.id_role=E.id_role and E.id_user=D.id_user AND A.level_flow=B.level_flow AND A.id_claim='$id_claim'"));                
            // dd($next);
            $claim = Claim::where('id_claim', $input['id_claim'])->update(['status'=>'Waiting from ' . $next[0]->nama_role . ' (' . $next[0]->email . ')', 'id_staff'=> $next[0]->id_user]);

            $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
            $mail=$query[0];
            Mail::send(new SubmitClaim($mail));

            $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
            $mail=$query[0];
            Mail::send(new WaitingApproveClaim($mail));
            
            return redirect('listclaim')->with('alert', 'Claim number ' . $input['id_claim'] . ' has been updated');
        }
    }

    public function cancelclaim(Request $request)
    {
        //
        $cancel = Claim::where('id_claim', $request->id_claim)->update(['status'=>'Canceled', 'id_staff'=>NULL]);
        
        $log = new Log_claim();
        $log->id_user=Session::get('id_user');
        $log->id_claim=$request->id_claim;
        $log->id_activity='9';
        $log->save();

        $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
        $mail=$query[0];
        Mail::send(new CancelClaim($mail));

        return redirect('listclaim')->with('alerts', 'Claim Number ' . $request->id_claim . ' has been canceled!');
    }

    public function addcomment(Request $request)
    {
        //
        $input = Input::all();
        // dd($input);

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

        return redirect('listclaim')->with('alert', 'Comment to ' . $request->id_claim . ' added successfully!');
    }

    public function approveclaim(Request $request)
    {
        //
        $current=DB::select(DB::raw("SELECT level_flow FROM claims WHERE id_claim='$request->id_claim'"));
        $level=$current[0]->level_flow+1;
        
        $max=DB::select(DB::raw("SELECT A.level_flow FROM flows A, claims B WHERE A.kode_flow=B.kode_flow AND B.id_claim='$request->id_claim' ORDER BY A.level_flow DESC LIMIT 1"));

        if($level>$max[0]->level_flow)
        {
            $closed = Claim::where('id_claim', $request->id_claim)->update(['status'=>'Closed']);

            $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
            $mail=$query[0];
            Mail::send(new ApproveClaim($mail));

            $approve = Claim::where('id_claim', $request->id_claim)->update(['id_staff'=>NULL]);
        }
        else
        {
            $next=DB::select(DB::raw("SELECT C.nama_role, D.id_user, D.email FROM claims A, flows B, roles C, users D, user_roles E WHERE A.kode_flow=B.kode_flow AND B.id_role=C.id_role AND C.id_role=E.id_role and E.id_user=D.id_user AND '$level'=B.level_flow AND A.id_claim='$request->id_claim'"));
            
            $approve = Claim::where('id_claim', $request->id_claim)->update(['level_flow'=>$level, 'id_staff'=>$next[0]->id_user, 'status'=>'Waiting from ' . $next[0]->nama_role . ' (' . $next[0]->email . ')']);

            $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
            $mail=$query[0];
            Mail::send(new ApproveClaim($mail));

            $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
            $mail=$query[0];
            Mail::send(new WaitingApproveClaim($mail));
        }

        $log = new Log_claim();
        $log->id_user=Session::get('id_user');
        $log->id_claim=$request->id_claim;
        $log->id_activity='2';
        $log->save();

        return redirect('listclaim')->with('alert', 'Claim Number ' . $request->id_claim . ' has been approved!');
    }

    public function marketingapproveclaim(Request $request)
    {
        //
        $input=Input::all();
        $update = Claim::where('id_claim', $request->id_claim)->update(['category_type'=>$input['categorytype']]);

        $current=DB::select(DB::raw("SELECT level_flow FROM claims WHERE id_claim='$request->id_claim'"));
        $level=$current[0]->level_flow+1;
        
        $max=DB::select(DB::raw("SELECT A.level_flow FROM flows A, claims B WHERE A.kode_flow=B.kode_flow AND B.id_claim='$request->id_claim' ORDER BY A.level_flow DESC LIMIT 1"));

        if($level>$max[0]->level_flow)
        {
            $closed = Claim::where('id_claim', $request->id_claim)->update(['status'=>'Closed']);

            $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
            $mail=$query[0];
            Mail::send(new ApproveClaim($mail));

            $approve = Claim::where('id_claim', $request->id_claim)->update(['id_staff'=>NULL]);
        }
        else
        {
            $next=DB::select(DB::raw("SELECT C.nama_role, D.id_user, D.email FROM claims A, flows B, roles C, users D, user_roles E WHERE A.kode_flow=B.kode_flow AND B.id_role=C.id_role AND C.id_role=E.id_role and E.id_user=D.id_user AND '$level'=B.level_flow AND A.id_claim='$request->id_claim'"));
            
            $approve = Claim::where('id_claim', $request->id_claim)->update(['level_flow'=>$level, 'id_staff'=>$next[0]->id_user, 'status'=>'Waiting from ' . $next[0]->nama_role . ' (' . $next[0]->email . ')']);

            $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
            $mail=$query[0];
            Mail::send(new ApproveClaim($mail));

            $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
            $mail=$query[0];
            Mail::send(new WaitingApproveClaim($mail));
        }

        $log = new Log_claim();
        $log->id_user=Session::get('id_user');
        $log->id_claim=$request->id_claim;
        $log->id_activity='11';
        $log->save();

        $log = new Log_claim();
        $log->id_user=Session::get('id_user');
        $log->id_claim=$request->id_claim;
        $log->id_activity='2';
        $log->save();

        return redirect('listclaim')->with('alert', 'Claim Number ' . $request->id_claim . ' has been approved!');
    }

    public function financeapproveclaim(Request $request)
    {
        //
        $input=Input::all();
        $update = Claim::where('id_claim', $request->id_claim)->update(['pr_number'=>$input['prnumber'], 'invoice_number'=>$input['invoicenumber']]);

        $current=DB::select(DB::raw("SELECT level_flow FROM claims WHERE id_claim='$request->id_claim'"));
        $level=$current[0]->level_flow+1;
        
        $max=DB::select(DB::raw("SELECT A.level_flow FROM flows A, claims B WHERE A.kode_flow=B.kode_flow AND B.id_claim='$request->id_claim' ORDER BY A.level_flow DESC LIMIT 1"));

        if($level>$max[0]->level_flow)
        {
            $closed = Claim::where('id_claim', $request->id_claim)->update(['status'=>'Closed']);

            $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
            $mail=$query[0];
            Mail::send(new ApproveClaim($mail));

            $approve = Claim::where('id_claim', $request->id_claim)->update(['id_staff'=>NULL]);
        }
        else
        {
            $next=DB::select(DB::raw("SELECT C.nama_role, D.id_user, D.email FROM claims A, flows B, roles C, users D, user_roles E WHERE A.kode_flow=B.kode_flow AND B.id_role=C.id_role AND C.id_role=E.id_role and E.id_user=D.id_user AND '$level'=B.level_flow AND A.id_claim='$request->id_claim'"));
            
            $approve = Claim::where('id_claim', $request->id_claim)->update(['level_flow'=>$level, 'id_staff'=>$next[0]->id_user, 'status'=>'Waiting from ' . $next[0]->nama_role . ' (' . $next[0]->email . ')']);

            $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
            $mail=$query[0];
            Mail::send(new ApproveClaim($mail));

            $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
            $mail=$query[0];
            Mail::send(new WaitingApproveClaim($mail));
        }

        $log = new Log_claim();
        $log->id_user=Session::get('id_user');
        $log->id_claim=$request->id_claim;
        $log->id_activity='11';
        $log->save();

        $log = new Log_claim();
        $log->id_user=Session::get('id_user');
        $log->id_claim=$request->id_claim;
        $log->id_activity='2';
        $log->save();

        return redirect('listclaim')->with('alert', 'Claim Number ' . $request->id_claim . ' has been approved!');
    }

    public function rejectclaim(Request $request)
    {
        //
        $input=Input::all();
        if($input['comment']!=NULL)
        {
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

            $log = new Log_claim();
            $log->id_user=Session::get('id_user');
            $log->id_claim=$request->id_claim;
            $log->id_activity='3';
            $log->save();

            $role=Session::get('role');
            $email=Session::get('email');

            $next=DB::select(DB::raw("SELECT C.nama_role, D.id_user, D.email FROM claims A, flows B, roles C, users D, user_roles E WHERE A.kode_flow=B.kode_flow AND B.id_role=C.id_role AND C.id_role=E.id_role and E.id_user=D.id_user AND 1=B.level_flow AND A.id_claim='$request->id_claim'"));
            
            $reject = Claim::where('id_claim', $request->id_claim)->update(['level_flow'=>'1', 'status'=>'Rejected by ' . $role[0] . ' (' . $email . ')']);

            $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
            $mail=$query[0];
            Mail::send(new RejectClaim($mail));

            $reject = Claim::where('id_claim', $request->id_claim)->update(['id_staff'=>$next[0]->id_user]);

            return redirect('listclaim')->with('alerts', 'Claim Number ' . $request->id_claim . ' has been rejected!');
        }
        else
        {
            return redirect('listclaim')->with('warning', 'Please input detail comment for ' . $request->id_claim . ' before rejecting!');
        }
        
    }
}