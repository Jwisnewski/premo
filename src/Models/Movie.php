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
     * @return string
     */
    public function getPosterUrl()
    {
        $poster_url =  'https://image.tmdb.org/t/p/w320' . $this->poster_image;

        return $poster_url;
    }

    /**
     * @inheritdoc
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * @inheritdoc
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }
}
