<?php

namespace pw\Models;

class AdherentSportif
{
	protected $no_licence;
	protected $no_adherent;
	protected $membre_ad71;
	protected $dojo;
	protected $certificat_med;
	protected $date_certificat;
	protected $attestation_sante;
	protected $autorisation_parent;
	protected $autorisation_prelevement;
	protected $location_kimono;
	protected $no_passeport;
	protected $categorie_age;
	protected $categorie_poids;

	public function __construct($_no_licence, $_no_adherent, $_membre_ad_71, $_dojo, $_certificat_med, $_date_certificat, $_attestation_sante, $_autorisation_parent, $_autorisation_prelevement, $_location_kimono, $_no_passeport, $_categorie_age, $_categorie_poids){
		$this->no_licence=$_no_licence;
		$this->no_adherent = $_no_adherent;
		$this->membre_ad71=$_membre_ad_71;
		$this->dojo=$_dojo;
		$this->certificat_med=$_certificat_med;
		$this->date_certificat=$_date_certificat;
		$this->attestation_sante=$_attestation_sante;
		$this->autorisation_parent=$_autorisation_parent;
		$this->autorisation_prelevement=$_autorisation_prelevement;
		$this->location_kimono=$_location_kimono;
		$this->no_passeport=$_no_passeport;
		$this->categorie_age=$_categorie_age;
		$this->categorie_poids=$_categorie_poids;	
	}

	public function setAdherentSportif($_membre_ad_71, $_dojo, $_certificat_med, $_date_certificat, $_attestation_sante, $_autorisation_parent, $_autorisation_prelevement, $_location_kimono, $_no_passeport, $_categorie_age, $_categorie_poids){
		$this->membre_ad71=$_membre_ad_71;
		$this->dojo=$_dojo;
		$this->certificat_med=$_certificat_med;
		$this->date_certificat=$_date_certificat;
		$this->attestation_sante=$_attestation_sante;
		$this->autorisation_parent=$_autorisation_parent;
		$this->autorisation_prelevement=$_autorisation_prelevement;
		$this->location_kimono=$_location_kimono;
		$this->no_passeport=$_no_passeport;
		$this->categorie_age=$_categorie_age;
		$this->categorie_poids=$_categorie_poids;
	}

	public function getNoLicence(){
		return $this->no_licence;
	}

	public function setNoLicence($_no_licence){
		if (!is_null($_no_licence)) {
			$this->no_licence = $_no_licence;
		}
	}

	public function getNoAdherent(){
		return $this->no_adherent;
	}

	public function setNoAdherent($_no_adherent){
		if (!is_null($_no_adherent)) {
			$this->no_adherent = $_no_adherent;
		}
	}

	public function getMembreAd71(){
		return $this->membre_ad71;
	}

	public function setMembreAd71($_membre_ad_71){
		if (!is_null($_membre_ad_71)) {
			$this->membre_ad71 = $_membre_ad_71;
		}
	}

	public function getDojo(){
		return $this->dojo;
	}

	public function setDojo($_dojo){
		if (!is_null($_dojo)) {
			$this->dojo = $_dojo;
		}
	}

	public function getCertificatMed(){
		return $this->certificat_med;
	}

	public function setCertificatMed($_certificat_med){
		if (!is_null($_certificat_med)) {
			$this->certificat_med = $_certificat_med;
		}
	}

	public function getDateCertificat(){
		return $this->date_certificat;
	}

	public function setDateCertificat($_date_certificat){
		if (!is_null($_date_certificat)) {
			$this->date_certificat = $_date_certificat;
		}
	}

	public function getAttestationSante(){
		return $this->attestation_sante;
	}

	public function setAttestationSante($_attestation_sante){
		if (!is_null($_attestation_sante)) {
			$this->attestation_sante = $_attestation_sante;
		}
	}

	public function getAutorisationParent(){
		return $this->autorisation_parent;
	}

	public function setAutorisationParent($_autorisation_parent){
		if (!is_null($_autorisation_parent)) {
			$this->autorisation_parent = $_autorisation_parent;
		}
	}

	public function getAutorisationPrelevement(){
		return $this->autorisation_prelevement;
	}

	public function setAutorisationPrelevement($_autorisation_prelevement){
		if (!is_null($_autorisation_prelevement)) {
			$this->autorisation_prelevement = $_autorisation_prelevement;
		}
	}

	public function getLocationKimono(){
		return $this->location_kimono;
	}

	public function setLocationKimono($_location_kimono){
		if (!is_null($_location_kimono)) {
			$this->location_kimono = $_location_kimono;
		}
	}

	public function getNoPasseport(){
		return $this->no_passeport;
	}

	public function setNoPasseport($_no_passeport){
		if (!is_null($_no_passeport)) {
			$this->no_passeport = $_no_passeport;
		}
	}

	public function getCategorieAge(){
		return $this->categorie_age;
	}

	public function setCategorieAge($_categorie_age){
		if (!is_null($_categorie_age)) {
			$this->categorie_age = $_categorie_age;
		}
	}

	public function getCategoriePoids(){
		return $this->categorie_poids;
	}

	public function setCategoriePoids($_categorie_poids){
		if (!is_null($_categorie_poids)) {
			$this->categorie_poids = $_categorie_poids;
		}
	}
}
?>