@extends('layouts.app')

@section('title', 'Detail Produk - ' . $produk->nama)

@section('content')


<style>
/* ==========================================================
   1. GLOBAL VARIABLES & TEMA DETAIL PRODUK (ROYAL BLUE THEME)
========================================================== */
:root {
    --bg-body: #f0f5ff;             /* Latar belakang utama (Biru Soft Segar) */
    --dark-card-bg: #ffffff;        /* Card Utama (Putih Bersih) */
    --dark-input-bg: #f8fafc;       /* Wrapper Foto/QR & Price Box (Light Soft) */
    --dark-border: #cce0ff;         /* Border Soft Biru */
    --text-label: #475569;          /* Label Keterangan (Abu-abu Tua) */
    --text-main: #0a1c33;           /* Teks Utama/Nilai (Gelap Kontras) */
    --accent-blue: #0d6efd;         /* Biru Royal Utama */
    --accent-hover: #0b5ed7;        /* Biru Royal Hover */
    --accent-green: #10b981;        /* Hijau untuk Harga Jual/Profit */
}

body {
    background-color: var(--bg-body) !important;
    color: var(--text-main);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* ==========================================================
   2. BANNER HEADER DETAIL PRODUK
========================================================== */
.banner-navy-gradient {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 60%, #0a58ca 100%) !important;
    color: #ffffff !important;
    border-radius: 16px;
    padding: 2rem 2.25rem;
    box-shadow: 0 10px 30px rgba(13, 110, 253, 0.2);
    border: none !important;
}

.banner-navy-gradient h1,
.banner-navy-gradient h2,
.banner-navy-gradient h3,
.banner-navy-gradient h4 {
    color: #ffffff !important;
    font-weight: 800;
}

.banner-navy-gradient p,
.banner-navy-gradient small,
.banner-navy-gradient span {
    color: rgba(255, 255, 255, 0.92) !important;
    font-weight: 500;
}

/* ==========================================================
   3. CARD UTAMA & WRAPPER GAMBAR / QR
========================================================== */
.product-card {
    background-color: var(--dark-card-bg) !important;
    border-radius: 16px;
    border: 1px solid var(--dark-border) !important;
    box-shadow: 0 8px 25px rgba(13, 110, 253, 0.06);
    overflow: hidden;
}

/* Wrapper Foto Produk */
.product-img-wrapper {
    background-color: var(--dark-input-bg);
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 250px;
    border: 1px solid var(--dark-border);
}

.product-img {
    max-height: 220px;
    width: auto;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.product-img:hover {
    transform: scale(1.05);
}

/* QR Code Box */
.qr-card-wrapper {
    background-color: var(--dark-input-bg);
    border-radius: 12px;
    padding: 16px;
    border: 2px dashed var(--dark-border);
    text-align: center;
}

/* ==========================================================
   4. LABELS, VALUES, & PRICE BOXES (FIX HARGA BELI & HARGA JUAL)
========================================================== */
.info-label {
    font-size: 0.85rem;
    font-weight: 700 !important;
    color: #475569 !important;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value {
    font-size: 1.1rem;
    font-weight: 700 !important;
    color: #0a1c33 !important;
}

/* --- PRICE BOX HARGA BELI (FIX KETERBACAAN) --- */
.price-box {
    background-color: #f1f5f9 !important;
    border-radius: 12px;
    padding: 16px;
    border: 1px solid #cbd5e1 !important;
}

.price-box .info-label,
.price-box small,
.price-box label {
    color: #334155 !important;
    font-weight: 700 !important;
}

.price-box .info-value,
.price-box h2,
.price-box h3,
.price-box h4,
.price-box span,
.price-box p {
    color: #0f172a !important; /* Hitam pekat tajam */
    font-weight: 800 !important;
}

/* --- PRICE BOX HARGA JUAL --- */
.price-box-sell {
    background-color: rgba(16, 185, 129, 0.12) !important;
    border: 1px solid rgba(16, 185, 129, 0.35) !important;
}

.price-box-sell .info-label,
.price-box-sell small,
.price-box-sell label {
    color: #047857 !important;
    font-weight: 700 !important;
}

.price-box-sell .info-value,
.price-box-sell h2,
.price-box-sell h3,
.price-box-sell h4,
.price-box-sell span,
.price-box-sell p {
    color: #059669 !important;
    font-weight: 800 !important;
}

/* ==========================================================
   5. BUTTONS (TOMBOL AKSI & KEMBALI)
========================================================== */
.btn-gradient-green,
.btn-primary-custom {
    background: var(--accent-blue) !important;
    border: none !important;
    color: #ffffff !important;
    padding: 0.6rem 1.5rem;
    border-radius: 50px;
    font-weight: 700;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

.btn-gradient-green:hover,
.btn-primary-custom:hover {
    background: var(--accent-hover) !important;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(13, 110, 253, 0.4);
    color: #ffffff !important;
}

a.btn-soft-secondary {
    background-color: rgba(13, 110, 253, 0.1) !important;
    color: var(--accent-blue) !important;
    border: 1px solid rgba(13, 110, 253, 0.25) !important;
    padding: 0.6rem 1.5rem;
    border-radius: 50px;
    font-weight: 700;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
}

a.btn-soft-secondary:hover {
    background-color: var(--accent-blue) !important;
    color: #ffffff !important;
}

/* ==========================================================
   6. MODE PRINT / CETAK LABEL BARCODE
========================================================== */
@media print {
    .no-print, nav, .navbar, .sidebar-custom {
        display: none !important;
    }
    body {
        background: #ffffff !important;
        color: #000000 !important;
    }
    .product-card {
        background: #ffffff !important;
        border: none !important;
        box-shadow: none !important;
    }
    .banner-navy-gradient {
        background: none !important;
        color: #000000 !important;
        padding: 0 !important;
        border-bottom: 2px solid #000;
        border-radius: 0 !important;
    }
    .banner-navy-gradient * {
        color: #000000 !important;
    }
    .info-label, .info-value, h2, h3, h4 {
        color: #000000 !important;
    }
    .price-box, .price-box-sell {
        background: #ffffff !important;
        border: 1px solid #000000 !important;
    }
}
</style>

<div class="container py-4">

    {{-- HEADER BANNER --}}
    <div class="banner-navy-gradient p-4 rounded-4 mb-4 shadow-sm">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="fw-bold mb-1 text-white d-flex align-items-center gap-2">
                    <i class="bi bi-box-seam-fill fs-2 text-info"></i> Detail Produk
                </h2>
                <p class="text-white opacity-75 small mb-0">Informasi lengkap spesifikasi, harga, stok, dan Barcode/QR produk.</p>
            </div>
            <div class="d-flex align-items-center gap-2 no-print">
                <button onclick="window.print()" class="btn btn-light rounded-pill px-3 fw-semibold text-dark shadow-sm d-flex align-items-center gap-1">
                    <i class="bi bi-printer-fill"></i> Cetak Label
                </button>
                <a href="{{ route('produk.index') }}" class="btn btn-outline-light rounded-pill px-4 fw-semibold shadow-sm d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    {{-- MAIN CARD --}}
    <div class="card border-0 shadow-sm product-card mb-4">
        <div class="card-body p-4 p-md-5">
            <div class="row g-4 align-items-start">

                {{-- FOTO PRODUK & QR CODE --}}
                <div class="col-md-5 col-lg-4">
                    {{-- FOTO PRODUK --}}
                    <div class="product-img-wrapper mb-3">
                        @if(!empty($produk->foto))
                            <img src="{{ asset('storage/' . $produk->foto) }}"
                                 alt="{{ $produk->nama }}"
                                 class="img-fluid product-img">
                        @else
                            <div class="text-center text-muted">
                                <i class="bi bi-image fs-1 d-block mb-2 style="color: #64748b;"></i>
                                <span style="color: #94a3b8;">Foto Tidak Tersedia</span>
                            </div>
                        @endif
                    </div>

                    {{-- QR CODE PRODUK --}}
                    <div class="qr-card-wrapper shadow-sm">
                        <div class="mb-2 p-2 bg-white d-inline-block rounded-3">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ urlencode(route('produk.show', $produk->id)) }}"
                                 alt="QR Code {{ $produk->nama }}"
                                 class="img-fluid"
                                 width="120" height="120">
                        </div>
                        <span class="d-block fw-bold text-white small">QR Code Produk</span>
                        <span class="d-block style-code small" style="color: #94a3b8;">ID: PRD-{{ sprintf('%04d', $produk->id) }}</span>
                    </div>
                </div>

                {{-- INFORMASI PRODUK --}}
                <div class="col-md-7 col-lg-8">
                    <div class="ps-md-3">

                        {{-- STATUS STOK BADGE --}}
                        <div class="mb-2">
                            @if(($produk->stok ?? 0) > 10)
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-semibold">
                                    <i class="bi bi-check-circle-fill me-1"></i> Stok Tersedia ({{ $produk->stok }})
                                </span>
                            @elseif(($produk->stok ?? 0) > 0)
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill fw-semibold">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Stok Menipis ({{ $produk->stok }})
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-semibold">
                                    <i class="bi bi-x-circle-fill me-1"></i> Stok Habis
                                </span>
                            @endif
                        </div>

                        {{-- NAMA PRODUK --}}
                        <h2 class="fw-bold text-white mb-4">{{ $produk->nama }}</h2>

                        {{-- HARGA BELI & HARGA JUAL --}}
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <div class="price-box">
                                    <span class="info-label d-block mb-1">Harga Beli</span>
                                    <span class="fs-5 fw-bold text-white">
                                        Rp {{ number_format($produk->harga_beli ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="price-box price-box-sell">
                                    <span class="info-label d-block mb-1" style="color: #a7f3d0;">Harga Jual</span>
                                    <span class="fs-4 fw-bold text-white">
                                        Rp {{ number_format($produk->harga_jual ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- RINCIAN TAMBAHAN --}}
                        <div class="row g-3 border-top pt-3 mb-4" style="border-color: var(--dark-border) !important;">
                            <div class="col-6 col-sm-4">
                                <span class="info-label d-block mb-1">Total Stok</span>
                                <span class="info-value">{{ $produk->stok ?? 0 }} {{ $produk->satuan ?? 'Unit' }}</span>
                            </div>
                            <div class="col-6 col-sm-4">
                                <span class="info-label d-block mb-1">Kategori</span>
                                <span class="info-value">{{ $produk->kategori->nama ?? '-' }}</span>
                            </div>
                            <div class="col-6 col-sm-4">
                                <span class="info-label d-block mb-1">Dibuat Pada</span>
                                <span class="info-value fs-6">{{ $produk->created_at ? $produk->created_at->format('d M Y') : '-' }}</span>
                            </div>
                        </div>

                        {{-- DESKRIPSI PRODUK --}}
                        @if(!empty($produk->deskripsi))
                            <div class="mb-4">
                                <span class="info-label d-block mb-1">Deskripsi</span>
                                <p class="text-white opacity-75 small mb-0">{{ $produk->deskripsi }}</p>
                            </div>
                        @endif

                        {{-- TOMBOL AKSI --}}
                        <div class="d-flex flex-wrap align-items-center gap-2 pt-2 no-print">
                            <a href="{{ route('produk.edit', $produk) }}" class="btn btn-gradient-green d-inline-flex align-items-center gap-2">
                                <i class="bi bi-pencil-square"></i>
                                <span>Edit Produk</span>
                            </a>
                            <a href="{{ route('produk.index') }}" class="btn btn-soft-secondary d-inline-flex align-items-center gap-2">
                                <i class="bi bi-arrow-left"></i>
                                <span>Kembali ke Daftar</span>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
