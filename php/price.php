<?php

abstract class price {
    public $des = "non";
    public   function getDesc(){
        return $des;
    }
    public abstract function cost();
}
?>