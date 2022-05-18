<?php
session_start();
if($_SESSION['login'] && $_SESSION['password']){
        require '../config.php';
    $old = $_POST['oldname'];
    $new = $_POST['newname'];
    $pass = $_POST['password'];
    $avatar = $_POST['avatar'];
    $sql="UPDATE admin SET user ='$new' ,image = '$avatar' WHERE user = '$old' and password = '$pass'";
			$db = config::getConnexion();
			try {
				$query = $db->prepare($sql);
                if($query->execute()){
                    $_SESSION['login'] = $new;
                    echo "True";
                }
			} catch (PDOException $e) {
				$e->getMessage();
			}
}else{
    header("location:../views/sign-in.php");
}
?>
