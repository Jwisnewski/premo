<?php

namespace Premo\Controllers;

use Phalcon\Mvc\Controller;
use Premo\Models\Movie;
use Premo\Services\FetchMovies;

class IndexController extends Controller
{
    /**
     *
     */
    public function indexAction()
    {
        $fetcher = new FetchMovies();
        $sort_by = $this->request->getQuery("sort");
        $movies_array = $fetcher->getUpcomingMovies();
        $this->passToDb($movies_array);
        $movies_array = $this->sort($sort_by);
        $this->view->movies = $movies_array;
    }

    /**
     * @param $movies_array
     */
    protected function passToDb($movies_array)
    {
        for ($i = 0; $i < count($movies_array); $i++) {
            $movie = Movie::findFirst($movies_array[$i]->id);
            if (empty($movie)) {
                $movies_array[$i]->save();
            }
        }
    }

    /**
     * @param $sorter
     * @return \Phalcon\Mvc\Model\ResultsetInterface
     */
    protected function sort($sorter)
    {
        if($sorter == "critic_rating") {
            $filtered_movies = Movie::find(["order" => "critic_rating DESC"]);

        }

        elseif($sorter == "alphabetical"){
            $filtered_movies = Movie::find(["order" => "title ASC"]);
        }

        else{
            $filtered_movies = Movie::find(["order" => "release_date ASC"]);
        }

        return $filtered_movies;
    }

}
