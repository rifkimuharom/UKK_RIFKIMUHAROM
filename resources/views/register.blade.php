@extends('layouts.guest')

@section('title', 'Sign Up - POS System')

@section('content')

    {{-- Bootstrap Icons CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ==========================================
            RESET & BACKGROUND ADVANCED
        ========================================== */
        body {
            margin: 0 !important;
            padding: 0 !important;
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #080d1a;
            background-image:
                radial-gradient(at 0% 0%, rgba(13, 110, 253, 0.25) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(11, 94, 215, 0.2) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(13, 110, 253, 0.1) 0px, transparent 80%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 35px 35px;
            pointer-events: none;
            z-index: 1;
        }

        .glow-sphere-1 {
            position: absolute;
            width: 320px;
            height: 320px;
            background: rgba(13, 110, 253, 0.3);
            filter: blur(100px);
            border-radius: 50%;
            top: 10%;
            left: 10%;
            z-index: 2;
        }

        .glow-sphere-2 {
            position: absolute;
            width: 350px;
            height: 350px;
            background: rgba(0, 210, 255, 0.2);
            filter: blur(100px);
            border-radius: 50%;
            bottom: 10%;
            right: 10%;
            z-index: 2;
        }

        /* ==========================================
            CONTAINER & CARD LAYOUT
        ========================================== */
        .register-wrapper {
            width: 100%;
            max-width: 980px;
            margin: 2rem;
            padding: 0;
            position: relative;
            z-index: 10;
        }

        .register-card {
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: #ffffff;
            overflow: hidden;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.5), 0 0 30px rgba(13, 110, 253, 0.2);
        }

        /* ==========================================
            PANEL KIRI (VISUAL BACKGROUND GAMBAR)
        ========================================== */
        .register-visual-panel {
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.82) 0%, rgba(10, 28, 51, 0.88) 100%), 
                        url('https://images.unsplash.com/photo-1556740758-90de374c12ad?q=80&w=1200&auto=format&fit=crop') center/cover no-repeat;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem 2rem;
            color: #ffffff;
            text-align: center;
            min-height: 520px;
        }

        .avatar-circle-large {
            width: 110px;
            height: 110px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        .avatar-circle-large i {
            font-size: 3.5rem;
            color: #ffffff;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        }

        .visual-title {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            line-height: 1.2;
            letter-spacing: -0.5px;
        }

        .visual-subtitle {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 2rem;
            max-width: 260px;
        }

        .btn-circle-next {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #ffffff;
            color: #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-circle-next:hover {
            transform: scale(1.1);
            color: #0b5ed7;
            background: #ffffff;
            box-shadow: 0 10px 25px rgba(13, 110, 253, 0.4);
        }

        /* ==========================================
            PANEL KANAN (FORM REGISTRASI)
        ========================================== */
        .register-form-panel {
            padding: 2.5rem 2.5rem;
            background: #ffffff;
        }

        .form-label-custom {
            font-size: 0.78rem;
            font-weight: 700;
            color: #1f3a60;
            margin-bottom: 0.3rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control-custom {
            border-radius: 12px;
            padding: 0.6rem 0.9rem;
            border: 1.5px solid #cce0ff;
            font-size: 0.875rem;
            background-color: #f8fafc;
            color: #0a1c33;
            transition: all 0.2s ease;
        }

        .form-control-custom:focus {
            background-color: #ffffff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 3.5px rgba(13, 110, 253, 0.15);
            outline: none;
        }

        /* UPLOAD FOTO PROFIL */
        .profile-upload-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .avatar-preview {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #f0f5ff;
            border: 2px dashed #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-bottom: 0.4rem;
            transition: all 0.2s ease;
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-preview i {
            font-size: 2rem;
            color: #0d6efd;
        }

        .btn-select-image {
            border: 1.5px solid #0d6efd;
            color: #0d6efd;
            background: transparent;
            font-weight: 700;
            font-size: 0.68rem;
            padding: 0.3rem 0.8rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            letter-spacing: 0.5px;
        }

        .btn-select-image:hover {
            background: #0d6efd;
            color: #ffffff;
        }

        /* GENDER RADIO BUTTONS */
        .gender-radio-group {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            padding-top: 0.4rem;
        }

        .gender-radio-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #1f3a60;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            user-select: none;
        }

        /* BUTTON ACTION */
        .btn-cancel {
            border: 1.5px solid #0d6efd;
            color: #0d6efd;
            background: #ffffff;
            border-radius: 12px;
            padding: 0.7rem;
            font-weight: 700;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            text-decoration: none;
            display: block;
            text-align: center;
            width: 100%;
        }

        .btn-cancel:hover {
            background: #f0f5ff;
            color: #0b5ed7;
        }

        .btn-register-submit {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            border: none;
            color: #ffffff;
            border-radius: 12px;
            padding: 0.7rem;
            font-weight: 700;
            font-size: 0.875rem;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
            transition: all 0.2s ease;
            width: 100%;
            cursor: pointer;
        }

        .btn-register-submit:hover {
            background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(13, 110, 253, 0.4);
            color: #ffffff;
        }

        @media (max-width: 991px) {
            .register-visual-panel { display: none; }
        }
    </style>

    {{-- EFEK GLOW BACKGROUND --}}
    <div class="glow-sphere-1"></div>
    <div class="glow-sphere-2"></div>

    <div class="register-wrapper">
        <div class="card register-card">
            <div class="row g-0">

                {{-- PANEL KIRI: VISUAL GAMBAR POS --}}
                <div class="col-lg-5 register-visual-panel">
                    <div class="avatar-circle-large">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>

                    <h2 class="visual-title">Let's get you set up</h2>
                    <p class="visual-subtitle">Buat akun kasir baru dengan mudah dan cepat dalam hitungan detik.</p>

                    <a href="{{ route('login') }}" class="btn-circle-next" title="Sudah Punya Akun? Login Kembali">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                {{-- PANEL KANAN: FORM REGISTRASI --}}
                <div class="col-lg-7 col-md-12 register-form-panel">

                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">

                            {{-- FOTO PROFIL (KANAN ATAS) --}}
                            <div class="col-12 d-flex justify-content-between align-items-center mb-1">
                                <div>
                                    <h4 class="fw-bold text-dark mb-0">Registrasi Akun</h4>
                                    <p class="text-muted small mb-0">Lengkapi identitas Anda di bawah ini</p>
                                </div>
                                <div class="profile-upload-wrapper">
                                    <div class="avatar-preview" id="avatarPreview">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <input type="file" name="profile_photo" id="profilePhotoInput" class="d-none" accept="image/*" onchange="previewImage(event)">
                                    <button type="button" class="btn-select-image" onclick="document.getElementById('profilePhotoInput').click()">
                                        PILIH FOTO
                                    </button>
                                </div>
                            </div>

                            {{-- FIRST NAME --}}
                            <div class="col-md-6">
                                <label class="form-label-custom">First Name</label>
                                <input type="text" name="first_name" class="form-control form-control-custom @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required placeholder="Nama Depan">
                            </div>

                            {{-- USERNAME --}}
                            <div class="col-md-6">
                                <label class="form-label-custom">Username</label>
                                <input type="text" name="username" class="form-control form-control-custom @error('username') is-invalid @enderror" value="{{ old('username') }}" required placeholder="Username">
                            </div>

                            {{-- MIDDLE NAME --}}
                            <div class="col-md-6">
                                <label class="form-label-custom">Middle Name</label>
                                <input type="text" name="middle_name" class="form-control form-control-custom" value="{{ old('middle_name') }}" placeholder="Nama Tengah (Opsional)">
                            </div>

                            {{-- PASSWORD --}}
                            <div class="col-md-6">
                                <label class="form-label-custom">Password</label>
                                <input type="password" name="password" id="regPassword" class="form-control form-control-custom @error('password') is-invalid @enderror" required placeholder="••••••••">
                            </div>

                            {{-- LAST NAME --}}
                            <div class="col-md-6">
                                <label class="form-label-custom">Last Name</label>
                                <input type="text" name="last_name" class="form-control form-control-custom @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required placeholder="Nama Belakang">
                            </div>

                            {{-- CONFIRM PASSWORD --}}
                            <div class="col-md-6">
                                <label class="form-label-custom">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="regPasswordConfirm" class="form-control form-control-custom" required placeholder="••••••••">
                            </div>

                            {{-- GENDER --}}
                            <div class="col-md-6">
                                <label class="form-label-custom">Gender</label>
                                <div class="gender-radio-group">
                                    <label class="gender-radio-label">
                                        <input type="radio" name="gender" value="male" class="form-check-input" checked>
                                        <i class="bi bi-gender-male text-primary fw-bold"></i> Male
                                    </label>
                                    <label class="gender-radio-label">
                                        <input type="radio" name="gender" value="female" class="form-check-input">
                                        <i class="bi bi-gender-female text-danger fw-bold"></i> Female
                                    </label>
                                </div>
                            </div>

                            {{-- SHOW PASSWORD TOGGLE --}}
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="showPasswordToggle" style="cursor: pointer;">
                                    <label class="form-check-label small text-secondary fw-semibold" for="showPasswordToggle" style="cursor: pointer;">
                                        Tampilkan Password
                                    </label>
                                </div>
                            </div>

                            {{-- DATE PICKER --}}
                            <div class="col-md-6">
                                <label class="form-label-custom">Birth Date</label>
                                <input type="date" name="birth_date" class="form-control form-control-custom" value="{{ old('birth_date', '2005-01-01') }}">
                            </div>

                            {{-- BUTTONS: CANCEL & REGISTER --}}
                            <div class="col-12 mt-4">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <a href="{{ route('login') }}" class="btn-cancel">BATAL</a>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn-register-submit">DAFTAR AKUN</button>
                                    </div>
                                </div>
                            </div>

                            {{-- FOOTER LINK --}}
                            <div class="col-12 text-center mt-3">
                                <span class="small text-muted">Sudah memiliki akun? </span>
                                <a href="{{ route('login') }}" class="small text-primary text-decoration-none fw-bold">Login Sekarang</a>
                            </div>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    {{-- SCRIPT INTERAKSI --}}
    <script>
        // Preview Gambar Profile
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('avatarPreview');
                output.innerHTML = `<img src="${reader.result}" alt="Preview Foto">`;
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }

        // Toggle Password Visibility
        document.getElementById('showPasswordToggle').addEventListener('change', function() {
            const pass = document.getElementById('regPassword');
            const passConfirm = document.getElementById('regPasswordConfirm');
            const isChecked = this.checked;

            pass.type = isChecked ? 'text' : 'password';
            passConfirm.type = isChecked ? 'text' : 'password';
        });
    </script>

@endsection