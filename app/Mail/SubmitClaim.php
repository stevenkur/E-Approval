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

class SubmitClaim extends Mailable
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
        $email = Session::get('email');
        $value = intval(preg_replace('/[^0-9]+/', '', $request->value), 10);
        $claims = DB::select(DB::raw("SELECT * FROM claims WHERE id_claim='$request->id_claim'"));
        $claim = $claims[0];
        $comment = DB::select(DB::raw("SELECT A.created_at, B.nama_user, A.comment FROM comments A, users B WHERE A.id_claim='$claim->id_claim' AND A.id_user=B.id_user"));
        return $this->markdown('emails.submitclaim', ['claim'=>$claim, 'comment'=>$comment])->subject('Claim Registration Number ' . $claim->id_claim . ' has been submitted')->to($email);
    }
}
