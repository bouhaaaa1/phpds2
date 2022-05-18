<?php
	class Article{
		private $id;
		private $label;
		private $prix;
		private $description;
		private $image;
		private $promo = 0;
		private $id_cat;
		
		function __construct(string $label, float $prix, string $description, string $image, int $promo,string $id_cat){
			
			$this->label=$label;
			$this->prix=$prix;
			$this->description=$description;
			$this->image=$image;
			$this->promo=$promo;
			$this->id_cat=$id_cat;
			
		}
		
		function getID(): string{
			return $this->id;
		}
		function getLABEL(): string{
			return $this->label;
		}
		function getID_CAT(): int{
			return $this->id_cat;
		}

		function getPRIX(): float{
			return $this->prix;
		}
		function getDESCRIPTION(): string{
			return $this->description;
		}
		function getIMAGE(): string{
			return $this->image;
		}
		function getPROMO(): string{
			return $this->promo;
		}
		
	}
?>