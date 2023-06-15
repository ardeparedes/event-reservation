<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'datetime',
        'deadline',
        'location',
        'price',
        'attendee_limit',
        'created_by',
    ];


    public function scopeAvailable(Builder $query)
    {
        return $query->select('events.*')
            ->leftJoin('event_user', 'events.id', '=', 'event_user.event_id')
            ->where([
                ['created_by', '!=', auth()->id()],
                ['deadline', '>', now()]
            ])
            ->groupBy('events.id')
            ->havingRaw('count(event_user.id) < events.attendee_limit');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function reservations()
    {
        return $this->belongsToMany(User::class, 'event_user');
    }
}
