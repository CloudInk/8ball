<?php
namespace App\Http\Controllers;
use DB;

class eightBall extends Controller {


    function getResponse($question)
    {
        if($question == '') {
            print('ask a better question');
        }

        $answer = DB::table('generator')->where('response_number', rand(1, 33))->value('response');
        $update = [
            'question_asked' => $question,
            'timestamp' => time()
        ];
        DB::table('generator')->insert($update);
        return print($answer);
    }


}