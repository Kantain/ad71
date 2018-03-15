<?php

namespace pw\Models;

class AdherentAdministratif
{
	protected $no_adherent;
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

	public function __construct($_no_adherent, $_nom, $_prenom, $_sexe, $_date_n, $_lieu_n, $_nationalite, $_no_secu_sociale, $_adresse, $_code_postal, $_ville, $_tel_f, $_tel_m_1, $_tel_m_2, $_email, $_newsletter, $_photo){
		$this->no_adherent=$_no_adherent;
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

	public function getNoAdherent(){
		return $this->no_adherent;
	}

	public function setNoAdherent($_no_adherent){
		if (!is_null($_no_adherent)) {
			$this->no_adherent = $_no_adherent;
		}
	}

	public function getNom(){
		return $this->nom;
	}

	public function setNom($_nom){
		if (!is_null($_nom)) {
			$this->nom = $_nom;
		}
	}

	public function getPrenom(){
		return $this->prenom;
	}

	public function setPrenom($_prenom){
		if (!is_null($_prenom)) {
			$this->prenom = $_prenom;
		}
	}

	public function getSexe(){
		return $this->sexe;
	}

	public function setSexe($_sexe){
		if (!is_null($_sexe)) {
			$this->sexe = $_sexe;
		}
	}

	public function getDateN(){
		return $this->date_n;
	}

	public function setDateN($_date_n){
		if (!is_null($_date_n)) {
			$this->date_n = $_date_n;
		}
	}

	public function getLieuN(){
		return $this->lieu_n;
	}

	public function setLieuN($_lieu_n){
		if (!is_null($_lieu_n)) {
			$this->lieu_n = $_lieu_n;
		}
	}

	public function getNationalite(){
		return $this->nationalite;
	}

	public function setNationalite($_nationalite){
		if (!is_null($_nationalite)) {
			$this->nationalite = $_nationalite;
		}
	}

	public function getNoSecuSociale(){
		return $this->no_secu_sociale;
	}

	public function setNoSecuSociale($_no_secu_sociale){
		if (!is_null($_no_secu_sociale)) {
			$this->no_secu_sociale = $_no_secu_sociale;
		}
	}

	public function getAdresse(){
		return $this->adresse;
	}

	public function setAdresse($_adresse){
		if (!is_null($_adresse)) {
			$this->adresse = $_adresse;
		}
	}

	public function getCodePostal(){
		return $this->code_postal;
	}

	public function setCodePostal($_code_postal){
		if (!is_null($_code_postal)) {
			$this->code_postal = $_code_postal;
		}
	}

	public function getVille(){
		return $this->ville;
	}

	public function setVille($_ville){
		if (!is_null($_ville)) {
			$this->ville = $_ville;
		}
	}

	public function getTelF(){
		return $this->tel_f;
	}

	public function setTelF($_tel_f){
		if (!is_null($_tel_f)) {
			$this->tel_f = $_tel_f;
		}
	}

	public function getTelM1(){
		return $this->tel_m_1;
	}

	public function setTelM1($_tel_m_1){
		if (!is_null($_tel_m_1)) {
			$this->tel_m_1 = $_tel_m_1;
		}
	}

	public function getTelM2(){
		return $this->tel_m_2;
	}

	public function setTelM2($_tel_m_2){
		if (!is_null($_tel_m_2)) {
			$this->tel_m_2 = $_tel_m_2;
		}
	}
	public function getEmail(){
		return $this->email;
	}

	public function setEmail($_email){
		if (!is_null($_email)) {
			$this->email = $_email;
		}
	}

	public function getNewsletter(){
		return $this->newsletter;
	}

	public function setNewsletter($_newsletter){
		if (!is_null($_newsletter)) {
			$this->newsletter = $_newsletter;
		}
	}

	public function getPhoto(){
		return $this->photo;
	}

	public function setPhoto($_photo){
		if (!is_null($_photo)) {
			$this->photo = $_photo;
		}
	}

	public function getAge(){
		$date = explode('/', $this->date_n);
        $temp = $date[0];
        $temp2 = $date[1];
        $date[0] = $temp2;
        $date[1] = $temp;
        $naissance = implode('/', $date);

        $age = date('Y') - date('Y', strtotime($naissance));
        if (date('md') < date('md', strtotime($naissance))) {
            return $age - 1;
        }
        return $age;
	}

	public function getNomFichier(){
		return $this->nom . "_" . $this->prenom;
	}
}
?>