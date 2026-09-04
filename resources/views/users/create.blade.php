@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

<style>
    /* ==========================================================
       1. COLOR PALETTE & CORE THEME (KUDE POS ROYAL BLUE)
    ========================================================== */
    :root {
        --bg-body: #ebf3fe;              /* Latar belakang biru soft terang */
        --card-bg: #ffffff;              /* Background kartu putih */
        --input-bg: #ffffff;              /* Form input putih */
        --border-color: #cbd5e1;          /* Border halus */
        --blue-primary: #0d6efd;         /* Warna Royal Blue utama */
        --blue-hover: #0b5ed7;           /* Warna hover tombol */
        --text-main: #0f172a;             /* Teks utama gelap pekat */
        --text-slate: #64748b;            /* Teks label / muted */
    }

    body {
        background-color: var(--bg-body) !important;
        font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
        color: var(--text-main) !important;
    }

    /* ==========================================================
       2. HEADER BANNER (ROYAL BLUE GRADIENT)
    ========================================================== */
    .banner-green-gradient {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
        color: #ffffff !important;
        border-radius: 16px !important;
        box-shadow: 0 10px 25px rgba(13, 110, 253, 0.15) !important;
        border: none !important;
        position: relative;
        overflow: hidden;
        padding: 1.75rem 2.25rem !important;
    }

    .banner-green-gradient * {
        color: #ffffff !important;
    }

    /* ==========================================================
       3. FORM CONTAINER CARD (PUTIH BERSIH)
    ========================================================== */
    .custom-card {
        background-color: var(--card-bg) !important;
        border: 1px solid var(--border-color) !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03) !important;
    }
</style>

<div class="container py-4">

    {{-- HEADER BANNER --}}
    <div class="banner-green-gradient p-4 p-md-5 rounded-4 mb-4 shadow-sm position-relative">
        <div class="position-relative" style="z-index: 1;">
            <h2 class="fw-bold mb-1 text-white d-flex align-items-center gap-2">
                <i class="bi bi-person-plus-fill fs-2" style="color: var(--cyan-accent);"></i> Tambah User Baru
            </h2>

            <p class="small mb-0" style="color: var(--text-slate);">
                Isi data akun baru untuk memberikan hak akses ke dalam sistem POS.
            </p>
        </div>

        <div class="position-absolute end-0 bottom-0 opacity-25 pe-4 pb-2 d-none d-md-block">
            <i class="bi bi-person-badge" style="font-size: 5rem; color: var(--cyan-accent);"></i>
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 custom-card">

        <div class="card-body p-4 p-md-5">

            <form action="{{ route('admin.users.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @include('users._form')

            </form>

        </div>

    </div>

</div>

@endsection
