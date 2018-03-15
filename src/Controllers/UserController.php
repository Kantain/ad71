<?php
namespace pw\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use pw\Services\SessionStorage;
use pw\Models\User;

class UserController{
	protected $storage;

	public function __construct() {
        $this->storage = new SessionStorage();
    }

    public function connexion(Request $request, Application $app){
    	$login = $request->get('login', null);
    	$mdp = $request->get('mdp', null);

    	$em = $app['em'];
        $url = $app['url_generator']->generate('home');

        $user = $em->find('pw\\Models\\User',$login);

        if(is_null($user) || is_null($login) || is_null($mdp) || $user->getPassword() != md5($mdp)){
        	return $app->redirect($url . 'connexion');
        }
        else{
            if($login=='administrateur')
                $app['session']->setConnectedAdmin(true);
            else{
                $app['session']->setPresidentNom($login);
                $app['session']->setPresidentClub($user->getClubLettre());
                $app['session']->setConnected(true);
            }

            return $app->redirect($url);
        }
    }

    public function inscription(Request $request, Application $app){
    	$login = $request->get('login', null);
    	$mdp = $request->get('mdp', null);
    	$mdp2 = $request->get('mdp2', null);
    	$em = $app['em'];
        $url = $app['url_generator']->generate('home');

        if($mdp != $mdp2 || is_null($login) || is_null($mdp) || is_null($mdp2)){
        	return $app->redirect($url . 'connexion');
        }
        else{
        	$user = new User($login, md5($mdp), false);
            $em->persist($user);
            $em->flush();
            $app['session']->setConnected(true);
            return $app->redirect($url);
        }
    }

    public function listePresident(Application $app){
        $em = $app['em'];
        $url = $app['url_generator']->generate('home');

        $repository = $em->getRepository('pw\\Models\\User');

        $compte = $repository->findAll();
        $compte = count($compte);

        $result = $repository->findBy(array(),array('login' => 'DESC'), $compte-1);

        $retour = array();

        foreach ($result as $key => $value) {
            array_push($retour, $value);
        }

        return $retour;
    }

    public function getPresident(Application $app, $login){
        $em = $app['em'];
        $url = $app['url_generator']->generate('home');

        $repository = $em->getRepository('pw\\Models\\User');
        $retour = $repository->find($login);

        return $retour;
    }

    public function modifierPresident(Request $request, Application $app, $login){
        $em = $app['em'];
        $url = $app['url_generator']->generate('home');

        $loginM = $request->request->all()["login"];
        $club = $request->request->get('club');

        var_dump($request->request);

        if (!is_null($loginM)) {
            echo "ok";
            $itemToModify = $em->find('pw\\Models\\User', $login);
            echo $itemToModify->getLogin();
            echo $loginM;
            if ($itemToModify->getLogin() != $loginM) {
                echo "login";
                $itemToModify->setLogin($loginM);
            }
            if ($itemToModify->getClub() != $club) {
                echo $club;
                $itemToModify->setClub($club);
            }
        }

        $em->persist($itemToModify);
        $em->flush();

        return $app->redirect($url . 'gestion_president');
    }
}

?>