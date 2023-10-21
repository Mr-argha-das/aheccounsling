<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class Downloadlink extends Mailable{

    use Queueable, SerializesModels;
    public $request;
    public $subject;

    
    public function __construct($subject,$request){
       $this->request = $request;
        $this->subject = $subject;
     }

    public function build(){

        return $this->subject($this->subject)->view('emails.downloadlinkfile')->with([
        'request' => $this->request,
        ],true);
    }
 }

