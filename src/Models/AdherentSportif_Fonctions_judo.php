<?php
	namespace pw\Models

	class AdherentSportif_Fonctions_Judo{
		protected $no_adherent;
		protected $fonction;
		protected $date_obtention;

		public function __construct($_no_adherent, $_fonction, $_date_obtention){
			this->no_adherent = $_no_adherent;
			this->fonction = $_fonction;
			this->date_obtention = $_date_obtention;
		}

		public function getNoAdherent(){
			return this->no_adherent;
		}

		public function getFonction(){
			return this->fonction;
		}

		public function getDateObtention(){
			return this->date_obtention;
		}
	}


?>