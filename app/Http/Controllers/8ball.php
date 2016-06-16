<?php
namespace App\Http\Controllers;
use DB;
use MongoDB\Driver\ReadPreference;


class eightBall {


    function getResponse($question)
    {
        if($question == '') {
            print('ask a better question');
        }

        $answer = DB::table('generator')->where('response_number', rand(1, 33))->value('response');
        return print($answer);
    }


}