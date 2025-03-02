<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;

    // Define the columns that are mass assignable
    protected $fillable = [
        'artist_id',
        'title',
        'event_date',
        'description',  // Add any other fields you might have
    ];

    // If you're using custom timestamps or no timestamps, you can define them here
    public $timestamps = true; // This is the default behavior. If you don't want automatic timestamps, you can set this to false.

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
