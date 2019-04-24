<?php
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
        echo "email to ".$this->em."<br>";
    }

}
?>