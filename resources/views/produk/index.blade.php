@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
    <style>
        /* ==========================================================
           1. STYLES & DYNAMIC DARK MODE ADAPTATION
        ========================================================== */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* Banner Header Adaptif */
        .banner-light {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 60%, #0a58ca 100%);
            color: #ffffff !important;
            border-radius: 16px;
            padding: 2rem 2.25rem;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.2);
        }

        .banner-light h1,
        .banner-light h2,
        .banner-light h3,
        .banner-light h4 {
            color: #ffffff !important;
            font-weight: 800;
        }

        .banner-light p,
        .banner-light small {
            color: rgba(255, 255, 255, 0.92) !important;
            font-weight: 500;
        }

        /* Stat Cards Adaptif */
        .stat-card {
            border-radius: 16px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(13, 110, 253, 0.15) !important;
        }

        /* Placeholder Thumbnail Foto */
        .product-thumb-placeholder {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background-color: rgba(13, 110, 253, 0.1);
            color: var(--bs-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        /* Action Buttons Minimalis */
        .btn-action-info {
            background-color: rgba(13, 110, 253, 0.15);
            color: #0d6efd;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-action-info:hover {
            background-color: #0d6efd;
            color: #ffffff;
            transform: scale(1.1);
        }

        .btn-action-edit {
            background-color: rgba(255, 193, 7, 0.2);
            color: #ffc107;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-action-edit:hover {
            background-color: #ffc107;
            color: #000000;
            transform: scale(1.1);
        }

        .btn-action-delete {
            background-color: rgba(220, 53, 69, 0.15);
            color: #dc3545;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-action-delete:hover {
            background-color: #dc3545;
            color: #ffffff;
            transform: scale(1.1);
        }

        /* Perbaikan Khusus untuk Dark Mode (Bootstrap Theme) */
        [data-bs-theme="dark"] .stat-card,
        [data-bs-theme="dark"] .custom-card {
            background-color: var(--bs-dark-bg-subtle) !important;
            border-color: var(--bs-border-color-translucent) !important;
        }

        [data-bs-theme="dark"] .table {
            --bs-table-bg: transparent;
            color: var(--bs-body-color);
        }

        [data-bs-theme="dark"] .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }
    </style>

    <div class="container py-4">

        {{-- HEADER BANNER --}}
        <div class="banner-light p-4 rounded-4 mb-4 shadow-sm border-0">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <h2 class="fw-bold mb-1 d-flex align-items-center gap-2">
                        <i class="bi bi-box-seam-fill fs-2"></i> Kelola Produk
                    </h2>
                    <p class="small mb-0">Kelola inventaris, harga jual, dan stok barang toko Anda secara terpusat.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <button onclick="window.print()"
                        class="btn btn-light text-primary rounded-pill px-3 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-printer-fill"></i>
                        <span>Cetak Data</span>
                    </button>

                    @can('create', App\Models\Produk::class)
                        <a href="{{ route('produk.create') }}"
                            class="btn btn-dark rounded-pill px-4 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                            <i class="bi bi-plus-circle-fill"></i>
                            <span>Tambah Produk</span>
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        {{-- STATISTIK RINGKASAN --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card stat-card border-0 p-3 shadow-sm bg-body-tertiary">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary"
                            style="width: 48px; height: 48px;">
                            <i class="bi bi-boxes fs-4"></i>
                        </div>
                        <div>
                            <span class="small d-block text-body-secondary fw-medium">Total Produk</span>
                            <h5 class="fw-bold mb-0 text-body">
                                {{ method_exists($products, 'total') ? $products->total() : count($products) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card border-0 p-3 shadow-sm bg-body-tertiary">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success"
                            style="width: 48px; height: 48px;">
                            <i class="bi bi-stack fs-4"></i>
                        </div>
                        <div>
                            <span class="small d-block text-body-secondary fw-medium">Total Item Stok</span>
                            <h5 class="fw-bold mb-0 text-body">{{ $products->sum('stok') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card border-0 p-3 shadow-sm bg-body-tertiary">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning"
                            style="width: 48px; height: 48px;">
                            <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                        </div>
                        <div>
                            <span class="small d-block text-body-secondary fw-medium">Stok Kritis</span>
                            <h5 class="fw-bold mb-0 text-warning">
                                {{ $products->where('stok', '<=', 10)->where('stok', '>', 0)->count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card border-0 p-3 shadow-sm bg-body-tertiary">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger"
                            style="width: 48px; height: 48px;">
                            <i class="bi bi-x-circle-fill fs-4"></i>
                        </div>
                        <div>
                            <span class="small d-block text-body-secondary fw-medium">Stok Habis</span>
                            <h5 class="fw-bold mb-0 text-danger">{{ $products->where('stok', 0)->count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MAIN CARD --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 custom-card bg-body-tertiary">

            {{-- FILTER & SEARCH --}}
            <div class="card-header border-0 pt-4 px-4 pb-0 bg-transparent">
                <form action="{{ route('produk.index') }}" method="GET">
                    <div class="row g-2 justify-content-between align-items-center">
                        <div class="col-md-5 col-lg-4">
                            <div class="input-group">
                                <span class="input-group-text border-end-0 bg-body rounded-start-pill ps-3 text-body-secondary">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control border-start-0 rounded-end-pill ps-0 bg-body text-body shadow-none"
                                    placeholder="Cari nama produk...">
                            </div>
                        </div>

                        <div class="col-md-7 col-lg-6 d-flex align-items-center justify-content-md-end gap-2">
                            <select name="stok_status" class="form-select bg-body text-body rounded-pill shadow-none w-auto"
                                onchange="this.form.submit()">
                                <option value="">Semua Status Stok</option>
                                <option value="ready" {{ request('stok_status') == 'ready' ? 'selected' : '' }}>Stok Tersedia (>10)</option>
                                <option value="kritis" {{ request('stok_status') == 'kritis' ? 'selected' : '' }}>Stok Kritis (1-10)</option>
                                <option value="habis" {{ request('stok_status') == 'habis' ? 'selected' : '' }}>Stok Habis (0)</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            {{-- TABLE SECTION --}}
            <div class="card-body p-0 mt-3">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr class="small text-uppercase text-body-secondary fw-bold">
                                <th class="ps-4" style="width: 5%;">NO</th>
                                <th style="width: 8%;">FOTO</th>
                                <th>NAMA PRODUK</th>
                                <th>JENIS PRODUK</th>
                                <th>HARGA BELI</th>
                                <th>HARGA JUAL</th>
                                <th>STOK</th>
                                <th class="pe-4 text-end" style="width: 15%;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                @php
                                    $fotoPath = $product->foto ?? null;
                                @endphp
                                <tr>
                                    <td class="ps-4 small fw-medium text-body-secondary">
                                        {{ method_exists($products, 'firstItem') ? $products->firstItem() + $loop->index : $loop->iteration }}
                                    </td>
                                    <td>
                                        @if($fotoPath)
                                            <img src="{{ asset('storage/' . $fotoPath) }}" 
                                                 alt="{{ $product->nama }}"
                                                 class="border rounded-2" 
                                                 style="width: 42px; height: 42px; object-fit: cover;"
                                                 onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'product-thumb-placeholder border rounded-2 d-flex align-items-center justify-content-center bg-light text-secondary\' style=\'width: 42px; height: 42px;\'><i class=\'bi bi-box-seam fs-5\'></i></div>';">
                                        @else
                                            <div class="product-thumb-placeholder border rounded-2 d-flex align-items-center justify-content-center bg-light text-secondary" style="width: 42px; height: 42px;">
                                                <i class="bi bi-box-seam fs-5"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-body d-block">{{ $product->nama }}</span>
                                    </td>
                                    <td class="small">
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle px-2 py-1 rounded-pill fw-normal">
                                            <i class="bi bi-tag-fill me-1"></i>{{ $product->category ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="small fw-medium text-body-secondary">
                                        Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                                    </td>
                                    <td class="fw-bold small text-body">
                                        Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        @if($product->stok > 10)
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-1 rounded-pill fw-semibold">
                                                {{ $product->stok }} {{ $product->satuan ?? 'Pcs' }}
                                            </span>
                                        @elseif($product->stok > 0)
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning-subtle px-3 py-1 rounded-pill fw-semibold">
                                                {{ $product->stok }} {{ $product->satuan ?? 'Pcs' }}
                                            </span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle px-3 py-1 rounded-pill fw-semibold">
                                                Habis
                                            </span>
                                        @endif
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('produk.show', $product) }}"
                                                class="btn btn-action-info rounded-circle d-inline-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px;" title="Detail">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="{{ route('produk.edit', $product) }}"
                                                class="btn btn-action-edit rounded-circle d-inline-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px;" title="Edit">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form action="{{ route('produk.destroy', $product) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-action-delete rounded-circle d-inline-flex align-items-center justify-content-center"
                                                    style="width: 32px; height: 32px;" title="Hapus">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-body-secondary">
                                        <i class="bi bi-box-seam fs-1 d-block mb-2 text-primary"></i>
                                        <span>Tidak ada data produk.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- PAGINATION --}}
            @if(method_exists($products, 'hasPages') && $products->hasPages())
                <div class="card-footer border-top px-4 py-3 bg-transparent">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                        <span class="small text-body-secondary">
                            Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari {{ $products->total() }} produk
                        </span>
                        <div>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>
@endsection