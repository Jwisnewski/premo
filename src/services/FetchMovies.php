<?php

namespace Premo\Services;

use Premo\Models\Movie;

class FetchMovies
{
    const BASE_URL = 'https://api.themoviedb.org/3';
    protected $api_key = 'f312ac2cb63002f508d52fd432cea28d';


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
     * @return string
     */
    public function getTimeZone()
    {
        $tz = 'America/New_York';
        $timestamp = time();
        $dt = new \DateTime("now", new \DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        return $dt->format('Y-m-d');
    }

    /**
     * @param array $raw_movies_array
     * @return array
     */
    protected function toMovieType(array $raw_movies_array)
    {
        //for each loop required
        $movie_array = [];
        foreach ($raw_movies_array as $raw_movie_array) {
            $movie = new Movie();
            $movie->id = $raw_movie_array['id'];
            $movie->title = $raw_movie_array['title'];
            $movie->release_date = $raw_movie_array['release_date'];
            $movie->poster_image = $raw_movie_array['poster_path'];
            $movie->critic_rating = $raw_movie_array['vote_average'];
            $movie->description = $raw_movie_array['overview'];
            $movie_array[] = $movie;
        }
        return $movie_array;
    }

    /**
     * @return array
     */
    public function getUpcomingMovies()
    {
        $data_string = $this->getUpcomingString();
        $data_arr = $this->jsonStringToArray($data_string);
        //need to pass through array converting to movie types
        $movie_data = $this->toMovieType($data_arr['results']);
        return $movie_data;
    }

    /**
     * @return bool|string
     */
    protected function getUpcomingString()
    {
        $date = $this->getTimeZone();
        $params = [
            'page' => "1",
            'primary_release_date.gte' => $date
        ];
        $completeurl = $this->buildApiUrl('/discover/movie', $params);
        $contents = file_get_contents($completeurl);
        return $contents;
    }

    /**
     * @param $endpoint
     * @param array $params
     * @return string
     */
    protected function buildApiUrl($endpoint, array $params = [])
    {

        $default_params = [
            'api_key' => $this->api_key,
            'language' => "en-US",
        ];

        $fetch_params = array_merge($default_params, $params);
        $url = self::BASE_URL . $endpoint . '?' . http_build_query($fetch_params);
        echo($url);
        return $url;
    }
}