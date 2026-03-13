<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Skill;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Portfolio::latest()->take(3)->get();
        $skills = Skill::orderBy('category')->get();

        return view('home', compact('projects', 'skills'));
    }
}