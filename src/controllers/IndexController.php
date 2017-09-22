<?php
namespace Premo\Controllers;

use Phalcon\Mvc\Controller;
use Premo\Services\FetchMovies;

class IndexController extends Controller
{
    public function indexAction()
    {
        $fetcher = new FetchMovies();
        $movies_array = $fetcher->getLatestMovie();

        passToDb($movies_array);
    }


    /**
     * @param $movies_array
     */
    public function passToDb($movies_array){

        $i=0;
        for($i=0; $i->count($movies_array); $i++)
        {
            $movie = Movie::findFirst($movies_array[$i]->$id);

            if(empty($movie)){
                $movies_array[$i]->save();
            }

        }
    }
}
