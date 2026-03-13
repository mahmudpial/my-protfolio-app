<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Public skills page.
     */
    public function index()
    {
        $skills = Skill::orderBy('name')->get();
        return view('skills', compact('skills'));
    }

    /**
     * Store a new skill (admin dashboard).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'level' => ['nullable', 'in:Beginner,Intermediate,Advanced,Expert'],
            'category' => ['nullable', 'string', 'max:100'],
            'years_exp' => ['nullable', 'integer', 'min:0', 'max:30'],
        ]);

        Skill::create($request->only('name', 'level', 'category', 'years_exp'));

        return redirect()->route('dashboard')
            ->with('success', 'Skill "' . $request->name . '" added successfully.');
    }

    /**
     * Show edit form for a skill.
     */
    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        return view('admin.skill-edit', compact('skill'));
    }

    /**
     * Update an existing skill.
     */
    public function update(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'level' => ['nullable', 'in:Beginner,Intermediate,Advanced,Expert'],
            'category' => ['nullable', 'string', 'max:100'],
            'years_exp' => ['nullable', 'integer', 'min:0', 'max:30'],
        ]);

        $skill->update($request->only('name', 'level', 'category', 'years_exp'));

        return redirect()->route('dashboard')
            ->with('success', 'Skill "' . $skill->name . '" updated successfully.');
    }

    /**
     * Delete a skill.
     */
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $name = $skill->name;
        $skill->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Skill "' . $name . '" deleted.');
    }
}