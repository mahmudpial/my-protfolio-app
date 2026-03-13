@extends('layouts.app')

@section('content')

    <div class="relative py-10 max-w-2xl mx-auto">

        {{-- Back link --}}
        <a href="{{ route('dashboard') }}"
            class="inline-flex items-center gap-1.5 text-sm text-smoke hover:text-frost transition-colors mb-8">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Dashboard
        </a>

        {{-- Header --}}
        <div class="mb-8">
            <p class="text-xs font-semibold tracking-[0.3em] uppercase text-electric mb-1">Edit</p>
            <h1 class="font-display text-3xl font-bold text-white">Edit Project</h1>
            <p class="text-sm text-frost mt-1">Updating <span class="text-white font-medium">{{ $project->title }}</span>
            </p>
        </div>

        {{-- Errors --}}
        @if($errors->any())
            <div class="mb-6 px-4 py-3 rounded-xl border border-red-500/30 bg-red-500/10">
                <ul class="space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="text-sm text-red-400 flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-red-400 flex-shrink-0"></span>{{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form card --}}
        <div class="rounded-2xl border border-electric/15 overflow-hidden" style="background: rgba(13,18,32,0.9);">

            <div class="flex items-center gap-3 px-6 py-4 border-b border-electric/10">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                    style="background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.2);">
                    <svg class="w-4 h-4 text-electric" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h2 class="font-display text-base font-bold text-white">Project Details</h2>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('portfolio.update', $project->id) }}" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">
                            Project Title <span class="text-electric">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title', $project->title) }}" required
                            class="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                            style="background: rgba(5,8,15,0.7);">
                    </div>

                    {{-- Description --}}
                    <div>
                        <label
                            class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-smoke/50 outline-none resize-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                            style="background: rgba(5,8,15,0.7);">{{ old('description', $project->description) }}</textarea>
                    </div>

                    {{-- URLs --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">Live
                                URL</label>
                            <input type="url" name="link" value="{{ old('link', $project->link) }}" placeholder="https://…"
                                class="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">GitHub
                                URL</label>
                            <input type="url" name="github" value="{{ old('github', $project->github) }}"
                                placeholder="https://github.com/…"
                                class="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                    </div>

                    {{-- Category + Tech Stack --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label
                                class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">Category</label>
                            <select name="category"
                                class="w-full px-4 py-3 rounded-xl text-sm text-white outline-none transition-all duration-200 border border-electric/20 focus:border-electric cursor-pointer"
                                style="background: rgba(5,8,15,0.7);">
                                <option value="">Select…</option>
                                @foreach(['Web App', 'UI/UX', 'API', 'Mobile', 'Other'] as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $project->category) == $cat ? 'selected' : '' }}
                                        style="background:#0D1220;">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">Tech
                                Stack</label>
                            <input type="text" name="tech_stack" value="{{ old('tech_stack', $project->tech_stack) }}"
                                placeholder="Laravel, Vue, MySQL"
                                class="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                    </div>

                    {{-- Current image preview --}}
                    @if($project->image)
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">Current
                                Image</label>
                            <div class="flex items-center gap-4 p-3 rounded-xl border border-electric/15"
                                style="background: rgba(5,8,15,0.5);">
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                    class="w-20 h-14 object-cover rounded-lg border border-electric/20 flex-shrink-0">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs text-frost truncate">{{ basename($project->image) }}</p>
                                    <label class="inline-flex items-center gap-1.5 mt-2 cursor-pointer">
                                        <input type="checkbox" name="remove_image" value="1" class="w-3.5 h-3.5 accent-red-500">
                                        <span class="text-xs text-red-400">Remove current image</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Upload new image --}}
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">
                            {{ $project->image ? 'Replace Image' : 'Project Image' }}
                        </label>
                        <label
                            class="flex flex-col items-center justify-center gap-2 w-full py-5 rounded-xl border-2 border-dashed border-electric/25 cursor-pointer hover:border-electric/50 transition-colors duration-200"
                            style="background: rgba(5,8,15,0.5);">
                            <svg class="w-7 h-7 text-smoke" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-xs text-smoke" id="file-label">Click to upload a new image</span>
                            <span class="text-xs text-smoke/50">PNG, JPG, WEBP up to 2MB</span>
                            <input type="file" name="image" accept="image/*" class="hidden"
                                onchange="document.getElementById('file-label').textContent = this.files[0]?.name || 'Click to upload a new image'">
                        </label>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit"
                            class="flex-1 flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-semibold text-white bg-electric hover:bg-blue-500 transition-all duration-200"
                            style="box-shadow: 0 0 18px rgba(59,130,246,0.25);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Save Changes
                        </button>
                        <a href="{{ route('dashboard') }}"
                            class="px-5 py-3 rounded-xl text-sm font-semibold text-frost border border-electric/25 hover:border-electric hover:text-white transition-all duration-200">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>

@endsection