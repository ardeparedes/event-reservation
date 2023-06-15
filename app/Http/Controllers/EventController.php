<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['createdBy', 'reservations'])
            ->available()
            ->paginate(5);

        return response()->json($events);
    }

    public function store(EventRequest $request)
    {
        $event = new Event($request->all());
        $event->createdBy()->associate(auth()->user());
        $event->save();

        return response()->json(['message' => 'Event created successfully']);
    }

    public function show(Event $event)
    {
        return response()->json($event);
    }
}
