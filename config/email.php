<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../../resources/PHPMailer/src/Exception.php';
require '../../resources/PHPMailer/src/PHPMailer.php';
require '../../resources/PHPMailer/src/SMTP.php';

class email{
    public function sendMail($email, $receiver,$subject,$body)
    {
        $mail = new PHPMailer(true); //Create an instance; passing `true` enables exceptions
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
        $mail->isSMTP();                        //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';   //Set the SMTP server to send through
        $mail->SMTPAuth   = true;               //Enable SMTP authentication
        $mail->Username   = 'yashguruge@gmail.com'; //SMTP username
        $mail->Password   = 'zfakuafasfduilrq';                    //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    //Enable implicit TLS encryption
        $mail->Port       = 465;      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('mrpaan@gmail.com', 'Mr.Paan');
        $mail->addAddress($email, $receiver);     //Add a recipient
        $mail->addReplyTo('yashguruge@gmail.com', 'Information');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        return $mail->send();
        
    }

    function Send_Mail_attachment($email,$subject,$body,$path){

        $mail = new PHPMailer;
        $GLOBALS['mail']=$mail;
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Username = 'yashguruge@gmail.com';
        $mail->Password = 'zfakuafasfduilrq';

        $mail->setFrom('yashguruge@gmail.com','MR.PAAN');
        $mail->addAddress($email);
        $mail->addReplyTo('yashguruge@gmail.com');
        $mail->addAttachment($path);
        $mail->isHTML(true);
        $mail->WordWrap = 50;

        $mail->Subject = $subject;
        $mail->Body    = $body;
    }

}