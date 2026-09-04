@extends('layouts.app')

@section('title', 'Profil Saya - KUDE POS')

@section('content')

    <style>
        .profile-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 10px 30px -5px rgba(13, 110, 253, 0.08);
            overflow: hidden;
        }

        .profile-banner {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 50%, #032830 100%);
            padding: 2.5rem 2rem 5rem 2rem;
            color: #ffffff;
        }

        .profile-avatar-wrapper {
            position: relative;
            margin-top: -60px;
            margin-bottom: 1.5rem;
            display: inline-block;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            font-size: 2.5rem;
            font-weight: 800;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid #ffffff;
            box-shadow: 0 10px 25px -5px rgba(13, 110, 253, 0.4);
            object-fit: cover;
        }

        .upload-badge {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #0d6efd;
            color: #ffffff;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ffffff;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            transition: all 0.2s ease;
        }

        .upload-badge:hover {
            background: #0a58ca;
            transform: scale(1.1);
        }

        .stat-chip {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1rem;
        }

        .form-floating > .form-control {
            border-radius: 12px;
            border: 1.5px solid #cbd5e1;
            padding-left: 2.75rem;
        }

        .form-floating > label {
            padding-left: 2.75rem;
            color: #64748b;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            z-index: 5;
            color: #0d6efd;
            font-size: 1.1rem;
        }

        .btn-gradient-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.75rem;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.35);
        }
    </style>

    <div class="container-fluid py-4 px-4">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-9">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 bg-success text-white d-flex align-items-center gap-2 p-3" role="alert">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        <div>
                            <strong>Berhasil!</strong> {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="profile-card">

                    <div class="profile-banner">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div>
                                <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold shadow-sm mb-2 text-uppercase">
                                    <i class="bi bi-shield-check me-1"></i> Akun Terverifikasi
                                </span>
                                <h3 class="fw-black mb-1">Pengaturan Profil</h3>
                                <p class="mb-0 opacity-75 small">Kelola informasi data diri dan foto akun Anda.</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 p-md-5 pt-0">

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="d-flex flex-column flex-sm-row align-items-sm-end justify-content-between gap-3 mb-4">
                                <div class="d-flex align-items-end gap-3">
                                    <div class="profile-avatar-wrapper">
                                        {{-- Disesuaikan memakai $user->photo dan Storage --}}
                                        @if(!empty($user->photo) && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->photo))
                                            <img src="{{ asset('storage/' . $user->photo) }}" id="avatarPreview" class="profile-avatar" alt="Foto Profil">
                                        @else
                                            <div id="avatarInitials" class="profile-avatar">
                                                {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                                            </div>
                                            <img src="" id="avatarPreview" class="profile-avatar d-none" alt="Foto Profil">
                                        @endif

                                        {{-- Input name diganti menjadi photo --}}
                                        <label for="photo" class="upload-badge" title="Ganti Foto Profil">
                                            <i class="bi bi-camera-fill"></i>
                                        </label>
                                        <input type="file" name="photo" id="photo" class="d-none" accept="image/*" onchange="previewImage(event)">
                                    </div>

                                    <div class="mb-2">
                                        <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 fw-semibold">
                                            <i class="bi bi-person-fill me-1"></i> 
                                            {{ is_object($user->role) ? ($user->role->nama ?? 'Kasir') : ucfirst($user->role ?? 'Kasir') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-12 col-md-4">
                                    <div class="stat-chip">
                                        <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.7rem;">Status Akun</span>
                                        <span class="fw-bold text-success d-flex align-items-center gap-1.5">
                                            <i class="bi bi-check-circle-fill"></i> Aktif & Siap Digunakan
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="stat-chip">
                                        <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.7rem;">Sistem Kasir</span>
                                        <span class="fw-bold text-dark d-flex align-items-center gap-1.5">
                                            <i class="bi bi-laptop text-primary"></i> KUDE POS Kasir
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="stat-chip">
                                        <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.7rem;">Terdaftar Sejak</span>
                                        <span class="fw-bold text-dark d-flex align-items-center gap-1.5">
                                            <i class="bi bi-calendar-event text-warning"></i> 
                                            {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->translatedFormat('d M Y') : '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 text-slate-200">

                            <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                                <i class="bi bi-sliders text-primary"></i> Ubah Detail Informasi
                            </h5>

                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="position-relative form-floating mb-1">
                                        <i class="bi bi-person input-icon"></i>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                        <label for="name">Nama Lengkap</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="position-relative form-floating mb-1">
                                        <i class="bi bi-envelope input-icon"></i>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        <label for="email">Alamat Email</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end align-items-center gap-3 mt-4 pt-2">
                                <button type="submit" class="btn btn-gradient-primary d-inline-flex align-items-center gap-2">
                                    <i class="bi bi-floppy-fill"></i>
                                    <span>Simpan Perubahan</span>
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('avatarPreview');
                const initials = document.getElementById('avatarInitials');

                output.src = reader.result;
                output.classList.remove('d-none');
                if (initials) initials.classList.add('d-none');
            }
            if(event.target.files && event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>

@endsection