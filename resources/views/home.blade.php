@extends('layouts.app')

@section('content')

<div class="relative">

    {{-- ============================================================ --}}
    {{-- HERO SECTION --}}
    {{-- ============================================================ --}}
    <section class="relative min-h-[92vh] flex flex-col justify-center py-20 overflow-hidden">

        {{-- Animated background orbs --}}
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute top-1/4 -right-32 w-[600px] h-[600px] rounded-full opacity-15 animate-pulse"
                style="background: radial-gradient(circle, #3B82F6, transparent 65%); animation-duration: 4s;"></div>
            <div class="absolute -bottom-20 -left-32 w-[500px] h-[500px] rounded-full opacity-10 animate-pulse"
                style="background: radial-gradient(circle, #1D4ED8, transparent 65%); animation-duration: 6s;"></div>
            <div class="absolute top-10 left-1/3 w-64 h-64 rounded-full opacity-5 animate-pulse"
                style="background: radial-gradient(circle, #60A5FA, transparent 65%); animation-duration: 5s;"></div>
        </div>

        {{-- Decorative grid lines --}}
        <div class="pointer-events-none absolute inset-0 opacity-30"
            style="background-image: linear-gradient(rgba(59,130,246,0.06) 1px, transparent 1px), linear-gradient(90deg, rgba(59,130,246,0.06) 1px, transparent 1px); background-size: 64px 64px;"></div>

        <div class="relative z-10 max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Left: Text --}}
            <div>
                {{-- Status badge --}}
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-electric/25 mb-8"
                    style="background: rgba(59,130,246,0.08);">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-green-500"></span>
                    </span>
                    <span class="text-xs font-semibold text-green-400 tracking-wide">Available for hire</span>
                </div>

                {{-- Headline --}}
                <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.08] mb-6">
                    Hi, I'm<br>
                    <span class="relative inline-block mt-1">
                        <span style="color:#60A5FA;">{{ auth()->check() ? auth()->user()->name : config('app.owner_name', 'Pial Mahmud') }}</span>
                        <span class="absolute -bottom-1 left-0 right-0 h-px opacity-40"
                            style="background: linear-gradient(90deg, #3B82F6, transparent);"></span>
                    </span>
                </h1>

                {{-- Role typewriter --}}
                <p class="text-lg md:text-xl font-medium mb-5" style="color:#A8C4E8;">
                    <span id="typed-role">Full-Stack Developer</span><span class="typed-cursor text-electric animate-pulse">|</span>
                </p>

                {{-- Bio --}}
                <p class="text-frost text-base leading-relaxed max-w-lg mb-10">
                    I build fast, accessible, and beautiful web applications — from pixel-perfect frontends to robust backend systems. Passionate about clean code and great user experiences.
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap items-center gap-4 mb-10">
                    <a href="/portfolio"
                        class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl font-semibold text-sm text-white bg-electric hover:bg-blue-500 transition-all duration-200"
                        style="box-shadow: 0 0 28px rgba(59,130,246,0.35);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        View My Work
                    </a>
                    <a href="/contact"
                        class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl font-semibold text-sm text-frost border border-electric/30 hover:border-electric hover:text-white transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Get In Touch
                    </a>
                </div>

                {{-- Social row --}}
                <div class="flex items-center gap-4">
                    <span class="text-xs text-smoke uppercase tracking-widest">Find me on</span>
                    <div class="flex items-center gap-3">
                        <a href="#" class="w-8 h-8 rounded-lg flex items-center justify-center border border-electric/20 hover:border-electric hover:bg-electric/10 transition-all duration-200 group">
                            <svg class="w-3.5 h-3.5 text-frost group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z" />
                            </svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg flex items-center justify-center border border-electric/20 hover:border-electric hover:bg-electric/10 transition-all duration-200 group">
                            <svg class="w-3.5 h-3.5 text-frost group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg flex items-center justify-center border border-electric/20 hover:border-electric hover:bg-electric/10 transition-all duration-200 group">
                            <svg class="w-3.5 h-3.5 text-frost group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right: Avatar / Visual Card --}}
            <div class="flex justify-center lg:justify-end">
                <div class="relative">
                    {{-- Outer glow ring --}}
                    <div class="absolute inset-0 rounded-3xl opacity-30 blur-xl"
                        style="background: linear-gradient(135deg, #3B82F6, #1D4ED8);"></div>

                    {{-- Profile card --}}
                    <div class="relative rounded-3xl overflow-hidden border border-electric/25 w-72 md:w-80"
                        style="background: rgba(13,18,32,0.9);">

                        {{-- Avatar area --}}
                        <div class="relative h-64 flex items-center justify-center overflow-hidden"
                            style="background: linear-gradient(135deg, rgba(59,130,246,0.12), rgba(13,18,32,1));">
                            {{-- If you have a profile image: --}}
                            {{-- <img src="{{ asset('images/profile.jpg') }}" class="w-full h-full object-cover"> --}}
                            <div class="w-28 h-28 rounded-full flex items-center justify-center font-display text-4xl font-bold text-white border-2 border-electric/30"
                                style="background: linear-gradient(135deg, rgba(59,130,246,0.3), rgba(29,78,216,0.2));">
                                {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 1)) . strtoupper(substr(explode(' ', auth()->user()->name)[1] ?? auth()->user()->name, 0, 1)) : strtoupper(substr(config('app.owner_name', 'PM'), 0, 2)) }}
                            </div>

                            {{-- Decorative corner dots --}}
                            <div class="absolute top-4 right-4 w-2 h-2 rounded-full bg-electric opacity-60"></div>
                            <div class="absolute bottom-4 left-4 w-1.5 h-1.5 rounded-full bg-glow opacity-40"></div>
                        </div>

                        {{-- Card info --}}
                        <div class="p-5 border-t border-electric/15">
                            <p class="font-display text-base font-bold text-white">{{ auth()->check() ? auth()->user()->name : config('app.owner_name', 'Pial Mahmud') }}</p>
                            <p class="text-xs text-frost mt-0.5">Full-Stack Developer</p>

                            <div class="mt-4 grid grid-cols-3 gap-2 text-center">
                                <div>
                                    <p class="font-bold text-sm text-white">{{ isset($projects) ? $projects->count() : '10' }}+</p>
                                    <p class="text-xs text-smoke mt-0.5">Projects</p>
                                </div>
                                <div class="border-x border-electric/10">
                                    <p class="font-bold text-sm text-white">3+</p>
                                    <p class="text-xs text-smoke mt-0.5">Years</p>
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-white">{{ isset($skills) ? $skills->count() : '15' }}+</p>
                                    <p class="text-xs text-smoke mt-0.5">Skills</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Floating badges --}}
                    <div class="absolute -top-4 -left-6 px-3 py-2 rounded-xl border border-electric/25 flex items-center gap-2"
                        style="background: rgba(13,18,32,0.95); backdrop-filter: blur(8px);">
                        <svg class="w-3.5 h-3.5 text-electric" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                        <span class="text-xs font-semibold text-frost">Clean Code</span>
                    </div>
                    <div class="absolute -bottom-4 -right-6 px-3 py-2 rounded-xl border border-green-500/25 flex items-center gap-2"
                        style="background: rgba(13,18,32,0.95); backdrop-filter: blur(8px);">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        <span class="text-xs font-semibold text-green-400">Open to Work</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 opacity-40">
            <span class="text-xs text-smoke uppercase tracking-widest">Scroll</span>
            <svg class="w-4 h-4 text-smoke animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- SERVICES SECTION --}}
    {{-- ============================================================ --}}
    <section class="py-20 border-t border-electric/10">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <p class="text-xs font-semibold tracking-[0.3em] uppercase text-electric mb-3">What I Do</p>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-white">Services I Offer</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach([
                ['icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title' => 'Web Development', 'desc' => 'Full-stack web applications built with Laravel, Vue, and modern tooling — fast, secure, and scalable.'],
                ['icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z', 'title' => 'Responsive UI Design', 'desc' => 'Pixel-perfect interfaces that look stunning on every screen size, crafted with Tailwind CSS.'],
                ['icon' => 'M4 7v10c0 2 1 3 3 3h10c2 0 3-1 3-3V7c0-2-1-3-3-3H7C5 4 4 5 4 7zm0 5h16', 'title' => 'REST API Development', 'desc' => 'Well-structured, documented REST APIs for web and mobile clients with auth and rate limiting.'],
                ['icon' => 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z', 'title' => 'Cloud Deployment', 'desc' => 'Deploy and manage applications on VPS, shared hosting, or cloud providers with CI/CD pipelines.'],
                ['icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'title' => 'Performance Optimization', 'desc' => 'Audit and optimize queries, caching, and asset delivery to make your app blazing fast.'],
                ['icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'title' => 'Technical Support', 'desc' => 'Bug fixes, code reviews, and ongoing maintenance for existing projects and legacy codebases.'],
                ] as $service)
                <div class="group rounded-2xl p-6 border border-electric/15 hover:border-electric/40 transition-all duration-300"
                    style="background: rgba(13,18,32,0.8);">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4 transition-all duration-300 group-hover:scale-110"
                        style="background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.2);">
                        <svg class="w-5 h-5 text-electric" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="{{ $service['icon'] }}" />
                        </svg>
                    </div>
                    <h3 class="font-display text-base font-bold text-white mb-2 group-hover:text-glow transition-colors">{{ $service['title'] }}</h3>
                    <p class="text-sm text-frost leading-relaxed">{{ $service['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- FEATURED SKILLS PREVIEW --}}
    {{-- ============================================================ --}}
    <section class="py-20 border-t border-electric/10">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-end justify-between mb-10 flex-wrap gap-4">
                <div>
                    <p class="text-xs font-semibold tracking-[0.3em] uppercase text-electric mb-2">Tech Stack</p>
                    <h2 class="font-display text-3xl md:text-4xl font-bold text-white">Core Technologies</h2>
                </div>
                <a href="/skills" class="text-sm text-frost hover:text-glow transition-colors flex items-center gap-1.5">
                    View all skills
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            @if(isset($skills) && $skills->count())
            <div class="flex flex-wrap gap-3">
                @foreach($skills->take(12) as $skill)
                @php
                $pct = match($skill->level ?? 'Intermediate') {
                'Expert' => 95, 'Advanced' => 80, 'Intermediate' => 60, default => 35
                };
                @endphp
                <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl border border-electric/20 hover:border-electric/50 transition-all duration-200"
                    style="background: rgba(13,18,32,0.8);">
                    <div class="w-6 h-6 rounded-md flex items-center justify-center text-xs font-bold text-white"
                        style="background: rgba(59,130,246,0.2);">
                        {{ strtoupper(substr($skill->name, 0, 1)) }}
                    </div>
                    <span class="text-sm font-medium text-frost">{{ $skill->name }}</span>
                    <span class="text-xs text-smoke">{{ $pct }}%</span>
                </div>
                @endforeach
            </div>
            @else
            <div class="flex flex-wrap gap-3">
                @foreach(['Laravel', 'PHP', 'Vue.js', 'Tailwind CSS', 'MySQL', 'JavaScript', 'REST API', 'Git'] as $tech)
                <span class="px-4 py-2.5 rounded-xl border border-electric/20 text-sm font-medium text-frost"
                    style="background: rgba(13,18,32,0.8);">{{ $tech }}</span>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- FEATURED PROJECTS PREVIEW --}}
    {{-- ============================================================ --}}
    <section class="py-20 border-t border-electric/10">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-end justify-between mb-10 flex-wrap gap-4">
                <div>
                    <p class="text-xs font-semibold tracking-[0.3em] uppercase text-electric mb-2">Recent Work</p>
                    <h2 class="font-display text-3xl md:text-4xl font-bold text-white">Featured Projects</h2>
                </div>
                <a href="/portfolio" class="text-sm text-frost hover:text-glow transition-colors flex items-center gap-1.5">
                    View all projects
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            @if(isset($projects) && $projects->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($projects->take(3) as $project)
                <div class="group rounded-2xl overflow-hidden border border-electric/15 hover:border-electric/40 transition-all duration-300"
                    style="background: rgba(13,18,32,0.85);">
                    <div class="relative h-44 overflow-hidden"
                        style="background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(13,18,32,1));">
                        @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-12 h-12 opacity-15" fill="none" stroke="#3B82F6" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 h-16"
                            style="background: linear-gradient(to top, rgba(13,18,32,1), transparent);"></div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-display text-base font-bold text-white mb-2 group-hover:text-glow transition-colors">{{ $project->title }}</h3>
                        <p class="text-xs text-frost leading-relaxed mb-4 line-clamp-2">{{ $project->description }}</p>
                        @if($project->link)
                        <a href="{{ $project->link }}" target="_blank"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-electric hover:text-glow transition-colors">
                            View Project
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-16 rounded-2xl border border-electric/10"
                style="background: rgba(13,18,32,0.5);">
                <p class="text-frost text-sm">Projects will appear here once added.</p>
                <a href="/portfolio" class="mt-3 inline-block text-xs text-electric hover:text-glow transition-colors">Browse portfolio →</a>
            </div>
            @endif
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- TESTIMONIALS --}}
    {{-- ============================================================ --}}
    <section class="py-20 border-t border-electric/10">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <p class="text-xs font-semibold tracking-[0.3em] uppercase text-electric mb-3">Kind Words</p>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-white">Client Feedback</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach([
                ['name' => 'Sarah M.', 'role' => 'Startup Founder', 'text' => 'Delivered the project ahead of schedule with exceptional attention to detail. The codebase is clean and easy to maintain.'],
                ['name' => 'James K.', 'role' => 'Product Manager', 'text' => 'Outstanding UI work. Every interaction feels polished. Highly recommend for anyone needing a skilled full-stack developer.'],
                ['name' => 'Lena R.', 'role' => 'Agency Director', 'text' => 'Reliable, communicative, and technically strong. Our go-to developer for complex Laravel projects.'],
                ] as $t)
                <div class="rounded-2xl p-6 border border-electric/15"
                    style="background: rgba(13,18,32,0.8);">
                    <div class="flex mb-3">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endfor
                    </div>
                    <p class="text-sm text-frost leading-relaxed mb-5 italic">"{{ $t['text'] }}"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-white"
                            style="background: rgba(59,130,246,0.2); border: 1px solid rgba(59,130,246,0.25);">
                            {{ substr($t['name'], 0, 1) }}
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-white">{{ $t['name'] }}</p>
                            <p class="text-xs text-smoke">{{ $t['role'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- FINAL CTA --}}
    {{-- ============================================================ --}}
    <section class="py-20 border-t border-electric/10">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <div class="relative rounded-3xl p-10 md:p-14 border border-electric/20 overflow-hidden"
                style="background: linear-gradient(135deg, rgba(13,18,32,0.95), rgba(20,27,45,0.95));">
                <div class="pointer-events-none absolute inset-0 opacity-20"
                    style="background: radial-gradient(ellipse at 50% 0%, #3B82F6, transparent 60%);"></div>
                <div class="relative z-10">
                    <p class="text-xs font-semibold tracking-[0.3em] uppercase text-electric mb-4">Ready to Build?</p>
                    <h2 class="font-display text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">
                        Let's Create Something<br><span style="color:#60A5FA;">Remarkable</span>
                    </h2>
                    <p class="text-frost text-sm leading-relaxed mb-8 max-w-md mx-auto">
                        Whether it's a new product, a redesign, or a complex backend — I'm ready to help turn your vision into reality.
                    </p>
                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <a href="/contact"
                            class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl font-semibold text-sm text-white bg-electric hover:bg-blue-500 transition-all duration-200"
                            style="box-shadow: 0 0 28px rgba(59,130,246,0.35);">
                            Start a Project
                        </a>
                        <a href="/portfolio"
                            class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl font-semibold text-sm text-frost border border-electric/30 hover:border-electric hover:text-white transition-all duration-200">
                            See My Work
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

{{-- Typewriter effect --}}
<script>
    const roles = ['Full-Stack Developer', 'Laravel Expert', 'UI/UX Enthusiast', 'API Architect', 'Problem Solver'];
    let ri = 0,
        ci = 0,
        deleting = false;
    const el = document.getElementById('typed-role');

    function type() {
        if (!el) return;
        const word = roles[ri];
        el.textContent = deleting ? word.slice(0, ci--) : word.slice(0, ci++);
        if (!deleting && ci > word.length) {
            deleting = true;
            setTimeout(type, 1400);
            return;
        }
        if (deleting && ci < 0) {
            deleting = false;
            ri = (ri + 1) % roles.length;
        }
        setTimeout(type, deleting ? 50 : 90);
    }
    document.addEventListener('DOMContentLoaded', () => setTimeout(type, 600));
</script>

@endsection