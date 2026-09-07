@extends('layouts.guest')

@section('title', 'Masuk - Sistem POS')

@section('content')

    {{-- Bootstrap Icons CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            margin: 0 !important;
            padding: 0 !important;
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #0b6bc8;
            background-image: linear-gradient(135deg, #026bd6 0%, #0052ad 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 900px;
            margin: 1.5rem;
            position: relative;
            z-index: 10;
        }

        .login-card {
            border-radius: 20px;
            border: none;
            background: #ffffff;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        /* PANEL KIRI (BLUE VISUAL / BLOB) */
        .login-visual-panel {
            background: #0072eb;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3.5rem 3rem;
            color: #ffffff;
            min-height: 480px;
        }

        /* LINGKARAN-LINGKARAN (BLOB DESIGN) */
        .blob-1 {
            position: absolute;
            width: 320px;
            height: 320px;
            background: #005dbd;
            border-radius: 50%;
            top: -60px;
            right: -80px;
        }

        .blob-2 {
            position: absolute;
            width: 220px;
            height: 220px;
            background: #0052a8;
            border-radius: 50%;
            bottom: -50px;
            left: -40px;
        }

        .blob-3 {
            position: absolute;
            width: 180px;
            height: 180px;
            background: #006ce0;
            border-radius: 50%;
            bottom: 60px;
            right: 40px;
        }

        .visual-content {
            position: relative;
            z-index: 5;
        }

        .visual-content h1 {
            font-weight: 800;
            letter-spacing: 1px;
            font-size: 2.2rem;
            margin-bottom: 0.2rem;
        }

        .visual-content h5 {
            font-weight: 700;
            letter-spacing: 0.5px;
            font-size: 1.05rem;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
        }

        .visual-content p {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.6;
            max-width: 320px;
        }

        /* PANEL KANAN (FORM MASUK) */
        .login-form-panel {
            padding: 3.5rem 3rem;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header h2 {
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 0.2rem;
        }

        .form-header p {
            font-size: 0.8rem;
            color: #8c8c8c;
            margin-bottom: 2rem;
        }

        /* INPUT FIELD CUSTOM */
        .input-box {
            position: relative;
            margin-bottom: 1.2rem;
        }

        .input-box .form-control {
            background-color: #f2f3f5;
            border: none;
            border-radius: 10px;
            padding: 0.8rem 1rem 0.8rem 2.8rem;
            font-size: 0.875rem;
            color: #333;
        }

        .input-box .form-control:focus {
            background-color: #e8ecef;
            box-shadow: none;
        }

        .input-box .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #555;
            font-size: 1.1rem;
        }

        .input-box .show-btn {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.75rem;
            font-weight: 700;
            color: #0056b3;
            cursor: pointer;
            text-transform: uppercase;
            user-select: none;
        }

        .btn-signin {
            background: #003e7e;
            color: #ffffff;
            font-weight: 700;
            padding: 0.8rem;
            border-radius: 10px;
            border: none;
            width: 100%;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .btn-signin:hover {
            background: #002d5c;
            color: #ffffff;
        }

        .btn-other {
            background: #ffffff;
            color: #333333;
            font-weight: 600;
            padding: 0.75rem;
            border-radius: 10px;
            border: 1.5px solid #333333;
            width: 100%;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .btn-other:hover {
            background: #f8f9fa;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #8c8c8c;
            font-size: 0.75rem;
            margin: 1.2rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }

        .divider::before {
            margin-right: .5em;
        }

        .divider::after {
            margin-left: .5em;
        }

        /* CHECKBOX & LINKS */
        .form-check-label {
            font-size: 0.78rem;
            color: #555;
        }

        .forgot-link {
            font-size: 0.78rem;
            color: #0056b3;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-text {
            font-size: 0.78rem;
            color: #666;
            text-align: center;
            margin-top: 1.5rem;
        }

        .signup-text a {
            color: #0072eb;
            font-weight: 700;
            text-decoration: none;
        }
    </style>

    <div class="login-wrapper">
        <div class="card login-card">
            <div class="row g-0">

                {{-- PANEL KIRI: VISUAL BLOB BIRU --}}
                <div class="col-lg-6 d-none d-lg-flex login-visual-panel">
                    <div class="blob-1"></div>
                    <div class="blob-2"></div>
                    <div class="blob-3"></div>

                    <div class="visual-content">
                        <h1>SELAMAT DATANG</h1>
                        <h5>KUDE POS SYSTEM</h5>
                        <p>Kelola transaksi penjualan, inventaris barang, dan laporan toko Anda secara efisien, cepat, dan
                            terintegrasi dalam satu sistem.</p>
                    </div>
                </div>

                {{-- PANEL KANAN: FORM MASUK --}}
                <div class="col-lg-6 col-md-12 login-form-panel">
                    <div class="form-header">
                        <h2>Masuk</h2>
                        <p>Masukkan email dan kata sandi Anda untuk melanjutkan</p>
                    </div>

                    {{-- ALERT SUCCESS / ERROR --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3 small mb-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 small mb-3" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('auth') }}" method="POST">
                        @csrf

                        {{-- EMAIL / USERNAME INPUT --}}
                        <div class="input-box">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email"
                                required autofocus>
                        </div>
                        @error('email')
                            <div class="text-danger small mb-2" style="font-size: 0.75rem;">{{ $message }}</div>
                        @enderror

                        {{-- PASSWORD INPUT --}}
                        <div class="input-box mb-2">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" name="password" id="passwordInput"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Kata Sandi"
                                required>
                            <span class="show-btn" id="togglePassword">LIHAT</span>
                        </div>
                        @error('password')
                            <div class="text-danger small mb-2" style="font-size: 0.75rem;">{{ $message }}</div>
                        @enderror

                        {{-- REMEMBER ME & FORGOT PASSWORD --}}
                        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Ingat saya</label>
                            </div>
                            <a href="javascript:void(0)" class="forgot-link" data-bs-toggle="modal"
                                data-bs-target="#forgotPasswordModal">Lupa Kata Sandi?</a>
                        </div>

                        {{-- BUTTON SUBMIT --}}
                        <button type="submit" class="btn btn-signin mb-2">Masuk SEKARANG</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- MODAL LUPA PASSWORD (FORM UPDATE DIRECT KE MYSQL) --}}
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark">
                        <i class="bi bi-key-fill text-primary me-2"></i>Reset Kata Sandi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('password.reset.direct') }}" method="POST">
                    @csrf
                    <div class="modal-body py-3">
                        <p class="text-secondary small mb-3">Masukkan email terdaftar dan buat kata sandi baru Anda.</p>

                        <div class="input-box mb-3">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" name="email" class="form-control" placeholder="Alamat Email Terdaftar"
                                required>
                        </div>

                        <div class="input-box mb-3">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" name="password" class="form-control" placeholder="Kata Sandi Baru"
                                required>
                        </div>

                        <div class="input-box mb-1">
                            <i class="bi bi-check2-circle input-icon"></i>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Konfirmasi Kata Sandi Baru" required>
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light rounded-3 btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-3 px-4 btn-sm fw-bold">Simpan Sandi
                            Baru</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT TOGGLE SHOW/HIDE PASSWORD --}}
    <script>
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');

        toggleBtn.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.textContent = 'SEMBUNYIKAN';
            } else {
                passwordInput.type = 'password';
                this.textContent = 'LIHAT';
            }
        });
    </script>

@endsection