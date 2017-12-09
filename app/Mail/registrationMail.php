<?php
namespace App\Mail;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class registrationMail extends Mailable
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
        return $this->view('mail.registration_mail',['fname'=>$request->fname,'lname'=>$request->lname,'v_code'=>$request->v_code,'id'=>$request->id])->to($request->email)->from('noreply@msecomerce.com');
    }
}
