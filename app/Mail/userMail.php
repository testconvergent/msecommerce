<?php
namespace App\Mail;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class userMail extends Mailable
{
    use Queueable, SerializesModels;
	public $userMail;
	public $userFullName;
	public $mailSubject;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userMail,$userFullName,$mailSubject)
    {
       $this->userMail=$userMail;
       $this->userFullName=$userFullName;      
	   $this->mailSubject=$mailSubject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        return $this->view('mail.user_mail',['nameOfSeller'=>$this->userFullName])
		->to($this->userMail)
		->subject($this->mailSubject)
		->from('noreply@msecomerce.com');
    }
}
