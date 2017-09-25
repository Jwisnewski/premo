<?php

namespace Premo\Models;

use Phalcon\Mvc\Model;

class Movie extends Model
{
    public $id;

    public $title;

    public $release_date;

    public $critic_rating;

    public $poster_image;

    public $description;

    public function initialize()
    {
        $this->setSource("movies");
    }

    public function getPosterUrl()
    {
        return 'https://image.tmdb.org/t/p/w320' . $this->poster_image;
    }
}
