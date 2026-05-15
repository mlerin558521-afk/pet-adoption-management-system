<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\User;
use App\Notifications\NewPetNotification;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $query = Pet::where('archived', false);

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

        if ($request->filled('adopted')) {
            $query->where('adopted', $request->adopted);
        }

        $pets = $query->paginate(10); 
    return view('admin.pets', compact('pets'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'species' => 'nullable|string|max:255',
            'characteristics' => 'nullable|string',
            'breed' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
            'adopted' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('pets', 'public');
        }

        $pet = Pet::create($data);

        foreach (User::all() as $user) {
            $user->notify(new NewPetNotification($pet->name));
        }

        return redirect()->route('pets.index')->with('success', 'Pet added successfully!');
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'species' => 'nullable|string|max:255',
            'characteristics' => 'nullable|string',
            'breed' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
            'adopted' => 'boolean',
        ]);

        $pet = Pet::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('pets', 'public');
        }

        $pet->update($data);

        return redirect()->route('pets.index')->with('success', 'Pet updated successfully!');
    }

    public function archive(Pet $pet)
    {
        $pet->update(['archived' => true]);
        return redirect()->route('admin.pets-archived')->with('success', 'Pet archived successfully.');
    }

    public function archived()
    {
        $pets = Pet::where('archived', true)->get();
        return view('admin.pets-archived', compact('pets'));
    }

    public function restore(Pet $pet)
    {
        $pet->update(['archived' => false]);
        return redirect()->route('admin.pets-archived')->with('success', 'Pet restored successfully.');
    }
}
