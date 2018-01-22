<?php
namespace pw\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use pw\Services\SessionStorage;
use pw\Models\Message;

class MessageController{
	protected $storage;

	public function __construct() {
        $this->storage = new SessionStorage();
    }

    public function envoi(Request $app, Application $app){
        $em = $app['em'];
        $url = $app['url_generator']->generate('home');

        $contenu = $request->get('contenu', null);
        $president = $request->get('president', null);

        if ($contenu==null || $president==null) {
            return $app->redirect($url . 'messages');
        }
        else{
            $message = new Message($president, $contenu);
            $em->persist($user);
            $em->flush();
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