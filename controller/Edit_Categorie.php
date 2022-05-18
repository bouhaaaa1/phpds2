<?php
session_start();
    if($_SESSION['login'] && $_SESSION['password']){
    require '../config.php';
    $name = $_POST['name'];
    $catid = $_POST['catid'];
    $sql="select * from categorie where nom = '$name'";
    $db = config::getConnexion();
            try{
				$count = $db->prepare($sql);
				$count->execute();
                if($count->fetchColumn() > 0){
                    echo "False";
                }else{
                    $sql="UPDATE categorie SET nom='$name' WHERE id_cat = $catid";
			$db = config::getConnexion();
			try {
				$query = $db->prepare($sql);
                if($query->execute()){
                    echo "True";
                }
			} catch (PDOException $e) {
				$e->getMessage();
			}
                }
            }catch(PDOException $e) {
				$e->getMessage();
			}
}else{
    header("location:../views/sign-in.php");
}
?>