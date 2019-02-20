<?php

namespace App\Http\Controllers;

use Log;
use App\ScheduleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ScheduleItemController extends Controller
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

    public function delete(string $id) {
      ScheduleItem::where("id", $id)->delete();
    }

    public function create($data) {
      echo($data);
    }

    public function update(Request $data) {
      $data = $data->input();

      ScheduleItem::where('id', $data['id'])->update([
        'start' => $data['start'],
        'end' => $data['end'],
        'name' => $data['name'],
        'teacher_id' => $data['teacher']
      ]);
    }
}