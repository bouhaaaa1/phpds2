<?php
session_start();
    if($_SESSION['login'] && $_SESSION['password']){
    require '../config.php';
    $id = $_POST['id'];
    $sql = "DELETE FROM articles WHERE id=$id";
    $db = config::getConnexion();
            try{
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