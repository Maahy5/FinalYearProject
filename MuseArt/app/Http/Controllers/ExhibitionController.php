<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class ExhibitionController extends Controller
{
    public function index()
    {
        $events = Event::all();  //Changes the product to products
        return view('exhibitions.events', compact('events'));
    }

    public function show($id)
    {
        $events = Event::findOrFail($id);
        return view('exhibitions.show', compact('events'));
    }

    //Get events for a specified date
    public function getEvents(Request $request)
    {
        $date = $request->get('date');
        //Fetch events for the given date
        $events = Event::whereDate('event_date', $date)->get();

        return response()->json($events);
    }
}
