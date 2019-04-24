<?php
require('Iobserver.php');
class notifier implements Iobserve
{
    function __construct()
    {

    }
    public  function notify()
    {
        echo "hello world 1";
    }

} 
class not implements Iobserve
{
    function __construct()
    {

    }
    public  function notify()
    {
        echo "hello world 2";
    }

}
?>