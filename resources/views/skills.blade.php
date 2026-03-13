@extends('layouts.app')

@section('content')

    <div class="relative py-16">

        {{-- Background blobs --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-20 w-[480px] h-[480px] rounded-full opacity-10"
                style="background: radial-gradient(circle, #3B82F6, transparent 70%);"></div>
            <div class="absolute bottom-10 -left-24 w-96 h-96 rounded-full opacity-8"
                style="background: radial-gradient(circle, #1D4ED8, transparent 70%);"></div>
        </div>

        {{-- Page Header --}}
        <div class="relative z-10 mb-6 text-center">
            <p class="text-xs font-semibold tracking-[0.3em] uppercase text-electric mb-3">What I Bring</p>
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white leading-tight">
                Skills & <span style="color:#60A5FA;">Expertise</span>
            </h1>
            <p class="mt-4 text-frost text-sm md:text-base max-w-lg mx-auto leading-relaxed">
                Technologies and tools I've worked with professionally — built through real projects, not just tutorials.
            </p>
            <div class="mt-6 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-electric to-transparent"></div>
        </div>

        {{-- Summary Stats --}}
        <div class="relative z-10 max-w-3xl mx-auto mb-14">
            <div class="grid grid-cols-3 gap-4">
                <div class="text-center rounded-2xl py-5 border border-electric/15" style="background: rgba(13,18,32,0.8);">
                    <p class="font-display text-2xl font-bold text-white">{{ $skills->count() }}+</p>
                    <p class="text-xs text-smoke uppercase tracking-widest mt-1">Technologies</p>
                </div>
                <div class="text-center rounded-2xl py-5 border border-electric/15" style="background: rgba(13,18,32,0.8);">
                    <p class="font-display text-2xl font-bold text-white">3+</p>
                    <p class="text-xs text-smoke uppercase tracking-widest mt-1">Years Active</p>
                </div>
                <div class="text-center rounded-2xl py-5 border border-electric/15" style="background: rgba(13,18,32,0.8);">
                    <p class="font-display text-2xl font-bold text-white">{{ $skills->where('level', 'Expert')->count() }}
                    </p>
                    <p class="text-xs text-smoke uppercase tracking-widest mt-1">Expert Level</p>
                </div>
            </div>
        </div>

        {{-- Category Filter Tabs --}}
        <div class="relative z-10 flex flex-wrap justify-center gap-2 mb-12">
            @php
                $categories = $skills->pluck('category')->filter()->unique()->values();
            @endphp
            <button onclick="filterSkills('All')" data-filter="All"
                class="filter-btn px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider border transition-all duration-200 bg-electric border-electric text-white">
                All
            </button>
            @foreach($categories as $cat)
                <button onclick="filterSkills('{{ $cat }}')" data-filter="{{ $cat }}"
                    class="filter-btn px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider border border-electric/25 text-frost hover:border-electric hover:text-white transition-all duration-200">
                    {{ $cat }}
                </button>
            @endforeach
        </div>

        {{-- Skills Grid --}}
        <div class="relative z-10 max-w-6xl mx-auto">
            @forelse($skills->groupBy('category') as $category => $categorySkills)
                <div class="skill-section mb-12" data-section="{{ $category ?? 'General' }}">

                    {{-- Section heading --}}
                    <div class="flex items-center gap-4 mb-6">
                        <h2 class="font-display text-lg font-bold text-white whitespace-nowrap">
                            {{ $category ?? 'General' }}
                        </h2>
                        <div class="flex-1 h-px" style="background: linear-gradient(90deg, rgba(59,130,246,0.3), transparent);">
                        </div>
                        <span class="text-xs text-smoke font-medium">{{ $categorySkills->count() }} skills</span>
                    </div>

                    {{-- Cards --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($categorySkills as $skill)
                            @php
                                $level = $skill->level ?? 'Beginner';
                                $pct = match ($level) {
                                    'Expert' => 95,
                                    'Advanced' => 80,
                                    'Intermediate' => 60,
                                    'Beginner' => 35,
                                    default => 50,
                                };
                                $levelColor = match ($level) {
                                    'Expert' => ['badge' => 'text-yellow-300 border-yellow-400/30 bg-yellow-400/10', 'bar' => '#F59E0B'],
                                    'Advanced' => ['badge' => 'text-electric border-electric/30 bg-electric/10', 'bar' => '#3B82F6'],
                                    'Intermediate' => ['badge' => 'text-glow border-glow/30 bg-glow/10', 'bar' => '#60A5FA'],
                                    default => ['badge' => 'text-smoke border-smoke/30 bg-smoke/10', 'bar' => '#4A5568'],
                                };
                            @endphp
                            <div class="skill-card group rounded-2xl p-5 border border-electric/15 hover:border-electric/40 transition-all duration-300"
                                style="background: rgba(13,18,32,0.85);" data-category="{{ $category ?? 'General' }}">

                                {{-- Top row --}}
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-3">
                                        {{-- Icon placeholder / initials --}}
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center font-display font-bold text-sm text-white flex-shrink-0"
                                            style="background: linear-gradient(135deg, rgba(59,130,246,0.25), rgba(29,78,216,0.15)); border: 1px solid rgba(59,130,246,0.2);">
                                            {{ strtoupper(substr($skill->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <h3
                                                class="text-sm font-semibold text-white group-hover:text-glow transition-colors duration-200 leading-tight">
                                                {{ $skill->name }}
                                            </h3>
                                            @if($skill->years_exp ?? false)
                                                <p class="text-xs text-smoke mt-0.5">{{ $skill->years_exp }}y exp.</p>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Level badge --}}
                                    <span
                                        class="flex-shrink-0 px-2.5 py-1 rounded-full text-xs font-semibold border {{ $levelColor['badge'] }}">
                                        {{ $level }}
                                    </span>
                                </div>

                                {{-- Progress bar --}}
                                <div class="mt-1">
                                    <div class="flex justify-between items-center mb-1.5">
                                        <span class="text-xs text-smoke">Proficiency</span>
                                        <span class="text-xs font-semibold text-frost">{{ $pct }}%</span>
                                    </div>
                                    <div class="h-1.5 w-full rounded-full overflow-hidden"
                                        style="background: rgba(59,130,246,0.1);">
                                        <div class="h-full rounded-full skill-bar transition-all duration-1000 ease-out"
                                            style="width: 0%; background: linear-gradient(90deg, {{ $levelColor['bar'] }}, rgba(59,130,246,0.5));"
                                            data-width="{{ $pct }}%">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-24 rounded-2xl border border-electric/10" style="background: rgba(13,18,32,0.5);">
                    <svg class="w-14 h-14 mx-auto mb-4 opacity-20" fill="none" stroke="#3B82F6" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                    <p class="text-frost text-sm font-medium">No skills listed yet.</p>
                    <p class="text-smoke text-xs mt-1">Add skills from the dashboard to display them here.</p>
                </div>
            @endforelse
        </div>

        {{-- Currently Learning Section --}}
        <div class="relative z-10 mt-16 max-w-6xl mx-auto">
            <div class="flex items-center gap-4 mb-6">
                <h2 class="font-display text-lg font-bold text-white whitespace-nowrap">Currently Learning</h2>
                <div class="flex-1 h-px" style="background: linear-gradient(90deg, rgba(59,130,246,0.3), transparent);">
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach(['AI / Machine Learning', 'DevOps & CI/CD', 'TypeScript', 'System Design'] as $item)
                    <div class="rounded-2xl p-4 border border-electric/10 flex items-center gap-3"
                        style="background: rgba(13,18,32,0.6);">
                        <span class="relative flex h-2 w-2 flex-shrink-0">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-electric opacity-60"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-electric"></span>
                        </span>
                        <p class="text-xs text-frost font-medium">{{ $item }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- CTA --}}
        <div class="relative z-10 mt-16 max-w-2xl mx-auto text-center rounded-2xl p-8 border border-electric/20"
            style="background: linear-gradient(135deg, rgba(13,18,32,0.9), rgba(20,27,45,0.9)); backdrop-filter: blur(10px);">
            <p class="text-xs font-semibold tracking-[0.3em] uppercase text-electric mb-2">Let's Collaborate</p>
            <h2 class="font-display text-2xl font-bold text-white mb-3">Need These Skills on Your Team?</h2>
            <p class="text-frost text-sm leading-relaxed mb-6">
                I'm open to freelance projects and full-time roles. Let's talk about what you're building.
            </p>
            <div class="flex items-center justify-center gap-3">
                <a href="/contact"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold text-sm text-white bg-electric hover:bg-blue-500 transition-all duration-200"
                    style="box-shadow: 0 0 24px rgba(59,130,246,0.3);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Hire Me
                </a>
                <a href="/portfolio"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold text-sm text-frost border border-electric/30 hover:border-electric hover:text-white transition-all duration-200">
                    View Work
                </a>
            </div>
        </div>

    </div>

    {{-- Animate progress bars on load & filter --}}
    <script>
        function animateBars() {
            document.querySelectorAll('.skill-bar').forEach(bar => {
                const card = bar.closest('.skill-card');
                if (card && card.style.display !== 'none') {
                    setTimeout(() => { bar.style.width = bar.dataset.width; }, 100);
                }
            });
        }

        function filterSkills(category) {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                const active = btn.dataset.filter === category;
                btn.classList.toggle('bg-electric', active);
                btn.classList.toggle('border-electric', active);
                btn.classList.toggle('text-white', active);
                btn.classList.toggle('border-electric/25', !active);
                btn.classList.toggle('text-frost', !active);
            });

            document.querySelectorAll('.skill-section').forEach(section => {
                const match = category === 'All' || section.dataset.section === category;
                section.style.display = match ? '' : 'none';
            });

            // Reset + re-animate visible bars
            document.querySelectorAll('.skill-bar').forEach(bar => bar.style.width = '0%');
            setTimeout(animateBars, 50);
        }

        // Run on page load
        document.addEventListener('DOMContentLoaded', animateBars);
    </script>

@endsection