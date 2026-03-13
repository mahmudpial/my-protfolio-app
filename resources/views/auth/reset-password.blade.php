<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Playfair Display', 'serif'],
                        body: ['DM Sans', 'sans-serif'],
                    },
                    colors: {
                        void: '#05080F',
                        surface: '#0D1220',
                        panel: '#141B2D',
                        electric: '#3B82F6',
                        glow: '#60A5FA',
                        frost: '#A8C4E8',
                        smoke: '#4A5568',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #05080F;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(59, 130, 246, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.04) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
            z-index: 0;
        }

        .input-field:focus {
            outline: none;
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            animation: slideUp 0.5s ease forwards;
        }

        .btn-shimmer::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
            transform: translateX(-100%);
            transition: transform 0.4s ease;
        }

        .btn-shimmer:hover::after {
            transform: translateX(100%);
        }

        #strength-bar {
            transition: width 0.3s ease, background-color 0.3s ease;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 py-12 relative">

    {{-- Background blobs --}}
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-0">
        <div class="absolute top-0 right-1/4 w-[500px] h-[500px] rounded-full opacity-12"
            style="background: radial-gradient(circle, #3B82F6, transparent 65%);"></div>
        <div class="absolute bottom-0 left-1/4 w-96 h-96 rounded-full opacity-8"
            style="background: radial-gradient(circle, #1D4ED8, transparent 65%);"></div>
    </div>

    {{-- Card --}}
    <div class="login-card relative z-10 w-full max-w-md">

        {{-- Brand --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2.5 justify-center mb-4">
                <span class="w-3 h-3 rounded-full bg-electric" style="box-shadow: 0 0 14px #3B82F6;"></span>
                <span class="font-display text-xl font-bold text-white">Portfolio</span>
            </a>

            {{-- Shield icon --}}
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4"
                style="background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.25);">
                <svg class="w-7 h-7 text-electric" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>

            <h1 class="font-display text-2xl md:text-3xl font-bold text-white">Reset Password</h1>
            <p class="text-sm text-frost mt-2 max-w-sm mx-auto leading-relaxed">
                Choose a strong new password for your account. Make sure it's at least 8 characters long.
            </p>
        </div>

        {{-- Card body --}}
        <div class="rounded-2xl border border-electric/20 overflow-hidden"
            style="background: rgba(13,18,32,0.95); backdrop-filter: blur(16px);">

            <div class="h-px w-full bg-gradient-to-r from-transparent via-electric to-transparent opacity-60"></div>

            <div class="p-8">

                {{-- Validation errors --}}
                @if($errors->any())
                    <div class="mb-5 px-4 py-3 rounded-xl border border-red-500/30 bg-red-500/10">
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

                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf

                    {{-- Hidden token --}}
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- Email (pre-filled, read-only) --}}
                    <div>
                        <label for="email"
                            class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">
                            Email Address
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-smoke" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                                required autofocus autocomplete="username"
                                class="input-field w-full pl-10 pr-4 py-3 rounded-xl text-sm text-white border border-electric/20 transition-all duration-200"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                    </div>

                    {{-- New Password --}}
                    <div>
                        <label for="password"
                            class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">
                            New Password
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-smoke" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input id="password" type="password" name="password" placeholder="Min. 8 characters"
                                required autocomplete="new-password" oninput="checkStrength(this.value)"
                                class="input-field w-full pl-10 pr-12 py-3 rounded-xl text-sm text-white placeholder-smoke/50 border border-electric/20 transition-all duration-200"
                                style="background: rgba(5,8,15,0.7);">
                            <button type="button" onclick="togglePwd('password', this)"
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-smoke hover:text-frost transition-colors">
                                <svg class="eye-open w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg class="eye-closed hidden w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        {{-- Strength meter --}}
                        <div class="mt-2">
                            <div class="h-1 w-full rounded-full overflow-hidden"
                                style="background: rgba(59,130,246,0.1);">
                                <div id="strength-bar" class="h-full rounded-full w-0"></div>
                            </div>
                            <p id="strength-label" class="text-xs text-smoke mt-1"></p>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation"
                            class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">
                            Confirm New Password
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-smoke" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </span>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                placeholder="Re-enter new password" required autocomplete="new-password"
                                oninput="checkMatch()"
                                class="input-field w-full pl-10 pr-12 py-3 rounded-xl text-sm text-white placeholder-smoke/50 border border-electric/20 transition-all duration-200"
                                style="background: rgba(5,8,15,0.7);">
                            <button type="button" onclick="togglePwd('password_confirmation', this)"
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-smoke hover:text-frost transition-colors">
                                <svg class="eye-open w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg class="eye-closed hidden w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <p id="match-label" class="text-xs mt-1.5 hidden"></p>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="btn-shimmer relative w-full flex items-center justify-center gap-2.5 py-3.5 rounded-xl font-semibold text-sm text-white overflow-hidden transition-all duration-200 bg-electric hover:bg-blue-500 mt-2"
                        style="box-shadow: 0 0 24px rgba(59,130,246,0.35);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Reset Password
                    </button>

                </form>
            </div>

            {{-- Footer --}}
            <div class="px-8 py-4 border-t border-electric/10 flex items-center justify-center gap-2"
                style="background: rgba(5,8,15,0.4);">
                <svg class="w-3.5 h-3.5 text-smoke" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <span class="text-xs text-smoke">Secured area — authorised personnel only</span>
            </div>
        </div>

        {{-- Back to login --}}
        <p class="text-center mt-6">
            <a href="{{ route('login') }}"
                class="inline-flex items-center gap-1.5 text-sm text-smoke hover:text-frost transition-colors duration-200">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to sign in
            </a>
        </p>

    </div>

    <script>
        function togglePwd(id, btn) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
            btn.querySelector('.eye-open').classList.toggle('hidden');
            btn.querySelector('.eye-closed').classList.toggle('hidden');
        }

        function checkStrength(val) {
            const bar = document.getElementById('strength-bar');
            const label = document.getElementById('strength-label');
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const levels = [
                { w: '0%', color: 'transparent', text: '' },
                { w: '25%', color: '#EF4444', text: 'Weak' },
                { w: '50%', color: '#F59E0B', text: 'Fair' },
                { w: '75%', color: '#3B82F6', text: 'Good' },
                { w: '100%', color: '#10B981', text: 'Strong' },
            ];
            const lvl = levels[score] ?? levels[0];
            bar.style.width = lvl.w;
            bar.style.backgroundColor = lvl.color;
            label.textContent = lvl.text;
            label.style.color = lvl.color;
        }

        function checkMatch() {
            const pw = document.getElementById('password').value;
            const conf = document.getElementById('password_confirmation').value;
            const label = document.getElementById('match-label');
            if (!conf) { label.classList.add('hidden'); return; }
            label.classList.remove('hidden');
            if (pw === conf) {
                label.textContent = '✓ Passwords match';
                label.style.color = '#10B981';
            } else {
                label.textContent = '✗ Passwords do not match';
                label.style.color = '#EF4444';
            }
        }
    </script>

</body>

</html>