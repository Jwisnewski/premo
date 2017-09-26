<?php
namespace Premo\Models;

use Phalcon\Mvc\Model;

class Users extends Model
{
    public $id;

    public $name;

    public $email;

    /**
     *
     */
    public function initialize()
    {
        $this->setSource("users");
    }
}
