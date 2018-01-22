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

    public function envoi(Request $request, Application $app){
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

    public function listeMessages(Application $app){
        $em = $app['em'];
        $url = $app['url_generator']->generate('home');


    }
}

?>