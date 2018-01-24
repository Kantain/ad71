<?php
	namespace pw\Models

	class Ceinture{
		protected $couleur;

		public function __construct($_couleur){
			$this->couleur=$_couleur;
		}

		public function getCouleur(){
			return this->$couleur;
		}

	}


?>