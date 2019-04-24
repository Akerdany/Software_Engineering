
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
    #public $observers = array();
    public $obs;
    function __construct()
    {
        $this->obs=array();
        // $this->obs = new Iobserve();
    }
    public  function AddObserver(Iobserve $o)
    {
        array_push($this->obs, $o);
        // $this->obs=$o;
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
        // $this->obs->notify();
    }
}
//   $h = new subject();
//   $n = new SMS();
//   $l = new Email();

//   $h->AddObserver($n);
//   $h->AddObserver($l);
//   $h->fireobserver();
?> 
