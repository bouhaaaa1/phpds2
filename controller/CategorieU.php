<?php

	require_once '../model/Categorie.php';

	class CategorieU {
	
			function modifierCategorie($id,$name){
				$sql="UPDATE categorie SET nom ='$name' WHERE id_cat = $id";
				$db = config::getConnexion();
				try {
				$query = $db->prepare($sql);
				if($query->execute()){
					return 'True';
				}else{
					return 'False';
				}	
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}
				function afficherCategorie(){
			
			$sql="SELECT * FROM Categorie";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}	
		}
		
				function ajouterCategorie($name){
			$sql="INSERT INTO categorie (nom) 
			VALUES ('$name')";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
			
				if($query->execute()){
					return 'True';
				}else{
					return 'False';
				}		
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
		
				
				function supprimerCategorie($id){
			$sql = "DELETE FROM categorie WHERE id_cat=$id";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				
				if($query->execute()){
					return 'True';
				}else{
					return 'False';
				}


			}
			catch(Exception $e){
				$e->getMessage();
			}
					
				}

				function CountCat($id){
					$sql = "SELECT count(*) FROM sous_cat WHERE id_cat=$id";
					$db = config::getConnexion();
					$count = $db->prepare($sql);
					$count->execute();
					return $count->fetchColumn();
				}

				function CountAllCat(){
					$sql = "SELECT count(*) FROM categorie";
					$db = config::getConnexion();
					$count = $db->prepare($sql);
					$count->execute();
					return $count->fetchColumn();
				}
		
	
	
	
	
	
    }
    class SousCategorieU {
	
        function modifierSousCategorie($id,$name){
			$sql="UPDATE sous_cat SET nom ='$name' WHERE id_cat = $id";
			$db = config::getConnexion();
			try {
			$query = $db->prepare($sql);
			if($query->execute()){
				return 'True';
			}else{
				return 'False';
			}	
		} catch (PDOException $e) {
			$e->getMessage();
		}
    }
            function afficherSousCategorie(){
        
        $sql="SELECT * FROM sous_cat";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
    }
    
            function ajouterSousCategorie($name,$cat_id){
        $sql="INSERT INTO sous_cat (nom,id_cat) 
        VALUES ('$name',$cat_id)";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
        
            if($query->execute()){
				return 'True';
			}else{
				return 'False';
			}		
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }			
    }
    
            
            function supprimerSousCategorie($id){
        $sql = "DELETE FROM sous_cat WHERE id_mark=$id";
		$db = config::getConnexion();
		try{
			$query = $db->prepare($sql);
			
			if($query->execute()){
				return 'True';
			}else{
				return 'False';
			}


		}
		catch(Exception $e){
			$e->getMessage();
		}
                
			}
		

			function Count($id){
				$sql = "SELECT count(*) FROM articles WHERE id_mark=$id";
				$db = config::getConnexion();
				$count = $db->prepare($sql);
				$count->execute();
				return $count->fetchColumn();
			}
			function afficherSousCat($id){
        
				$sql="SELECT * FROM sous_cat where id_mark = $id";
				$db = config::getConnexion();
				try{
					$liste = $db->query($sql);
					return $liste;
				}
				catch (Exception $e){
					die('Erreur: '.$e->getMessage());
				}	
			}
			function CountAllSCat(){
				$sql = "SELECT count(*) FROM sous_cat";
				$db = config::getConnexion();
				$count = $db->prepare($sql);
				$count->execute();
				return $count->fetchColumn();
			}
    





}
	?>