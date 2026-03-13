<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Public portfolio page.
     */
    public function index()
    {
        $projects = Portfolio::latest()->get();
        return view('portfolio', compact('projects'));
    }

    /**
     * Store a new project (admin dashboard).
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'link' => ['nullable', 'url', 'max:255'],
            'github' => ['nullable', 'url', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'tech_stack' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $data = $request->only('title', 'description', 'link', 'github', 'category', 'tech_stack');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('portfolio', 'public');
        }

        Portfolio::create($data);

        return redirect()->route('dashboard')
            ->with('success', 'Project "' . $request->title . '" added successfully.');
    }

    /**
     * Show edit form for a project.
     */
    public function edit($id)
    {
        $project = Portfolio::findOrFail($id);
        return view('admin.portfolio-edit', compact('project'));
    }

    /**
     * Update an existing project.
     */
    public function update(Request $request, $id)
    {
        $project = Portfolio::findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'link' => ['nullable', 'url', 'max:255'],
            'github' => ['nullable', 'url', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'tech_stack' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $data = $request->only('title', 'description', 'link', 'github', 'category', 'tech_stack');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('portfolio', 'public');
        }

        // Allow removing the image
        if ($request->boolean('remove_image') && $project->image) {
            Storage::disk('public')->delete($project->image);
            $data['image'] = null;
        }

        $project->update($data);

        return redirect()->route('dashboard')
            ->with('success', 'Project "' . $project->title . '" updated successfully.');
    }

    /**
     * Delete a project.
     */
    public function destroy($id)
    {
        $project = Portfolio::findOrFail($id);
        $title = $project->title;

        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Project "' . $title . '" deleted.');
    }
}