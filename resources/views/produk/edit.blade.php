@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')


<style>
/* ==========================================================
   1. GLOBAL COLOR PALETTE (ROYAL BLUE THEME)
========================================================== */
:root {
    --bg-body: #f0f5ff;             /* Latar belakang utama (Biru Soft Segar) */
    --card-bg: #ffffff;             /* Form Card (Putih Bersih) */
    --border-color: #cce0ff;        /* Border Soft Biru */
    --text-primary: #0a1c33;        /* Teks Isian & Label (Gelap Kontras) */
    --text-secondary: #475569;      /* Teks Keterangan/Sub-label */
    --accent-primary: #0d6efd;      /* Biru Royal Utama */
    --accent-hover: #0b5ed7;        /* Biru Royal Hover */
    --danger: #dc3545;            /* Merah Batal */
}

body {
    background-color: var(--bg-body) !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    color: var(--text-primary);
}

/* ==========================================================
   2. HEADER BANNER (EDIT PRODUK)
========================================================== */
.banner-light {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 60%, #0a58ca 100%) !important;
    color: #ffffff !important;
    border-radius: 16px;
    padding: 2rem 2.25rem;
    box-shadow: 0 10px 30px rgba(13, 110, 253, 0.2);
    border: none !important;
}

.banner-light h1,
.banner-light h2,
.banner-light h3,
.banner-light h4 {
    color: #ffffff !important;
    font-weight: 800;
}

.banner-light p,
.banner-light small,
.banner-light span {
    color: rgba(255, 255, 255, 0.92) !important;
    font-weight: 500;
}

/* ==========================================================
   3. FORM CONTAINER & CARD EDIT
========================================================== */
.custom-card {
    background-color: var(--card-bg) !important;
    border: 1px solid var(--border-color) !important;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(13, 110, 253, 0.06);
    padding: 1.5rem;
}

/* Label Input Form (Dipertegas) */
.form-label,
label {
    color: #0a1c33 !important;
    font-weight: 700 !important;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

/* Text Muted / Sub-keterangan di bawah input */
.text-muted,
small,
.form-text {
    color: #475569 !important;
    font-weight: 600 !important;
}

/* ==========================================================
   4. FORM INPUTS, TEXTAREA, SELECT, & FILE UPLOAD
========================================================== */
.form-control,
.form-select,
.input-group-text {
    background-color: #ffffff !important;
    border: 1px solid var(--border-color) !important;
    color: #0a1c33 !important;
    font-weight: 600 !important;
    border-radius: 10px;
    padding: 0.65rem 1rem;
}

/* Prefix Input Group (misal "Rp" atau icon) */
.input-group-text {
    background-color: rgba(13, 110, 253, 0.08) !important;
    color: var(--accent-primary) !important;
    font-weight: 700 !important;
}

/* State Focus pada Input */
.form-control:focus,
.form-select:focus {
    border-color: var(--accent-primary) !important;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15) !important;
    background-color: #ffffff !important;
}

.form-control::placeholder {
    color: #64748b !important;
    opacity: 1 !important;
}

/* Preview Foto Produk */
.img-preview-wrapper {
    background-color: #f8fafc;
    border: 2px dashed var(--border-color);
    border-radius: 12px;
    padding: 15px;
    text-align: center;
}

/* ==========================================================
   5. BUTTONS (SIMPAN PERUBAHAN & BATAL)
========================================================== */
/* Tombol Submit / Simpan (Biru Royal) */
.btn-primary,
.btn-save-custom {
    background: var(--accent-primary) !important;
    color: #ffffff !important;
    font-weight: 700;
    border: none !important;
    padding: 0.65rem 1.75rem;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    transition: all 0.2s ease;
}

.btn-primary:hover,
.btn-save-custom:hover {
    background: var(--accent-hover) !important;
    color: #ffffff !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(13, 110, 253, 0.4);
}

/* Tombol Batal / Kembali (Soft Red atau Soft Blue) */
.btn-secondary,
.btn-cancel-custom {
    background-color: rgba(220, 53, 69, 0.1) !important;
    color: var(--danger) !important;
    border: 1px solid rgba(220, 53, 69, 0.25) !important;
    font-weight: 700;
    padding: 0.65rem 1.75rem;
    border-radius: 10px;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-secondary:hover,
.btn-cancel-custom:hover {
    background-color: var(--danger) !important;
    color: #ffffff !important;
}
</style>

<div class="container py-4">

    {{-- HEADER BANNER --}}
    <div class="banner-light p-4 rounded-4 mb-4 shadow-sm">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                    <i class="bi bi-pencil-square text-primary fs-2"></i> Edit Data Produk
                </h2>
                <p class="small mb-0 text-secondary" style="color: #475569 !important;">Perbarui informasi, harga, stok, atau foto produk yang dipilih.</p>
            </div>
            <div>
                <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="card custom-card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('produk.update', $produk) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @include('produk._form')

            </form>
        </div>
    </div>

</div>

@endsection