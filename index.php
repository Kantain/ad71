<?php

require __DIR__ . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use pw\Services\SessionStorage;
use pw\Controllers\UserController;
use pw\Controllers\MessageController;
use pw\Controllers\AdherentController;

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
		return $app['twig']->render('listeAdherents.html', ['session' => $app['session'], 'adherents' => $ac->listeAdherent($app) ]);
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

$app['debug'] = true;
$app->run();
