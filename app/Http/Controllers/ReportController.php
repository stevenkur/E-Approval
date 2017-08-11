<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claim;
use App\Comment;
use App\Marketing;
use Session;
use DatePeriod;
use DateTime;
use DateInterval;
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
            $monitoring=DB::select(DB::raw("SELECT A.id_claim, A.created_at, A.nama_distributor ,A.nama_category, A.category_type, A.nama_program, A.value,  A.status, GROUP_CONCAT(DISTINCT B.comment SEPARATOR ' ') as comment, A.pr_number,A.invoice_number,A.entitlement, A.payment_form, A.original_tax, A.airwaybill, A.courier FROM claims A, comments B WHERE A.id_claim=B.id_claim GROUP BY A.id_claim, A.created_at, A.nama_distributor, A.category_type, A.nama_program, A.value,  A.status, A.pr_number, A.invoice_number, A.nama_category, A.entitlement, A.payment_form, A.original_tax, A.airwaybill, A.courier"));
            $comment=DB::select(DB::raw("SELECT A.id_claim, A.comment, B.nama_user as id_user, A.created_at FROM comments A, users B WHERE A.id_user=B.id_user"));
            $status=DB::select(DB::raw("SELECT B.nama_user as id_user, A.id_claim, A.id_activity, C.nama_activity as id_activity, A.created_at FROM log_claims A, users B, activities C WHERE A.id_user=B.id_user AND A.id_activity=C.id_activity"));
            $attachment=DB::select(DB::raw("SELECT * FROM Claim_attachments"));
            return view('user/monitoringreport')->with('monitoring',$monitoring)->with('comment',$comment)->with('status',$status)->with('attachment',$attachment);
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
            $claim= array();
            $categorynow = Session::get('categories');
            $idcategorynow = DB::select(DB::raw("SELECT id_category FROM categories WHERE nama_category='$categorynow' "));            
            $holiday = DB::select(DB::raw("SELECT tanggal_libur from holidays"));     
            $holiday_length = sizeof($holiday);      
           
            $idcategory = $idcategorynow[0]->id_category;
            
            $role = DB::select(DB::raw("SELECT A.id_role,A.id_user,A.id_category,B.nama_role FROM category_accesses A, roles B, categories C WHERE A.id_category=C.id_category and B.nama_role!='Distributor' and A.id_role=B.id_role and A.id_category=$idcategory"));            
            
            $role_length = sizeof($role);
            $claim = DB::select(DB::raw("SELECT A.id_claim, B.nama_program,C.id_user, C.created_at FROM claims A, programs B, log_claims C, categories D where C.id_activity=2 and A.id_claim=C.id_claim and A.nama_program=B.nama_program  and A.nama_category=D.nama_category"));            
            // dd($claim);
            $length = sizeof($claim);
            $pisah = array();
                        
            foreach($claim as $key=>$value){
                $id = $value->id_claim;
                
                if(!isset($pisah[$id])) 
                {
                    $pisah[$id] = array();
                    $i=0;

                }
                $i++;
                $pisah[$id][$i] = $value;

            }

            // dd($pisah);
            $tes=array();
            $array=array();
            $arr_keys = array_keys($pisah);
            $arr_keys_length = sizeof($arr_keys);
           
            // dd($arr_keys);
            for($m=0;$m<$arr_keys_length;$m++)
            {
                $id=$arr_keys[$m];
                $jumlah = sizeof($pisah[$id]);
                // dd($pisah);
                for($i=1;$i<$jumlah;$i++)
                    {
                    $tes=(strtotime($pisah[$id][$i+1]->created_at)-strtotime($pisah[$id][$i]->created_at));                
                    $datediff= floor($tes / (60 * 60 * 24));
                    $from= $claim[$i]->created_at;
                    $start = DateTime::createFromFormat("Y-m-d H:i:s","$from");
                    $interval = new DateInterval("P1D");
                    $period = new DatePeriod($start,$interval,$datediff);
                    $difference=iterator_count($period);

                    foreach($period as $dt)
                    {
                        $array[] = $dt->format("Y-m-d");
                    }
                    $date[$id][$i]= $array;
                    $array=array();
                    }

                // $cumates = sizeof($date[$id][$m+1]);
                // dd($cumates);  
            }
            
            dd($date);
            return view('user/resolutionreport')->with('role',$role);
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
            $marketing=DB::select(DB::raw("SELECT a.id_dist, a.nama_distributor, CONCAT('Rp ',FORMAT(a.entitlement,0,'de_DE')) as entitlement, a.id_program, a.nama_program, a.maxclaim_date, CONCAT('Rp ',FORMAT(IFNULL(b.Pending,0),0,'de_DE')) AS Pending, CONCAT('Rp ',FORMAT(IFNULL(b.Closed,0),0,'de_DE')) AS Closed
                    FROM ((SELECT  A.id_dist, B.nama_distributor, A.id_program, C.nama_program, SUM(A.entitlement) as entitlement,  A.maxclaim_date 
                    FROM marketings A, distributors B, programs C
                    WHERE (A.id_dist=B.id_dist and A.id_program=C.id_program ) 
                    GROUP BY  A.id_dist, B.nama_distributor, A.id_program, C.nama_program,A.maxclaim_date) AS A 
                    LEFT JOIN 
                    (SELECT C.nama_distributor, D.nama_program, SUM(IF(A.status!='Closed',A.value,NULL)) as Pending,SUM(IF(A.status='Closed',A.value,NULL)) as Closed 
                    FROM  claims A, users B, distributors C, programs D, user_distributors E
                    WHERE  (E.id_user=B.id_user and A.nama_distributor=B.email and E.id_dist=C.id_dist and A.nama_program=D.nama_program) 
                    GROUP BY C.nama_distributor, D.nama_program) as B 
                    on (A.nama_distributor=B.nama_distributor AND A.nama_program=B.nama_program))"));

            $market=DB::select(DB::raw("SELECT a.id_dist, a.nama_distributor, CONCAT('Rp ',FORMAT(a.entitlement,0,'de_DE')) as entitlement, a.id_category, a.nama_category,  CONCAT('Rp ',FORMAT(IFNULL(b.Pending,0),0,'de_DE')) AS Pending, CONCAT('Rp ',FORMAT(IFNULL(b.Closed,0),0,'de_DE')) AS Closed
                    FROM ((SELECT A.id_dist, B.nama_distributor ,SUM(A.entitlement) as entitlement, D.nama_category, D.id_category 
                    FROM marketings A, distributors B, programs C, categories D 
                    WHERE (A.id_dist=B.id_dist and A.id_program=C.id_program and A.id_category=D.id_category) 
                    GROUP BY  A.id_dist, B.nama_distributor, D.nama_category, D.id_category) AS A 
                    LEFT JOIN 
                    (SELECT C.nama_distributor, D.nama_category, SUM(IF(A.status!='Closed',A.value,NULL)) as Pending,SUM(IF(A.status='Closed',A.value,NULL)) as Closed 
                    FROM  claims A, users B, distributors C, categories D, user_distributors E
                    WHERE  (E.id_user=B.id_user and A.nama_distributor=B.email and E.id_dist=C.id_dist and A.nama_category=D.nama_category) 
                    GROUP BY C.nama_distributor, D.nama_category) as B 
                    on (A.nama_distributor=B.nama_distributor AND A.nama_category=B.nama_category))"));                   
            
            return view('user/summaryclaimreport')->with('marketing',$marketing)->with('market',$market);
        }
    }
}
