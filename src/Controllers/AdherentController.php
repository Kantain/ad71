<?php
namespace pw\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        $retour = $repository->find($id);

        return $retour;
    }

    public function miseAjour(Application $app){
        $em = $app['em'];
        $url = $app['url_generator']->generate('home');

        $nomFichier = 'C:\\xampp\\htdocs\\ad71\\src\\Excel\\ffj.csv';
        $fichier = fopen($nomFichier, 'r');
        $retour = array();

        while(!feof($fichier)){
            $ligne = fgetcsv($fichier,512,';');
            array_push($retour, $ligne);
        }

        $i=1;

        while(isset($retour[$i+1])){
            $infos = $retour[$i];

            $date = explode('/', $infos[7]);
            $temp = $date[0];
            $temp2 = $date[1];
            $date[0] = $temp2;
            $date[1] = $temp;
            $naissance = implode('/', $date);

            $age = $this->age($naissance);

            switch ($age) {
                case $age = 6:
                    $cat = "Poussinet";
                    break;
                case $age<=8:
                    $cat = "Mini-Poussin";
                    break;
                case $age<=10:
                    $cat = "Poussin";
                    break;
                case $age<=12:
                    $cat = "Benjamin";
                    break;
                case $age<=14:
                    $cat = "Minime";
                    break;
                case $age<=17:
                    $cat = "Cadet";
                    break;
                case $age<=20:
                    $cat = "Junior";
                    break;
                case $age>=21:
                    $cat = "Senior";
                    break;
                default:
                    $cat = "";
                    break;
            }

            $adherentA = new AdherentAdministratif('default',$infos[4],$infos[5],$infos[6], $infos[7], 'à définir', 'français', 'à définir', $infos[8] . " " . $infos[9], $infos[10], $infos[11], $infos[12], $infos[14], $infos[13], $infos[16], 'à définir', 'à définir');

            $em->persist($adherentA);
            $em->flush();

            $adherentS = new AdherentSportif($infos[1], $adherentA->getNoAdherent(), 'non', $infos[3],'nom', 'à faire', 'non', 'non', 'non', 'non', 'à faire', $cat, 'à définir');


            $em->persist($adherentS);
            $em->flush();

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
}

?>