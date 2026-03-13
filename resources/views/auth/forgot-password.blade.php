<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password — Portfolio</title>
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
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] rounded-full opacity-12"
            style="background: radial-gradient(circle, #3B82F6, transparent 65%);"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 rounded-full opacity-8"
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

            {{-- Icon --}}
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4"
                style="background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.25);">
                <svg class="w-7 h-7 text-electric" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>

            <h1 class="font-display text-2xl md:text-3xl font-bold text-white">Forgot Password?</h1>
            <p class="text-sm text-frost mt-2 max-w-sm mx-auto leading-relaxed">
                No problem. Enter your email address and we'll send you a reset link to choose a new password.
            </p>
        </div>

        {{-- Card body --}}
        <div class="rounded-2xl border border-electric/20 overflow-hidden"
            style="background: rgba(13,18,32,0.95); backdrop-filter: blur(16px);">

            <div class="h-px w-full bg-gradient-to-r from-transparent via-electric to-transparent opacity-60"></div>

            <div class="p-8">

                {{-- Success status --}}
                @if(session('status'))
                    <div
                        class="mb-6 flex items-start gap-3 px-4 py-3.5 rounded-xl border border-green-500/30 bg-green-500/10">
                        <svg class="w-4 h-4 text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-green-400 mb-0.5">Reset link sent!</p>
                            <p class="text-xs text-green-400/80">{{ session('status') }}</p>
                        </div>
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

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
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
                                placeholder="admin@example.com" required autofocus
                                class="input-field w-full pl-10 pr-4 py-3 rounded-xl text-sm text-white placeholder-smoke/50 border border-electric/20 transition-all duration-200"
                                style="background: rgba(5,8,15,0.7);">
                        </div>
                        <p class="mt-1.5 text-xs text-smoke">We'll send a reset link to this address.</p>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="btn-shimmer relative w-full flex items-center justify-center gap-2.5 py-3.5 rounded-xl font-semibold text-sm text-white overflow-hidden transition-all duration-200 bg-electric hover:bg-blue-500"
                        style="box-shadow: 0 0 24px rgba(59,130,246,0.35);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Email Password Reset Link
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
                <span class="text-xs text-smoke">Remember your password?</span>
                <a href="{{ route('login') }}"
                    class="text-xs font-semibold text-electric hover:text-glow transition-colors">
                    Sign in →
                </a>
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