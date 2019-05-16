<?php

interface Icrud{
    public static function display($this_page_first_result, $results_per_page);
    public static function add($object);
    public static function edit($object);
    public static function delete($id);
}


?>