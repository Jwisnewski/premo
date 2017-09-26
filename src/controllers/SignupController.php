<?php
namespace Premo\Controllers;

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    //controls the index actions
    public function indexAction()
    {
    }

    /**
     * is a signup register
     */
    public function registerAction()
    {
        $user = new Users();

        // Store and check for errors
        $success = $user->save(
            $this->request->getPost(),
            [
                "name",
                "email",
            ]
        );

        if ($success) {
            echo "Thanks for registering!";
        } else {
            echo "Sorry, the following problems were generated: ";

            $messages = $user->getMessages();

            foreach ($messages as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }

        $this->view->disable();
    }
}
