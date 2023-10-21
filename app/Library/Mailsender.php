<?php

namespace App\Library;

use Illuminate\Support\Facades\DB;



use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;



use \App\Model\Common;



class Mailsender {



    public $phpMailer;

    public $config;



    public function __construct()

    {

        $this->common = new Common;

        $this->config = $this->common->pConfig;



        $this->phpMailer = new PHPMailer(true);



        //Server settings

        //$this->phpMailer->SMTPDebug = 2;                                  // Enable verbose debug output

        $this->phpMailer->isSMTP();                                       // Set mailer to use SMTP

        $this->phpMailer->Host       = $this->config->EmailerHost;        // Specify main and backup SMTP servers

        $this->phpMailer->SMTPAuth   = true;                              // Enable SMTP authentication

        $this->phpMailer->Username   = $this->config->EmailerUsername;    // SMTP username

        $this->phpMailer->Password   = $this->config->EmailerPassword;    // SMTP password

        $this->phpMailer->SMTPSecure = $this->config->EmailerEncryption;  // Enable TLS encryption, `ssl` also accepted

        $this->phpMailer->Port       = $this->config->EmailerPort;        // TCP port to connect to



        //Recipients

        $this->phpMailer->setFrom($this->config->EmailerUsername);

        $this->phpMailer->isHTML(true);

    }



    public function sendEmail($data)

    {

        $data['to'] = empty($data['to'])?$this->config->EmailerReceiver:$data['to'];

        

        $this->phpMailer->addAddress($data['to']);

       /* $address = explode(',', $data["to"]);

        $rec = [];

        foreach ($address as $addressSend) {

          // $this->phpMailer->addAddress($addressSend);

            $rec[] = $addressSend;

        }

        print_r($rec);die();*/

       

        //$this->phpMailer->addCC('cc@example.com');

        //$this->phpMailer->addBCC('bcc@example.com');



        //Attachments

        /*

        $this->phpMailer->addAttachment('/var/tmp/file.tar.gz');         // Add attachments

        $this->phpMailer->addAttachment('/tmp/image.jpg','new.jpg');    // Optional name

        */

        //Content

        //Set email format to HTML



        $this->phpMailer->Subject = $data['subject'];

        $this->phpMailer->Body    = $data['html'];

        /*$this->phpMailer->AltBody = 'This is the body in plain text for non-HTML mail clients';*/



        if(!empty($data['stringAttachment'])){

            $this->phpMailer->addStringAttachment($data['stringAttachment']['data'], $data['stringAttachment']['name']);

        }



        if($this->phpMailer->send())

        {

            return true;

        }

        return false;

    }



}

