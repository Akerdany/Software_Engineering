<?php
use PHPMailer\PHPMailer\PHPMailer;
require('Iobserver.php');
class SMS implements Iobserve
{
    public $numbers;
    public $msg;
    function __construct($n,$m)
    {
        $this->numbers=$n;
        $this->msg=$m;
    }
    public  function notify()
    {
        
        $key = "9878a9e8-0451-4e77-a637-0aa965bab1d4";
        $secret = "IkaHL23HG0SWetBMMIueFA==";
        $phone_number = $this->numbers;
        
        $user = "application\\" . $key . ":" . $secret;
        $message = array("message"=>$this->msg);
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
    public $msg;
    function __construct($e,$m)
    {
        $this->em=$e;
        $this->msg=$m;
    }
    public  function notify()
    {
        
        include_once "PHPMailer\PHPMailer.php";
        include_once "PHPMailer\Exception.php";
        include_once "PHPMailer\SMTP.php";
        
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
        $mail->Body =$this->msg ;
       
        if($mail->send()){
        
        }else{
        echo "error sending mail to ".$this->em;
        }
    }

}
?>