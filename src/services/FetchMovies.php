<?php
namespace Premo\Services;

use Premo\Models\Movie;

class FetchMovies {
	protected $api_key = "f312ac2cb63002f508d52fd432cea28d";
	protected $nowPlaying_url = "https://api.themoviedb.org/3/movie/latest?api_key=";

	public function getMovies(){
		$data_string = $this->getJsonString();
		$data_arr = $this->jsonStringToArray($data_string);
		$movieData = $this->toMovieType($data_arr);
		return $movieData;

	}

	public function jsonStringToArray($resource){
			$movie = new Movie();
			$resource_arr = json_decode($resource, true);
			return $resource_arr;
		}


	public function getJsonString()
	{
		$completeurl = $this->nowPlaying_url . $this->api_key;
		$contents = file_get_contents($completeurl);
		
		return $contents;
	}

	public function toMovieType($resource)
	{
		$movie = new Movie();
		print_r($resource);
		$movie->id = $resource['id'];
		$movie->title = $resource['title'];
		$movie->release_date = $resource['release_date'];
		$movie->poster_image = $resource['poster_path'];
		echo($movie->poster_image);
		$movie->critic_rating = $resource['vote_average'];
		$movie->description = $resource['overview'];
		return $movie;
	}
}

