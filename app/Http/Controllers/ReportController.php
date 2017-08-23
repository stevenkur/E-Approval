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
    private $holiday, $holiday_length;
    
    public function monitoringreport()
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
            $monitoring=DB::select(DB::raw("SELECT A.id_claim, A.created_at, A.nama_distributor, A.nama_category, A.category_type, A.nama_program, A.value,  A.status, A.pr_number, A.invoice_number,A.entitlement, A.payment_form, A.original_tax, A.airwaybill, A.courier, A.level_flow FROM claims A, log_claims B WHERE '$user'=A.id_user OR '$user'=A.id_staff OR '$user'=B.id_user AND A.id_claim=B.id_claim GROUP BY A.id_claim, A.created_at, A.nama_distributor, A.nama_category, A.category_type, A.nama_program, A.value,  A.status, A.pr_number, A.invoice_number, A.entitlement, A.payment_form, A.original_tax, A.airwaybill, A.courier, A.level_flow"));
            $comment=DB::select(DB::raw("SELECT A.id_claim, A.comment, B.nama_user as id_user, A.created_at FROM comments A, users B WHERE A.id_user=B.id_user"));
            $status=DB::select(DB::raw("SELECT B.nama_user as id_user, A.id_claim, A.id_activity, C.nama_activity as id_activity, A.created_at FROM log_claims A, users B, activities C WHERE A.id_user=B.id_user AND A.id_activity=C.id_activity"));
            $attachment=DB::select(DB::raw("SELECT * FROM claim_attachments"));            
            $categorytype=DB::select(DB::raw("SELECT category_type FROM category_details WHERE nama_category='$category'"));
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
            $this->holiday = DB::select(DB::raw("SELECT tanggal_libur from holidays"));     
            $this->holiday_length = sizeof($this->holiday);      
            $category_length = sizeof(Session::get('nama_category'));
            $category = Session::get('nama_category');
            
            $list = null;
            
            for($z=0;$z<$category_length;$z++)
            {
                $idclaim[$z] = null;
                $nama_category=$category[$z];
                $id_category = DB::select(DB::raw("SELECT id_category from categories where nama_category='$nama_category'"));
                $now= $id_category[0]->id_category;
                $role[$z] = DB::select(DB::raw("SELECT A.id_role,A.id_user,A.id_category,B.nama_role FROM category_accesses A, roles B, categories C WHERE A.id_category=C.id_category and B.nama_role!='Administrator' and A.id_role=B.id_role and A.id_category=$now"));               
                $role_length[$z] = sizeof($role[$z]);                

                $claim[$z] = DB::select(DB::raw("SELECT Distinct A.id_claim, A.nama_category, B.nama_program,C.id_user, C.created_at,E.nama_role FROM claims A, programs B, log_claims C, categories D, roles E, category_accesses F where E.id_role=F.id_role and C.id_user=F.id_user and C.id_activity=2 and A.id_claim=C.id_claim and A.nama_program=B.nama_program  and A.nama_category='$nama_category'"));
                $register[$z] = DB::select(DB::raw("SELECT Distinct A.id_claim, A.nama_category, B.nama_program,C.id_user, C.created_at,E.nama_role FROM claims A, programs B, log_claims C, categories D, roles E, category_accesses F where E.id_role=F.id_role and C.id_user=F.id_user and C.id_activity=6 and A.id_claim=C.id_claim and A.nama_program=B.nama_program  and A.nama_category='$nama_category' ORDER BY A.id_claim"));

                $x=-1;
                for($y=0; $y<count($register[$z]); $y++)
                {
                    if($y==0)
                        $idclaim[$z][++$x]=$register[$z][$y]->id_claim;
                    if($register[$z][$y]->id_claim != $idclaim[$z][$x])
                        $idclaim[$z][++$x]=$register[$z][$y]->id_claim;
                }
                                
                for($x=0; $x<count($idclaim[$z]); $x++){
                    $list[$z][$x]['category'] = $nama_category;
                    $list[$z][$x]['id_claim'] = $idclaim[$z][$x];
                    $list[$z][$x]['program'] = $register[$z][$x]->nama_program;
                    $list[$z][$x]['register'] = $register[$z][$x]->created_at;
                    
                    for($y=0; $y<$role_length[$z]; $y++)
                    {
                        $role[$z][$y]->nama_role;
                        $list[$z][$x][$role[$z][$y]->nama_role] = null;
                    }
                    
                    for($y=0; $y<count($claim[$z]); $y++)
                    {
                        if($y==0){
                            $list[$z][$x][$claim[$z][$y]->nama_role]['date'] = $claim[$z][$y]->created_at;
                            $list[$z][$x][$claim[$z][$y]->nama_role]['interval'] = $this->getInterval($list[$z][$x]['register'], $claim[$z][$y]->created_at);
                        }
                        else{
                            $list[$z][$x][$claim[$z][$y]->nama_role]['date'] = $claim[$z][$y]->created_at;
                            $list[$z][$x][$claim[$z][$y]->nama_role]['interval'] = $this->getInterval($list[$z][$x][$claim[$z][$y-1]->nama_role]['date'], $claim[$z][$y]->created_at);
                        }
                    }
                }
            }
            
//            dd($list);
//            dd($role);
            return view('user/resolutionreport')->with('role',$role)->with('list',$list);
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
                    WHERE  (E.id_user=B.id_user and A.nama_distributor=C.nama_distributor and E.id_dist=C.id_dist and A.nama_program=D.nama_program and A.id_user=B.id_user) 
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
                    WHERE  (E.id_user=B.id_user and A.nama_distributor=C.nama_distributor and E.id_dist=C.id_dist and A.nama_category=D.nama_category and A.id_user=B.id_user) 
                    GROUP BY C.nama_distributor, D.nama_category) as B 
                    on (A.nama_distributor=B.nama_distributor AND A.nama_category=B.nama_category))"));                              
            $category = DB::select(DB::raw("SELECT D.nama_category AS Category, CONCAT('Rp ',FORMAT(IFNULL(SUM(A.value),0),0,'de_DE')) AS Total, CONCAT('Rp ',FORMAT(IFNULL(SUM(IF(A.status!='Closed',A.value,NULL)),0),0,'de_DE')) AS Pending, CONCAT('Rp ',FORMAT(IFNULL(SUM(IF(A.status='Closed',A.value,NULL)),0),0,'de_DE')) as Closed FROM claims A, distributors C, categories D WHERE (A.nama_distributor=C.nama_distributor and A.nama_category=D.nama_category) GROUP BY D.nama_category"));
            
            $catCount = count($category);
            
            $i=-1;
            $j=-1;
                        
            foreach($category as $categoryy)
            {
                $color[++$i] = "hsl(".rand(0,359).",100%,50%)";
                
                $cat[$i]['title'] = $categoryy->Category.' :<br> '.$categoryy->Total;
                $cat[$i]['value'] = 100/$catCount;
                $cat[$i]['color'] = $color[$i];
                
                $subcat[++$j]['title'] = "Pending :<br> ".$categoryy->Pending;
                $subcat[$j]['value'] = 100/$catCount/2;
                $subcat[$j]['color'] = "#FF0000";
                
                $subcat[++$j]['title'] = "Closed :<br> ".$categoryy->Closed;
                $subcat[$j]['value'] = 100/$catCount/2;
                $subcat[$j]['color'] = "#00FF00";
            }
                        
            $program = DB::select(DB::raw("SELECT D.nama_program AS Program, CONCAT('Rp ',FORMAT(IFNULL(SUM(A.value),0),0,'de_DE')) AS Total, CONCAT('Rp ',FORMAT(IFNULL(SUM(IF(A.status!='Closed',A.value,NULL)),0),0,'de_DE')) AS Pending, CONCAT('Rp ',FORMAT(IFNULL(SUM(IF(A.status='Closed',A.value,NULL)),0),0,'de_DE')) as Closed FROM claims A, distributors C, programs D WHERE (A.nama_distributor=C.nama_distributor and A.nama_program=D.nama_program) GROUP BY D.nama_program"));
            
            $progCount = count($program);
            
            $i=-1;
            $j=-1;
                        
            foreach($program as $programs)
            {                
                $color[++$i] = "hsl(".rand(0,359).",100%,50%)";

                $prog[$i]['title'] = $programs->Program.' :<br> '.$programs->Total;
                $prog[$i]['value'] = 100/$progCount;
                $prog[$i]['color'] = $color[$i];
                
                $subprog[++$j]['title'] = "Pending :<br> ".$programs->Pending;
                $subprog[$j]['value'] = 100/$progCount/2;
                $subprog[$j]['color'] = "#FF0000";
                
                $subprog[++$j]['title'] = "Closed :<br> ".$programs->Closed;
                $subprog[$j]['value'] = 100/$progCount/2;
                $subprog[$j]['color'] = "#00FF00";
            }
            
            $total = DB::select(DB::raw("SELECT CONCAT('Rp ',FORMAT(IFNULL(SUM(A.value),0),0,'de_DE')) AS Total FROM claims A"));
                        
            return view('user/summaryclaimreport')->with('marketing',$marketing)->with('market',$market)->with('total',$total)->with('program',$program)->with('cat',$cat)->with('subcat',$subcat)->with('prog',$prog)->with('subprog',$subprog);
        }
    }
    
    private function getInterval($date1, $date2)
    {
        $tes=(strtotime($date1)-strtotime($date2));                
//             dd($tes);
        $datediff= floor($tes / (60 * 60 * 24));
        $from = $date2;
        $start = DateTime::createFromFormat("Y-m-d H:i:s","$from");
        $interval = new DateInterval("P1D");
        $period = new DatePeriod($start,$interval,$datediff);
//        dd($period);
        $difference=iterator_count($period);
                        
        $count=0;
        foreach($period as $dt)
        {
            for($n=0;$n<$this->holiday_length;$n++)
            {
                if($dt->format("Y-m-d")==$this->holiday[$n]->tanggal_libur)
                {                                       
                    $count++;                                     
                }     
            }                                
        }

        return $difference-$count;
    }
}