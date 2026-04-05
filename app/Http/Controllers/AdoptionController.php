<?php

namespace App\Http\Controllers;

use App\Models\AdoptionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AdoptionStatusNotification;

class AdoptionController extends Controller
{
    public function index(Request $request)
    {
        $query = AdoptionRequest::with(['pet', 'user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('pet', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $requests = $query->get();

        return view('admin.adoptions', compact('requests'));
    }

    public function approve($id)
    {
        $request = AdoptionRequest::findOrFail($id);
        $request->status = 'approved';
        $request->save();

        $request->user->notify(new AdoptionStatusNotification('approved', $request->pet->name));

        $pet = $request->pet;
        if ($pet) {
            $pet->adopted = true;
            $pet->save();

            AdoptionRequest::where('pet_id', $pet->id)
                ->where('id', '!=', $request->id)
                ->where('status', 'pending')
                ->update(['status' => 'disapproved']);
        }

        return redirect()->route('adoptions.index')->with('success', 'Request approved and pet marked as adopted.');
    }

    public function disapprove($id)
    {
        $request = AdoptionRequest::findOrFail($id);
        $request->status = 'disapproved';
        $request->save();

        $request->user->notify(new AdoptionStatusNotification('disapproved', $request->pet->name));

        return redirect()->route('adoptions.index')->with('success', 'Request disapproved.');
    }

    public function store(Request $request)
    {
        $existing = AdoptionRequest::where('user_id', Auth::id())
            ->where('pet_id', $request->pet_id)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return redirect()->route('adoptions.userIndex')
                ->with('error', 'You already have a pending request for this pet.');
        }

        AdoptionRequest::create([
            'user_id' => Auth::id(),
            'pet_id' => $request->pet_id,
            'status' => 'pending',
        ]);

        return redirect()->route('adoptions.userIndex')
            ->with('success', 'Your adoption request has been submitted!');
    }

    public function userIndex()
    {
        $requests = AdoptionRequest::with('pet')
            ->where('user_id', Auth::id())
            ->get();

        return view('user.adopt', compact('requests'));
    }
}
