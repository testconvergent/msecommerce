<?php
namespace App\Mail;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class sendMail extends Mailable
{
    use Queueable, SerializesModels;
	public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function build()
    {
		//echo"<pre>";print_r($this->data);die;
        return $this->view('mail.mail',$this->data)->to($this->data['email'])->subject('Reset Password')->from('noreply@msecommerce.com');
    }
}
