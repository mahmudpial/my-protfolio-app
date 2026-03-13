<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Portfolio</title>
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

        /* Blue mesh grid */
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

        /* Input focus glow */
        .input-field:focus {
            outline: none;
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        /* Card entrance animation */
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

        /* Button shimmer */
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
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 py-12 relative">

    {{-- Background radial blobs --}}
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-0">
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] rounded-full opacity-12"
            style="background: radial-gradient(circle, #3B82F6, transparent 65%);"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 rounded-full opacity-8"
            style="background: radial-gradient(circle, #1D4ED8, transparent 65%);"></div>
    </div>

    {{-- Login Card --}}
    <div class="login-card relative z-10 w-full max-w-md">

        {{-- Logo / Brand --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2.5 justify-center mb-4">
                <span class="w-3 h-3 rounded-full bg-electric" style="box-shadow: 0 0 14px #3B82F6;"></span>
                <span class="font-display text-xl font-bold text-white">Portfolio</span>
            </a>
            <h1 class="font-display text-2xl md:text-3xl font-bold text-white mt-2">Admin Login</h1>
            <p class="text-sm text-frost mt-2">Sign in to manage your portfolio content</p>
        </div>

        {{-- Card --}}
        <div class="rounded-2xl border border-electric/20 overflow-hidden"
            style="background: rgba(13,18,32,0.95); backdrop-filter: blur(16px);">

            {{-- Top accent bar --}}
            <div class="h-px w-full bg-gradient-to-r from-transparent via-electric to-transparent opacity-60"></div>

            <div class="p-8">

                {{-- Session status --}}
                @if(session('status'))
                    <div
                        class="mb-5 flex items-center gap-3 px-4 py-3 rounded-xl border border-green-500/30 bg-green-500/10">
                        <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p class="text-sm text-green-400">{{ session('status') }}</p>
                    </div>
                @endif

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

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
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
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                placeholder="admin@example.com" required autofocus autocomplete="username"
                                class="input-field w-full pl-10 pr-4 py-3 rounded-xl text-sm text-white placeholder-smoke/50 border border-electric/20 transition-all duration-200"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password"
                            class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-smoke" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input id="password" type="password" name="password" placeholder="••••••••••" required
                                autocomplete="current-password"
                                class="input-field w-full pl-10 pr-12 py-3 rounded-xl text-sm text-white placeholder-smoke/50 border border-electric/20 transition-all duration-200"
                                style="background: rgba(5,8,15,0.7);">
                            {{-- Toggle visibility --}}
                            <button type="button"
                                onclick="const p=document.getElementById('password'); p.type=p.type==='password'?'text':'password'; this.querySelector('.eye-open').classList.toggle('hidden'); this.querySelector('.eye-closed').classList.toggle('hidden');"
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
                    </div>

                    {{-- Remember Me + Forgot Password --}}
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center gap-2.5 cursor-pointer group">
                            <div class="relative">
                                <input id="remember_me" type="checkbox" name="remember" class="sr-only peer">
                                <div class="w-4 h-4 rounded border border-electric/30 peer-checked:bg-electric peer-checked:border-electric transition-all duration-200"
                                    style="background: rgba(5,8,15,0.7);"
                                    onclick="document.getElementById('remember_me').click()"></div>
                                <svg class="absolute inset-0 w-4 h-4 text-white hidden peer-checked:block pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-sm text-frost group-hover:text-white transition-colors">Remember me</span>
                        </label>

                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm text-electric hover:text-glow transition-colors duration-200">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="btn-shimmer relative w-full flex items-center justify-center gap-2.5 py-3.5 rounded-xl font-semibold text-sm text-white overflow-hidden transition-all duration-200 bg-electric hover:bg-blue-500"
                        style="box-shadow: 0 0 24px rgba(59,130,246,0.35);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Sign In to Dashboard
                    </button>

                </form>
            </div>

            {{-- Bottom bar --}}
            <div class="px-8 py-4 border-t border-electric/10 flex items-center justify-center gap-2"
                style="background: rgba(5,8,15,0.4);">
                <svg class="w-3.5 h-3.5 text-smoke" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <span class="text-xs text-smoke">Secured area — authorised personnel only</span>
            </div>
        </div>

        {{-- Back to site --}}
        <p class="text-center mt-6">
            <a href="/"
                class="inline-flex items-center gap-1.5 text-sm text-smoke hover:text-frost transition-colors duration-200">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to portfolio
            </a>
        </p>

    </div>

</body>

</html>