<?php

namespace App\Http\Controllers;
require '../vendor/autoload.php';

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    private $provider = 'http://api.openweathermap.org/data/2.5/';

    public function CallAPI(Request $request)
    {
        $url = $this->provider. 'weather?q='. $request->input('city'). '&appid='. $request->input('APIKey');
        //Http get request
        $client = new Client;
        $result = $client->get($url);
        $body = $result->getBody();
        $obj = json_decode($body, true);
        //Converstion from kelvins to celsius
        $temp = round($obj['main']['temp'] - 273, 0);
        //Return to view (front-end)
        return $temp;
    }
}
