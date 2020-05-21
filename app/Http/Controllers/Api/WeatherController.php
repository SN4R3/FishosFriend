<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\WeatherTrait;

class WeatherController extends Controller {
  
  use WeatherTrait;

  public function fetchTodaysWeather(Request $request) {

    return $this->fetchAreaWeather($request->area_id);

  }
}
