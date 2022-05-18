<?php
session_start();
$array=$_POST['data'];
foreach($array as $row):
            $_SESSION['cart'][$row['id']]= $row['quantity'];
            $_SESSION['total'][$row['id']] = floatval($row['quantity']*$row['prix']);
endforeach;



?>


