<?php
/**
 * Created by PhpStorm.
 * User: jeffrywisnewski
 * Date: 9/25/17
 * Time: 3:08 PM
 */

namespace Premo\Controllers;

use Phalcon\Mvc\Controller;
use Premo\Models\Movie;


class InfoController extends Controller
{
    public function showAction($id)
    {
        $movie = Movie::findFirst($id);
        $this->view->movie = $movie;
    }
}
