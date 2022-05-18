<?php
session_start();
//if(isset($_SESSION['cart']) && isset($_SESSION['total'])){
$id = $_POST['id'];
$q = $_POST['quantity'];
$prix = $_POST['prix'];
if(array_key_exists($id,$_SESSION['cart'])){
    $_SESSION['cart'][$id]+= $q;
    $_SESSION['total'][$id] += $prix*$q;
}else{
    $_SESSION['cart']+= [intval($id) => intval($q)];
    $_SESSION['total']+= [intval($id) => floatval($prix*$q)];
}
// }
// else{
//         $_SESSION['cart'] = array();
//         $_SESSION['total'] = array();
// }


// $_SESSION['total'] += floatval($prix*$q);

$sum = count($_SESSION['cart']);
echo htmlspecialchars(intval($sum));

//var_dump($_SESSION['cart']);
?>


