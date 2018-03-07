<?php
namespace pw\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Silex\Application;
use pw\Services\SessionStorage;
use pw\Models\AdherentAdministratif;
use pw\Models\AdherentSportif;
use \DateTime;

class AdherentController{
	protected $storage;

	public function __construct() {
        $this->storage = new SessionStorage();
    }

    public function ajoutAdherent(Request $request, Application $app){
        $em = $app['em'];
        $url = $app['url_generator']->generate('home');

        $contenu = $request->get('contenu', null);
        $president = $request->get('president', null);

        if ($contenu==null || $president==null) {
            return $app->redirect($url . 'messages');
        }
        else{
            $message = new Message($president, $contenu);
            $em->persist($message);
            $em->flush();
            return $app->redirect($url);
        }
    }

    public function listeAdherent(Application $app){
        $em = $app['em'];
        $url = $app['url_generator']->generate('home');

        $repository = $em->getRepository('pw\\Models\\AdherentAdministratif');
        $result = $repository->findBy(array(), array('no_adherent' => 'ASC'));
        $retour = array();

        foreach ($result as $key => $value) {
            array_push($retour, $value);
        }

        return $retour;
    }

    public function getAdherent($id, Application $app){
        $em = $app['em'];
        $url = $app['url_generator']->generate('home');

        $repository = $em->getRepository('pw\\Models\\AdherentAdministratif');
        $administratif = $repository->find($id);
        $repository = $em->getRepository('pw\\Models\\AdherentSportif');
        $sportif = $repository->findOneBy(array('no_adherent' => $id));

        $retour[0] = $administratif;
        $retour[1] = $sportif;

        return $retour;
    }

    public function miseAjour(Application $app){
        $em = $app['em'];
        $url = $app['url_generator']->generate('home');

        $nomFichier = 'src/Excel/ffj.csv';
        $fichier = fopen($nomFichier, 'r');
        $retour = array();

        while(!feof($fichier)){
            $ligne = fgetcsv($fichier,512,';');
            array_push($retour, $ligne);
        }

        $i=1;

        while(isset($retour[$i+1])){
            $infos = $retour[$i];

            $cat = $this->categorie($infos[7]);

            if($this->verifierNouveau($app,$infos[4] . "_" . $infos[5])){
                $adherentA = new AdherentAdministratif('default',$infos[4],$infos[5],$infos[6], $infos[7], 'à définir', 'français', 'à définir', $infos[8] . " " . $infos[9], $infos[10], $infos[11], $infos[12], $infos[14], $infos[13], $infos[16], 'à définir', 'à définir');
                $em->persist($adherentA);
                $em->flush();

                $repo = $em->getRepository('pw\\Models\\AdherentAdministratif');
                $adh = $repo->findOneBy(array(), array('no_adherent' => 'DESC'));

                $adherentS = new AdherentSportif($infos[1], $adh->getNoAdherent(), 'non', $infos[3],'nom', 'à faire', 'non', 'non', 'non', 'non', 'à faire', $cat, 'à définir');

                $em->persist($adherentS);
                $em->flush();
            }

            $i++;
        }

        return $app->redirect($url . 'liste');
    }

    private function age($date) {
        $age = date('Y') - date('Y', strtotime($date));
        if (date('md') < date('md', strtotime($date))) {
            return $age - 1;
        }
        return $age;
    }

    private function categorie($_date){
        $date = explode('/', $_date);
        $temp = $date[0];
        $temp2 = $date[1];
        $date[0] = $temp2;
        $date[1] = $temp;
        $naissance = implode('/', $date);

        $age = $this->age($naissance);

        switch ($age) {
            case $age>=21:
            $cat = "Senior";
            break;
            case $age<=20:
            $cat = "Junior";
            break;
            case $age<=17:
            $cat = "Cadet";
            break;
            case $age<=14:
            $cat = "Minime";
            break;
            case $age<=12:
            $cat = "Benjamin";
            break;
            case $age<=10:
            $cat = "Poussin";
            break;
            case $age<=8:
            $cat = "Mini-Poussin";
            break;
            case $age = 6:
            $cat = "Poussinet";
            break;
            default:
            $cat = "";
            break;
        }

        return $cat;
    }

    public function modifierAdherentSportif(Request $request, Application $app, $numero){
        $em = $app['em'];
        $url = $app['url_generator']->generate('home');

        $no_licence = $request->get('no_licence');
        $membre_ad_71 = $request->get('membre_ad_71');
        $dojo = $request->get('dojo');
        $certificat_medical = $request->get('certificat_medical');
        $attestation_sante = $request->get('attestation_sante');
        $autorisation_parentale = $request->get('autorisation_parentale');
        $autorisation_prelevement = $request->get('autorisation_prelevement');
        $location_kimono = $request->get('location_kimono');
        $no_passeport = $request->get('no_passeport');
        $categorie_poids = $request->get('categorie_poids');

        if(!is_null($no_licence)){
            $itemToModify = $em->find('pw\\Models\\AdherentSportif', $no_licence);
            if ($itemToModify->getNoLicence() != $no_licence) {
                $itemToModify->setNoLicence($no_licence);
            }
            if ($itemToModify->getMembreAd71() != $membre_ad_71) {
                $itemToModify->setMembreAd71($membre_ad_71);
            }
            if ($itemToModify->getDojo() != $dojo) {
                $itemToModify->setDojo($dojo);
            }
            if ($itemToModify->getCertificatMed() != $certificat_medical) {
                $itemToModify->setCertificatMed($certificat_medical);
            }
            if ($itemToModify->getAttestationSante() != $attestation_sante) {
                $itemToModify->setAttestationSante($attestation_sante);
            }
            if ($itemToModify->getAutorisationParent() != $autorisation_parentale) {
                $itemToModify->setAutorisationParent($autorisation_parentale);
            }
            if ($itemToModify->getAutorisationPrelevement() != $autorisation_prelevement) {
                $itemToModify->setAutorisationPrelevement($autorisation_prelevement);
            }
            if ($itemToModify->getLocationKimono() != $location_kimono) {
                $itemToModify->setLocationKimono($location_kimono);
            }
            if ($itemToModify->getNoPasseport() != $no_passeport) {
                $itemToModify->setNoPasseport($no_passeport);
            }
            if ($itemToModify->getCategoriePoids() != $categorie_poids) {
                $itemToModify->setCategoriePoids($categorie_poids);
            }

            $em->persist($itemToModify);
            $em->flush();
        }
        return $app->redirect($url . 'liste');
    }

    public function modifierAdherentAdministratif(Request $request, Application $app, $numero){
        $em = $app['em'];
        $url = $app['url_generator']->generate('home');
        $no_adherent = $request->get('no_adherent');
        $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $sexe = $request->get('sexe');
        $date_j = $request->get('dateJour');
        $date_m = $request->get('dateMois');
        $date_a = $request->get('dateAnnee');
        $lieu_n = $request->get('lieu_n');
        $nationalite = $request->get('nationalite');
        $no_secu_sociale = $request->get('no_secu_sociale');
        $adresse = $request->get('adresse');
        $code_postal = $request->get('code_postal');
        $ville = $request->get('ville');
        $tel_f = $request->get('tel_f');
        $tel_m_1 = $request->get('tel_m_1');
        $tel_m_2 = $request->get('tel_m_2');
        $email = $request->get('email');

        $date_n=implode('/', array($date_j,$date_m,$date_a));

        if(!is_null($numero)){
            echo "ok";
            $itemToModify = $em->find('pw\\Models\\AdherentAdministratif', $numero);
            if ($itemToModify->getNoAdherent() != $no_adherent) {
                $itemToModify->setNoAdherent($no_adherent);
            }
            if ($itemToModify->getNom() != $nom) {
                $itemToModify->setNom($nom);
            }
            if ($itemToModify->getPrenom() != $prenom) {
                $itemToModify->setPrenom($prenom);
            }
            if ($itemToModify->getSexe() != $sexe) {
                $itemToModify->setSexe($sexe);
            }
            if ($itemToModify->getDateN() != $date_n) {
                $itemToModify->setDateN($date_n);
            }
            if ($itemToModify->getLieuN() != $lieu_n) {
                $itemToModify->setLieuN($lieu_n);
            }
            if ($itemToModify->getNationalite() != $nationalite) {
                $itemToModify->setNationalite($nationalite);
            }
            if ($itemToModify->getNoSecuSociale() != $no_secu_sociale) {
                $itemToModify->setNoSecuSociale($no_secu_sociale);
            }
            if ($itemToModify->getAdresse() != $adresse) {
                $itemToModify->setAdresse($adresse);
            }
            if ($itemToModify->getCodePostal() != $code_postal) {
                $itemToModify->setCodePostal($code_postal);
            }
            if ($itemToModify->getVille() != $ville) {
                $itemToModify->setVille($ville);
            }
            if ($itemToModify->getTelF() != $tel_f) {
                $itemToModify->setTelF($tel_f);
            }
            if ($itemToModify->getTelM1() != $tel_m_1) {
                $itemToModify->setTelM1($tel_m_1);
            }
            if ($itemToModify->getTelM2() != $tel_m_2) {
                $itemToModify->setTelM2($tel_m_2);
            }
            if ($itemToModify->getEmail() != $email) {
                $itemToModify->setEmail($email);
            }

            $em->persist($itemToModify);
            $em->flush();
        }
        return $app->redirect($url . 'liste');
    }

    public function ajoutAdherentFormulaire(Request $request, Application $app){
        $url = $app['url_generator']->generate('home');
        $data = $request->request->all();
        $nom = $request->get('nom',null);
        $prenom = $request->get('prenom',null);
        $retour = new StreamedResponse();

        $handle = fopen('fichesAttente/' . $nom . '_' . $prenom . '.csv', 'w+');
        fputcsv($handle, $data, ';');

        fclose($handle);

        echo '<script type="text/javascript">alert("Fiche enregistrée");window.location.href = "' . $url . '";</script>';

        return true; //$app->redirect($url);
    }

    public function compterAttente(Application $app){
        $rep = 'fichesAttente/';
        $fichiers = scandir($rep,0);
        $retour = 0;
        foreach ($fichiers as $f) {
            if (!is_dir($f)) {
                $retour++;
            }
        }
        return $retour;
    }

    public function listeAttente(Application $app){
        $rep = 'fichesAttente/';
        $fichiers = scandir($rep,0);
        $retour=array();
        foreach ($fichiers as $f) {
            if (!is_dir($f)) {
                array_push($retour, $f);
            }
        }

        return $retour;
    }

    public function getNomFichier($_fichier){
        $nom = explode('.', $_fichier);
        return $nom[0];
    }

    public function getFichier($_fichier){
        $nomFichier = 'fichesAttente/' . $_fichier;
        $fichier = fopen($nomFichier, 'r');
        $retour = array();

        while(!feof($fichier)){
            $ligne = fgetcsv($fichier,512,';');
            array_push($retour, $ligne);
        }

        return $retour;
    }

    public function verifierNouveau(Application $app, $id){
        $em = $app['em'];
        $url = $app['url_generator']->generate('home');

        $nomC = explode('_', $id);

        $nom = $nomC[0];
        $prenom = $nomC[1];

        $repository = $em->getRepository('pw\\Models\\AdherentAdministratif');
        $profil = $repository->findOneBy(array('nom' => $nom, 'prenom' => $prenom));

        if (is_null($profil)) {
            return true;
        }

        return false;
    }
}

?>