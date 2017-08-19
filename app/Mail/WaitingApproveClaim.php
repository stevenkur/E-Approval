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

class WaitingApproveClaim extends Mailable
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
        return $this->markdown('emails.waitingapproveclaim', ['nama'=>$nama])->subject('New Claim Registration Number ' . $claim->id_claim)->to($email);
    }
}
