<?php

use League\Container\Container;

$container = new Container();

#
# Controllers
#
$container->add(\App\Controller\IndexController::class);

#
# Services
#
$container->add(\App\Service\CacheService::class)
    ->addArgument(\Monolog\Logger::class);

#
# Repositories
#

#
# Dependencies
#
$container->add(\Envms\FluentPDO\Query::class)
    ->addArgument('mysql:host=db;dbname=db')
    ->addArgument('db')
    ->addArgument('db');

$responseFactory = (new \Laminas\Diactoros\ResponseFactory());
$strategy = (new \League\Route\Strategy\JsonStrategy($responseFactory))->setContainer($container);
$router = (new \League\Route\Router())->setStrategy($strategy);