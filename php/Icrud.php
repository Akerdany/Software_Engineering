<?php

interface Icrud{
    public static function display();
    public static function add($object);
    public static function edit($object);
    public static function delete($id);
}


?>