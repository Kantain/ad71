<?php

namespace pw\Models;

class AdherentAdministratif
{
	protected $id;
	protected $nom;
	protected $prenom;
	protected $sexe;
	protected $date_n;
	protected $lieu_n;
	protected $nationalite;
	protected $no_secu_sociale;
	protected $adresse;
	protected $code_postal;
	protected $ville;
	protected $tel_f;
	protected $tel_m_1;
	protected $tel_m_2;
	protected $email;
	protected $newsletter;
	protected $photo;

	public function __construct($_id, $_nom, $_prenom, $_sexe, $_date_n, $_lieu_n, $_nationalite, $_no_secu_sociale, $_adresse, $_code_postal, $_ville, $_tel_f, $_tel_m_1, $_tel_m_2, $_email, $_newsletter, $_photo){
		$this->id=$_id;
		$this->nom=$_nom;
		$this->prenom=$_prenom;
		$this->sexe=$_sexe;
		$this->date_n=$_date_n;
		$this->lieu_n=$_lieu_n;
		$this->nationalite=$_nationalite;
		$this->no_secu_sociale=$_no_secu_sociale;
		$this->adresse=$_adresse;
		$this->code_postal=$_code_postal;
		$this->ville=$_ville;
		$this->tel_f=$_tel_f;
		$this->tel_m_1=$_tel_m_1;
		$this->tel_m_2=$_tel_m_2;
		$this->email=$_email;
		$this->newsletter=$_newsletter;
		$this->photo=$_photo;
	}


}
?>