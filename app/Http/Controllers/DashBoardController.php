<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Skill;
use App\Models\Contact; // rename to your actual messages model if different

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Portfolio::latest()->get();
        $skills = Skill::orderBy('name')->get();
        // $messages = Contact::latest()->get(); // uncomment when you have a messages model

        return view('admin.dashboard', compact('projects', 'skills'));
    }
}