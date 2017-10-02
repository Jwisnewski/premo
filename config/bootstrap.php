<?php

use Phalcon\Mvc\View;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\Router;

date_default_timezone_set('UTC');

// Create a DI
$di = new FactoryDefault();

// Setup the view component
$di->set(
    "view",
    function () {
        $view = new View();

        $view->setViewsDir("../src/views/");

        return $view;
    }
);
$dispatcher = $di->get('dispatcher');
$dispatcher->setDefaultNamespace(
    'Premo\Controllers'
);

// Use $_SERVER["REQUEST_URI"]
$di->get('router')->setUriSource(
    Router::URI_SOURCE_SERVER_REQUEST_URI
);

$router = $di->get('router');

$router->add(
    "/",
    [
        "controller" => "index",

        "action" => "index",
    ]
);
$router->add(
    "/info",
    [
        "controller" => "info",

        "action" => "info",
    ]
);
$router->add(
    "/info/(id:[0-9]+)",
    [
        "controller" => "info",

        "action" => "info",
    ]
);

$router->handle();

// Setup the database service
$di->set(
    "db",
    function () {
        return new DbAdapter(
            [
                "host" => "mysql",
                "username" => "premo",
                "password" => "premo",
                "dbname" => "premo"
            ]
        );
    }
);
