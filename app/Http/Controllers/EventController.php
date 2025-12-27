<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::where('start_date', '>=', now())
            ->where('status', '!=', 'cancelled')
            ->orderBy('start_date', 'asc') 
            ->get();

        $pastEvents = Event::where('end_date', '<', now())
            ->orderBy('start_date', 'desc')
            ->paginate(6);

        return view('events.index', compact('upcomingEvents', 'pastEvents'));
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('events.show', compact('event'));
    }
}