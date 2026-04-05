<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;

class PetBrowseController extends Controller
{
    public function index(Request $request)
    {
        $query = Pet::where('adopted', false);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('species', 'like', "%{$search}%")
                ->orWhere('breed', 'like', "%{$search}%")
                ->orWhere('age', 'like', "%{$search}%");
            });
    }
    
    if ($request->filled('species')) {
        $query->where('species', $request->species);
    }

    if ($request->filled('breed')) {
        $query->where('breed', 'like', "%{$request->breed}%");
    }

    if ($request->filled('age')) {
        $query->where('age', $request->age);
    }

    $pets = $query->get();

    return view('pets.browse', compact('pets'));
    }

}
