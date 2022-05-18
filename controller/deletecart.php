<?php
session_start();
if(isset($_SESSION['cart']) && isset($_SESSION['total'])){
$id = $_POST['id'];
unset($_SESSION['cart'][$id]);
unset($_SESSION['total'][$id]);
echo "True";
}
?>
