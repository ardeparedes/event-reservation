<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return $request->user();
    }

    public function events()
    {
        $events = auth()->user()
            ->createdEvents()
            ->paginate(5);

        return response()->json($events);
    }

    public function reservations()
    {
        $reservations = auth()->user()
            ->reservedEvents()
            ->paginate(5);

        return response()->json($reservations);
    }
}
