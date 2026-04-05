<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\User;
use App\Models\AdoptionRequest;

class ReportController extends Controller
{
    public function index()
    {
        $requestsPending = AdoptionRequest::where('status', 'pending')->count();
        $requestsApproved = AdoptionRequest::where('status', 'approved')->count();
        $requestsDisapproved = AdoptionRequest::where('status', 'disapproved')->count();

        $petsAvailable = Pet::where('adopted', false)->count();
        $petsAdopted = Pet::where('adopted', true)->count();

        $totalUsers = User::count();
        $activeUsers = User::whereHas('adoptionRequests')->count();
        $inactiveUsers = $totalUsers - $activeUsers;

        $lastBackup = now()->subDays(1)->toDateTimeString();
        $errorsCount = 0;
        $systemStatus = "Healthy";

        return view('admin.reports', compact(
            'requestsPending',
            'requestsApproved',
            'requestsDisapproved',
            'petsAvailable',
            'petsAdopted',
            'totalUsers',
            'activeUsers',
            'inactiveUsers',
            'lastBackup',
            'errorsCount',
            'systemStatus'
        ));
    }
}
