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

class GroupController extends Controller
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

    public function getByName(string $req) {
      $group = Group::getByName($req);

      $group->schedules = Schedule::GetById($group->schedule_id);

      foreach($group->schedules as $schedule) {
        $schedule->items = ScheduleItem::getFromSchedule($group->schedule_id);

        foreach($schedule->items as $item)
          $item->teacher = Teacher::getById($item->teacher_id);
      }

      $group->members = $this->getMembers($group);
      echo json_encode($group);
    }

    private function getMembers($group) {
      if($group->isTeacherGroup === 0)
        return $group->members = Student::getFromGroup($group->name);

      return $group->members = Teacher::getFromGroup($group->name);
    }
}
