<?php
session_start();
    if($_SESSION['login'] && $_SESSION['password']){
    require '../config.php';
    $name = $_POST['name'];
    $markid = $_POST['markid'];
    $sql="select * from sous_cat where nom = '$name'";
    $db = config::getConnexion();
            try{
				$count = $db->prepare($sql);
				$count->execute();
                if($count->fetchColumn() > 0){
                    echo "False";
                }else{
                    $sql="UPDATE sous_cat SET nom='$name' WHERE id_mark = $markid";
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