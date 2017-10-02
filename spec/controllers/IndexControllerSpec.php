<?php
/**
 * Created by PhpStorm.
 * User: jeffrywisnewski
 * Date: 9/29/17
 * Time: 2:58 PM
 */

Namespace Premo\Controllers;


use Kahlan\Allow;
use Kahlan\Plugin\Stub;
use Kahlan\Plugin\Double;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Premo\Models\Movie;
use Premo\Services\FetchMovies;

describe(IndexController::class, function () {
    given('controller', function () {
        $controller = Double::instance(['extends' => IndexController::class]);
        $controller->view = Double::instance([
            'extends' => View::class,
            'magicMethods' => true,
        ]);
        $controller->request = Double::instance();
        return $controller;
    });

    given('default_sort', function(){
        $params = [
            'conditions' => 'release_date  > "' . date('Y-m-d') . '"'
        ];
        return $params;
    });

    describe('->indexAction()', function () {
        it("gets a list of movies", function () {
            $fetcher = new FetchMovies();
            $movies_array = $fetcher->getUpcomingMovies();

            foreach ($movies_array as $movie) {
                expect($movie)
                    ->toBeAnInstanceOf(Movie::class);
            }
        });

        fcontext('when the sorting by `critic_rating`', function () {
            beforeEach(function () {
                allow($this->controller->request)
                    ->toReceive('getQuery')
                    ->with('sort')
                    ->andReturn('critic_rating');
            });
            it("it calls ->sort() with `critic_rating`", function () {
                expect($this->controller)
                    ->toReceive('sort')
                    ->with('critic_rating');

                $this->controller->indexAction();
            });
            it('calls Movie::find with the expected parameters', function () {
                $sort_array = $this->default_sort;
                expect(Movie::class)
                    ->toReceive('::find')
                    ->with(array_merge($sort_array, [
                        "order" => "critic_rating DESC"
                    ]));

                $this->controller->indexAction();
            });
        });

        fcontext('when sorting by `alphabetical`', function() {
            beforeEach(function () {
                allow($this->controller->request)
                    ->toReceive('getQuery')
                    ->with('sort')
                    ->andReturn('alphabetical');
            });
            it("calls ->sort() with `alphabetical", function () {
                expect($this->controller)
                    ->toReceive('sort')
                    ->with('alphabetical');

                $this->controller->indexAction();
            });
            it('calls Movie::find with the expected parameters', function () {
                $sort_array = $this->default_sort;
                expect(Movie::class)
                    ->toReceive('::find')
                    ->with(array_merge($sort_array, [
                        "order" => "title ASC"
                    ]));

                $this->controller->indexAction();
            });
        });

        fcontext('when sorting by `release_date`', function() {
            beforeEach(function () {
                allow($this->controller->request)
                    ->toReceive('getQuery')
                    ->with('sort')
                    ->andReturn('release_date');
            });
            it("calls ->sort() with `release", function () {
                expect($this->controller)
                    ->toReceive('sort')
                    ->with('release_date');

                $this->controller->indexAction();
            });
            it('calls Movie::find with the expected parameters', function () {
                $sort_array = $this->default_sort;
                expect(Movie::class)
                    ->toReceive('::find')
                    ->with(array_merge($sort_array, [
                        "order" => "release_date ASC"
                    ]));

                $this->controller->indexAction();
            });
        });


        xit("passes the sorted array to the view", function () {

            $this->controller->indexAction();

            $fetcher = new FetchMovies();

            $sort_by = $this->controller->request->getQuery("sort");

            $params['order'] = 'critic_rating DESC';
            $movies_array = $fetcher->getUpcomingMovies();
            $movies_array = $this->sort($sort_by);

            allow(IndexController::class)
                ->toReceive('find')
                ->with('critic_rating DESC')
                ->andReturn($movies_array);

            expect($this->controller->view->movies = $movies_array);
        });
    });
});