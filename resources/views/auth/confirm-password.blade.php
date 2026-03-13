<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Password — Portfolio</title>
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
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 py-12 relative">

    {{-- Background blobs --}}
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-0">
        <div class="absolute top-0 left-1/3 w-[480px] h-[480px] rounded-full opacity-12"
            style="background: radial-gradient(circle, #3B82F6, transparent 65%);"></div>
        <div class="absolute bottom-0 right-1/3 w-80 h-80 rounded-full opacity-8"
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

            {{-- Lock icon with warning ring --}}
            <div class="relative w-14 h-14 mx-auto mb-4">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center"
                    style="background: rgba(245,158,11,0.12); border: 1px solid rgba(245,158,11,0.3);">
                    <svg class="w-7 h-7" fill="none" stroke="#F59E0B" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                {{-- Pulse ring --}}
                <span class="absolute -inset-1 rounded-2xl border border-yellow-500/20 animate-ping opacity-40"></span>
            </div>

            <h1 class="font-display text-2xl md:text-3xl font-bold text-white">Confirm Password</h1>
            <p class="text-sm text-frost mt-2 max-w-sm mx-auto leading-relaxed">
                This is a secure area. Please re-enter your password to confirm your identity before continuing.
            </p>
        </div>

        {{-- Card body --}}
        <div class="rounded-2xl border border-electric/20 overflow-hidden"
            style="background: rgba(13,18,32,0.95); backdrop-filter: blur(16px);">

            <div class="h-px w-full bg-gradient-to-r from-transparent via-electric to-transparent opacity-60"></div>

            <div class="p-8">

                {{-- Security notice banner --}}
                <div class="mb-6 flex items-start gap-3 px-4 py-3.5 rounded-xl border border-yellow-500/20"
                    style="background: rgba(245,158,11,0.06);">
                    <svg class="w-4 h-4 text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-xs text-yellow-300/80 leading-relaxed">
                        For your security, please confirm your current password to access this protected section.
                    </p>
                </div>

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

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                    @csrf

                    {{-- Password --}}
                    <div>
                        <label for="password"
                            class="block text-xs font-semibold uppercase tracking-widest text-smoke mb-2">
                            Current Password
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
                        <p class="mt-1.5 text-xs text-smoke">Enter the password you use to sign in.</p>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="btn-shimmer relative w-full flex items-center justify-center gap-2.5 py-3.5 rounded-xl font-semibold text-sm text-white overflow-hidden transition-all duration-200 bg-electric hover:bg-blue-500 mt-2"
                        style="box-shadow: 0 0 24px rgba(59,130,246,0.35);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Confirm & Continue
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

        {{-- Forgot password --}}
        <p class="text-center mt-6">
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="inline-flex items-center gap-1.5 text-sm text-smoke hover:text-frost transition-colors duration-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Forgot your password?
                </a>
            @endif
        </p>

    </div>

</body>

</html>