<?php
/**
 * Created by PhpStorm.
 * User: jeffrywisnewski
 * Date: 9/19/17
 * Time: 12:14 PM
 */

namespace Premo\Services;

use Premo\Models\Movie;

describe(PassToDatabase::Class, function() {
    describe("->passToDB()", function(){
        it("connects to the database", function(){
            $passer = new PassToDatabase();
            $error_message = $passer->passToDB();
        });
    });
});
