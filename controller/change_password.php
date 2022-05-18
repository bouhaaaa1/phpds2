<?php
session_start();
    if($_SESSION['login'] && $_SESSION['password']){
    require '../config.php';
    $user = $_POST['user'];
    $psw = $_POST['psw'];
    $sql="UPDATE admin SET password = '$psw' where user = '$user'";
			$db = config::getConnexion();
			try {
				$query = $db->prepare($sql);
                if($query->execute()){
                    $_SESSION['password'] = $psw;
                    echo "True";
                }
			} catch (PDOException $e) {
				$e->getMessage();
			}
}else{
    header("location:../views/sign-in.php");
}
?>