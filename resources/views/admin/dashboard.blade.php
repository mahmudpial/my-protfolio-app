@extends('layouts.app')

@section('content')

<div class="relative py-10">

    {{-- Background blobs --}}
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -top-20 right-0 w-96 h-96 rounded-full opacity-10"
            style="background: radial-gradient(circle, #3B82F6, transparent 70%);"></div>
        <div class="absolute bottom-0 -left-20 w-72 h-72 rounded-full opacity-8"
            style="background: radial-gradient(circle, #1D4ED8, transparent 70%);"></div>
    </div>

    {{-- ── PAGE HEADER ── --}}
    <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
        <div>
            <p class="text-xs font-semibold tracking-[0.3em] uppercase text-electric mb-1">Admin Panel</p>
            <h1 class="font-display text-3xl md:text-4xl font-bold text-white">Dashboard</h1>
        </div>
        <div class="flex items-center gap-2 px-3.5 py-2 rounded-xl border border-electric/20"
            style="background: rgba(13,18,32,0.8);">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-70"></span>
                <span class="relative inline-flex h-2 w-2 rounded-full bg-green-500"></span>
            </span>
            <span class="text-xs font-medium text-green-400">Logged in as Admin</span>
        </div>
    </div>

    {{-- ── STAT CARDS ── --}}
    <div class="relative z-10 grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        @foreach([
        ['label' => 'Total Projects', 'value' => isset($projects) ? $projects->count() : 0, 'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => '#3B82F6'],
        ['label' => 'Total Skills', 'value' => isset($skills) ? $skills->count() : 0, 'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'color' => '#60A5FA'],
        ['label' => 'Live Projects', 'value' => isset($projects) ? $projects->where('link', '!=', null)->count() : 0, 'icon' => 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1', 'color' => '#34D399'],
        ['label' => 'Messages', 'value' => isset($messages) ? $messages->count() : 0, 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => '#F59E0B'],
        ] as $stat)
        <div class="rounded-2xl p-5 border border-electric/15 flex items-center gap-4"
            style="background: rgba(13,18,32,0.85);">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                style="background: {{ $stat['color'] }}1A; border: 1px solid {{ $stat['color'] }}33;">
                <svg class="w-5 h-5" fill="none" stroke="{{ $stat['color'] }}" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="{{ $stat['icon'] }}" />
                </svg>
            </div>
            <div>
                <p class="font-display text-2xl font-bold text-white">{{ $stat['value'] }}</p>
                <p class="text-xs text-smoke mt-0.5">{{ $stat['label'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ── ALERTS ── --}}
    @if(session('success'))
    <div class="relative z-10 mb-6 flex items-center gap-3 px-4 py-3 rounded-xl border border-green-500/30 bg-green-500/10">
        <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <p class="text-sm text-green-400 font-medium">{{ session('success') }}</p>
    </div>
    @endif
    @if($errors->any())
    <div class="relative z-10 mb-6 px-4 py-3 rounded-xl border border-red-500/30 bg-red-500/10">
        <ul class="space-y-1">
            @foreach($errors->all() as $error)
            <li class="text-sm text-red-400 flex items-center gap-2">
                <span class="w-1 h-1 rounded-full bg-red-400 flex-shrink-0"></span>{{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- ── TWO-COLUMN FORMS ── --}}
    <div class="relative z-10 grid grid-cols-1 xl:grid-cols-2 gap-6 mb-10">

        {{-- ─ ADD SKILL ─ --}}
        <div class="rounded-2xl border border-electric/15 overflow-hidden"
            style="background: rgba(13,18,32,0.9);">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-electric/10">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                    style="background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.2);">
                    <svg class="w-4 h-4 text-electric" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                            d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h2 class="font-display text-base font-bold text-white">Add New Skill</h2>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('skill.store') }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">
                                Skill Name <span class="text-electric">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="e.g. Laravel" required
                                class="w-full px-4 py-2.5 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">Level</label>
                            <select name="level"
                                class="w-full px-4 py-2.5 rounded-xl text-sm text-white outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20 cursor-pointer"
                                style="background: rgba(5,8,15,0.7);">
                                <option value="">Select level…</option>
                                <option value="Beginner" {{ old('level') == 'Beginner'     ? 'selected' : '' }} style="background:#0D1220;">Beginner</option>
                                <option value="Intermediate" {{ old('level') == 'Intermediate' ? 'selected' : '' }} style="background:#0D1220;">Intermediate</option>
                                <option value="Advanced" {{ old('level') == 'Advanced'     ? 'selected' : '' }} style="background:#0D1220;">Advanced</option>
                                <option value="Expert" {{ old('level') == 'Expert'       ? 'selected' : '' }} style="background:#0D1220;">Expert</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">Category</label>
                            <input type="text" name="category" value="{{ old('category') }}"
                                placeholder="e.g. Frontend, Backend"
                                class="w-full px-4 py-2.5 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">Years Exp.</label>
                            <input type="number" name="years_exp" value="{{ old('years_exp') }}"
                                placeholder="e.g. 2" min="0" max="30"
                                class="w-full px-4 py-2.5 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-semibold text-white bg-electric hover:bg-blue-500 transition-all duration-200"
                        style="box-shadow: 0 0 18px rgba(59,130,246,0.25);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Skill
                    </button>
                </form>
            </div>
        </div>

        {{-- ─ ADD PROJECT ─ --}}
        <div class="rounded-2xl border border-electric/15 overflow-hidden"
            style="background: rgba(13,18,32,0.9);">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-electric/10">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                    style="background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.2);">
                    <svg class="w-4 h-4 text-electric" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="font-display text-base font-bold text-white">Add New Project</h2>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('portfolio.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">
                            Project Title <span class="text-electric">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            placeholder="e.g. E-Commerce Platform" required
                            class="w-full px-4 py-2.5 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                            style="background: rgba(5,8,15,0.7);">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">Description</label>
                        <textarea name="description" rows="3"
                            placeholder="Brief description of the project…"
                            class="w-full px-4 py-2.5 rounded-xl text-sm text-white placeholder-smoke/50 outline-none resize-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                            style="background: rgba(5,8,15,0.7);">{{ old('description') }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">Live URL</label>
                            <input type="url" name="link" value="{{ old('link') }}"
                                placeholder="https://…"
                                class="w-full px-4 py-2.5 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">GitHub URL</label>
                            <input type="url" name="github" value="{{ old('github') }}"
                                placeholder="https://github.com/…"
                                class="w-full px-4 py-2.5 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">Category</label>
                            <select name="category"
                                class="w-full px-4 py-2.5 rounded-xl text-sm text-white outline-none transition-all duration-200 border border-electric/20 focus:border-electric cursor-pointer"
                                style="background: rgba(5,8,15,0.7);">
                                <option value="">Select…</option>
                                @foreach(['Web App','UI/UX','API','Mobile','Other'] as $cat)
                                <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }} style="background:#0D1220;">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">Tech Stack</label>
                            <input type="text" name="tech_stack" value="{{ old('tech_stack') }}"
                                placeholder="Laravel, Vue, MySQL"
                                class="w-full px-4 py-2.5 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                    </div>
                    {{-- File Upload --}}
                    <div>
                        <label class="block text-xs font-medium text-smoke uppercase tracking-widest mb-2">Project Image</label>
                        <label class="flex flex-col items-center justify-center gap-2 w-full py-6 rounded-xl border-2 border-dashed border-electric/25 cursor-pointer hover:border-electric/50 transition-colors duration-200"
                            style="background: rgba(5,8,15,0.5);" id="dropzone-label">
                            <svg class="w-8 h-8 text-smoke" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-xs text-smoke" id="file-label">Click to upload or drag & drop</span>
                            <span class="text-xs text-smoke/50">PNG, JPG, WEBP up to 2MB</span>
                            <input type="file" name="image" accept="image/*" class="hidden"
                                onchange="document.getElementById('file-label').textContent = this.files[0]?.name || 'Click to upload'">
                        </label>
                    </div>
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-semibold text-white bg-electric hover:bg-blue-500 transition-all duration-200"
                        style="box-shadow: 0 0 18px rgba(59,130,246,0.25);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Project
                    </button>
                </form>
            </div>
        </div>

    </div>{{-- end forms grid --}}

    {{-- ── SKILLS TABLE ── --}}
    <div class="relative z-10 rounded-2xl border border-electric/15 overflow-hidden mb-6"
        style="background: rgba(13,18,32,0.9);">
        <div class="flex items-center justify-between px-6 py-4 border-b border-electric/10">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                    style="background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.2);">
                    <svg class="w-4 h-4 text-electric" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <h2 class="font-display text-base font-bold text-white">Skills</h2>
                <span class="px-2 py-0.5 rounded-full text-xs font-semibold text-electric border border-electric/25"
                    style="background: rgba(59,130,246,0.08);">
                    {{ isset($skills) ? $skills->count() : 0 }}
                </span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-electric/10">
                        <th class="text-left px-6 py-3 text-xs font-semibold uppercase tracking-widest text-smoke">#</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold uppercase tracking-widest text-smoke">Skill</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold uppercase tracking-widest text-smoke">Level</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold uppercase tracking-widest text-smoke">Category</th>
                        <th class="text-right px-6 py-3 text-xs font-semibold uppercase tracking-widest text-smoke">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-electric/8">
                    @forelse(isset($skills) ? $skills : [] as $skill)
                    @php
                    $levelColor = match($skill->level ?? '') {
                    'Expert' => 'text-yellow-300 border-yellow-400/30 bg-yellow-400/10',
                    'Advanced' => 'text-electric border-electric/30 bg-electric/10',
                    'Intermediate' => 'text-glow border-glow/30 bg-glow/10',
                    default => 'text-smoke border-smoke/30 bg-smoke/10',
                    };
                    @endphp
                    <tr class="hover:bg-electric/5 transition-colors duration-150 group">
                        <td class="px-6 py-3.5 text-smoke text-xs">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3.5">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold text-white"
                                    style="background: rgba(59,130,246,0.18);">
                                    {{ strtoupper(substr($skill->name, 0, 2)) }}
                                </div>
                                <span class="text-white font-medium">{{ $skill->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-3.5">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $levelColor }}">
                                {{ $skill->level ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-3.5 text-frost text-xs">{{ $skill->category ?? '—' }}</td>
                        <td class="px-6 py-3.5">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('skill.edit', $skill->id) }}"
                                    class="w-7 h-7 rounded-lg flex items-center justify-center border border-electric/20 hover:border-electric hover:bg-electric/10 transition-all duration-200 group/btn">
                                    <svg class="w-3.5 h-3.5 text-frost group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('skill.destroy', $skill->id) }}"
                                    onsubmit="return confirm('Delete {{ $skill->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-7 h-7 rounded-lg flex items-center justify-center border border-red-500/20 hover:border-red-500/60 hover:bg-red-500/10 transition-all duration-200 group/btn">
                                        <svg class="w-3.5 h-3.5 text-red-400/70 group-hover/btn:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-sm text-smoke">
                            No skills added yet. Use the form above to get started.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── PROJECTS TABLE ── --}}
    <div class="relative z-10 rounded-2xl border border-electric/15 overflow-hidden"
        style="background: rgba(13,18,32,0.9);">
        <div class="flex items-center justify-between px-6 py-4 border-b border-electric/10">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                    style="background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.2);">
                    <svg class="w-4 h-4 text-electric" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="font-display text-base font-bold text-white">Projects</h2>
                <span class="px-2 py-0.5 rounded-full text-xs font-semibold text-electric border border-electric/25"
                    style="background: rgba(59,130,246,0.08);">
                    {{ isset($projects) ? $projects->count() : 0 }}
                </span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-electric/10">
                        <th class="text-left px-6 py-3 text-xs font-semibold uppercase tracking-widest text-smoke">#</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold uppercase tracking-widest text-smoke">Project</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold uppercase tracking-widest text-smoke">Category</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold uppercase tracking-widest text-smoke">Live URL</th>
                        <th class="text-right px-6 py-3 text-xs font-semibold uppercase tracking-widest text-smoke">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-electric/8">
                    @forelse(isset($projects) ? $projects : [] as $project)
                    <tr class="hover:bg-electric/5 transition-colors duration-150 group">
                        <td class="px-6 py-3.5 text-smoke text-xs">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3.5">
                            <div class="flex items-center gap-3">
                                @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}"
                                    class="w-9 h-9 rounded-lg object-cover flex-shrink-0 border border-electric/20"
                                    alt="{{ $project->title }}">
                                @else
                                <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 border border-electric/15"
                                    style="background: rgba(59,130,246,0.1);">
                                    <svg class="w-4 h-4 opacity-30" fill="none" stroke="#3B82F6" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" />
                                    </svg>
                                </div>
                                @endif
                                <div>
                                    <p class="text-white font-medium leading-tight">{{ $project->title }}</p>
                                    @if($project->tech_stack ?? false)
                                    <p class="text-xs text-smoke mt-0.5 truncate max-w-[180px]">{{ $project->tech_stack }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3.5">
                            @if($project->category ?? false)
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium text-frost border border-electric/20"
                                style="background: rgba(59,130,246,0.08);">
                                {{ $project->category }}
                            </span>
                            @else
                            <span class="text-smoke text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-3.5">
                            @if($project->link)
                            <a href="{{ $project->link }}" target="_blank"
                                class="inline-flex items-center gap-1 text-xs text-electric hover:text-glow transition-colors truncate max-w-[160px]">
                                <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                {{ parse_url($project->link, PHP_URL_HOST) }}
                            </a>
                            @else
                            <span class="text-smoke text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-3.5">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('portfolio.edit', $project->id) }}"
                                    class="w-7 h-7 rounded-lg flex items-center justify-center border border-electric/20 hover:border-electric hover:bg-electric/10 transition-all duration-200 group/btn">
                                    <svg class="w-3.5 h-3.5 text-frost group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('portfolio.destroy', $project->id) }}"
                                    onsubmit="return confirm('Delete {{ $project->title }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-7 h-7 rounded-lg flex items-center justify-center border border-red-500/20 hover:border-red-500/60 hover:bg-red-500/10 transition-all duration-200 group/btn">
                                        <svg class="w-3.5 h-3.5 text-red-400/70 group-hover/btn:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-sm text-smoke">
                            No projects added yet. Use the form above to get started.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection