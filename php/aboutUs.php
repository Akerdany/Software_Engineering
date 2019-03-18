<?php require_once('connection.php');
$DB = new DbConnection();
$sql = 'SELECT HTML from pagecode where id = 1';
$result = mysqli_query($DB->getdbconnect(), $sql);
if($row = mysqli_fetch_array($result)){
	echo $row['HTML'];
}
?>