<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Post;
use App\Models\Event;
use App\Models\Gallery;


class HomeController extends Controller
{
    
    public function index()
    {
        $destinationCategories = Destination::where('status', 'active')
            ->with('images')
            ->get()
            ->groupBy('category')
            ->map(function ($group) {
                return $group->first(); 
            })
            ->take(3); 

        $latestPosts = Post::where('status', 'published')->latest('published_at')->take(5)->get();
        
        $galleries = Gallery::latest()->get();

        
        $events = Event::whereIn('status', ['upcoming', 'ongoing'])
            ->orderBy('start_date', 'asc')
            ->take(6)
            ->get();

        $activities = [];

        return view('home', compact(
        'destinationCategories', 
        'latestPosts', 
        'events', 
        'activities', 
        'galleries' // <--- Kita pakai nama variabel ini
    ));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)
            ->with('images')
            ->where('status', 'active') 
            ->firstOrFail();

        return view('destinations.show', compact('destination'));
    }
}