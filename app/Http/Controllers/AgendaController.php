<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Group;
use App\Person;
use App\Schedule;
use App\ScheduleItem;
use App\Student;
use App\Teacher;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function full(Request $req) {
      if($validator->fails()) {
          return var_dump($validator);
      }
      $agenda = new \stdClass();

      $agenda->groups = Group::all();

      foreach($agenda->groups as $group) {
        $group->schedules = Schedule::GetById($group->schedule_id);

        foreach($group->schedules as $schedule) {
          $schedule->items = ScheduleItem::getFromSchedule($group->schedule_id);
        }

        if($group->isTeacherGroup === 0) {
          $group->members = Student::getFromGroup($group->name);
          continue;
        }

        $group->members = Teacher::getFromGroup($group->name);
      }

      echo json_encode($agenda);
    }
}
