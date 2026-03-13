<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function create()
    {
        return view('contact');
    }

    /**
     * Handle the contact form submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'subject' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:20'],
        ]);

        // Optional: send email notification
        // Mail::to(config('mail.from.address'))->send(new \App\Mail\ContactMail($validated));

        // Optional: save to DB
        // \App\Models\Contact::create($validated);

        return redirect()->route('contact')
            ->with('success', 'Your message has been sent! I\'ll get back to you within 24 hours.');
    }
}