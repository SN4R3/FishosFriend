<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Spot;
use App\SpotSheltered;
use App\SpotPrefWind;
use App\Species;
use App\SpotTip;

use App\Traits\WeatherTrait;

class SpotController extends Controller {
  
  use WeatherTrait;

  public function fetchRecommendedSpots(Request $request) {

    return $this->fetchAreaWeather(13856);

    // Filter by Water & Bay
    $spots = Spot::where('water_type', $request->water_type);
    if($request->water_type === 'salt') {
      $spots = $spots->where('bay', $request->bay);
    }

    // By Species
    if($request->species !== 'all') {
      $spots = $spots->whereHas('species', function($q) use ($request) {
        $exists = false;
        foreach($request->species as $s) {
          $exists = $q->where('name', $s)->count();
        }
        return $exists > 0 ? true : false;
      });
    }

    // By Location


    // By Priority
    if($request->priority === 'sheltered') {

    }

    // Sort spots by Location


    // Sort spots by chance of target species
    if($request->priority === 'chance' || $request->priority === 'water') {

    }

    // Check weather preferences against forecast & apply 'badege' when applicable TODO

  }

}
