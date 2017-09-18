<?php

namespace Premo\Services;

use Premo\Models\Movie;

describe(FetchMovies::class, function () {

    describe("->getLatestMovie()", function () {
        it('fetches a json string', function () {
            $fetcher = new FetchMovies();
            expect(FetchMovies::class)
            ->toReceive('getJsonString');
        });

        it('converts the json string into an array', function () {
            $fetcher = new FetchMovies();
            $movieDataArr = $fetcher->getLatestMovie();
            expect($movieDataArr)
            ->toBeA('object');
        });

        it('converts the array into a variable of data type movie', function () {
            $fetcher = new FetchMovies();
            $movieData = $fetcher->getLatestMovie();
            expect($movieData)
            ->toBeA('object');
            expect($movieData->id)
            ->toBeA('int');
            expect($movieData->title)
            ->toBeA('string');
            expect($movieData->release_date)
            ->toBeA('string');
            expect($movieData->poster_image)
            ->toBeA('string');
            expect($movieData->critic_rating)
            ->toBeA('double');
            expect($movieData->description)
            ->toBeA('string');
        });

        it("gets the latest movie", function () {
            $fetcher = new FetchMovies();
            $fetcher->getLatestMovie();
            expect($fetcher)->toBeAnInstanceOf(FetchMovies::class);
        });
    });
});
