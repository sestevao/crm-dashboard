<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Event;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with key metrics and recent items.
     */
    public function index()
    {
        $data = [
            'recent_projects' => Project::with(['manager'])
                ->latest()
                ->take(5)
                ->get(),
            'upcoming_events' => Event::where('start_date', '>=', now())
                ->orderBy('start_date')
                ->take(3)
                ->get(),
            'active_vacancies' => Vacancy::where('status', 'open')
                ->latest()
                ->take(3)
                ->get(),
            'project_stats' => [
                'total' => Project::count(),
                'medium' => Project::where('status', 'medium')->count(),
                'low' => Project::where('status', 'low')->count(),
            ],
            'events' => Event::where('start_date', '>=', now())
                ->orderBy('start_date')
                ->take(3)
                ->get(),
            'worflow_users' => User::where('position', '!=', 'admin')
                ->orderBy('name')
                ->take(8)
                ->get(),
        ];


        // return view('dashboard', compact('data', 'teamMembers', 'events'));
        return view('dashboard', $data,);
    }
}
