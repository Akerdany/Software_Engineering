<?php
include_once('price.php');
// include_once('Extra.php');
class total extends price
{
    public $money;
    function __construct($m) {
        $des="court";
        $this->money=$m;
    }
    public function getDesc(){
        return  " total ";
     } 
    public function cost(){
        return $this->money;
    }
}
class Taxs extends price
{
    public $price;
    public $amount;
    function __construct(price $p,$a) 
    {
        $this->price=$p;
        $this->amount=$a;
    }
    public function getDesc(){
       return $this->price->getDesc() . "& taxs ";
    } 
    public function cost(){
        return $this->amount * $this->price->cost();
    }
}
class promo extends price
{
    public $price; 
    public $amount;
    function __construct(price $p,$a) 
    {
        $this->price=$p;
        $this->amount=$a;
    }
    public function getDesc(){
        return $this->price->getDesc() . "& promo ";
    }
    public function cost(){
        return $this->amount * $this->price->cost();
    }
}
class Discount extends price
{
    public $price; 
    public $amount;
    function __construct(price $p,$a) 
    {
        $this->price=$p;
        $this->amount=$a;
    }
    public function getDesc(){
        return $this->price->getDesc() . "& Discount ";
    }
    public function cost(){
        return $this->amount * $this->price->cost();
    }
}
?>