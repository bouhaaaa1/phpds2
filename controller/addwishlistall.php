<?php
session_start();
$array=$_POST['data'];
foreach($array as $row):
    if(array_key_exists($row['id'],$_SESSION['cart'])){
        $_SESSION['cart'][$row['id']]+= $row['quantity'];
        $_SESSION['total'][$row['id']] += floatval($row['quantity']*$row['prix']);
    }else{
        $_SESSION['cart']+= [intval($row['id']) => intval($row['quantity'])];
        $_SESSION['total']+= [intval($row['id']) => floatval($row['quantity']*$row['prix'])];
    }
endforeach;
$_SESSION['wishlist'] = [];


?>
