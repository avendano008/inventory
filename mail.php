<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
// include 'connect/connect.php';
session_start();
// $type=$_SESSION['type'];

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$recipient="a.avendano@asiatech.edu.ph"; // Recipient

$verification = random_int(100000, 999999); // Random 6 number

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                               //Send using SMTP

    $mail->SMTPAuth   = true;                                      //Enable SMTP authentication
    $mail->Host       = 'smtp.gmail.com';                          //Set the SMTP server to send through
    $mail->Username   = 'iiptsystem@gmail.com';                    //SMTP username
    $mail->Password   = 'zqcwpekjebyioizn';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('iiptsystem@gmail.com', 'Inventory System'); // Title
    $mail->addAddress($recipient, '');     //Add a recipient

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verification Code ';              
    $mail->Body    = 'Your verification number is<br><br> <center> <h1 class="display-1">'.$verification.'</h1></center>';
    $mail->AltBody = '';

    if($mail->send()){
        echo"email send";
    }

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}