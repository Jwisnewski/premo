<?php

namespace Premo\Controllers;

use Phalcon\Mvc\Controller;

class MoviesController extends Controller
{
    /**
     *runs the index
     */
    public function indexAction()
    {
    }

    /**
     *registers actions from index
     */
    public function registerAction()
    {
        $this->view->disable();
    }
}
