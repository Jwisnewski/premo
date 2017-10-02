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

            $this->controller->showAction($id);

            expect($this->controller->view->movie)
                ->toBe($movie);

        });
        it( "passes the movie to the view to be displayed", function(){

            $id = 'some_id';
            $movie = new Movie();
            $movie->id = $id;

            allow(Movie::class)
                ->toReceive('::findFirst')
                ->with($id)
                ->andReturn($movie);

            $this->controller->showAction($id);
            expect($this->controller->view->movie = $movie);
        });
    });
});