<?php
/**
 * Created by PhpStorm.
 * User: jeffrywisnewski
 * Date: 9/19/17
 * Time: 12:18 PM
 */

namespace Premo\Services;


class PassToDatabase
{
    public function passToDB()
    {
        $username = 'premo';
        $password = 'premo';
        try {
            $conn = new PDO('mysql:host=localhost;dbname=premo', $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            $error_message =  'ERROR: ' . $e->getMessage();
        }
        return ($error_message);
    }

}
