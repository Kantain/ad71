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
                $app['session']->setPresident($login);
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
}

?>