<?php
include_once('total.php');
include_once('price.php');
$price ;

$price = new total(10);
echo $price->getDesc();
echo $price->cost();
echo '<br>';
$t = new Taxs($price,1.2);
echo $t->getDesc();
echo $t->cost();
echo '<br>';
$p = new promo($t,1.1);
echo $p->getDesc();
echo $p->cost();
echo '<br>';
$d = new Discount($p,0.75);
echo $d->getDesc();
echo $d->cost();
echo '<br>';
?>