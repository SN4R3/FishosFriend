<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Species;

class PageController extends Controller {
  public function landing() {
    return view('landing', ['species' => Species::all()]);
  }
}
