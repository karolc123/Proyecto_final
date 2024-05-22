<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


class Email
{

    public function sendEmail($email,$cedula,$tipo,$nombre,$telefono,$direccion)
    {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 0;
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'miyarlethvarelas@gmail.com';                     //SMTP username
            // $mail->Password   = 'uxhrrzfelyffrzrq';                               //SMTP password
            $mail->Password   = 'lozanomiyarleth123';                               //SMTP password, con
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            // $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('miyarlethvarelas@gmail.com', 'REGISTRO');
            $mail->addAddress($email);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            
            for ($i=0; $i < $totalArchivos; $i++) { 
              $mail->addAttachment($file['tmp_name'][$i], $file['name'][$i]);         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            }
            

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "REGISTRO DE - ".$nombre;
            $mail->Body    = "<h1>".$cedula."</h1><br><h3>".$telefono."</h3> <br> <h3>".$tipo."</h3>";
            
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // echo 'Message has been sent';
            // echo 'el mensaje ha sido enviado';
            echo 1;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
