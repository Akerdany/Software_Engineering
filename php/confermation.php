<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <style>
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 25px;
  text-align: center;
  font-size: 16px;
  cursor: pointer;
}

.button:hover {
  background-color: green;
}
</style>
</head>
<body style="text-align: center" >
    <h1>Checkout</h1>
    <h2>xxxxxxxxxx</h2>
    <h2>Date:</h2>
    <?php if (session_status() == PHP_SESSION_NONE) {session_start();}
echo "<h3>" . $_SESSION["date"] . "</h3>";?>
    <h2>From:</h2>
    <?php if (session_status() == PHP_SESSION_NONE) {session_start();}
echo " <h3>" . $_SESSION["STime"] . "</h3>";?>
    <h2>To:</h2>
    <?php if (session_status() == PHP_SESSION_NONE) {session_start();}
echo " <h3>" . $_SESSION["ETime"] . "</h3>";?>
    <h2>Reserved Court:</h2>
    <?php if (session_status() == PHP_SESSION_NONE) {session_start();}
echo " <h3>" . $_SESSION["CN"] . "</h3>";?>
    <h2>Total Cost:</h2>
    <?php
    include_once('total.php');
    include_once('price.php');
    if (session_status() == PHP_SESSION_NONE) {session_start();}
        $p     = (float) $_SESSION["price"];
        $hours = (float) $_SESSION["NH"];
        $price = new total($p * $hours);
        echo "<h3>". $price->getDesc() . "</h3>";
        echo "<h3>". $price->cost() . "</h3>";
        echo "<br>";
        if(!empty($_SESSION["promov"])){
            $price = new promo($price,(float)$_SESSION["promov"]);
        }
        echo "<h3>".$price->getDesc() . "</h3>";
        echo "<h3>". $price->cost() . "</h3>";
        $_SESSION["sum"]=$price->cost();
        // echo "<h3>" .  . "</h3>";

?>
    <h2>Payment Method: </h2>
    <?php if (session_status() == PHP_SESSION_NONE) {session_start();}
echo " <h3>" . $_SESSION["Method"] . "</h3>";?>
    <div >
    <?php 
      $code=sha1($_SESSION["date"].$_SESSION["STime"].$_SESSION["ETime"].$_SESSION["CN"]);
      
      $_SESSION["code"]=$code;
      echo '<img src=https://api.qrserver.com/v1/create-qr-code/?data=http://localhost/Software_Engineering/php/tester.php?c='.$code.'&amp;size=100x100" alt="" title="" />';
        echo "<br>";
   ?>
    <a href="ToDB.php">
    <button class="button">confirm</button>
    </a>
    <a href="addRe.php">
    <button class="button">cancel</button>
    </a>


    </div>
</body>
</html>