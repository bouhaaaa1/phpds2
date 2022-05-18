<?php
session_start();
    if($_SESSION['login'] && $_SESSION['password']){
    require '../config.php';
    $id = $_POST['id'];
    $sql="DELETE FROM categorie WHERE id_cat = $id";
			$db = config::getConnexion();
			try {
				$query = $db->prepare($sql);
                if($query->execute()){
                    echo "True";
                }
			} catch (PDOException $e) {
				$e->getMessage();
			}
}else{
    header("location:../views/sign-in.php");
}
?>