<?php
    class categorie{
		private $id;
		private $nom;
		
		function __construct(string $nom){
			
			$this->nom=$nom;
		}
		
		function getNOM(): string{
			return $this->nom;
		}
    }

    class sous_categorie{
		private $id;
		private $id_cat;
		private $nom;
		
		function __construct(string $nom, int $id_cat){
			
			$this->nom=$nom;
			$this->id_cat=$id_cat;
		}
		
		function getNOM(): string{
			return $this->nom;
		}
		function getCAT_ID(): string{
			return $this->cat_id;
		}
	}
?>