<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $referal_code;
    public $name;
    public $ref_url;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($referal_code,$name,$ref_url)
    {
    	$this->referal_code = $referal_code;
        $this->name = $name;
        $this->ref_url = $ref_url;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.profile.mail_page')->with('referal_code,name,ref_url');
    }
}