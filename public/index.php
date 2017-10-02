<?php

use Phalcon\Mvc\Application;

// Register an autoloader
include '../vendor/autoload.php';
include '../config/bootstrap.php';

$application = new Application($di);

try {
    // Handle the request
    $response = $application->handle();

    $response->send();
} catch (\Exception $e) {
    echo "Exception: ", $e->getMessage();
}
