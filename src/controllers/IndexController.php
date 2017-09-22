<?php

namespace Premo\Controllers;

use Phalcon\Mvc\Controller;
use Premo\Models\Movie;
use Premo\Services\FetchMovies;

class IndexController extends Controller
{
    public function indexAction()
    {
        $fetcher = new FetchMovies();
        $movies_array = $fetcher->getUpcomingMovies();

        $this->passToDb($movies_array);
    }


    /**
     * @param $movies_array
     */
    public function passToDb($movies_array)
    {

        for ($i = 0; $i < count($movies_array); $i++) {
            $movie = Movie::findFirst($movies_array[$i]->id);

            if (empty($movie)) {
                $movies_array[$i]->save();
            }

        }
    }
}
