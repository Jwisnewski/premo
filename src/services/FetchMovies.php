<?php
namespace Premo\Services;

use Premo\Models\Movie;

class FetchMovies {
	protected $api_key = "f312ac2cb63002f508d52fd432cea28d";
	protected $nowPlaying_url = "https://api.themoviedb.org/3/movie/latest?api_key=";

	public function getMovies(){
		// $data_string = $this->getJsonString();
		var_dump($data_string);
	}

	public function moviesResponseToMovieModel($resource){
		foreach ($resource as $raw_movie_data) {
			$movie = new Movie();
			$movie->id = $raw_movie_data['id'];
			$movie->title = $raw_movie_data['title'];
			var_dump($movie);
		}
	}

	protected function fetchJsonString()
	{
		$completeurl = $this->nowPlaying_url . $this->api_key;
		$contents = file_get_contents($completeurl);
	}

}
