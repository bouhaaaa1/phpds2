<?php
	 require "../config.php";
	require_once '../model/Article.php';

	class ArticleU {
	
				function afficherArticles($cat,$sous_cat){
			$sql="select * from articles join sous_cat using(id_mark) join categorie using(id_cat) where categorie.nom='$cat' and sous_cat.nom='$sous_cat';";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}	
		}
		
				function afficherAll(){

					$sql="SELECT * FROM articles;";
					$db = config::getConnexion();
					try{
						$liste = $db->query($sql);
						return $liste;
					}
					catch (Exception $e){
						die('Erreur: '.$e->getMessage());
					}	
				}
				function CountAllArt(){
					$sql = "SELECT count(*) FROM articles";
					$db = config::getConnexion();
					$count = $db->prepare($sql);
					$count->execute();
					return $count->fetchColumn();
				}
				function CountArt($cat,$mark){
					$sql="select count(*) from articles join sous_cat using(id_mark) join categorie using(id_cat) where categorie.nom='$cat' and sous_cat.nom='$mark';";
					$db = config::getConnexion();
					$count = $db->prepare($sql);
					$count->execute();
					return $count->fetchColumn();
				}
				function CountPromo(){
					$sql="select count(*) from articles  where promo > 0;";
					$db = config::getConnexion();
					$count = $db->prepare($sql);
					$count->execute();
					return $count->fetchColumn();
				}
		
		
	
	
	
	
	
	}
	?>