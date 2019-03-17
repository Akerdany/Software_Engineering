<?php 
require_once("connection.php");
class Manager extends User {


public static function editUsers()
{
    parent::displayAllUsers();
}

public static function displayReports($reports)
{
}

public static function addCourt($court)
{   
    $court->addCourt($court);
}

public static function deleteCourt($court)
{

}

public static function deleteUser()
{

}
public static function assignPrivilege($Feature)
{

}
?>
