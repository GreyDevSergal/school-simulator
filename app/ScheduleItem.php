<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model {
  
  protected $table = 'schedule_item';

  public static function getFromSchedule(int $id) {
    return self::where("schedule_item.schedule_id", $id)->get()->all();
  }

}