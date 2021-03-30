<?php

require_once __DIR__ . '/../vendor/autoload.php';
use app\engine\Application;

$app = new Application();

$app->router->get('/', [\app\classes\controllers\AppController::class, 'default']);

$app->run();


