<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model {

  public function species() {
    return $this->belongsToMany('App\Species');
  }

}
