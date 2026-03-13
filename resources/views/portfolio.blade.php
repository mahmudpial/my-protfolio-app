@extends('layouts.app')

@section('content')

    <div class="relative py-16">

        {{-- Background blobs --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -top-32 right-0 w-[500px] h-[500px] rounded-full opacity-10"
                style="background: radial-gradient(circle, #3B82F6, transparent 70%);"></div>
            <div class="absolute bottom-0 -left-20 w-80 h-80 rounded-full opacity-8"
                style="background: radial-gradient(circle, #1D4ED8, transparent 70%);"></div>
        </div>

        {{-- Page Header --}}
        <div class="relative z-10 mb-6 text-center">
            <p class="text-xs font-semibold tracking-[0.3em] uppercase text-electric mb-3">My Work</p>
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white leading-tight">
                Featured <span style="color:#60A5FA;">Projects</span>
            </h1>
            <p class="mt-4 text-frost text-sm md:text-base max-w-lg mx-auto leading-relaxed">
                A curated selection of projects I've built — from web applications to UI systems. Each one crafted with care
                and purpose.
            </p>
            <div class="mt-6 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-electric to-transparent"></div>
        </div>

        {{-- Stats Strip --}}
        <div class="relative z-10 max-w-3xl mx-auto mb-14">
            <div class="grid grid-cols-3 gap-4">
                <div class="text-center rounded-2xl py-5 border border-electric/15" style="background: rgba(13,18,32,0.8);">
                    <p class="font-display text-2xl font-bold text-white">{{ $projects->count() }}+</p>
                    <p class="text-xs text-smoke uppercase tracking-widest mt-1">Projects</p>
                </div>
                <div class="text-center rounded-2xl py-5 border border-electric/15" style="background: rgba(13,18,32,0.8);">
                    <p class="font-display text-2xl font-bold text-white">3+</p>
                    <p class="text-xs text-smoke uppercase tracking-widest mt-1">Years Exp.</p>
                </div>
                <div class="text-center rounded-2xl py-5 border border-electric/15" style="background: rgba(13,18,32,0.8);">
                    <p class="font-display text-2xl font-bold text-white">100%</p>
                    <p class="text-xs text-smoke uppercase tracking-widest mt-1">Satisfaction</p>
                </div>
            </div>
        </div>

        {{-- Filter Tabs --}}
        <div class="relative z-10 flex flex-wrap justify-center gap-2 mb-10">
            @foreach(['All', 'Web App', 'UI/UX', 'API', 'Mobile'] as $tab)
                <button onclick="filterProjects('{{ $tab }}')" data-filter="{{ $tab }}"
                    class="filter-btn px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider border transition-all duration-200
                                       {{ $loop->first ? 'bg-electric border-electric text-white' : 'border-electric/25 text-frost hover:border-electric hover:text-white' }}">
                    {{ $tab }}
                </button>
            @endforeach
        </div>

        {{-- Projects Grid --}}
        <div class="relative z-10 max-w-6xl mx-auto">
            @forelse($projects as $project)
                <div class="project-card group relative rounded-2xl overflow-hidden border border-electric/15 mb-8 transition-all duration-300 hover:border-electric/40"
                    style="background: rgba(13,18,32,0.85); backdrop-filter: blur(10px);"
                    data-category="{{ $project->category ?? 'Web App' }}">

                    <div class="flex flex-col md:flex-row">

                        {{-- Project Image --}}
                        <div class="md:w-80 lg:w-96 flex-shrink-0 relative overflow-hidden bg-void" style="min-height: 220px;">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    style="min-height: 220px;">
                            @else
                                {{-- Placeholder --}}
                                <div class="w-full h-full flex items-center justify-center"
                                    style="min-height: 220px; background: linear-gradient(135deg, rgba(59,130,246,0.08) 0%, rgba(13,18,32,1) 100%);">
                                    <svg class="w-16 h-16 opacity-20" fill="none" stroke="#3B82F6" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            {{-- Category badge on image --}}
                            <span
                                class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider text-white"
                                style="background: rgba(59,130,246,0.75); backdrop-filter: blur(6px);">
                                {{ $project->category ?? 'Web App' }}
                            </span>
                        </div>

                        {{-- Project Content --}}
                        <div class="flex-1 p-7 flex flex-col justify-between">
                            <div>
                                {{-- Title + Status --}}
                                <div class="flex items-start justify-between gap-3 mb-3">
                                    <h3
                                        class="font-display text-xl font-bold text-white group-hover:text-glow transition-colors duration-200 leading-snug">
                                        {{ $project->title }}
                                    </h3>
                                    @if($project->status ?? true)
                                        <span
                                            class="flex-shrink-0 flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium text-green-400 border border-green-500/25"
                                            style="background: rgba(16,185,129,0.08);">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                                            Live
                                        </span>
                                    @endif
                                </div>

                                {{-- Description --}}
                                <p class="text-sm text-frost leading-relaxed mb-5 line-clamp-3">
                                    {{ $project->description }}
                                </p>

                                {{-- Tech Stack Tags --}}
                                @if($project->tech_stack ?? false)
                                    <div class="flex flex-wrap gap-2 mb-5">
                                        @foreach(explode(',', $project->tech_stack) as $tech)
                                            <span class="px-2.5 py-1 rounded-lg text-xs font-medium text-glow border border-electric/20"
                                                style="background: rgba(59,130,246,0.08);">
                                                {{ trim($tech) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- Actions --}}
                            <div class="flex items-center gap-3 mt-2">
                                @if($project->link)
                                    <a href="{{ $project->link }}" target="_blank" rel="noopener noreferrer"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-white bg-electric hover:bg-blue-500 transition-all duration-200"
                                        style="box-shadow: 0 0 16px rgba(59,130,246,0.25);">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        Live Demo
                                    </a>
                                @endif
                                @if($project->github ?? false)
                                    <a href="{{ $project->github }}" target="_blank" rel="noopener noreferrer"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-frost border border-electric/25 hover:border-electric hover:text-white transition-all duration-200">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z" />
                                        </svg>
                                        GitHub
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>

                    {{-- Bottom glow bar on hover --}}
                    <div class="absolute bottom-0 left-0 right-0 h-px opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        style="background: linear-gradient(90deg, transparent, #3B82F6, transparent);"></div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="text-center py-24 rounded-2xl border border-electric/10" style="background: rgba(13,18,32,0.5);">
                    <svg class="w-14 h-14 mx-auto mb-4 opacity-20" fill="none" stroke="#3B82F6" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <p class="text-frost text-sm font-medium">No projects yet.</p>
                    <p class="text-smoke text-xs mt-1">Check back soon — something great is on its way.</p>
                </div>
            @endforelse
        </div>

        {{-- CTA Strip --}}
        <div class="relative z-10 mt-16 max-w-2xl mx-auto text-center rounded-2xl p-8 border border-electric/20"
            style="background: linear-gradient(135deg, rgba(13,18,32,0.9), rgba(20,27,45,0.9)); backdrop-filter: blur(10px);">
            <p class="text-xs font-semibold tracking-[0.3em] uppercase text-electric mb-2">Open to Work</p>
            <h2 class="font-display text-2xl font-bold text-white mb-3">Have a Project in Mind?</h2>
            <p class="text-frost text-sm leading-relaxed mb-6">
                I'm currently available for freelance projects and full-time opportunities. Let's build something great
                together.
            </p>
            <a href="/contact"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold text-sm text-white bg-electric hover:bg-blue-500 transition-all duration-200"
                style="box-shadow: 0 0 24px rgba(59,130,246,0.3);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                Get In Touch
            </a>
        </div>

    </div>

    {{-- Filter Script --}}
    <script>
        function filterProjects(category) {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                const active = btn.dataset.filter === category;
                btn.classList.toggle('bg-electric', active);
                btn.classList.toggle('border-electric', active);
                btn.classList.toggle('text-white', active);
                btn.classList.toggle('border-electric/25', !active);
                btn.classList.toggle('text-frost', !active);
            });
            document.querySelectorAll('.project-card').forEach(card => {
                const match = category === 'All' || card.dataset.category === category;
                card.style.display = match ? '' : 'none';
            });
        }
    </script>

@endsection