<?php

namespace App\Http\Controllers;

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
}
