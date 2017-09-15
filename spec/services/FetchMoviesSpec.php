<?php

namespace Premo\Services;

use Premo\Models\Movie;

describe(FetchMovies::class, function () {

    describe("->getMovies()", function () {
        it('fetches a json string', function () {
            $fetcher = new FetchMovies();
            expect(FetchMovies::class)
            ->toReceive('getJsonString');
            $fetcher->getMovies();
        });

        it('converts the json string into an array', function () {
            $fetcher = new FetchMovies();
            $movieDataArr = $fetcher->getMovies();
            expect($movieDataArr)
            ->toBeA('object');
        });

        it('converts the array into a variable of data type movie', function () {
            $fetcher = new FetchMovies();
            $movieData = $fetcher->getMovies();
            expect($movieData)
            ->toBeA('object');
            expect($movieData->id)
            ->toBeA('int');
            expect($movieData->title)
            ->toBeA('string');
            expect($movieData->release_date)
            ->toBeA('string');
            expect($movieData->poster_image)
            ->toBeA('null');
            expect($movieData->critic_rating)
            ->toBeA('double');
            expect($movieData->description)
            ->toBeA('string');
        });

        it('creates an array of Movie Models', function () {
        });

        it("gets the latest movie", function () {
            $fetcher = new FetchMovies();
            $fetcher->getMovies();
            expect($fetcher)->toBeAnInstanceOf(FetchMovies::class);
        });
    });
});
