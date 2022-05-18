<?php
session_start();
if(isset($_SESSION['wishlist'])){
$id = $_POST['id'];
unset($_SESSION['wishlist'][$id]);
}
?>
