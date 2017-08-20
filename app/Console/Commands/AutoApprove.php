<?php

namespace App\Console\Commands;

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
use App\Mail\ApproveClaim;
use App\Mail\WaitingApproveClaim;
use Illuminate\Console\Command;

class AutoApprove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AutoApprove:autoapproveclaims';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Approve Claims';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $claims = DB::select(DB::raw("SELECT A.id_claim, A.updated_at, A.id_staff, B.auto_approved, D.nama_role, E.nama_user, E.email FROM claims A, category_accesses B, categories C, roles D, users E WHERE A.id_staff=B.id_user AND B.id_category=C.id_category AND A.nama_category=C.nama_category AND B.id_role=D.id_role AND A.id_staff=E.id_user AND A.status NOT LIKE '%Closed%' AND A.status NOT LIKE '%Canceled%' AND A.status NOT LIKE '%Rejected%'"));
        foreach($claims as $claim)
        {
            if($claim->id_staff!=NULL)
            {
                $today=Carbon::now();
                $start = Carbon::parse($claim->updated_at);                
                $length = $today->diffInDays($start);
                // dd($length);
                if($length==$claim->auto_approved)
                {
                    $current=DB::select(DB::raw("SELECT level_flow FROM claims WHERE id_claim='$claim->id_claim'"));
                    $level=$current[0]->level_flow+1;
                    
                    $max=DB::select(DB::raw("SELECT A.level_flow FROM flows A, claims B WHERE A.kode_flow=B.kode_flow AND B.id_claim='$claim->id_claim' ORDER BY A.level_flow DESC LIMIT 1"));

                    if($level>$max[0]->level_flow)
                    {
                        $closed = Claim::where('id_claim', $claim->id_claim)->update(['status'=>'Closed']);

                        $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$claim->id_claim'"));
                        $mail=$query[0];
                        Mail::send(new ApproveClaim($mail));

                        $approve = Claim::where('id_claim', $claim->id_claim)->update(['id_staff'=>NULL]);
                    }
                    else
                    {
                        $next=DB::select(DB::raw("SELECT C.nama_role, D.id_user, D.email FROM claims A, flows B, roles C, users D, user_roles E WHERE A.kode_flow=B.kode_flow AND B.id_role=C.id_role AND C.id_role=E.id_role and E.id_user=D.id_user AND '$level'=B.level_flow AND A.id_claim='$claim->id_claim'"));
                        
                        $approve = Claim::where('id_claim', $claim->id_claim)->update(['level_flow'=>$level, 'id_staff'=>$next[0]->id_user, 'status'=>'Waiting from ' . $next[0]->nama_role . ' (' . $next[0]->email . ')']);

                        $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$claim->id_claim'"));
                        $mail=$query[0];
                        Mail::send(new ApproveClaim($mail));

                        $query=DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$claim->id_claim'"));
                        $mail=$query[0];
                        Mail::send(new WaitingApproveClaim($mail));
                    }

                    $log = new Log_claim();
                    $log->id_user=Session::get('id_user');
                    $log->id_claim=$claim->id_claim;
                    $log->id_activity='2';
                    $log->save();
                }
            }
        }
    }
}
