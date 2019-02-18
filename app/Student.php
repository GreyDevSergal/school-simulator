<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {
  
  protected $table = 'student';

  public static function getFromGroup(string $name) {
    return self::join("person", "student.person_id", "person.id")
    ->select('student.student_id', 'person.*')
    ->where('person.group_id', $name)
    ->get()
    ->first();
  }

}