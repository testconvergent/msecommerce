<?php
namespace App\Mail;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class adminMail extends Mailable
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
        return $this->view('mail.admin_mail',['fname'=>$request->first_name,'lname'=>$request->last_name,'email'=>$request->email,'password'=>$request->password,'subject'=>$request->subject])->to($request->email)->subject($request->subject)->from('noreply@msecomerce.com');
    }
}
