<?php

namespace Premo\Controllers;

use Phalcon\Mvc\Controller;
use Premo\Models\Movie;
use Premo\Services\FetchMovies;

class IndexController extends Controller
{
    /**
     * gets movies and enters them into the database
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
     * @param $movies_array saves movies to the database
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
        $params = [
            'conditions' => 'release_date  > "' . date('Y-m-d') . '"'
        ];

        if ($sorter == "critic_rating") {
            $params['order'] = 'critic_rating';
        } elseif ($sorter == "alphabetical") {
            $params['order'] = 'title ASC';
        } else {
            $params['order'] = 'release_date ASC';;
        }
        return Movie::find($params);
    }
}
