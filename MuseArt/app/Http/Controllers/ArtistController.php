<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Notifications\SubscribedUserNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    // Show a list of all artists
    public function index()
    {
        $artists = Artist::all();  // Fetch all artists from the database

        $subscribedUsers = User::where('is_subscribed', true)->get();
        return view('artists', compact('artists', 'subscribedUsers'));  // Return the view with artists data
    }

    // Page that shows panel for artists to send notification
    public function showNotificationPage($id)
    {

        $artist = Artist::find($id);


        return view('artists.page');
    }

    // Show a list of all artists
    public function showArtistsPage($id)
    {

        $artist = Artist::find($id);

        if (!$artist) {
            return redirect()->back()->with('error', 'Artist not found');
        }

        $subscribedUsers = User::where('is_subscribed', true)->get();
        dd($subscribedUsers);

        return redirect()->route('artists.artist', ['id' => auth()->id()], compact('artist', 'subscribedUsers'));  // Return the view with artists data
    }


    // Show method to display the details of a specific artist
    public function show($slug)
    {
        // Fetch the artist by id from the database
        $artist = Artist::where('slug', $slug)->firstOrFail();

        // Return a view with the artist data
        return view('artists.show', compact('artist'));
    }

    // Show the form to create a new artist
    public function create()
    {
        return view('artists.create');
    }

    // Store a newly created artist in the database
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload if it exists
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('artists', 'public');
        }

        $slug = Str::slug($request->name);

        // Create a new artist record
        Artist::create([
            'name' => $request->name,
            'slug' => $slug,
            'bio' => $request->bio,
            'image' => $imagePath,
        ]);

        return redirect()->route('artists')->with('success', 'Artist created successfully!');
    }

    // Show the form to edit the specified artist
    public function edit($id)
    {
        $artist = Artist::findOrFail($id);
        return view('admin.edit_artist', compact('artist'));
    }

    // Update the specified artist in the database
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'string',
        ]);

        $artist = Artist::findOrFail($id);
        $artist->name = $request->name;
        $artist->bio = $request->bio;
        $artist->slug = Str::slug($request->name);


        if ($request->has('email')) {
            $artist->email = $request->email;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $artist->image = $request->file('image')->store('artists', 'public');
        }

        $artist->save();

        return redirect()->route('artists')->with('success', 'Artist updated successfully!');
    }


    // Remove the specified artist from the database

    public function destroy($id)
    {
        // Find the artist by slug
        $artist = Artist::findOrFail($id);

        // Delete the associated image from storage, if it exists
        if ($artist->image && Storage::disk('public')->exists($artist->image)) {
            Storage::disk('public')->delete($artist->image);
        }

        // Delete the artist
        $artist->delete();

        return redirect()->route('artists')->with('success', 'Artist was deleted successfully.');
    }

    //For sending notification to users
    public function sendNotifications(Request $request, $artistId)
    {
        $this->validate($request, [
            'message' => 'required|string',
            'event_id' => 'required|exists:events,id',
        ]);

        //Get the message
        $message = $request->input('message');
        $eventId = $request->input('event_id');

        //Retrieving the artist
        $artist = User::findOrFail($artistId);

        //Retrieve the event that the artist is associated with

        $event = Event::findOrFail($eventId);

        //fetching subscribed users
        $subscribedUsers = User::whereHas('artist_user_subscriptions', function ($query) use ($artistId) {
            $query->where('artist_id', $artistId);
        })->get();

        if ($subscribedUsers->isEmpty()) {
            return back()->with('error', 'No subscribed users found.');
        }
        //Sending the notification to all subscribed users
        Notification::send($subscribedUsers, new SubscribedUserNotification($message, $event));

        return response()->json(['success' => 'Notification sent successfully to all subscribed users.']);
    }
}
