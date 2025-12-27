<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('category')) {
            $destinations = Destination::where('status', 'active')
                ->where('category', $request->category)
                ->with('images')
                ->latest()
                ->paginate(9);

            $destinations->appends($request->all());
            
            return view('destinations.list', compact('destinations'));
        }

        $groupedDestinations = Destination::where('status', 'active')
            ->with('images')
            ->get()
            ->groupBy('category');

        $descriptions = [
            'Alam' => 'Lorem Ipsum is a placeholder text commonly used in graphic design, publishing, and web development. It has been the industry standard since the 1500s and is derived from a section of Ciceros De Finibus Bonorum et Malorum.',
            'Sejarah' => 'Lorem Ipsum is a placeholder text commonly used in graphic design, publishing, and web development. It has been the industry standard since the 1500s and is derived from a section of Ciceros De Finibus Bonorum et Malorum.',
            'Kuliner' => 'Lorem Ipsum is a placeholder text commonly used in graphic design, publishing, and web development. It has been the industry standard since the 1500s and is derived from a section of Ciceros De Finibus Bonorum et Malorum.',
            
        ];

        return view('destinations.index', compact('groupedDestinations', 'descriptions'));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)
            ->where('status', 'active')
            ->with('images') 
            ->firstOrFail();

        return view('destinations.show', compact('destination'));
    }
}
