<style>
    /* ==========================================================
       1. CORE SIDEBAR STYLING
    ========================================================== */
    .sidebar-custom {
        width: var(--sidebar-width, 260px);
        height: 100vh;
        /* Default Light Mode */
        background: linear-gradient(180deg, #0d6efd 0%, #0b5ed7 60%, #0a58ca 100%);
        box-shadow: 4px 0 24px rgba(13, 110, 253, 0.18);
        border-right: 1px solid rgba(255, 255, 255, 0.12);
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        overflow-x: hidden;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1030;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), background 0.3s ease;

        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .sidebar-custom::-webkit-scrollbar {
        display: none;
    }

    /* ==========================================================
       2. BRANDING & HEADER
    ========================================================== */
    .sidebar-header {
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    .navbar-brand-logo {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        overflow: hidden;
        flex-shrink: 0;
        transition: transform 0.25s ease;
    }

    .sidebar-header:hover .navbar-brand-logo {
        transform: scale(1.05);
    }

    .brand-title {
        font-size: 1.25rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        color: #ffffff !important;
    }

    /* ==========================================================
       3. NAVIGATION LINKS
    ========================================================== */
    .sidebar-menu {
        padding: 1.25rem 0.85rem;
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
        flex-grow: 1;
    }

    .nav-link-custom {
        color: rgba(255, 255, 255, 0.82) !important;
        padding: 0.75rem 1rem !important;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 0.85rem;
        font-weight: 600;
        font-size: 0.925rem;
        transition: all 0.25s ease;
        text-decoration: none;
    }

    .nav-link-custom i {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.82) !important;
        transition: transform 0.25s ease;
    }

    .nav-link-custom:hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.15);
        transform: translateX(4px);
    }

    .nav-link-custom:hover i {
        color: #ffffff !important;
        transform: scale(1.1);
    }

    /* Active State Light Mode */
    .nav-link-custom.active {
        color: #0d6efd !important;
        background: #ffffff !important;
        font-weight: 700;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
    }

    .nav-link-custom.active i {
        color: #0d6efd !important;
    }

    /* ==========================================================
       4. USER PROFILE & FOOTER
    ========================================================== */
    .sidebar-footer {
        padding: 0.85rem;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        background: rgba(0, 0, 0, 0.08);
    }

    .user-profile-card {
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(8px);
        border-radius: 12px;
        padding: 0.6rem 0.75rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
    }

    .btn-logout-custom {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.15);
        border: none;
        transition: all 0.25s ease;
        flex-shrink: 0;
    }

    .btn-logout-custom:hover {
        background: #ef4444 !important;
        color: #ffffff !important;
        transform: rotate(90deg);
    }

    .mobile-navbar-header {
        display: none;
        background: #0d6efd;
        padding: 0.75rem 1.25rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    @media (max-width: 991.98px) {
        .mobile-navbar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .sidebar-custom {
            transform: translateX(-100%);
        }

        .sidebar-custom.show {
            transform: translateX(0);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }
    }

    /* ==========================================================
       5. UNIVERSAL DARK MODE (MENCAKUP SEMUA JENIS SCRIPT DARK MODE)
    ========================================================== */
    /* Bootstrap 5 Theme / Tailwind / Class Custom Dark */
    [data-bs-theme="dark"] .sidebar-custom,
    [data-theme="dark"] .sidebar-custom,
    .dark .sidebar-custom,
    .dark-mode .sidebar-custom,
    body.dark .sidebar-custom,
    body.dark-mode .sidebar-custom,
    html[data-bs-theme="dark"] .sidebar-custom {
        background: #1e293b !important;
        /* Dark Slate Navy */
        box-shadow: 4px 0 24px rgba(0, 0, 0, 0.5) !important;
        border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
    }

    /* Mobile Header saat Dark Mode */
    [data-bs-theme="dark"] .mobile-navbar-header,
    [data-theme="dark"] .mobile-navbar-header,
    .dark .mobile-navbar-header,
    .dark-mode .mobile-navbar-header {
        background: #1e293b !important;
    }

    /* Menu Aktif saat Dark Mode */
    [data-bs-theme="dark"] .nav-link-custom.active,
    [data-theme="dark"] .nav-link-custom.active,
    .dark .nav-link-custom.active,
    .dark-mode .nav-link-custom.active {
        color: #38bdf8 !important;
        /* Cyan Glow */
        background: rgba(56, 189, 248, 0.15) !important;
        border: 1px solid rgba(56, 189, 248, 0.3) !important;
    }

    [data-bs-theme="dark"] .nav-link-custom.active i,
    [data-theme="dark"] .nav-link-custom.active i,
    .dark .nav-link-custom.active i,
    .dark-mode .nav-link-custom.active i {
        color: #38bdf8 !important;
    }
</style>

{{-- HEADER MOBILE --}}
<div class="mobile-navbar-header">
    <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ route('dashboard') }}">
        <div class="navbar-brand-logo" style="width:34px; height:34px; border-radius: 8px;">
            <img src="{{ asset('images/R.png') }}?v=2" alt="Logo KUDE" class="w-100 h-100 object-fit-cover">
        </div>
        <span class="brand-title" style="font-size: 1.1rem;">POS</span>
    </a>
    <button class="btn text-white p-1 border-0" type="button" id="sidebarToggleBtn">
        <i class="bi bi-list fs-2"></i>
    </button>
</div>

{{-- SIDEBAR UTAMA --}}
<aside class="sidebar-custom" id="sidebarMenu">

    {{-- HEADER SIDEBAR DESKTOP --}}
    <div class="sidebar-header">
        <a class="navbar-brand d-flex align-items-center gap-2.5 text-decoration-none" href="{{ route('dashboard') }}">
            <div class="navbar-brand-logo">
                <img src="{{ asset('images/R.png') }}?v=2" alt="Logo KUDE" class="w-100 h-100 object-fit-cover">
            </div>
            <div>
                <span class="brand-title">POS</span>
            </div>
        </a>
    </div>

    {{-- NAVIGATION MENU --}}
    <ul class="sidebar-menu list-unstyled mb-0">
        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @php
$userRole = '';
if (Auth::check() && Auth::user()->role) {
    $userRole = strtolower(Auth::user()->role->name ?? Auth::user()->role);
}
        @endphp

        @if (Auth::check() && $userRole == 'admin')
            <li class="nav-item">
                <a class="nav-link-custom {{ Request::is('admin/users*') ? 'active' : '' }}"
                    href="{{ route('admin.users') }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Users</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('produk*') ? 'active' : '' }}" href="{{ route('produk.index') }}">
                <i class="bi bi-box-seam-fill"></i>
                <span>Produk</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('penjualan*') ? 'active' : '' }}"
                href="{{ route('penjualan.index') }}">
                <i class="bi bi-cart-check-fill"></i>
                <span>Penjualan</span>
            </a>
        </li>

        {{-- TAMBAHAN MENU SETTING DI SINI --}}
        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('setting*') ? 'active' : '' }}"
                href="{{ Route::has('setting.index') ? route('setting.index') : '#' }}">
                <i class="bi bi-gear-fill"></i>
                <span>Setting</span>
            </a>
        </li>
    </ul>

    {{-- USER PROFILE & FOOTER --}}
    @auth
        <div class="sidebar-footer">
            <div class="user-profile-card">
                <button type="button"
                    class="btn p-0 border-0 bg-transparent text-start d-flex align-items-center gap-2 overflow-hidden flex-grow-1"
                    data-bs-toggle="modal" data-bs-target="#userProfileSidebarModal">

                    <img src="{{ asset('images/image copy.png') }}" alt="Foto Profil"
                        class="rounded-circle object-fit-cover border border-2 border-white"
                        style="width: 36px; height: 36px; flex-shrink: 0;">

                    <div class="text-truncate">
                        <div class="fw-bold text-truncate" style="font-size: 0.85rem; color: #ffffff !important;">
                            {{ Auth::user()->name }}
                        </div>
                        <small class="text-uppercase d-block fw-semibold"
                            style="font-size: 0.68rem; color: rgba(255, 255, 255, 0.75) !important;">
                            {{ optional(Auth::user()->role)->name ?? (Auth::user()->role ?? 'Staff') }}
                        </small>
                    </div>
                </button>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-logout-custom" title="Logout">
                        <i class="bi bi-power fs-6"></i>
                    </button>
                </form>
            </div>
        </div>
    @endauth

</aside>

{{-- JS TOGGLE MOBILE --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const sidebar = document.getElementById('sidebarMenu');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('show');
                });

                document.addEventListener('click', function (event) {
                    const isClickInside = sidebar.contains(event.target) || toggleBtn.contains(event.target);
                    if (!isClickInside && sidebar.classList.contains('show')) {
                        sidebar.classList.remove('show');
                    }
                });
            }
        });
    </script>
@endpush