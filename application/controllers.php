<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$app->get('/', function () use ($app) {
    $homeController = new \DA\Controller\Home($app);
    $data = $homeController->indexAction();
    return $app['twig']->render('index.html', $data);
})
->bind('homepage');

$app->get('/Deputado/{deputadoId}', function ($deputadoId) use ($app) {
    $deputadoController = new \DA\Controller\Deputado($app);
    $deputadoHash = urldecode($deputadoId);
    $deputadoId = explode('_', $deputadoHash)[0];
    $data = $deputadoController->profileAction($deputadoId);
    return $app['twig']->render('deputado.html', $data);
})
->bind('perfil deputado');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    print $e->getTraceAsString();
    print $e->getMessage();
    $page = 404 == $code ? '404.html' : '500.html';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});