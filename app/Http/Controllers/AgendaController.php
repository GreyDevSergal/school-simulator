<?php

namespace App\Http\Controllers;

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

    public function get(Request $req) {
      $agenda = new \stdClass();

      $agenda->groups = DB::table('group')->get()->all();

      $agenda = $this->addMembers($agenda);
      $agenda = $this->addSchedule($agenda);
      $agenda = $this->addScheduleItems($agenda);

      echo json_encode((array)$agenda);
    }

    private function getMembersFromAs(string $name, string $table) {
      return DB::table($table)
        ->join("person", "student.person_id", "person.id")
        ->select('student.student_id', 'person.*')
        ->where('person.group_id', $name)
        ->get()
        ->first();
    }

    private function addMembers(object $agenda) {
      foreach($agenda->groups as $group) {
        if($group->isTeacherGroup === 0) {
          $group->members = $this->getMembersFromAs($group->name, "student");
        } else {
          $group->members = $this->getMembersFromAs($group->name, "teacher");
        }
      }

      return $agenda;
    }

    private function addSchedule(object $agenda) {
      foreach($agenda->groups as $group) {
        $group->schedules = DB::table("schedule")->where("schedule.id", $group->schedule_id)->get()->all();
      }

      return $agenda;
    }

    private function addScheduleItems(object $agenda) {
      foreach($agenda->groups as $group) {
        foreach($group->schedules as $schedule) {
          $schedule->items = DB::table("schedule_item")->where("schedule_item.schedule_id", $group->schedule_id)->get()->all();
        }
      }

      return $agenda;
    }
}
