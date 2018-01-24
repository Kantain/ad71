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

	public function getNom(){
		return $this->nom;
	}

	public function getPrenom(){
		return $this->prenom;
	}

	public function getSexe(){
		return $this->sexe;
	}

	public function getDateN(){
		return $this->date_n;
	}

	public function getLieuN(){
		return $this->lieu_n;
	}

	public function getNationalite(){
		return $this->nationalite;
	}

	public function getNoSecuSociale(){
		return $this->no_secu_sociale;
	}

	public function getAdresse(){
		return $this->adresse;
	}

	public function getCodePostal(){
		return $this->code_postal;
	}

	public function getVille(){
		return $this->ville;
	}

	public function getTelF(){
		return $this->tel_f;
	}

	public function getTelM1(){
		return $this->tel_m_1;
	}

	public function getTelM2(){
		return $this->tel_m_2;
	}
	public function getEmail(){
		return $this->email;
	}

	public function getNewsletter(){
		return $this->newsletter;
	}

	public function getPhoto(){
		return $this->photo;
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
}
?>