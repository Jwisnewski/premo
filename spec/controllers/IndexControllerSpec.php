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

describe(IndexController::class, function(){
    given('controller', function () {
        $controller = Double::instance(['extends' => IndexController::class]);
        $controller->view = Double::instance([
            'extends' => View::class,
            'magicMethods' => true,
        ]);
        return $controller;
    });
   describe('->indexAction()', function(){
       it("gets a list of movies", function(){
           $fetcher = new FetchMovies();
           $movies_array = $fetcher->getUpcomingMovies();

           foreach($movies_array as $movie){
               expect($movie)
                   ->toBeAnInstanceOf(Movie::class);
           }
       });

       it("sorts the movie array", function(){
           $fetcher = new FetchMovies();
           $movie = new Movie();
           $movies_array[] = $fetcher->getUpcomingMovies();
           //$sort_by = $this->request->getQuery("sort");
           $sort_by[] = "alphabetical";
           //echo ($sort_by);
           foreach($movies_array as $movie)
           {
               echo($movie->id);
           }
           $movies_array[] = sort($sort_by);
           $title1 = $movies_array[0]->title;
           $title2 = $movies_array[1]->title;
           echo($title1 . ' . '  . $title2);
           //expect($title1 < $title2);



       });
   });
});