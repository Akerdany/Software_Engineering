<?php
use PHPMailer\PHPMailer\PHPMailer;
require('Iobserver.php');
class SMS implements Iobserve
{
    public $numbers;
    function __construct($n)
    {
        $this->numbers=$n;
    }
    public  function notify()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
            $promoc=$_SESSION['promoc'];
            $promov=$_SESSION['promov'];
        $key = "9878a9e8-0451-4e77-a637-0aa965bab1d4";
        $secret = "IkaHL23HG0SWetBMMIueFA==";
        $phone_number = $this->numbers;
        
        $user = "application\\" . $key . ":" . $secret;
        $message = array("message"=>"use code ".$promoc." to get ".$promov."% off");
        $data = json_encode($message);
        $ch = curl_init('https://messagingapi.sinch.com/v1/sms/' . $phone_number);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_USERPWD,$user);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
        $result = curl_exec($ch);
        
        if(curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            echo $result;
        }
        
        curl_close($ch);
        echo "SMS to ".$this->numbers."<br>";
    }

} 
class Email implements Iobserve
{
    public $em;
    function __construct($e)
    {
        $this->em=$e;
    }
    public  function notify()
    {
        
        include_once "PHPMailer\PHPMailer.php";
        include_once "PHPMailer\Exception.php";
        include_once "PHPMailer\SMTP.php";
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
            $promoc=$_SESSION['promoc'];
            $promov=$_SESSION['promov'];
           
        $mail= new PHPMailer(true);
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "reservationSE123@gmail.com";
        $mail->Password = "reservation123";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->addAddress($this->em);
        $mail->setFrom('reservationSE123@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = "court Reservation ";
        $mail->Body ="use code ".$promoc." to get ".$promov."% off" ;
        echo $this->em;
        // var_dump( $mail->send());
        if($mail->send()){
        
        }else{
        echo "error sending mail to ".$this->em;
        }
    }

}
?>