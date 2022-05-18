<?php
session_start();
    if($_SESSION['login'] && $_SESSION['password']){
    require '../config.php';
    $name = $_POST['name'];
    $price = $_POST['price'];
    $promo = $_POST['promo'];
    $description = $_POST['description'];
    $mark = $_POST['mark'];
    $image = $_POST['image'];
    $sql="select * from articles where label = '$name'";
    $db = config::getConnexion();
            try{
				$count = $db->prepare($sql);
				$count->execute();
                if($count->fetchColumn() > 0){
                    echo "False";
                }else{
                    $sql="insert into articles (label,prix,description,image,promo,id_mark) values('$name',$price,'$description','$image',$promo,$mark);";
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