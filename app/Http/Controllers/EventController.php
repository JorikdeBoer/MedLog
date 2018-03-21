<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Calendar;
use App\Event;

class EventController extends Controller
{
    // authentication requirement
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Requires data from database to fill in and show calendar
    public function index()
    {
       $events = [];
       $data = Event::all();
       if($data->count()){
          foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                $value->title,
                true,
                new \DateTime($value->start_date),
                new \DateTime($value->end_date.' +1 day')
            );
          }
       }
      $calendar = Calendar::addEvents($events);
      return view('homepage.mycalendar', compact('calendar'));
    }

    // goes to create a new event page/view
    public function create()
    {
      return view('homepage.create');
    }

    // adds new event to the event database to show later in calendar
    public function store(Request $request)
    {
        Event::create($request->all());
        $events = [];
        $data = Event::all();
        if($data->count()){
          foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                $value->title,
                $value->description,
                new \DateTime($value->start_date),
                new \DateTime($value->end_date)
            );
          }
        }

        $calendar = Calendar::addEvents($events);
        return redirect('home/mycalendar')->with(compact('calendar'));
    }

    // searches all titles of events in database with keyword in text
    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $search = Event::where('title', 'LIKE', '%' . $keyword . '%')->get();
        $start = date('Y-m-d');
        $end ="5999-12-31";
        $events = Event::whereBetween('start_date', array(
          $start,
          $end
        ))->take(5)->orderBy('start_date')->get();
        return view('homepage.home', compact('events','search'));
   }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        //
    }
}
