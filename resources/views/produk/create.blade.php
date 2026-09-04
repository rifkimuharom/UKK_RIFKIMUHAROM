@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')


<style>
    /* Global Color Palette (Light Theme Ultra Clean) */
    :root {
        --bg-body: #f8fafc;
        --card-bg: #ffffff;
        --border-color: #cbd5e1;
        --text-primary: #0f172a;
        --text-secondary: #475569;
        --accent-primary: #0d6efd;
    }

    body {
        background-color: var(--bg-body) !important;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        color: var(--text-primary) !important;
    }

    /* Header Banner Light */
    .banner-light {
        background: #ffffff !important;
        color: var(--text-primary) !important;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
    }

    /* Card Light */
    .custom-card {
        background-color: var(--card-bg) !important;
        border: 1px solid var(--border-color) !important;
        border-radius: 16px;
        color: var(--text-primary) !important;
    }

    .custom-card label {
        color: var(--text-primary) !important;
        font-weight: 600 !important;
        font-size: 0.9rem !important;
        margin-bottom: 0.4rem !important;
    }

    /* Input & Form Control Terang */
    .custom-card .form-control,
    .custom-card .form-select,
    .custom-card textarea {
        background-color: #ffffff !important;
        border: 1px solid var(--border-color) !important;
        color: var(--text-primary) !important;
        border-radius: 10px !important;
        padding: 0.65rem 0.9rem !important;
        cursor: pointer !important; /* Memastikan kursor mengidentifikasi dropdown */
    }

    .custom-card .form-control:focus,
    .custom-card .form-select:focus,
    .custom-card textarea:focus {
        background-color: #ffffff !important;
        border-color: var(--accent-primary) !important;
        color: var(--text-primary) !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15) !important;
    }

    .custom-card .form-control::placeholder {
        color: #94a3b8 !important;
    }

    /* Styling tombol di dalam form */
    .custom-card .btn-primary {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #ffffff !important;
    }

    .custom-card .btn-secondary,
    .custom-card .btn-outline-secondary {
        background-color: #e2e8f0 !important;
        border-color: #cbd5e1 !important;
        color: #334155 !important;
    }
</style>

<div class="container py-4">

    {{-- HEADER BANNER --}}
    <div class="banner-light p-4 rounded-4 mb-4 shadow-sm">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle-fill text-primary fs-2"></i> Tambah Produk Baru
                </h2>
                <p class="small mb-0 text-secondary">Isi formulir di bawah ini untuk menambahkan barang baru ke inventaris toko.</p>
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
            <form action="{{ route('produk.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @include('produk._form')
            </form>
        </div>
    </div>

</div>

@endsection