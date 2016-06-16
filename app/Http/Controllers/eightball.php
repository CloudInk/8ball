<?php
namespace App\Http\Controllers;
use DB;

class eightBall extends Controller {


    function getResponse()
    {
        if($_GET['text'] == '') {
            print('ask a better question');
        }

        print_r($_GET);

        $answer = DB::table('generator')->where('response_number', rand(1, 33))->value('response');
        $update = [
            'question_asked' => $_GET['text'],
            'user_name'=> ''
        ];
        DB::table('saved_inqueries')->insert($update);
        return $answer;
    }


}