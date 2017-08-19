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
        $nama = Session::get('nama_user');
        $email = DB::select(DB::raw("SELECT A.nama_user, A.email, C.nama_distributor FROM users A, user_distributors B, distributors C, claims D WHERE A.id_user=B.id_user AND B.id_dist=C.id_dist"));
        $claims = DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
        $claim = $claims[0];
        $comment = DB::select(DB::raw("SELECT * FROM comments WHERE id_claim='$claim->id_claim'"));
        return $this->markdown('emails.approveclaim', ['nama'=>$nama, 'claim'=>$claim, 'comment'=>$comment])->subject('Claim Registration Number ' . $claim->id_claim . ' Approved')->to($email);
    }
}
