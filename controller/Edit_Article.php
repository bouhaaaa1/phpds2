<?php
session_start();
    if($_SESSION['login'] && $_SESSION['password']){
    require '../config.php';
    $id = $_POST['id'];
    $oldname = $_POST['oldname'];
    $name = $_POST['name'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $promo = $_POST['promo'];
    $idmark = $_POST['idmark'];
    $sql="select * from articles where not label = '$oldname' and label = '$name'";
    $db = config::getConnexion();
            try{
				$count = $db->prepare($sql);
				$count->execute();
                if($count->fetchColumn() > 0){
                    echo "False";
                }else{
                    $sql="UPDATE Articles SET label ='$name' ,prix = $prix,description = '$description',image = '$image',promo = $promo , id_mark = $idmark WHERE id = $id";
                    $db = config::getConnexion();
			try {
				$query = $db->prepare($sql);
                if($query->execute()){
                    echo "True";
                }
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
                }
            }catch(PDOException $e) {
				echo$e->getMessage();
			}
}else{
    header("location:../views/sign-in.php");
}
?>