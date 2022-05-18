<?php
session_start();
$id = $_POST['id'];
$q = $_POST['quantity'];
$prix = $_POST['prix'];
if(array_key_exists($id,$_SESSION['cart'])){
    $_SESSION['cart'][$id]+= $q;
    $_SESSION['total'][$id] += floatval($prix*$q);
}else{
    $_SESSION['cart']+= [intval($id) => intval($q)];
    $_SESSION['total']+= [intval($id) => floatval($prix*$q)];
}
unset($_SESSION['wishlist'][$id]);
?>