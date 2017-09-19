<?php

namespace Premo\Services;

use Premo\Models\Movie;

describe(FetchMovies::class, function () {

    describe("->getLatestMovie()", function () {
        it('fetches a string', function () {
            expect(FetchMovies::class)
                ->toRecieve('getJsonString');

            $fetcher = new FetchMovies();
            $fetcher->getLatestMovie();
        });

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
