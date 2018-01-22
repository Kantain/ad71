<?php

require __DIR__ . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use pw\Services\SessionStorage;
use pw\Controllers\UserController;
use pw\Controllers\MessageController;

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

$app->post('/envoi_message', 'pw\\Controllers\\MessageController::envoi');

$app['debug'] = true;
$app->run();
