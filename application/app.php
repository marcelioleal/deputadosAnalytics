<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;

//Refactoring this
date_default_timezone_set('America/Sao_Paulo');
defined('APPLICATION_PATH') || define('APPLICATION_PATH', __DIR__);
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'dev'));
//end refactoring


$app = new Application();

//Config
//Change to Pimple
$configFile = APPLICATION_PATH."/../config/config.ini";
$config = parse_ini_file($configFile,true);
$config2 = array();
array_walk($config, function($val,$key) use (&$config2) { 
    $keys               = explode(" : ", $key);
    $config2[$keys[0]]  = $val;
    if(array_key_exists(1,$keys) && array_key_exists($keys[1], $config2))
        $config2[$keys[0]] = array_merge($config2[$keys[1]],$config2[$keys[0]]);
});

$app['config'] = $config2[APPLICATION_ENV];
//End to change to pimple


$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path'    => array(__DIR__.'/views'),
    //'twig.options' => array('cache' => __DIR__.'/../cache/twig'),
));
$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
}));

return $app;