<?php

use Premo\Services\FetchMovies;

describe(FetchMovies::class, function () {
	beforeEach(function(){
		$this->fetcher = new FetchMovies();
	});

	describe("->getMovies()", function () { 
		it('fetches a json string', function(){
			expect(FetchMovies::class)
			->toReceive('fetchJsonString');

			$this->fetcher->getMovies();
		});

		it('converts the json string into an array', function(){

		});

		it('creates an array of Movie Models', function(){

		});

		it("gets the latest movie", function () {
			
			$fetcher->getMovies();
			expect($fetcher)->toBeAnInstanceOf(FetchMovies::class);
		});
	});
});

