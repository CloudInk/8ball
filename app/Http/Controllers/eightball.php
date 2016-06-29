<?php
namespace App\Http\Controllers;
use DB;

class eightBall extends Controller {


    function getResponse()
    {
        if($_GET['text'] == '') {
            print('ask a better question');
        }

        $answer = DB::table('generator')->where('response_number', rand(1, 34))->value('response');
        $update = [
            'question_asked' => $_GET['text'],
            'user_name'=> isset($_GET['user_name']) ? $_GET['user_name'] : 'not passed'
        ];
        DB::table('saved_inqueries')->insert($update);
        return $answer;
    }

    function getWeather()
    {
        return 'Weather not available at the moment.';
    }

}
