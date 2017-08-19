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

class RegisterClaim extends Mailable
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
        $claims = DB::select(DB::raw("SELECT * FROM claims WHERE value='$value' and nama_program='$request->programname' ORDER BY created_at DESC limit 1"));
        $claim = $claims[0];
        $comment = DB::select(DB::raw("SELECT * FROM comments WHERE id_claim='$claim->id_claim'"));
        // dd($comment);
        return $this->markdown('emails.registerclaim', ['claim'=>$claim, 'comment'=>$comment])->subject('New Claim Registration Number ' . $claim->id_claim)->to($email);
    }
}
