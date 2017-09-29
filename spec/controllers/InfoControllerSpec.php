<?php

Namespace Premo\Controllers;

use Kahlan\Allow;
use Kahlan\Plugin\Stub;
use Kahlan\Plugin\Double;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Premo\Models\Movie;

describe(InfoController::class, function () {
    given('controller', function () {
        $controller = Double::instance(['extends' => InfoController::class]);
        $controller->view = Double::instance([
            'extends' => View::class,
            'magicMethods' => true,
        ]);
        return $controller;
    });

    describe("->showAction()", function () {
        it("finds the first instance of a movie with the passed id", function () {
            $id = 'some_id';
            $movie = new Movie();
            $movie->id = $id;

            allow(Movie::class)
                ->toReceive('::findFirst')
                ->with($id)
                ->andReturn($movie);

//            allow(Movie::class)
//                ->toReceive('::findFirst')
//                ->with($id);

            $this->controller->showAction($id);

            expect($this->controller->view->movie)
                ->toBe($movie);

            //$instance = new InfoController();
            //$movie = new Movie();

            //allow($instance)->toReceive('showAction')->andReturn($movie);
            //expect($instance->showAction($id))->toBeAnInstanceOf('Premo\\Models\\Movie');

        });
    });
});