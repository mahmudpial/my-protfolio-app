<!DOCTYPE html>
<html lang="en">

<head>
    <title>Portfolio Website</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <script>
        // Config must be set BEFORE tailwind processes classes
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Playfair Display"', 'serif'],
                        body: ['"DM Sans"', 'sans-serif'],
                    },
                    colors: {
                        void: '#05080F',
                        surface: '#0D1220',
                        panel: '#141B2D',
                        electric: '#3B82F6',
                        glow: '#60A5FA',
                        frost: '#A8C4E8',
                        smoke: '#6B7280',
                    }
                }
            }
        }
    </script>

    <style>
        /* ── Base ── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #05080F;
            color: #A8C4E8;
            min-height: 100vh;
        }

        /* ── Blue mesh background ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                radial-gradient(ellipse at 15% 10%, rgba(30, 60, 130, 0.30) 0%, transparent 50%),
                radial-gradient(ellipse at 85% 85%, rgba(15, 40, 100, 0.25) 0%, transparent 50%),
                linear-gradient(rgba(59, 130, 246, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.03) 1px, transparent 1px);
            background-size: auto, auto, 48px 48px, 48px 48px;
            pointer-events: none;
            z-index: 0;
        }

        /* ── Nav glass ── */
        .nav-glass {
            background: rgba(13, 18, 32, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(59, 130, 246, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* ── Nav link underline ── */
        .nav-link {
            position: relative;
            color: #A8C4E8;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: #fff;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 1px;
            background: #3B82F6;
            box-shadow: 0 0 6px #3B82F6;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* ── Logo dot pulse ── */
        @keyframes pulse-dot {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.5);
                transform: scale(1);
            }

            50% {
                box-shadow: 0 0 12px 4px rgba(59, 130, 246, 0.3);
                transform: scale(1.15);
            }
        }

        .logo-dot {
            animation: pulse-dot 2.5s ease-in-out infinite;
        }

        /* ── Nav fade in ── */
        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        nav {
            animation: fadeDown 0.45s ease forwards;
        }

        /* ── Pill buttons ── */
        .btn-outline {
            font-size: 0.8125rem;
            font-weight: 600;
            color: #60A5FA;
            border: 1px solid rgba(59, 130, 246, 0.35);
            padding: 0.35rem 1rem;
            border-radius: 9999px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-outline:hover {
            border-color: #3B82F6;
            color: #fff;
            box-shadow: 0 0 14px rgba(59, 130, 246, 0.35);
        }

        .btn-solid {
            font-size: 0.8125rem;
            font-weight: 600;
            color: #fff;
            background: #3B82F6;
            padding: 0.35rem 1rem;
            border-radius: 9999px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-solid:hover {
            background: #60A5FA;
            box-shadow: 0 0 14px rgba(59, 130, 246, 0.4);
        }

        /* ── Mobile menu ── */
        #mobile-menu {
            display: none;
        }

        #mobile-menu.open {
            display: block;
        }

        /* ── Page content ── */
        main {
            position: relative;
            z-index: 10;
            padding-top: 5rem;
            min-height: 100vh;
        }

        .content-wrap {
            max-width: 72rem;
            margin: 0 auto;
            padding: 3rem 1.5rem;
        }

        /* ── Footer styles ── */
        .footer-link {
            color: #A8C4E8;
            font-size: 0.875rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            transition: all 0.2s;
        }

        .footer-link:hover {
            color: #fff;
            transform: translateX(3px);
        }

        .footer-icon-btn {
            width: 2rem;
            height: 2rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(59, 130, 246, 0.2);
            background: transparent;
            color: #A8C4E8;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .footer-icon-btn:hover {
            border-color: #3B82F6;
            background: rgba(59, 130, 246, 0.12);
            color: #fff;
        }

        /* ── Section dividers ── */
        .gradient-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.25), transparent);
        }

        /* ── Card base ── */
        .card {
            background: rgba(13, 18, 32, 0.88);
            border: 1px solid rgba(59, 130, 246, 0.15);
            border-radius: 1rem;
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body>

    <!-- Top accent line -->
    <div
        style="position:fixed;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,#3B82F6,transparent);opacity:0.7;z-index:60;">
    </div>

    <!-- ═══════════════════════ NAVIGATION ═══════════════════════ -->
    <nav class="nav-glass" style="position:fixed;top:0;left:0;right:0;z-index:50;">
        <div style="max-width:72rem;margin:0 auto;padding:0.9rem 1.5rem;display:flex;align-items:center;width:100%;">

            <!-- Logo -->
            <a href="/" style="display:flex;align-items:center;gap:0.625rem;text-decoration:none;flex-shrink:0;">
                <span class="logo-dot"
                    style="width:0.625rem;height:0.625rem;border-radius:9999px;background:#3B82F6;flex-shrink:0;"></span>
                <span
                    style="font-family:'Playfair Display',serif;font-size:1.125rem;font-weight:700;color:#fff;letter-spacing:-0.02em;">PialCodes</span>
            </a>

            <!-- Desktop Nav — right aligned with tight gap -->
            <div style="display:flex;align-items:center;gap:2rem;margin-left:auto;margin-right:2rem;"
                class="hidden md:flex">
                <a href="/" class="nav-link">Home</a>
                <a href="/skills" class="nav-link">Skills</a>
                <a href="/portfolio" class="nav-link">Portfolio</a>
                <a href="/contact" class="nav-link">Contact</a>
            </div>

            <!-- Auth -->
            <div style="display:flex;align-items:center;gap:0.75rem;">
                @auth
                    <!-- Profile dropdown -->
                    <div style="position:relative;" id="profile-menu-wrap">
                        <button
                            onclick="var d=document.getElementById('profile-dropdown');d.style.display=d.style.display==='block'?'none':'block';"
                            style="display:flex;align-items:center;gap:0.625rem;background:rgba(59,130,246,0.08);border:1px solid rgba(59,130,246,0.25);border-radius:9999px;padding:0.3rem 0.9rem 0.3rem 0.35rem;cursor:pointer;transition:all 0.2s;"
                            onmouseover="this.style.borderColor='rgba(59,130,246,0.6)'"
                            onmouseout="this.style.borderColor='rgba(59,130,246,0.25)'">
                            <!-- Avatar initials -->
                            <span
                                style="width:1.75rem;height:1.75rem;border-radius:9999px;background:linear-gradient(135deg,#3B82F6,#1D4ED8);display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:700;color:#fff;flex-shrink:0;letter-spacing:0.03em;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', auth()->user()->name)[1] ?? '', 0, 1)) }}
                            </span>
                            <!-- Name -->
                            <span
                                style="font-size:0.8125rem;font-weight:600;color:#A8C4E8;max-width:7rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                {{ auth()->user()->name }}
                            </span>
                            <!-- Chevron -->
                            <svg style="width:0.75rem;height:0.75rem;color:#4A5568;flex-shrink:0;transition:transform 0.2s;"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown panel -->
                        <div id="profile-dropdown"
                            style="display:none;position:absolute;right:0;top:calc(100% + 0.5rem);min-width:13rem;border-radius:0.875rem;border:1px solid rgba(59,130,246,0.2);overflow:hidden;z-index:100;box-shadow:0 16px 40px rgba(0,0,0,0.5);"
                            class="dropdown-panel">
                            <!-- User info header -->
                            <div
                                style="padding:0.875rem 1rem;border-bottom:1px solid rgba(59,130,246,0.12);background:rgba(5,8,15,0.95);">
                                <div style="display:flex;align-items:center;gap:0.625rem;">
                                    <span
                                        style="width:2rem;height:2rem;border-radius:9999px;background:linear-gradient(135deg,#3B82F6,#1D4ED8);display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:#fff;flex-shrink:0;">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', auth()->user()->name)[1] ?? '', 0, 1)) }}
                                    </span>
                                    <div style="overflow:hidden;">
                                        <p
                                            style="font-size:0.8125rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                            {{ auth()->user()->name }}</p>
                                        <p
                                            style="font-size:0.7rem;color:#4A5568;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                            {{ auth()->user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Menu items -->
                            <div style="background:rgba(13,18,32,0.98);padding:0.375rem;">
                                <a href="{{ route('dashboard') }}"
                                    style="display:flex;align-items:center;gap:0.625rem;padding:0.6rem 0.75rem;border-radius:0.5rem;text-decoration:none;color:#A8C4E8;font-size:0.8125rem;font-weight:500;transition:all 0.15s;"
                                    onmouseover="this.style.background='rgba(59,130,246,0.1)';this.style.color='#fff'"
                                    onmouseout="this.style.background='transparent';this.style.color='#A8C4E8'">
                                    <svg style="width:0.875rem;height:0.875rem;flex-shrink:0;" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </a>
                                <div style="height:1px;background:rgba(59,130,246,0.1);margin:0.25rem 0;"></div>
                                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                    @csrf
                                    <button type="submit"
                                        style="width:100%;display:flex;align-items:center;gap:0.625rem;padding:0.6rem 0.75rem;border-radius:0.5rem;background:none;border:none;color:#F87171;font-size:0.8125rem;font-weight:500;cursor:pointer;text-align:left;transition:all 0.15s;"
                                        onmouseover="this.style.background='rgba(239,68,68,0.1)'"
                                        onmouseout="this.style.background='transparent'">
                                        <svg style="width:0.875rem;height:0.875rem;flex-shrink:0;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <button onclick="document.getElementById('mobile-menu').classList.toggle('open')"
                style="display:none;padding:0.5rem;background:none;border:none;cursor:pointer;color:#A8C4E8;"
                class="md-hidden-btn" aria-label="Menu">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" style="border-top:1px solid rgba(59,130,246,0.12);background:rgba(13,18,32,0.96);">
            <div style="max-width:72rem;margin:0 auto;padding:1rem 1.5rem;display:flex;flex-direction:column;gap:1rem;">
                <a href="/" class="nav-link" style="font-size:0.9rem;">Home</a>
                <a href="/skills" class="nav-link" style="font-size:0.9rem;">Skills</a>
                <a href="/portfolio" class="nav-link" style="font-size:0.9rem;">Portfolio</a>
                <a href="/contact" class="nav-link" style="font-size:0.9rem;">Contact</a>
                @auth
                    <div style="height:1px;background:rgba(59,130,246,0.12);"></div>
                    <!-- Mobile user info -->
                    <div style="display:flex;align-items:center;gap:0.625rem;padding:0.5rem 0;">
                        <span
                            style="width:2rem;height:2rem;border-radius:9999px;background:linear-gradient(135deg,#3B82F6,#1D4ED8);display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:700;color:#fff;flex-shrink:0;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', auth()->user()->name)[1] ?? '', 0, 1)) }}
                        </span>
                        <div>
                            <p style="font-size:0.8125rem;font-weight:600;color:#fff;">{{ auth()->user()->name }}</p>
                            <p style="font-size:0.7rem;color:#4A5568;">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('dashboard') }}"
                        style="color:#60A5FA;font-size:0.875rem;font-weight:600;text-decoration:none;">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit"
                            style="background:none;border:none;color:#F87171;font-size:0.875rem;font-weight:600;cursor:pointer;padding:0;">Sign
                            Out</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hamburger show on mobile via CSS -->
    <style>
        @media (max-width: 767px) {
            .hidden.md\:flex {
                display: none !important;
            }

            .md-hidden-btn {
                display: block !important;
            }
        }
    </style>

    <!-- ═══════════════════════ PAGE CONTENT ═══════════════════════ -->
    <main>
        <div class="content-wrap">
            @yield('content')
        </div>
    </main>

    <!-- ═══════════════════════ FOOTER ═══════════════════════ -->
    <footer style="position:relative;z-index:10;border-top:1px solid rgba(59,130,246,0.12);margin-top:6rem;">
        <!-- Glow top line -->
        <div
            style="position:absolute;top:-1px;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(59,130,246,0.5),transparent);">
        </div>

        <div style="max-width:72rem;margin:0 auto;padding:3rem 1.5rem 1.5rem;">

            <!-- 4-col grid -->
            <div style="display:grid;grid-template-columns:1fr;gap:2.5rem;margin-bottom:2.5rem;">
                <style>
                    @media(min-width:768px) {
                        .footer-grid {
                            grid-template-columns: 2fr 1fr 1fr !important;
                        }
                    }

                    @media(min-width:1024px) {
                        .footer-grid {
                            grid-template-columns: 2fr 1fr 1fr !important;
                        }
                    }
                </style>
            </div>

            <div class="footer-grid" style="display:grid;grid-template-columns:1fr;gap:2.5rem;margin-bottom:2.5rem;">

                <!-- Brand -->
                <div>
                    <a href="/"
                        style="display:inline-flex;align-items:center;gap:0.625rem;text-decoration:none;margin-bottom:1rem;">
                        <span
                            style="width:0.625rem;height:0.625rem;border-radius:9999px;background:#3B82F6;box-shadow:0 0 10px #3B82F6;"></span>
                        <span
                            style="font-family:'Playfair Display',serif;font-size:1.125rem;font-weight:700;color:#fff;">PialCodes</span>
                    </a>
                    <p style="font-size:0.875rem;color:#A8C4E8;line-height:1.7;max-width:22rem;margin-bottom:1.25rem;">
                        Full-stack developer crafting fast, accessible, and beautiful web applications. Open to
                        freelance projects and full-time opportunities.
                    </p>
                    <div
                        style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.375rem 0.875rem;border-radius:9999px;border:1px solid rgba(34,197,94,0.25);background:rgba(16,185,129,0.07);">
                        <span style="position:relative;display:flex;width:0.5rem;height:0.5rem;">
                            <span class="animate-ping"
                                style="position:absolute;inset:0;border-radius:9999px;background:#4ADE80;opacity:0.7;animation:ping 1.5s cubic-bezier(0,0,0.2,1) infinite;"></span>
                            <span
                                style="position:relative;width:0.5rem;height:0.5rem;border-radius:9999px;background:#22C55E;"></span>
                        </span>
                        <span style="font-size:0.75rem;font-weight:600;color:#4ADE80;">Available for hire</span>
                    </div>
                    <style>
                        @keyframes ping {

                            75%,
                            100% {
                                transform: scale(2);
                                opacity: 0;
                            }
                        }
                    </style>
                </div>

                <!-- Navigation -->
                <div>
                    <p
                        style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.2em;color:#6B7280;margin-bottom:1rem;">
                        Navigation</p>
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:0.625rem;">
                        @foreach([['href' => '/', 'label' => 'Home'], ['href' => '/skills', 'label' => 'Skills'], ['href' => '/portfolio', 'label' => 'Portfolio'], ['href' => '/contact', 'label' => 'Contact']] as $link)
                            <li>
                                <a href="{{ $link['href'] }}" class="footer-link">
                                    <span
                                        style="display:inline-block;width:0;height:1px;background:#3B82F6;transition:width 0.2s;vertical-align:middle;"
                                        class="footer-dash"></span>
                                    {{ $link['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <p
                        style="font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.2em;color:#6B7280;margin-bottom:1rem;">
                        Contact</p>
                    <div style="display:flex;flex-direction:column;gap:0.875rem;">
                        <!-- Email -->
                        <a href="/cdn-cgi/l/email-protection#8de5e8e1e1e2cdf4e2f8fffde2fff9ebe2e1e4e2a3eee2e0"
                            style="display:flex;align-items:center;gap:0.625rem;text-decoration:none;color:#A8C4E8;font-size:0.875rem;transition:color 0.2s;"
                            onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#A8C4E8'">
                            <span
                                style="width:1.75rem;height:1.75rem;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:rgba(59,130,246,0.1);border:1px solid rgba(59,130,246,0.2);">
                                <svg width="14" height="14" fill="none" stroke="#3B82F6" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <span class="__cf_email__"
                                data-cfemail="026a676e6e6d427b6d7770726d7076646d6e6b6d2c616d6f">[email&#160;protected]</span>
                        </a>
                        <!-- Location -->
                        <span style="display:flex;align-items:center;gap:0.625rem;color:#A8C4E8;font-size:0.875rem;">
                            <span
                                style="width:1.75rem;height:1.75rem;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:rgba(59,130,246,0.1);border:1px solid rgba(59,130,246,0.2);">
                                <svg width="14" height="14" fill="none" stroke="#3B82F6" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                            Dhaka, Bangladesh
                        </span>
                        <!-- CTA -->
                        <a href="/contact"
                            style="display:inline-flex;align-items:center;gap:0.375rem;font-size:0.75rem;font-weight:700;color:#3B82F6;text-decoration:none;transition:color 0.2s;margin-top:0.25rem;"
                            onmouseover="this.style.color='#60A5FA'" onmouseout="this.style.color='#3B82F6'">
                            Send a message
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Divider -->
            <div class="gradient-divider" style="margin-bottom:1.5rem;"></div>

            <!-- Bottom bar -->
            <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1rem;">
                <span style="font-size:0.75rem;color:#6B7280;">
                    © {{ date('Y') }} PialCodes 
                     Created by
                    <span style="color:#3B82F6;font-weight:600;">Pial Mahmud</span>
                    . Built with
                    <span style="color:#3B82F6;font-weight:600;">Laravel</span> &amp;
                    <span style="color:#3B82F6;font-weight:600;">Tailwind CSS</span>.
                </span>

                <div style="display:flex;align-items:center;gap:0.625rem;">
                    @foreach([
    ['href' => '#', 'label' => 'GitHub', 'path' => 'M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z'],
    ['href' => '#', 'label' => 'LinkedIn', 'path' => 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z'],
    ['href' => '#', 'label' => 'X', 'path' => 'M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z'],
] as $s)
                        <a href="{{ $s['href'] }}" aria-label="{{ $s['label'] }}" class="footer-icon-btn">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                                <path d="{{ $s['path'] }}"/>

                                                   </svg>
                        </a>
                     @endforeach
                    <button onclick="window.scrollTo({top:0,behavior:'smooth'})" class="footer-icon-btn" aria-label="Back to top">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
     </footer>

    <script>
        document.addEventListener('click', function(e) {
            const wrap = document.getElementById('profile-menu-wrap');
            const dropdown = document.getElementById('profile-dropdown');
            if (wrap && dropdown && !wrap.contains(e.target)) {
                dropdown.style.display = 'none';
       
     }
        });
    </script>

</body>
</html>