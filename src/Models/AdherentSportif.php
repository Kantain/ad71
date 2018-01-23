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

	public function __construct($_no_licence, $_no_adherent, $_membre_ad_71, $_dojo, $_certificat_med, $_date_certificat, $_attestation_sante, $_autorisation_parent, $_autorisation_prelevement, $_location_kimono, $_no_passeport, $_categorie_age, $_categorie_poids)
	{
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

	public function getNoLicence(){
		return $this->no_licence;
	}

	public function getNoAdherent(){
		return $this->no_adherent;
	}

	public function getMembreAd71(){
		return $this->membre_ad71;
	}

	public function getDojo(){
		return $this->dojo;
	}

	public function getCertificatMed(){
		return $this->certificat_med;
	}

	public function getDateCertificat(){
		return $this->date_certificat;
	}

	public function getAttestationSante(){
		return $this->attestation_sante;
	}

	public function getAutorisationParent(){
		return $this->autorisation_parent;
	}

	public function getAutorisationPrelevement(){
		return $this->autorisation_prelevement;
	}

	public function getLocationKimono(){
		return $this->location_kimono;
	}

	public function getNoPasseport(){
		return $this->no_passeport;
	}

	public function getCategorieAge(){
		return $this->categorie_age;
	}

	public function getCategoriePoids(){
		return $this->categorie_poids;
	}
}
?>