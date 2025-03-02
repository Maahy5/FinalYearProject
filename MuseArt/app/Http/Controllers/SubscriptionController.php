<?php

namespace App\Http\Controllers;


use App\Models\Artist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function subscribe($artistId)
    {
        $user = Auth::user();
        $artist = Artist::findOrFail($artistId);

        if (!$user->subscribedArtists->contains($artist)) {
            $user->subscribedArtists()->attach($artist);
        }

        return redirect()->back()->with('success', 'You have subscribed to ' . $artist->name);
    }


    public function unsubscribe($artistId)
    {
        $user = Auth::user();
        // Detach user from artist's subscribers
        $artist = Artist::findOrFail($artistId);

        if ($user->subscribedArtists->contains($artist)) {
            $user->subscribedArtists()->detach($artist);
        }

        return redirect()->back()->with('success', 'You have unsubscribed from this artist.');
    }
}
