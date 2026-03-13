@extends('layouts.app')

@section('content')

    <div class="relative min-h-screen py-16">

        {{-- Decorative background blobs --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full opacity-10"
                style="background: radial-gradient(circle, #3B82F6, transparent 70%);"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 rounded-full opacity-10"
                style="background: radial-gradient(circle, #1D4ED8, transparent 70%);"></div>
        </div>

        {{-- Page Header --}}
        <div class="relative z-10 mb-14 text-center">
            <p class="text-xs font-semibold tracking-[0.3em] uppercase text-electric mb-3">Get In Touch</p>
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white leading-tight">
                Let's <span style="color:#60A5FA;">Work Together</span>
            </h1>
            <p class="mt-4 text-frost text-sm md:text-base max-w-md mx-auto leading-relaxed">
                Have a project in mind or want to collaborate? I'd love to hear from you. Drop a message and I'll get back
                within 24 hours.
            </p>
            <div class="mt-6 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-electric to-transparent"></div>
        </div>

        {{-- Main Grid --}}
        <div class="relative z-10 max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-5 gap-8">

            {{-- LEFT: Contact Info Panel --}}
            <div class="lg:col-span-2 flex flex-col gap-5">

                {{-- Info Card --}}
                <div class="rounded-2xl p-6 border border-electric/15"
                    style="background: rgba(13,18,32,0.85); backdrop-filter: blur(10px);">
                    <h2 class="font-display text-lg font-semibold text-white mb-5">Contact Info</h2>

                    <div class="flex items-start gap-4 mb-5">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                            style="background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.2);">
                            <svg class="w-4 h-4 text-electric" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-smoke uppercase tracking-widest mb-0.5">Email</p>
                            <a href="mailto:hello@yourportfolio.com"
                                class="text-sm text-frost hover:text-glow transition-colors">hello@yourportfolio.com</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 mb-5">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                            style="background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.2);">
                            <svg class="w-4 h-4 text-electric" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-smoke uppercase tracking-widest mb-0.5">Location</p>
                            <p class="text-sm text-frost">Dhaka, Bangladesh</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                            style="background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.2);">
                            <svg class="w-4 h-4 text-electric" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-smoke uppercase tracking-widest mb-0.5">Response Time</p>
                            <p class="text-sm text-frost">Within 24 hours</p>
                        </div>
                    </div>
                </div>

                {{-- Availability Badge --}}
                <div class="rounded-2xl p-5 border border-green-500/20 flex items-center gap-3"
                    style="background: rgba(16,185,129,0.05);">
                    <span class="relative flex h-2.5 w-2.5 flex-shrink-0">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                    </span>
                    <p class="text-sm text-green-400 font-medium">Available for freelance & full-time</p>
                </div>

                {{-- Social Links --}}
                <div class="rounded-2xl p-5 border border-electric/15" style="background: rgba(13,18,32,0.85);">
                    <p class="text-xs font-medium text-smoke uppercase tracking-widest mb-4">Find Me Online</p>
                    <div class="flex items-center gap-3">
                        <a href="#"
                            class="w-9 h-9 rounded-xl flex items-center justify-center border border-electric/20 hover:border-electric hover:bg-electric/10 transition-all duration-200 group">
                            <svg class="w-4 h-4 text-frost group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-9 h-9 rounded-xl flex items-center justify-center border border-electric/20 hover:border-electric hover:bg-electric/10 transition-all duration-200 group">
                            <svg class="w-4 h-4 text-frost group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-9 h-9 rounded-xl flex items-center justify-center border border-electric/20 hover:border-electric hover:bg-electric/10 transition-all duration-200 group">
                            <svg class="w-4 h-4 text-frost group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-9 h-9 rounded-xl flex items-center justify-center border border-electric/20 hover:border-electric hover:bg-electric/10 transition-all duration-200 group">
                            <svg class="w-4 h-4 text-frost group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 24C5.385 24 0 18.615 0 12S5.385 0 12 0s12 5.385 12 12-5.385 12-12 12zm10.12-10.358c-.35-.11-3.17-.953-6.384-.438 1.34 3.684 1.887 6.684 1.992 7.308 2.3-1.555 3.936-4.02 4.395-6.87zm-6.115 7.808c-.153-.9-.75-4.032-2.19-7.77l-.066.02c-5.79 2.015-7.86 6.017-8.04 6.4 1.73 1.358 3.92 2.166 6.29 2.166 1.42 0 2.77-.29 4.01-.814zm-9.89-2.19c.25-.47 3.025-5.235 8.317-6.99.138-.045.278-.087.418-.128-.167-.38-.345-.76-.53-1.132C8.19 13 2.642 12.916 2.166 12.468a9.758 9.758 0 000 .532c0 2.4.968 4.578 2.535 6.16zm-2.46-7.77c.488.017 5.71.19 10.063-1.354-1.8-3.2-3.74-5.89-4.023-6.28C7.38 4.558 5.21 6.7 3.755 9.49zm7.44-8.07c.297.404 2.27 3.085 4.044 6.346 3.85-1.44 5.485-3.628 5.685-3.91C19.35 2.64 15.84 1.268 12 1.268c-.28 0-.556.013-.83.027z" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            {{-- RIGHT: Contact Form --}}
            <div class="lg:col-span-3 rounded-2xl p-7 md:p-9 border border-electric/15"
                style="background: rgba(13,18,32,0.9); backdrop-filter: blur(12px);">

                <h2 class="font-display text-xl font-semibold text-white mb-1">Send a Message</h2>
                <p class="text-sm text-smoke mb-7">All fields are required. I'll respond as soon as possible.</p>

                @if(session('success'))
                    <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl border border-green-500/30 bg-green-500/10">
                        <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p class="text-sm text-green-400 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 px-4 py-3 rounded-xl border border-red-500/30 bg-red-500/10">
                        <ul class="space-y-1">
                            @foreach($errors->all() as $error)
                                <li class="text-sm text-red-400 flex items-center gap-2">
                                    <span class="w-1 h-1 rounded-full bg-red-400 flex-shrink-0"></span>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="/contact" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">
                                Full Name <span class="text-electric">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required
                                class="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-smoke/60 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">
                                Email Address <span class="text-electric">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com"
                                required
                                class="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-smoke/60 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">
                            Subject <span class="text-electric">*</span>
                        </label>
                        <select name="subject" required
                            class="w-full px-4 py-3 rounded-xl text-sm text-white outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20 cursor-pointer"
                            style="background: rgba(5,8,15,0.7);">
                            <option value="" disabled selected>Select a subject…</option>
                            <option value="freelance" style="background:#0D1220;">Freelance Project</option>
                            <option value="fulltime" style="background:#0D1220;">Full-time Opportunity</option>
                            <option value="collab" style="background:#0D1220;">Collaboration</option>
                            <option value="feedback" style="background:#0D1220;">Feedback</option>
                            <option value="other" style="background:#0D1220;">Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">
                            Message <span class="text-electric">*</span>
                        </label>
                        <textarea name="message" rows="5" placeholder="Tell me about your project or idea…" required
                            class="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-smoke/60 outline-none resize-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                            style="background: rgba(5,8,15,0.7);">{{ old('message') }}</textarea>
                        <p class="mt-1.5 text-xs text-smoke">Minimum 20 characters.</p>
                    </div>

                    <div class="pt-1">
                        <button type="submit"
                            class="group relative w-full flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-xl font-semibold text-sm text-white overflow-hidden transition-all duration-300 bg-electric hover:bg-blue-500 focus:ring-2 focus:ring-electric/50"
                            style="box-shadow: 0 0 24px rgba(59,130,246,0.3);">
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-0.5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Send Message
                        </button>
                    </div>

                </form>
            </div>
        </div>

        {{-- Trust strip --}}
        <div class="relative z-10 mt-14 text-center">
            <p class="text-xs text-smoke">🔒 Your information is private and will never be shared with third parties.</p>
        </div>

    </div>

@endsection