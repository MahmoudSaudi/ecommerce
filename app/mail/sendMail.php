<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require __DIR__.'\../../vendor\autoload.php';

class sendMail {
    public function sendEmail($email,$subject,$body)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            // $mail->Port = 2525;
            $mail->Port = 587; 
            // 465 ssl
            $mail->Username = 'd73775345c668d';
            $mail->Password = 'ce5ab192da04c6';
            $mail->SMTPSecure = 'tls';
            //Recipients
            $mail->setFrom('mai@gmail.com', 'E-commerce');
            $mail->addAddress($email);     //Add a recipient
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
        
            $mail->send();
            // echo 'Message has been sent';
            return TRUE;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";die;
            return FALSE;
        }
    }
}