<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="htmlElement">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sistem Kasir')</title>

    {{-- Script Pencegah Flash Dark Mode --}}
    <script>
        (function () {
            const savedTheme = localStorage.getItem('app_theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
        })();
    </script>

    {{-- Bootstrap 5 CSS & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        /* ==========================================================
           1. VARIABLE & LAYOUT CORE
        ========================================================== */
        :root {
            --sidebar-width: 260px;
            --sidebar-minimal-width: 80px;
            --bg-body: #f1f5f9;
            --card-bg: #ffffff;
            --border-color: #cbd5e1;
            --text-main: #0f172a;
            --text-muted: #475569;

            --primary-color: #0d6efd;
            --secondary-color: #0b5ed7;
            --accent-color: #34d399;

            --table-row-bg: #ffffff;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body) !important;
            color: var(--text-main) !important;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            transition: background-color 0.25s ease, color 0.25s ease;
        }

        .main-wrapper {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
        }

        /* Penyesuaian Layout Desktop */
        @media (min-width: 992px) {
            .main-wrapper {
                margin-left: var(--sidebar-width);
                width: calc(100% - var(--sidebar-width));
            }

            /* Saat Mode Minimal Active (80px) */
            body.has-minimal-sidebar .main-wrapper {
                margin-left: var(--sidebar-minimal-width) !important;
                width: calc(100% - var(--sidebar-minimal-width)) !important;
            }

            body.has-minimal-sidebar #sidebarMenu,
            body.has-minimal-sidebar .sidebar-custom,
            body.has-minimal-sidebar aside {
                width: var(--sidebar-minimal-width) !important;
            }

            body.has-minimal-sidebar aside .nav-link span,
            body.has-minimal-sidebar aside .sidebar-text,
            body.has-minimal-sidebar aside .brand-text {
                display: none !important;
            }

            body.has-minimal-sidebar aside .nav-link {
                text-align: center;
                justify-content: center !important;
                padding: 12px 0 !important;
            }
        }

        /* Responsive Mobile Layout */
        @media (max-width: 991.98px) {
            .main-wrapper {
                margin-left: 0 !important;
                width: 100% !important;
            }
        }

        /* ==========================================================
           2. UTILITY CLASSES DYNAMIC TEMA & SIDEBAR
        ========================================================== */
        .bg-theme-primary {
            background-color: var(--primary-color) !important;
        }

        .bg-theme-gradient {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
        }

        .text-theme-primary {
            color: var(--primary-color) !important;
        }

        .sidebar,
        .sidebar-custom,
        aside {
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: #ffffff !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1030;
        }

        .sidebar-plain {
            background: #ffffff !important;
            color: #0f172a !important;
            border-right: 1px solid var(--border-color) !important;
        }

        .sidebar-plain a {
            color: #475569 !important;
        }

        .sidebar-plain a.active {
            background-color: var(--primary-color) !important;
            color: #ffffff !important;
        }

        /* ==========================================================
           3. TABEL GLOBAL
        ========================================================== */
        .table,
        .custom-table {
            background-color: transparent !important;
            color: #0f172a !important;
        }

        .table th,
        .table thead th,
        .table-head-text,
        .custom-table th,
        .custom-table thead tr th {
            color: #0f172a !important;
            font-weight: 800 !important;
            background-color: #f8fafc !important;
            border-bottom: 2px solid var(--border-color) !important;
        }

        .table tr,
        .table td,
        .table tbody tr,
        .table tbody tr td,
        .custom-table tr,
        .custom-table td,
        .custom-table tbody tr,
        .custom-table tbody tr td {
            background-color: var(--table-row-bg) !important;
            color: #0f172a !important;
            border-bottom: 1px solid var(--border-color) !important;
        }

        .table td .text-muted,
        .table td small,
        .custom-table td .text-muted,
        .custom-table td small {
            color: #475569 !important;
        }

        /* ==========================================================
           4. DARK MODE OVERRIDES
        ========================================================== */
        [data-bs-theme="dark"] {
            --bg-body: #0b0f19 !important;
            --card-bg: #1e293b !important;
            --border-color: #334155 !important;
            --text-main: #f8fafc !important;
            --text-muted: #94a3b8 !important;
            --table-row-bg: #1e293b !important;
        }

        [data-bs-theme="dark"] body {
            background-color: var(--bg-body) !important;
            color: var(--text-main) !important;
        }

        [data-bs-theme="dark"] .sidebar,
        [data-bs-theme="dark"] .sidebar-custom,
        [data-bs-theme="dark"] aside {
            background: #0f172a !important;
            border-right: 1px solid #1e293b !important;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.3) !important;
        }

        [data-bs-theme="dark"] .bg-white,
        [data-bs-theme="dark"] header,
        [data-bs-theme="dark"] nav.navbar,
        [data-bs-theme="dark"] .topbar {
            background-color: #1e293b !important;
            border-bottom: 1px solid #334155 !important;
            color: #f8fafc !important;
        }

        [data-bs-theme="dark"] .card,
        [data-bs-theme="dark"] .custom-card,
        [data-bs-theme="dark"] .stat-card,
        [data-bs-theme="dark"] .modal-content,
        [data-bs-theme="dark"] .dropdown-menu {
            background-color: var(--card-bg) !important;
            color: var(--text-main) !important;
            border-color: var(--border-color) !important;
        }

        [data-bs-theme="dark"] .table,
        [data-bs-theme="dark"] .custom-table,
        [data-bs-theme="dark"] .table tbody,
        [data-bs-theme="dark"] .custom-table tbody {
            background-color: transparent !important;
            color: #f8fafc !important;
        }

        [data-bs-theme="dark"] .table th,
        [data-bs-theme="dark"] .custom-table th,
        [data-bs-theme="dark"] .table-head-text,
        [data-bs-theme="dark"] .table thead tr th {
            background-color: #0f172a !important;
            color: #38bdf8 !important;
            border-bottom: 1px solid #334155 !important;
        }

        [data-bs-theme="dark"] .table tr,
        [data-bs-theme="dark"] .table td,
        [data-bs-theme="dark"] .table tbody tr,
        [data-bs-theme="dark"] .table tbody tr td,
        [data-bs-theme="dark"] .custom-table tr,
        [data-bs-theme="dark"] .custom-table td,
        [data-bs-theme="dark"] .custom-table tbody tr,
        [data-bs-theme="dark"] .custom-table tbody tr td {
            background-color: #1e293b !important;
            color: #f8fafc !important;
            border-bottom: 1px solid #334155 !important;
        }

        [data-bs-theme="dark"] .form-control,
        [data-bs-theme="dark"] .form-select,
        [data-bs-theme="dark"] .bg-search {
            background-color: #0f172a !important;
            color: #ffffff !important;
            border-color: #334155 !important;
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased">

    {{-- Pemanggilan Sidebar --}}
    @include('layouts.sidebar')

    {{-- Area Konten Utama --}}
    <div class="main-wrapper min-vh-100 d-flex flex-column">

        {{-- HEADER UTAMA --}}
        <header class="navbar navbar-expand bg-white border-bottom px-3 py-2 sticky-top shadow-sm">
            <div class="container-fluid p-0 d-flex align-items-center justify-content-between">

                {{-- Tombol Toggle Sidebar Navbar --}}
                <div class="d-flex align-items-center gap-3">
                    <button id="sidebarToggleBtnNavbar" type="button"
                        class="btn btn-light border shadow-sm rounded-3 p-2 d-flex align-items-center justify-content-center"
                        title="Toggle Sidebar">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <span class="fw-bold fs-6 text-uppercase d-none d-sm-inline">
                        @yield('title', 'Sistem Kasir')
                    </span>
                </div>

                {{-- Bagian Kanan Header (Status / Profil) --}}
                <div class="d-flex align-items-center gap-2">
                    @auth
                        <button type="button" class="btn btn-outline-primary rounded-pill px-3 py-1 btn-sm fw-semibold"
                            data-bs-toggle="modal" data-bs-target="#userProfileSidebarModal">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name ?? 'Profil' }}
                        </button>
                    @endauth
                </div>
            </div>
        </header>

        {{-- Notifikasi Error --}}
        @if(session('error'))
            <div class="container-fluid px-4 pt-3">
                <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm mb-0" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        {{-- Main Content --}}
        <main class="p-3 p-md-4 flex-grow-1">
            @yield('content')
        </main>
    </div>

    {{-- Modal Pop-up Profil --}}
    @auth
        <div class="modal fade" id="userProfileSidebarModal" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content border-0 shadow text-center" style="border-radius: 20px;">
                    <div class="modal-header border-0 pb-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 pt-0 pb-4">

                        @php
                            $user = Auth::user();
                            $namaToko = $setting->nama_toko ?? 'KUDE POS';
                            $logoToko = $setting->logo ?? null;
                            $userRole = is_object($user->role) ? ($user->role->name ?? 'Kasir') : ($user->role ?? 'Kasir');
                        @endphp

                        @if($logoToko)
                            <img src="{{ asset('storage/' . $logoToko) }}" alt="Logo Toko"
                                class="mx-auto mb-3 rounded-circle shadow-sm object-fit-cover"
                                style="width: 80px; height: 80px; border: 3px solid var(--primary-color, #0d6efd);">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($namaToko ?? $user->name) }}&background=0d6efd&color=fff"
                                alt="Foto Profil" class="mx-auto mb-3 rounded-circle shadow-sm object-fit-cover"
                                style="width: 80px; height: 80px; border: 3px solid var(--primary-color, #0d6efd);">
                        @endif

                        <h5 class="fw-bold mb-1">{{ $user->name ?? $user->username }}</h5>
                        <p class="text-primary fw-semibold small mb-1">{{ $namaToko }}</p>
                        <p class="text-muted small mb-2">{{ $user->email ?? $setting->email_kontak ?? 'Kasir Aktif' }}</p>

                        <span
                            class="badge bg-primary-subtle text-primary border border-primary-subtle text-uppercase px-3 py-1.5 rounded-pill fw-semibold small">
                            <i class="bi bi-shield-check me-1"></i>
                            {{ $userRole }}
                        </span>

                        <hr class="my-3" style="border-color: #e2e8f0;">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-danger w-100 rounded-pill fw-bold py-2 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                                <i class="bi bi-box-arrow-right"></i> Logout / Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    {{-- Bootstrap & JS Libraries --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const duration = 2 * 1000;
                const animationEnd = Date.now() + duration;
                const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 9999 };

                function randomInRange(min, max) { return Math.random() * (max - min) + min; }

                const interval = setInterval(function () {
                    const timeLeft = animationEnd - Date.now();
                    if (timeLeft <= 0) return clearInterval(interval);
                    const particleCount = 50 * (timeLeft / duration);

                    confetti({ ...defaults, particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } });
                    confetti({ ...defaults, particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } });
                }, 250);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    html: `
                                <p class="text-secondary mb-0 fs-6">{{ session('success') }}</p>
                                @if(session('kembalian'))
                                    <div class="p-3 bg-light rounded-3 mt-3 border">
                                        <small class="text-muted fw-semibold d-block mb-1">UANG KEMBALIAN</small>
                                        <h2 class="text-success fw-bold m-0">Rp {{ number_format(session('kembalian'), 0, ',', '.') }}</h2>
                                    </div>
                                @endif
                            `,
                    showConfirmButton: true,
                    confirmButtonText: 'Selesai',
                    confirmButtonColor: '#0d6efd',
                    timer: 3500,
                    timerProgressBar: true,
                    customClass: { popup: 'rounded-4 shadow-lg border-0' }
                });
            });
        </script>
    @endif

    {{-- SCRIPT MANAGEMENT TEMA & SIDEBAR TOGGLE --}}
    <script>
        function applyTheme(theme) {
            document.documentElement.setAttribute('data-bs-theme', theme === 'dark' ? 'dark' : 'light');
            localStorage.setItem('app_theme', theme);
        }

        function applyColors(primary, secondary, accent) {
            if (primary) {
                document.documentElement.style.setProperty('--primary-color', primary);
                localStorage.setItem('app_primary', primary);
            }
            if (secondary) {
                document.documentElement.style.setProperty('--secondary-color', secondary);
                localStorage.setItem('app_secondary', secondary);
            }
            if (accent) {
                document.documentElement.style.setProperty('--accent-color', accent);
                localStorage.setItem('app_accent', accent);
            }
        }

        (function () {
            const primary = localStorage.getItem('app_primary');
            const secondary = localStorage.getItem('app_secondary');
            const accent = localStorage.getItem('app_accent');
            if (primary || secondary || accent) applyColors(primary, secondary, accent);

            // Restore status sidebar minimal dari LocalStorage
            if (localStorage.getItem('sidebar_minimal') === 'true') {
                document.body.classList.add('has-minimal-sidebar');
            }
        })();

        document.addEventListener('DOMContentLoaded', function () {
            // LOGIKA TOGGLE BUTTON HEADER
            const toggleNavbarBtn = document.getElementById('sidebarToggleBtnNavbar');
            const sidebar = document.getElementById('sidebarMenu') || document.querySelector('.sidebar, .sidebar-custom, aside');

            if (toggleNavbarBtn) {
                toggleNavbarBtn.addEventListener('click', function (e) {
                    e.preventDefault();

                    if (window.innerWidth < 992) {
                        // Tampilan HP
                        if (sidebar) sidebar.classList.toggle('show');
                    } else {
                        // Tampilan Desktop (Kecilkan / Melebarkan Sidebar & Layout Utama)
                        document.body.classList.toggle('has-minimal-sidebar');

                        if (sidebar) {
                            sidebar.classList.toggle('sidebar-minimal');
                        }

                        const isMinimal = document.body.classList.contains('has-minimal-sidebar');
                        localStorage.setItem('sidebar_minimal', isMinimal);
                    }
                });
            }
        });

        function setAppTheme(theme) { applyTheme(theme); }
    </script>

    @stack('scripts')

</body>

</html>