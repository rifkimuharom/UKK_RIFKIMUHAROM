<style>
    /* ==========================================================
       1. CORE SIDEBAR BASE STYLE
    ========================================================== */
    #sidebarMenu {
        width: var(--sidebar-width, 260px);
        height: 100vh;
        background: linear-gradient(180deg, var(--primary-color, #0d6efd) 0%, var(--secondary-color, #0b5ed7) 100%);
        color: #ffffff;
        box-shadow: 4px 0 24px rgba(13, 110, 253, 0.18);
        border-right: 1px solid rgba(255, 255, 255, 0.12);
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    #sidebarMenu::-webkit-scrollbar {
        display: none;
    }

    /* ==========================================================
       2. VARIANT SIDEBAR (Minimal / Collapse)
    ========================================================== */
    #sidebarMenu.sidebar-minimal {
        width: 80px !important;
    }

    #sidebarMenu.sidebar-minimal .hide-on-minimal {
        display: none !important;
    }

    #sidebarMenu.sidebar-minimal .sidebar-header {
        justify-content: center;
        padding: 1.25rem 0.5rem;
    }

    #sidebarMenu.sidebar-minimal .nav-link-custom {
        justify-content: center;
        padding: 0.75rem;
    }

    #sidebarMenu.sidebar-minimal .user-profile-card {
        justify-content: center;
        padding: 0.5rem;
    }

    /* ==========================================================
       3. BRANDING & HEADER
    ========================================================== */
    #sidebarMenu .sidebar-header {
        padding: 1.25rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        flex-shrink: 0;
    }

    #sidebarMenu .navbar-brand-logo {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        flex-shrink: 0;
    }

    #sidebarMenu .brand-title {
        font-size: 1.15rem;
        font-weight: 800;
        letter-spacing: 0.3px;
        color: #ffffff;
    }

    /* ==========================================================
       4. NAVIGATION MENU LINKS
    ========================================================== */
    #sidebarMenu .sidebar-menu {
        padding: 1rem 0.75rem;
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
        flex-grow: 1;
        overflow-y: auto;
    }

    #sidebarMenu .sidebar-menu-header {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255, 255, 255, 0.7) !important;
        padding: 1rem 0.85rem 0.25rem;
    }

    #sidebarMenu .nav-link-custom {
        color: rgba(255, 255, 255, 0.85);
        padding: 0.7rem 0.85rem;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 0.85rem;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    #sidebarMenu .nav-link-custom:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.15);
    }

    #sidebarMenu .nav-link-custom.active {
        background-color: #ffffff !important;
        color: var(--primary-color, #0b5ed7) !important;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* ==========================================================
       5. USER PROFILE & FOOTER
    ========================================================== */
    #sidebarMenu .sidebar-footer {
        padding: 0.85rem;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        background: rgba(0, 0, 0, 0.08);
        flex-shrink: 0;
    }

    #sidebarMenu .user-profile-card {
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(8px);
        border-radius: 10px;
        padding: 0.5rem 0.75rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
    }

    #sidebarMenu .btn-logout-custom {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        background: rgba(255, 255, 255, 0.15);
        border: none;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    #sidebarMenu .btn-logout-custom:hover {
        background: #dc3545 !important;
        color: #ffffff !important;
    }

    /* ==========================================================
       6. MOBILE RESPONSIVE
    ========================================================== */
    .mobile-navbar-header {
        display: none;
        background: var(--primary-color, #0d6efd);
        padding: 0.75rem 1.25rem;
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

        #sidebarMenu {
            transform: translateX(-100%);
        }

        #sidebarMenu.show {
            transform: translateX(0);
        }
    }
</style>

{{-- HEADER MOBILE --}}
<div class="mobile-navbar-header">
    <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ route('dashboard') }}">
        <span class="brand-title text-white fs-5 fw-bold">{{ $setting->nama_toko ?? 'POS' }}</span>
    </a>
    <button class="btn text-white p-1 border-0" type="button" id="mobileSidebarToggleBtn">
        <i class="bi bi-list fs-2"></i>
    </button>
</div>

{{-- SIDEBAR UTAMA --}}
<aside class="sidebar-custom" id="sidebarMenu">

    {{-- HEADER DESKTOP --}}
    <div class="sidebar-header">
        <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ route('dashboard') }}">
            <div class="navbar-brand-logo">
                @php
                    $logoPath = null;
                    $namaToko = $setting->nama_toko ?? 'KUDE POS';
                    if (isset($setting) && !empty($setting->logo)) {
                        $clean = str_replace(['public/', 'storage/'], '', $setting->logo);
                        if (\Storage::disk('public')->exists($clean)) {
                            $logoPath = asset('storage/' . $clean);
                        }
                    }
                @endphp

                @if($logoPath)
                    <img src="{{ $logoPath }}" alt="Logo" class="w-100 h-100 object-fit-contain p-1">
                @else
                    <img src="{{ asset('images/R.png') }}" alt="Logo" class="w-100 h-100 object-fit-cover"
                        onerror="this.src='https://ui-avatars.com/api/?name=KUDE&background=0d6efd&color=fff';">
                @endif
            </div>
            <div class="hide-on-minimal">
                <span class="brand-title fw-bold ms-1 text-truncate d-block" style="max-width: 130px;">
                    {{ $namaToko }}
                </span>
            </div>
        </a>

        {{-- TOGGLE MINIMAL --}}
        <button type="button" id="sidebarToggleBtn"
            class="btn btn-sm text-white p-1 border-0 rounded-2 shadow-none ms-auto hide-on-minimal">
            <i class="bi bi-indent fs-5" id="collapseIcon"></i>
            <i class="bi bi-outdent fs-5 d-none" id="expandIcon"></i>
        </button>
    </div>

    {{-- MENU SIDEBAR --}}
    <ul class="sidebar-menu list-unstyled mb-0">
        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}"
                data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                <i class="bi bi-grid-1x2-fill fs-5"></i>
                <span class="hide-on-minimal">Dashboard</span>
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
                    href="{{ route('admin.users') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Users">
                    <i class="bi bi-people-fill fs-5"></i>
                    <span class="hide-on-minimal">Users</span>
                </a>
            </li>
        @endif

        {{-- MENU KATEGORI (Tepat di atas Produk) --}}
        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('kategori*') ? 'active' : '' }}"
                href="{{ Route::has('kategori.index') ? route('kategori.index') : '#' }}" data-bs-toggle="tooltip"
                data-bs-placement="right" title="Kategori">
                <i class="bi bi-tags-fill fs-5"></i>
                <span class="hide-on-minimal">Kategori</span>
            </a>
        </li>

        {{-- MENU PRODUK --}}
        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('produk*') ? 'active' : '' }}" href="{{ route('produk.index') }}"
                data-bs-toggle="tooltip" data-bs-placement="right" title="Produk">
                <i class="bi bi-box-seam-fill fs-5"></i>
                <span class="hide-on-minimal">Produk</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('penjualan*') ? 'active' : '' }}"
                href="{{ route('penjualan.index') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Penjualan">
                <i class="bi bi-cart-check-fill fs-5"></i>
                <span class="hide-on-minimal">Penjualan</span>
            </a>
        </li>

        <li class="sidebar-menu-header hide-on-minimal">
            <span>AKUN</span>
        </li>

        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('profile*') ? 'active' : '' }}" href="{{ route('profile.index') }}"
                data-bs-toggle="tooltip" data-bs-placement="right" title="Profil">
                <i class="bi bi-person-fill fs-5"></i>
                <span class="hide-on-minimal">Profil</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('setting*') ? 'active' : '' }}"
                href="{{ Route::has('setting.index') ? route('setting.index') : '#' }}" data-bs-toggle="tooltip"
                data-bs-placement="right" title="Setting">
                <i class="bi bi-gear-fill fs-5"></i>
                <span class="hide-on-minimal">Setting</span>
            </a>
        </li>
    </ul>

    {{-- USER PROFILE & FOOTER --}}
    @auth
        @php
            $authUser = Auth::user();
            $rawUserPhoto = $authUser->avatar ?? $authUser->photo ?? $authUser->foto ?? null;
            $userPhotoUrl = $rawUserPhoto ? asset('storage/' . str_replace(['public/', 'storage/'], '', $rawUserPhoto)) : null;
        @endphp

        <div class="sidebar-footer">
            <div class="user-profile-card">
                <button type="button"
                    class="btn p-0 border-0 bg-transparent text-start d-flex align-items-center gap-2 overflow-hidden flex-grow-1"
                    data-bs-toggle="modal" data-bs-target="#userProfileSidebarModal">
                    <div class="rounded-circle overflow-hidden d-flex align-items-center justify-content-center border border-2 border-white flex-shrink-0"
                        style="width: 34px; height: 34px; background-color: rgba(255, 255, 255, 0.2);">
                        @if($userPhotoUrl)
                            <img src="{{ $userPhotoUrl }}" alt="{{ $authUser->name }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <span class="fw-bold text-white small">{{ strtoupper(substr($authUser->name, 0, 1)) }}</span>
                        @endif
                    </div>

                    <div class="text-truncate hide-on-minimal">
                        <div class="fw-bold text-truncate text-white" style="font-size: 0.825rem;">{{ $authUser->name }}
                        </div>
                        <small class="text-uppercase d-block fw-semibold opacity-75 text-white" style="font-size: 0.65rem;">
                            {{ optional($authUser->role)->name ?? (is_string($authUser->role) ? $authUser->role : 'Staff') }}
                        </small>
                    </div>
                </button>

                <form action="{{ route('logout') }}" method="POST" class="m-0 hide-on-minimal">
                    @csrf
                    <button type="submit" class="btn btn-logout-custom" title="Logout">
                        <i class="bi bi-power fs-6"></i>
                    </button>
                </form>
            </div>
        </div>
    @endauth

</aside>

{{-- MODAL USER PROFILE SIDEBAR --}}
@auth
    <div class="modal fade" id="userProfileSidebarModal" tabindex="-1" aria-labelledby="userProfileSidebarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden text-center p-3"
                style="background-color: #ffffff;">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 pt-0">
                    <div class="rounded-circle overflow-hidden mx-auto mb-3 border border-3 border-primary shadow-sm d-flex align-items-center justify-content-center"
                        style="width: 80px; height: 80px; background: #eff6ff;">
                        @if($userPhotoUrl)
                            <img src="{{ $userPhotoUrl }}" alt="{{ $authUser->name }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <span class="fw-bold text-primary fs-2">{{ strtoupper(substr($authUser->name, 0, 1)) }}</span>
                        @endif
                    </div>

                    <h5 class="fw-bold mb-0 text-dark">{{ $authUser->name }}</h5>
                    <p class="small text-muted mb-2">{{ $namaToko }}</p>
                    <p class="small text-secondary mb-3">{{ $authUser->email }}</p>

                    <span
                        class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-1 fw-semibold text-uppercase small">
                        <i class="bi bi-shield-check me-1"></i>
                        {{ optional($authUser->role)->name ?? (is_string($authUser->role) ? $authUser->role : 'Staff') }}
                    </span>
                </div>
                <div class="px-3 pb-2">
                    <form action="{{ route('logout') }}" method="POST" class="w-100">
                        @csrf
                        <button type="submit"
                            class="btn btn-danger rounded-pill w-100 fw-semibold d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout / Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endauth

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const mobileToggleBtn = document.getElementById('mobileSidebarToggleBtn');
            const sidebar = document.getElementById('sidebarMenu');
            const collapseIcon = document.getElementById('collapseIcon');
            const expandIcon = document.getElementById('expandIcon');

            function updateIcons(isMinimal) {
                if (collapseIcon && expandIcon) {
                    if (isMinimal) {
                        collapseIcon.classList.add('d-none');
                        expandIcon.classList.remove('d-none');
                    } else {
                        collapseIcon.classList.remove('d-none');
                        expandIcon.classList.add('d-none');
                    }
                }
            }

            // Restore status tersimpan
            const isSavedMinimal = localStorage.getItem('sidebar_minimal') === 'true';
            if (isSavedMinimal && sidebar) {
                sidebar.classList.add('sidebar-minimal');
                document.body.classList.add('has-minimal-sidebar');
                updateIcons(true);
            }

            // Event Toggle Desktop
            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    sidebar.classList.toggle('sidebar-minimal');
                    document.body.classList.toggle('has-minimal-sidebar');

                    const isMinimal = sidebar.classList.contains('sidebar-minimal');
                    localStorage.setItem('sidebar_minimal', isMinimal);
                    updateIcons(isMinimal);
                });
            }

            // Event Toggle Mobile
            if (mobileToggleBtn && sidebar) {
                mobileToggleBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    sidebar.classList.toggle('show');
                });
            }

            // Inisialisasi Tooltip Bootstrap (Ikon Hover)
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(tooltipTriggerEl => {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endpush