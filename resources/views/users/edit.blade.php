@extends('layouts.app')

@section('title', 'Edit User')

@section('content')


<style>
    /* ==========================================================
       1. GLOBAL VARIABLES & OVERRIDE SEMUA TEMA HIJAU
    ========================================================== */
    :root {
        --bg-body: #ebf3fe !important;
        --card-bg: #ffffff !important;
        --input-bg: #ffffff !important;
        --border-color: #cbd5e1 !important;
        --text-main: #0f172a !important;
        --text-slate: #64748b !important;
        --blue-primary: #0d6efd !important;
        --blue-hover: #0b5ed7 !important;
    }

    body {
        background-color: #ebf3fe !important;
        font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
        color: #0f172a !important;
    }

    /* ==========================================================
       2. TIMPA SEMUA CLASS WARNA HIJAU/EMERALD/TEAL BAWAAN
    ========================================================== */
    /* Timpa warna teks hijau */
    .text-success, 
    .text-emerald-500, 
    .text-emerald-600, 
    .text-teal-500, 
    .text-teal-600,
    .text-green-500,
    .text-green-600 {
        color: #0d6efd !important;
    }

    /* Timpa warna background hijau */
    .bg-success, 
    .bg-emerald-500, 
    .bg-emerald-600, 
    .bg-teal-500, 
    .bg-teal-600,
    .bg-green-500,
    .bg-green-600 {
        background-color: #0d6efd !important;
    }

    /* Timpa badge / box soft hijau */
    .bg-success-soft,
    .bg-emerald-50,
    .bg-emerald-100,
    .bg-teal-50,
    .bg-teal-100,
    .bg-green-50,
    .badge-soft-emerald,
    .badge-soft-success {
        background-color: #e0f2fe !important;
        color: #0284c7 !important;
        border-color: #bae6fd !important;
    }

    /* ==========================================================
       3. HEADER BANNER & FORM CARD
    ========================================================== */
    .banner-green-gradient,
    .banner-dark-gradient,
    .receipt-header-banner {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
        color: #ffffff !important;
        border-radius: 16px !important;
        border: none !important;
        box-shadow: 0 10px 25px rgba(13, 110, 253, 0.15) !important;
        padding: 1.75rem 2.25rem !important;
    }

    .banner-green-gradient *,
    .banner-dark-gradient * {
        color: #ffffff !important;
    }

    .custom-card,
    .stat-card,
    .pos-card-white {
        background-color: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03) !important;
    }

    /* ==========================================================
       4. FORM INPUT & BUTTONS
    ========================================================== */
    .custom-card label {
        color: #0f172a !important;
        font-weight: 700 !important;
        margin-bottom: 0.5rem;
    }

    .custom-card .form-control,
    .custom-card .form-select {
        background-color: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #0f172a !important;
        font-weight: 600 !important;
        border-radius: 12px !important;
        padding: 0.75rem 1rem !important;
    }

    .custom-card .form-control:focus,
    .custom-card .form-select:focus {
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15) !important;
    }

    .btn-cyan-accent,
    .btn-cyan,
    .btn-success {
        background: #0d6efd !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        border: none !important;
        border-radius: 10px !important;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2) !important;
    }

    .btn-cyan-accent:hover,
    .btn-cyan:hover,
    .btn-success:hover {
        background: #0b5ed7 !important;
        color: #ffffff !important;
    }
</style>

<div class="container py-4">

    {{-- HEADER BANNER --}}
    <div class="banner-green-gradient p-4 p-md-5 rounded-4 mb-4 shadow-sm position-relative">
        <div class="position-relative" style="z-index: 1;">
            <h2 class="fw-bold mb-1 text-white d-flex align-items-center gap-2">
                <i class="bi bi-person-gear fs-2" style="color: var(--cyan-accent);"></i> Edit Data User
            </h2>
            <p class="small mb-0" style="color: var(--text-slate);">
                Perbarui informasi pengguna, email, hak akses role, atau ganti password.
            </p>
        </div>

        <div class="position-absolute end-0 bottom-0 opacity-25 pe-4 pb-2 d-none d-md-block">
            <i class="bi bi-person-gear" style="font-size: 5rem; color: var(--cyan-accent);"></i>
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 custom-card">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @include('users._form')
            </form>
        </div>
    </div>

</div>

@endsection
