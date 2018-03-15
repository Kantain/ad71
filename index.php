<?php

require __DIR__ . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use pw\Services\SessionStorage;
use pw\Controllers\UserController;
use pw\Controllers\MessageController;
use pw\Controllers\AdherentController;
use pw\Controllers\PresidentController;

$app = new Silex\Application();
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(),['twig.path' => __DIR__ . '/views',]);

$app['connection'] = [
	'driver' => 'pdo_mysql',
	'host' => 'localhost',
	'user' => 'root',
	'password' => '',
	'dbname' => 'alliance_dojo_71'
];

$app['doctrine_config'] = Setup::createYAMLMetadataConfiguration([__DIR__ . '/config'], true);

$app['em'] = function ($app) {
	return EntityManager::create($app['connection'], $app['doctrine_config']);
};

$app['session'] = new SessionStorage();

/**
 * ROUTES
 */

$session = new SessionStorage();

$app->get('/', function() use ($app){
	if($app['session']->isConnectedAdmin()){
		return $app['twig']->render('admin.html', ['session' => $app['session']]);
	}
	if($app['session']->isConnected()){
		return $app['twig']->render('president.html', ['session' => $app['session']]);
	}
	return $app['twig']->render('index.html', ['session' => $app['session']]);
})->bind('home');

$app->get('/formulaire', function() use ($app){
	return $app['twig']->render('formulaire.html', ['session' => $app['session']]);
});

$app->post('/formulaire', 'pw\\Controllers\\AdherentController::ajoutAdherentFormulaire');

$app->get('/connexion', function() use ($app){
	$url = $app['url_generator']->generate('home');

	return $app->redirect($url);
});
$app->post('/connexion', 'pw\\Controllers\\UserController::connexion');

$app->get('/deconnexion', function() use ($app){
	$app['session']->setConnected(false);
	$app['session']->setConnectedAdmin(false);
	
	$url = $app['url_generator']->generate('home');

	return $app->redirect($url);
});

$app->get('/messages', function() use ($app){
	$url = $app['url_generator']->generate('home');
	if($app['session']->isConnectedAdmin()){
		$mc = new MessageController();
		$messages = $mc->listeMessages($app);
		return $app['twig']->render('messagesAdmin.html', ['session' => $app['session'], 'messages' => $messages]);
	}
	if($app['session']->isConnected())
		return $app['twig']->render('messages.html', ['session' => $app['session']]);
	else
		return $app->redirect($url);
});

$app->get('/liste', function() use ($app){
	$url = $app['url_generator']->generate('home');
	if($app['session']->isConnectedAdmin()){
		$ac = new AdherentController();
		$nb_attente = $ac->compterAttente($app);
		return $app['twig']->render('listeAdherents.html', ['session' => $app['session'], 'adherents' => $ac->listeAdherent($app), 'attente' => $nb_attente]);
	}
	else if($app['session']->isConnected()){
		$ac = new AdherentController();
		return $app['twig']->render('listeAdherents.html', ['session' => $app['session'], 'adherents' => $ac->listeAdherent($app)]);
	}
	return $app->redirect($url);
});

$app->get('/liste/attente', function() use ($app){
	$url = $app['url_generator']->generate('home');
	if($app['session']->isConnectedAdmin()){
		$ac = new AdherentController();
		$fichiers = $ac->listeAttente($app);
		return $app['twig']->render('listeAttente.html', ['session' => $app['session'], 'liste' => $fichiers]);
	}
	return $app->redirect($url);
});

$app->post('/envoi_message', 'pw\\Controllers\\MessageController::envoi');

$app->get('/majListe', 'pw\\Controllers\\AdherentController::miseAjour');

$app->get('/supprimerMessage/{id}', 'pw\\Controllers\\MessageController::supprimer');

$app->get('/adherent/{numero}', function($numero) use ($app){
	$url = $app['url_generator']->generate('home');
	if($app['session']->isConnectedAdmin()){
		$ac = new AdherentController();
		$temp = $ac->getAdherent($numero, $app);
		if(!is_null($temp[0]) && !is_null($temp[1])){
			return $app['twig']->render('profilAdherent.html', ['session' => $app['session'], 'adherentAdministratif' => $temp[0] , 'adherentSportif' => $temp[1]]);
		}
		return $app->redirect($url . 'liste');
	}
	return $app->redirect($url);
});

$app->get('/adherent/{numero}/modifier', function($numero) use ($app){
	$url = $app['url_generator']->generate('home');
	if($app['session']->isConnectedAdmin()){
		return $app['twig']->render('AccueilModifier.html', ['session' => $app['session'], 'numero' => $numero]);
	}
	return $app->redirect($url);
});

$app->get('/adherent/{numero}/modifier/administratif', function($numero) use ($app){
	$url = $app['url_generator']->generate('home');
	if($app['session']->isConnectedAdmin()){
		$ac = new AdherentController();
		$temp = $ac->getAdherent($numero, $app);
		return $app['twig']->render('modifierAdministratif.html', ['session' => $app['session'], 'numero' => $numero, 'profil' => $temp[0]]);
	}
	return $app->redirect($url);
});

$app->post('/adherent/{numero}/modifier/administratif', 'pw\\Controllers\\AdherentController::modifierAdherentAdministratif');

$app->get('/adherent/{numero}/modifier/sportif', function($numero) use ($app){
	$url = $app['url_generator']->generate('home');
	if($app['session']->isConnectedAdmin()){
		$ac = new AdherentController();
		$temp = $ac->getAdherent($numero, $app);
		$age = $temp[0]->getAge();
		return $app['twig']->render('modifierSportif.html', ['session' => $app['session'], 'numero' => $numero, 'profil' => $temp[1], 'age' => $age]);
	}
	return $app->redirect($url);
});

$app->post('/adherent/{numero}/modifier/sportif', 'pw\\Controllers\\AdherentController::modifierAdherentSportif');

$app->get('/adherent/ajouter/{nom}', function($nom) use ($app){
	$url = $app['url_generator']->generate('home');
	if($app['session']->isConnectedAdmin()){
		$ac = new AdherentController();
		$adherent = $ac->getFichier($nom . '.csv');
		$nouveau = $ac->verifierNouveau($app,$nom);
		return $app['twig']->render('nouveauAdherent.html', ['session' => $app['session'], 'adherent' => $adherent, 'nouveau' => $nouveau ]);
	}
	return $app->redirect($url . '/liste/attente');
});

$app->get('/gestion_president', function() use ($app){
	$url = $app['url_generator']->generate('home');
	if($app['session']->isConnectedAdmin()){
		$uc = new UserController();
		$listePresident = $uc->listePresident($app);
		return $app['twig']->render('adminGestionPresident.html', ['session' => $app['session'], 'presidents' => $listePresident]);
	}
	return $app->redirect($url);
});

$app->get('/modifier_president/{login}', function($login) use ($app){
	$url = $app['url_generator']->generate('home');
	if($app['session']->isConnectedAdmin()){
		$uc = new UserController();
		$president = $uc->getPresident($app, $login);
		return $app['twig']->render('adminModifierPresident.html', ['session' => $app['session'], 'president' => $president]);
	}
	return $app->redirect($url);
});

$app->post('modifier_president/{login}', 'pw\\Controllers\\UserController::modifierPresident');

$app->get('ajouter_president',function() use ($app){
	$url = $app['url_generator']->generate('home');
	if($app['session']->isConnectedAdmin()){
		return $app['twig']->render('adminAjouterPresident.html', ['session' => $app['session']]);
	}
	return $app->redirect($url);
});

$app['debug'] = true;
$app->run();
