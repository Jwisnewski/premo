<?php

namespace Premo\Services;

use Premo\Models\Movie;

class FetchMovies
{
    const BASE_URL = "https://api.themoviedb.org/3";
    protected $api_key = "f312ac2cb63002f508d52fd432cea28d";
    protected $nowPlaying_url = "https://api.themoviedb.org/3/movie/latest?api_key=";
    protected $upcoming_movies_url = "https://api.themoviedb.org/3/discover/movie?api_key=";
    protected $upcoming_movies_url_2 = "&language=en-US&page=1&primary_release_date.gte=";
    protected $todays_date = date("Y-m-d");


    /**
     * @return Movie
     */
    public function getLatestMovie()
    {
        $data_string = $this->getJsonString();
        $data_arr = $this->jsonStringToArray($data_string);
        $movieData = $this->toMovieType($data_arr);
        return $movieData;
    }

    /**
     * @param string $json_string
     * @return mixed
     */
    protected function jsonStringToArray($json_string)
    {
        $raw_movies_array = json_decode($json_string, true);
        return $raw_movies_array;
    }

    /**
     * @return bool|string
     */
    protected function getJsonString()
    {
        $completeurl = $this->nowPlaying_url . $this->api_key;
        $contents = file_get_contents($completeurl);

        return $contents;
    }

    /**
     * @param array $raw_movie_array
     * @return Movie
     */
    protected function toMovieType(array $raw_movie_array)
    {
        $movie = new Movie();
        print_r($raw_movie_array);
        $movie->id = $raw_movie_array['id'];
        $movie->title = $raw_movie_array['title'];
        $movie->release_date = $raw_movie_array['release_date'];
        $movie->poster_image = $raw_movie_array['poster_path'];
        echo($movie->poster_image);
        $movie->critic_rating = $raw_movie_array['vote_average'];
        $movie->description = $raw_movie_array['overview'];
        return $movie;
    }

    public function getUpcomingMovies()
    {
        $data_string = $this->getUpcomingMovies();
        $data_arr = $this->jsonStringToArray($data_string);
        $movie_data = $this->toMovieType($data_arr);
        return $movie_data;
    }


    protected function getUpcomingString()
    {
        $params = [
            'release_date.gte' => date('Y-m-d')
        ];
        $completeurl = $this->buildApiUrl('/discover/movie', $params);
        $contents = file_get_contents($completeurl);
        return $contents;
    }

    protected function buildApiUrl($endpoint, array $params = [])
    {
        $params['api_key'] = $this->api_key;
        $url = self::BASE_URL . $endpoint . '?' .http_build_query($params);

        return $url;
    }
}