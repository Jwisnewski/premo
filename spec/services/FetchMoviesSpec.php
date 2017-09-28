<?php

namespace Premo\Services;

use Premo\Models\Movie;

describe(FetchMovies::class, function () {

    describe("->getUpcomingMovies()", function (){
        it('gets an array of upcoming movies', function() {
            $fetcher = new FetchMovies();
            $movie_list = $fetcher->getUpcomingMovies();
        });
        it('converts the json string into an array', function () {
            expect(FetchMovies::class)
                ->toReceive('jsonStringToArray');
            $fetcher = new FetchMovies();
            $fetcher->getUpcomingMovies();
        });

        it("gets the latest movie", function () {
            $fetcher = new FetchMovies();
            $movies = $fetcher->getUpcomingMovies();
            foreach ($movies as $movie) {
                expect($movie)
                    ->toBeAnInstanceOf('Premo\Models\Movie');
            }
        });
    });
});
