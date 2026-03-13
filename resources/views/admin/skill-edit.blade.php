@extends('layouts.app')

@section('content')

    <div class="relative py-10 max-w-xl mx-auto">

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
            <h1 class="font-display text-3xl font-bold text-white">Edit Skill</h1>
            <p class="text-sm text-frost mt-1">Update the details for <span
                    class="text-white font-medium">{{ $skill->name }}</span></p>
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
                <h2 class="font-display text-base font-bold text-white">Skill Details</h2>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('skill.update', $skill->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">
                            Skill Name <span class="text-electric">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $skill->name) }}" required
                            class="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                            style="background: rgba(5,8,15,0.7);">
                    </div>

                    {{-- Level --}}
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">Level</label>
                        <select name="level"
                            class="w-full px-4 py-3 rounded-xl text-sm text-white outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20 cursor-pointer"
                            style="background: rgba(5,8,15,0.7);">
                            <option value="">Select level…</option>
                            @foreach(['Beginner', 'Intermediate', 'Advanced', 'Expert'] as $lvl)
                                <option value="{{ $lvl }}" {{ old('level', $skill->level) == $lvl ? 'selected' : '' }}
                                    style="background:#0D1220;">{{ $lvl }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Category + Years --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label
                                class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">Category</label>
                            <input type="text" name="category" value="{{ old('category', $skill->category) }}"
                                placeholder="e.g. Frontend"
                                class="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">Years
                                Exp.</label>
                            <input type="number" name="years_exp" value="{{ old('years_exp', $skill->years_exp) }}"
                                placeholder="e.g. 2" min="0" max="30"
                                class="w-full px-4 py-3 rounded-xl text-sm text-white placeholder-smoke/50 outline-none transition-all duration-200 border border-electric/20 focus:border-electric focus:ring-2 focus:ring-electric/20"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
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