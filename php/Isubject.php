
<?php  
  require('notifier.php');
  require_once('Iobserver.php');
interface Isubject { 
   public  function AddObserver(Iobserve $o); 
   public  function deleteobserver(Iobserve $o); 
   public function fireobserver();
}  
class subject implements Isubject 
{
    
    public $obs;
    function __construct()
    {
        $this->obs=array();
        
    }
    public  function AddObserver(Iobserve $o)
    {
        array_push($this->obs, $o);
        
    }
    public  function deleteobserver(Iobserve $o)
    {
        $arrKeys = array_keys($this->observers, $o);
        unset($this->list[$arrKeys]);

    }
    public  function fireobserver()
    {
        foreach ($this->obs as $o) {
            $o->notify();
        }
        
    }
}

?> 
