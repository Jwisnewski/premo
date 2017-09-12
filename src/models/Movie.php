<?php
Namespace Premo\Models;

use Phalcon\Mvc\Model

Class Movie Extends Model
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

}