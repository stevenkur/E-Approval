<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Claim;
use App\Comment;
use App\Log_claim;
use Session;

class ApproveClaim extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $email = DB::select(DB::raw("SELECT A.nama_user, A.email, C.nama_distributor FROM users A, user_distributors B, distributors C, claims D WHERE A.id_user=B.id_user AND B.id_dist=C.id_dist AND D.id_user=A.id_user AND D.id_claim='$request->id_claim'"));
        $claims = DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
        $claim = $claims[0];
        $comment = DB::select(DB::raw("SELECT A.created_at, B.nama_user, A.comment FROM comments A, users B WHERE A.id_claim='$claim->id_claim' AND A.id_user=B.id_user"));
        $staffs = DB::select(DB::raw("SELECT A.nama_user, A.email, C.nama_distributor, G.nama_role FROM users A, user_distributors B, distributors C, claims D, categories E, category_accesses F, roles G WHERE A.id_user=B.id_user AND B.id_dist=C.id_dist AND D.id_staff=A.id_user AND D.id_claim='$request->id_claim'AND E.nama_category=D.nama_category AND E.id_category=F.id_category AND A.id_user=F.id_user AND G.id_role=F.id_role"));
        $staff = $staffs[0];
        return $this->markdown('emails.approveclaim', ['claim'=>$claim, 'comment'=>$comment, 'staff'=>$staff])->subject('Claim Registration Number ' . $claim->id_claim . ' has been approved by ' . $staff->nama_role)->to($email[0]->email);
    }
}
