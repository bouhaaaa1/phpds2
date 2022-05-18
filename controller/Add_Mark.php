<?php
session_start();
    if($_SESSION['login'] && $_SESSION['password']){
    require '../config.php';
    $name = $_POST['name'];
    $categorie = $_POST['categorie'];
    $sql="select * from sous_cat where nom = '$name'";
    $db = config::getConnexion();
            try{
				$count = $db->prepare($sql);
				$count->execute();
                if($count->fetchColumn() > 0){
                    echo "False";
                }else{
                    $sql2="insert into sous_cat (nom,id_cat) values('$name',$categorie);";
			$db = config::getConnexion();
			try {
				$query = $db->prepare($sql2);
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