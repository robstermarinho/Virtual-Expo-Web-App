<?php

namespace App\Http\Controllers\Event;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventStandController extends Controller
{
    /**
     * Display a list of stands in an event
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {

        $stands = $event->stands()
        ->with('bookin.user.company')
        ->get();
        //->pluck('bookin');

        return response()->json($stands , 200);
    }

}
