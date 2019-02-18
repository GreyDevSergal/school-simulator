<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {
  
  protected $table = 'schedule';

  public static function getById(int $id) {
    return self::where("schedule.id", $id)->get()->all();
  }

}