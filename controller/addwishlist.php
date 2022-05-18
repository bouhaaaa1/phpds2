<?php
session_start();
$id = $_POST['id'];
$quantity = $_POST['quantity'];
$prix = $_POST['prix'];
$label = $_POST['label'];
$image = $_POST['image'];
if(array_key_exists($id,$_SESSION['wishlist'])){
    $_SESSION['wishlist'][$id]['quantity'] += floatval($quantity);
}else{
    $_SESSION['wishlist'] += [$id => ['quantity' => $quantity , 'prix' => $prix , 'label' => $label , 'image' => $image, 'id'=> $id]];
}

echo $_SESSION['wishlist'];
?>


