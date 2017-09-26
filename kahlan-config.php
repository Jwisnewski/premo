<?php
use Kahlan\Filter\Filter;
use Kahlan\Jit\Interceptor;
use Kahlan\Jit\Patcher\Layer;

Filter::register('api.patchers', function($chain) {
    $interceptor = Interceptor::instance();
    $patchers = $interceptor->patchers();
    $patchers->add('layer', new Layer([
        'override' => [
            \Phalcon\Mvc\Model::class
        ]
    ]));

    return $chain->next();
});


Filter::register('mycustom.namespaces', function ($chain) {

    $this->autoloader()->addPsr4('Premo\\Services\\', __DIR__ . '/src/services/');
    $this->autoloader()->addPsr4('Premo\\Models\\', __DIR__ . '/src/models/');

    return $chain->next();
});

Filter::apply($this, 'namespaces', 'mycustom.namespaces');
Filter::apply($this, 'patchers', 'api.patchers');
