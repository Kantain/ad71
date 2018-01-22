<?php

namespace pw\Models;

class AdherentSportif
{
	protected $no_licence;
	protected $membre_ad_71;
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

	public function __construct($_no_licence, $_membre_ad_71, $_dojo, $_certificat_med, $_date_certificat, $_attestation_sante, $_autorisation_parent, $_autorisation_prelevement, $_location_kimono, $_no_passeport, $_categorie_age, $_categorie_poids)
	{
		$this->no_licence=$_no_licence;
		$this->membre_ad_71=$_membre_ad_71;
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
}
?>