<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\Router;


// Register an autoloader
$loader = new Loader();

$loader->registerNamespaces(
    [
        'Premo\Src\Controllers' => "../src/controllers/",
        'Premo\Src\Models' =>"../src/models/",
        'Premo\Src\Services' => "../src/services"
    ]
);

$loader->register();


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

$di->set('url', function(){
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace(
        'Premo\Src\Controllers'
    );
});

// Use $_SERVER["REQUEST_URI"]
$di->get('router')->setUriSource(
    Router::URI_SOURCE_SERVER_REQUEST_URI
);

$router = $di->get('router');

$router->add(
    "/",
    [
            "controller" => "index",

            "action"     => "index",
    ]
);
$router->add(
 "/info",
    [
         "controller" => "info",

        "action"     => "info",
    ]
);
$router->add(
    "/info/(id:[0-9]+",
    [
             "controller" => "info",

            "action"     => "info",
    ]
);

$router->handle();

// Setup the database service
$di->set(
    "db",
    function () {
        return new DbAdapter(
            [
                "host"     => "mysql",
                "username" => "premo",
                "password" => "premo",
                "dbname"   => "premo"
            ]
        );
    }
);

$application = new Application($di);

try {
    // Handle the request
    $response = $application->handle();

    $response->send();
} catch (\Exception $e) {
    echo "Exception: ", $e->getMessage();
}
