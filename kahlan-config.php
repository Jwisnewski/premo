<?php
use Kahlan\Filter\Filter;

Filter::register('mycustom.namespaces', function($chain) {

  $this->autoloader()->addPsr4('Premo\\Services\\', __DIR__ . '/src/services/');
  $this->autoloader()->addPsr4('Premo\\Models\\', __DIR__ . '/src/models/');

  return $chain->next();

});

Filter::apply($this, 'namespaces', 'mycustom.namespaces');
?>