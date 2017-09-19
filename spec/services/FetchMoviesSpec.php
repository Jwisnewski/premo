<?php

namespace Premo\Services;

use Premo\Models\Movie;

describe(FetchMovies::class, function () {

    describe("->getUpcomingMovies()", function (){
        it('gets an array of upcoming movies', function(){
            $fetcher = new FetchMovies();
            $movie_list = $fetcher->getUpcomingMovies();

            foreach($movie_list as $movie){
                expect($movie)->toBeAnInstanceOf(Movie::class);
            }
        });
    });
});
