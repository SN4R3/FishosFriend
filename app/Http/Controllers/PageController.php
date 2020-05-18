<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Species;
use App\Spot;

class PageController extends Controller {

  public function dashboard() {
    return view('dashboard', ['spots' => Spot::with('species')->get(), 'species' => Species::all()]);
  }

  public function preferences() {
    return view('preferences', ['species' => Species::all()]);
  }
}
