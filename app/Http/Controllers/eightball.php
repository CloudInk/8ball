<?php
namespace App\Http\Controllers;

use DB;

class eightBall extends Controller
{


    function getResponse()
    {
        if ($_GET['text'] == '') {
            print('ask a better question');
        }

        $answer = DB::table('generator')->where('response_number', rand(1, 34))->value('response');
        $update = [
            'question_asked' => $_GET['text'],
            'user_name' => isset($_GET['user_name']) ? $_GET['user_name'] : 'not passed'
        ];
        DB::table('saved_inqueries')->insert($update);
        return $answer;
    }

    function getWeather()
    {
        if (isset($_POST['token']) && $_POST['token'] == 'uL7D0HPY3gyiyeX0ztB2da3M' || isset($_GET['test'])) {
            $weather = json_decode(file_get_contents("http://api.wunderground.com/api/a654c6d1f24346d5/conditions/q/KS/Wichita.json"), true);
            $alerts = json_decode(file_get_contents("http://api.wunderground.com/api/a654c6d1f24346d5/alerts/q/KS/Wichita.json"), true);
            $forecast = json_decode(file_get_contents("http://api.wunderground.com/api/a654c6d1f24346d5/forecast/q/KS/Wichita.json"), true);
            $sh = $weather['current_observation'];
            $al = $alerts['alerts'];
            $fc = $forecast['forecast']['txt_forecast']['forecastday'];
            if (empty($alerts['alerts'])) {
                $alert = "No active alerts / warnings for this area!";
            } else {
                $alert = "{$al[0]['description']}\n{$al[0]['message']}";
            }
            $time = date('m-d-Y', time()); //change
            $time2 = date('H:m', time());  //change
            echo "```
Hello, {$_POST['user_name']}!
Currently, its {$sh['weather']}.
The temperature outside is {$sh['temperature_string']}
The wind is blowing {$sh['wind_string']}
The wind makes it feel like {$sh['feelslike_string']}
=== Forecast ===
{$fc[0]['title']}
 {$fc[0]['fcttext']}
{$fc[2]['title']}
 {$fc[2]['fcttext']}
{$fc[4]['title']}
 {$fc[4]['fcttext']}
=== Alerts ===
{$alert}
```";
        } else {
            die("This is a webhook URI, please check your POST parameters and try again.");
        }
    }

}
