<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {
  
  protected $table = 'teacher';

  public static function getFromGroup(string $name) {
    return self::join("person", "teacher.person_id", "person.id")
      ->select('teacher.teacher_id', 'person.*')
      ->where('person.group_id', $name)
      ->get()
      ->first();
  }

  public static function getById($id) {
    return self::join("person", 'teacher.person_id', 'person.id')
      ->select("person.*", "teacher.*")
      ->where('teacher_id', $id)->get()->first();
  }

}