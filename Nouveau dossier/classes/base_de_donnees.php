<?php
class bd{
	private $dsn ='mysql:host=localhost;port=3306;dbname=test; charset=utf8';
	private $pdo;


	function __construct(){
		try{
			$this->pdo = new PDO($this->dsn, 'root','');
		}
		catch (PDOException $e){
			die("Erreur :". $e->getMessage());
		}
	}

	function requete($rqt){
		$stmt=$this->pdo->query($rqt);
		$rows = $stmt->fetchAll();

		return $rows;
	}

	function ajout_infos_adh($_post){
		$req = "INSERT INTO adherent_administratif(no_adherent,nom,prenom,sexe,date_n,lieu_n,nationalite,no_secu_sociale,adresse,code_postal,ville,tel_f,tel_m_1,tel_m_2,email,newsletter,photo) VALUES (:no_adherent,:nom,:prenom,:sexe,:date_n,:lieu_n,:nationalite,:no_secu_sociale,:adresse,:code_postal,:ville,:tel_f,:tel_m_1,:tel_m_2,:email,:newsletter,:photo)";
		$stmt = $this->pdo->prepare($req);
		$stmt->execute(array(
			'no_adherent' => $_post['no_adherent'],
			'nom' => $_post['nom'], 
			'prenom' => $_post['prenom'], 
			'sexe' => $_post['sexe'], 
			'date_n' => $_post['date_naissance'], 
			'lieu_n' => $_post['lieu_naissance'], 
			'nationalite' => $_post['nationalite'], 
			'no_secu_sociale' => $_post['no_secu'], 
			'adresse' => $_post['adresse'], 
			'code_postal' => $_post['code_postal'], 
			'ville' => $_post['ville'], 
			'tel_f' => $_post['tel_fixe'], 
			'tel_m_1' => $_post['tel_portable_1'], 
			'tel_m_2' => $_post['tel_portable_2'], 
			'email' => $_post['email'], 
			'newsletter' => $_post['newsletter'], 
			'photo' => $_post['photo'];
		));
	}


}



?>