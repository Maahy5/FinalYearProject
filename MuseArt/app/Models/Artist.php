<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Artist extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = ['name', 'bio', 'image', 'email', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($artist) {
            if (empty($artist->slug)) {
                $artist->slug = Str::slug($artist->name); // Generate slug from the name
            }
        });
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'artist_user_subscriptions');
    }
}
