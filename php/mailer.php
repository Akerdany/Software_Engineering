<?php
use PHPMailer\PHPMailer\PHPMailer;
include_once "PHPMailer\PHPMailer.php";
include_once "PHPMailer\Exception.php";
include_once "PHPMailer\SMTP.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    }
    $promoc=$_SESSION['promoc'];
    $promov=$_SESSION['promov'];
    $email=$_SESSION['email'];
$mail= new PHPMailer(true);
$mail->SMTPDebug = 2;
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "reservationSE123@gmail.com";
$mail->Password = "reservation123";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->addAddress($email);
$mail->setFrom('reservationSE123@gmail.com');
$mail->isHTML(true);
$mail->Subject = "Contact Chicken News ";
$mail->Body ="use code ".$promoc." to get ".$promov."% off" ;
echo $email;
// var_dump( $mail->send());
if($mail->send()){

}else{
echo "error sending mail to ".$email;
}
?>