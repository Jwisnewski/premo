<?php

namespace Premo\Services;

use Premo\Models\Movie;

describe(FetchMovies::class, function () {

    describe("->getUpcomingMovies()", function (){
        it('gets an array of upcoming movies', function(){
            $fetcher = new FetchMovies();
            $movie_list = $fetcher->getUpcomingMovies();

        it('converts the json string into an array', function () {
            expect(FetchMovies::class)
                ->toReceive('jsonStringToArray');
            $fetcher = new FetchMovies();
            $fetcher->getLatestMovie();
        });

        it("gets the latest movie", function () {
            $fetcher = new FetchMovies();
            $movie = $fetcher->getLatestMovie();
            expect($movie)->toBeAnInstanceOf(Movie::class);
        });
    });
});
