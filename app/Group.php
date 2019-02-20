<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {
  
  protected $table = 'group';

  public static function getByName($name) {
    return self::where('name', $name)->get()->first();
  }

}