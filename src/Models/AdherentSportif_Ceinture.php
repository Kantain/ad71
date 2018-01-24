<?php
	namespace pw\Models

	class AdherentSportif_Ceinture{
		protected $no_adherent;
		protected $couleur;
		protected $date;

		public function __construct($_no_adherent, $_couleur, $_date){
			this->no_adherent = $_no_adherent;
			this->couleur = $_couleur;
			this->date = $_date;
		}

		public function getNoAdherent(){
			return this->no_adherent;
		}

		public function getCouleur(){
			return this->couleur;
		}

		public function getDate(){
			return this->date;
		}
	}


?>