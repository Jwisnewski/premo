<?php

namespace Premo\Models;

use Phalcon\Mvc\Model;
use Kahlan\Plugin\Stub;

class Movie extends Model
{
    public $id;

    public $title;

    public $release_date;

    public $critic_rating;

    public $poster_image;

    public $description;

    /**
     * sets the source of the movie class
     */
    public function initialize()
    {
        $this->setSource("movies");
    }

    /**
     * @param $id
     * @deprecated
     */
    public function getFirst($id)
    {
        $movie = new Movie();
        Stub::on(Model::class)
            ->method('::findFirst', $id)
            ->andReturn($movie);
    }
    /**
     * @return string
     */
    public function getPosterUrl()
    {
        return 'https://image.tmdb.org/t/p/w320' . $this->poster_image;
    }

    public static function findFirst($parameters = null)
    {
        parent::findFirst($parameters);
    }

}
