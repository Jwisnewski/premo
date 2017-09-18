<?php

namespace Premo\Services;

use Premo\Models\Movie;

class FetchMovies
{
    protected $api_key = "f312ac2cb63002f508d52fd432cea28d";
    protected $nowPlaying_url = "https://api.themoviedb.org/3/movie/latest?api_key=";


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
}
