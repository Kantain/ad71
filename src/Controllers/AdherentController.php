<?php
namespace pw\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use pw\Services\SessionStorage;
use pw\Models\AdherentAdministratif;

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
        $result = $repository->findBy(array(), array('nom' => 'ASC'));
        $retour = array();

        foreach ($result as $key => $value) {
            array_push($retour, $value);
        }

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

        var_dump($retour);

        $i=0;
        while(!is_null($retour[$i+1])){
            $infos = $retour[$i];
            $adherent = new AdherentAdministratif();
            $em->persist($adherent);
            $em->flush();
        }

        return $app->redirect($url . 'liste');
    }
}

?>