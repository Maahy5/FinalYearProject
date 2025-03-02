<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Notifications\AdminEventNotification;
use App\Notifications\EventNotification;
use App\Notifications\InterestNotification;
use App\Notifications\ArtistConfirmationNotification;
use App\Http\Controllers\SubscriptionController;
use App\Models\Subscription;
use Illuminate\Support\Str;

class EventController extends Controller
{
    // Display all events
    public function index()
    {
        $events = Event::all(); // Fetch all events
        return view('events', compact('events'));
    }



    public function create()
    {
        return view('events.create');
    }

    // Display a single event by ID
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('events'));
    }

    // Load event details for editing
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('events'));
    }

    // Update event details
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        if (!$event) {
            return redirect()->route('events')->with('error', 'Event not found.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
        ]);

        //Updating product details
        $event->title = $request->title;
        $event->description = $request->description;
        $event->event_date = $request->event_date;

        $event->save();

        return redirect()->route('events')->with('success', 'Event updated successfully!');
    }


    // Store a new event
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',

        ]);


        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->event_date = $request->event_date;
        $event->save();

        return redirect()->route('events')->with('success', 'Event added successfully!');
    }




    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->back()->with('success', 'Event deleted successfully!');
    }

    //Get events for a specified date
    public function getEvents(Request $request)
    {
        $date = $request->get('date');
        //Fetch events for the given date
        $events = Event::whereDate('event_date', $date)->get();

        return response()->json($events);
    }

    // Fetch upcoming events
    public function upcomingEvents()
    {
        $events = Event::where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->get();

        return view('exhibitions.events', compact('events'));
    }

    // Search for events by name or description
    public function search(Request $request)
    {
        $query = $request->input('query');
        $events = Event::where('title', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->get();

        return view('events.search-results', compact('events'));
    }
}
