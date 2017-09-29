<?php

use Kahlan\Filter\Filter;
use Kahlan\Jit\Interceptor;
use Kahlan\Jit\Patcher\Layer;

Filter::register('api.patchers', function ($chain) {
    if (!$interceptor = Interceptor::instance()) {
        return;
    }
    $patchers = $interceptor->patchers();
    $patchers->add('layer', new Layer([
        'override' => [
            'Phalcon\Mvc\Model', // this will dynamically apply a layer on top of the `Phalcon\Mvc\Model` to make it stubbable.
            'Phalcon\Mvc\View',
            'Phalcon\Di\FactoryDefault',
            'Phalcon\Db\Adapter\Pdo\Mysql',
            'Phalcon\Mvc\Router'
        ]
    ]));
    return $chain->next();
});

Filter::apply($this, 'patchers', 'api.patchers');

include 'config/bootstrap.php';