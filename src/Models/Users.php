<?php
namespace Premo\Models;

use Phalcon\Mvc\Model;

class Users extends Model
{
    public $id;

    public $name;

    public $email;

    /**
     * sets the class source to users
     */
    public function initialize()
    {
        $this->setSource("users");
    }
}
