<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'slug',
        'artist_id',
    ];

    use HasFactory;

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
