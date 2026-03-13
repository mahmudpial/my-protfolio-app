<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email — Portfolio</title>
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

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        .icon-float {
            animation: float 3s ease-in-out infinite;
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

        /* Countdown ring */
        @keyframes countdown {
            from {
                stroke-dashoffset: 0;
            }

            to {
                stroke-dashoffset: 113;
            }
        }

        #countdown-ring {
            animation: countdown 60s linear forwards;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 py-12 relative">

    {{-- Background blobs --}}
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-0">
        <div class="absolute top-0 left-1/4 w-[480px] h-[480px] rounded-full opacity-12"
            style="background: radial-gradient(circle, #3B82F6, transparent 65%);"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 rounded-full opacity-8"
            style="background: radial-gradient(circle, #1D4ED8, transparent 65%);"></div>
    </div>

    {{-- Card --}}
    <div class="login-card relative z-10 w-full max-w-md">

        {{-- Brand --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2.5 justify-center mb-6">
                <span class="w-3 h-3 rounded-full bg-electric" style="box-shadow: 0 0 14px #3B82F6;"></span>
                <span class="font-display text-xl font-bold text-white">Portfolio</span>
            </a>

            {{-- Floating envelope icon --}}
            <div class="icon-float relative w-20 h-20 mx-auto mb-5">
                {{-- Countdown ring --}}
                <svg class="absolute inset-0 w-20 h-20 -rotate-90" viewBox="0 0 40 40">
                    <circle cx="20" cy="20" r="18" fill="none" stroke="rgba(59,130,246,0.1)" stroke-width="1.5" />
                    <circle id="countdown-ring" cx="20" cy="20" r="18" fill="none" stroke="rgba(59,130,246,0.5)"
                        stroke-width="1.5" stroke-dasharray="113" stroke-dashoffset="0" stroke-linecap="round" />
                </svg>
                <div class="absolute inset-1.5 rounded-full flex items-center justify-center"
                    style="background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.25);">
                    <svg class="w-8 h-8 text-electric" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                {{-- Decorative dots --}}
                <span class="absolute top-0 right-0 w-2.5 h-2.5 rounded-full bg-green-400 border-2"
                    style="border-color: #05080F;"></span>
            </div>

            <h1 class="font-display text-2xl md:text-3xl font-bold text-white">Check Your Email</h1>
            <p class="text-sm text-frost mt-2 max-w-sm mx-auto leading-relaxed">
                Thanks for signing up! We've sent a verification link to your email address. Click the link to activate
                your account.
            </p>
        </div>

        {{-- Card body --}}
        <div class="rounded-2xl border border-electric/20 overflow-hidden"
            style="background: rgba(13,18,32,0.95); backdrop-filter: blur(16px);">

            <div class="h-px w-full bg-gradient-to-r from-transparent via-electric to-transparent opacity-60"></div>

            <div class="p-8 space-y-5">

                {{-- Resent success --}}
                @if(session('status') == 'verification-link-sent')
                    <div class="flex items-start gap-3 px-4 py-3.5 rounded-xl border border-green-500/30 bg-green-500/10">
                        <svg class="w-4 h-4 text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-green-400 mb-0.5">Email sent!</p>
                            <p class="text-xs text-green-400/80">A new verification link has been sent to your registered
                                email address.</p>
                        </div>
                    </div>
                @endif

                {{-- Steps --}}
                <div class="rounded-xl border border-electric/12 overflow-hidden" style="background: rgba(5,8,15,0.5);">
                    @foreach([
                            ['step' => '1', 'text' => 'Open your email inbox', 'sub' => 'Check spam or junk if you don\'t see it'],
                            ['step' => '2', 'text' => 'Click the verification link', 'sub' => 'The link expires after 60 minutes'],
                            ['step' => '3', 'text' => 'You\'re all set!', 'sub' => 'You\'ll be redirected to the dashboard'],
                        ] as $i => $s)
                        <div class="flex items-start gap-4 px-5 py-4 {{ $i < 2 ? 'border-b border-electric/10' : '' }}">
                            <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0 mt-0.5"
                                  style="background: rgba(59,130,246,0.25); border: 1px solid rgba(59,130,246,0.3);">
                                {{ $s['step'] }}
                            </span>
                            <div>
                                <p class="text-sm font-medium text-white">{{ $s['text'] }}</p>
                                <p class="text-xs text-smoke mt-0.5">{{ $s['sub'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            {{-- Resend button --}}
            <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                          class="btn-shimmer relative w-full flex items-center justify-center gap-2.5 py-3.5 rounded-xl font-semibold text-sm t ext-white overflow-hidden transition-all duration-200 bg-electric hover:bg-blue-500"
                            style="box-shadow: 0 0 24px rgba(59,130,246,0.35);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Resend Verification Email
                    </button>
                </form>

                {{-- Divider --}}
                <div class="flex items-center gap-3">
                    <div class="flex-1 h-px" style="background: rgba(59,130,246,0.12);"></div>
                    <span class="text-xs text-smoke">or</span>
                    <div class="flex-1 h-px" style="background: rgba(59,130,246,0.12);"></div>
                </div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                          class="w-full flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-medium text-smoke  border border-electric/15 hover:border-red-500/40 hover:text-red-400 transition-all duration-200"
                            style="background: rgba(5,8,15,0.5);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Sign Out &amp; Use a Different Account
                    </button>
                </form>

           </div>

            {{-- Footer --}}
          <div class="px-8 py-4 border-t border-electric/10 flex items-center justify-center gap-2"
                  style="background: rgba(5,8,15,0.4);">
                <svg class="w-3.5 h-3.5 text-smoke" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <span class="text-xs text-smoke">Check your spam folder if you don't see the email</span>
            </div>
        </div>

               
        {{-- Back to site --}}

                                <p class="text-center mt-6">
            <a href="/" class="inline-flex items-center gap-1.5 text-sm text-smoke hover:text-frost transition-colors duration-200">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to portfolio
            </a>
        </p>

    </div>

    {{-- Countdown timer --}}
    <script>
        let secs = 60;
        const label = document.createElement('p');
        label.className = 'text-xs text-smoke text-center mt-2';
        document.querySelector('form[action*="verification"]').after(label);

        const tick = setInterval(() => {
            secs--;
            if (secs > 0) {
                label.textContent = `Resend available again in ${secs}s`;
            } else {
                clearInterval(tick);
                label.textContent = '';
       
     }
        }, 1000);
    </script>

</body>
</html>