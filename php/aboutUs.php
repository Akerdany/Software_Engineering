<?php require_once('connection.php');
include('navbar.php');
$DB = new DbConnection();
$sql = 'SELECT HTML from pagecode where id = 1';
$result = mysqli_query($DB->getdbconnect(), $sql);
if($row = mysqli_fetch_array($result)){
	echo $row['HTML'];
	echo $_SESSION['userType'];
}
?>