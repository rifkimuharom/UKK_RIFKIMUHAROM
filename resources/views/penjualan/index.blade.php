@extends('layouts.app')

@section('title', 'Riwayat Penjualan')

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

        /* Print Mode Optimization */
        @media print {
            .no-print, nav, .navbar, .sidebar {
                display: none !important;
            }
            .container {
                max-width: 100% !important;
                width: 100% !important;
                padding: 0 !important;
            }
        }
    </style>

    <div class="container py-4">

        {{-- ALERT ERRORS --}}
        @if (session('errors'))
            <div class="alert alert-danger rounded-3 shadow-sm mb-4 border-0 border-start border-4 border-danger">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <div>{{ session('errors') }}</div>
                </div>
            </div>
        @endif

        {{-- HEADER BANNER --}}
        <div class="banner-light p-4 rounded-4 mb-4 shadow-sm border-0">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <h2 class="fw-bold mb-1 d-flex align-items-center gap-2">
                        <i class="bi bi-receipt-cutoff fs-2"></i> Riwayat Penjualan
                    </h2>
                    <p class="small mb-0">Pantau transaksi penjualan, metode pembayaran, dan laporan kasir secara real-time.</p>
                </div>
                <div class="d-flex flex-wrap gap-2 no-print">
                    <button onclick="window.print()"
                        class="btn btn-light text-primary rounded-pill px-3 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-printer-fill"></i>
                        <span>Cetak Laporan</span>
                    </button>

                    <a href="{{ route('penjualan.create') }}"
                        class="btn btn-dark rounded-pill px-4 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-cart-plus-fill"></i>
                        <span>Transaksi Baru</span>
                    </a>
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
                            <i class="bi bi-receipt fs-4"></i>
                        </div>
                        <div>
                            <span class="small d-block text-body-secondary fw-medium">Total Transaksi</span>
                            <h5 class="fw-bold mb-0 text-body">
                                {{ method_exists($sales, 'total') ? $sales->total() : count($sales) }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card border-0 p-3 shadow-sm bg-body-tertiary">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success"
                            style="width: 48px; height: 48px;">
                            <i class="bi bi-wallet2 fs-4"></i>
                        </div>
                        <div>
                            <span class="small d-block text-body-secondary fw-medium">Omset Terlihat</span>
                            <h5 class="fw-bold mb-0 text-body">
                                Rp {{ number_format($sales->sum('total_pembayaran'), 0, ',', '.') }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card border-0 p-3 shadow-sm bg-body-tertiary">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-info bg-opacity-10 text-info"
                            style="width: 48px; height: 48px;">
                            <i class="bi bi-qr-code-scan fs-4"></i>
                        </div>
                        <div>
                            <span class="small d-block text-body-secondary fw-medium">Digital (QRIS/Trf)</span>
                            <h5 class="fw-bold mb-0 text-info">
                                {{ $sales->whereIn('metode_pembayaran', ['qris', 'transfer', 'QRIS', 'TRANSFER'])->count() }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card border-0 p-3 shadow-sm bg-body-tertiary">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning"
                            style="width: 48px; height: 48px;">
                            <i class="bi bi-cash-stack fs-4"></i>
                        </div>
                        <div>
                            <span class="small d-block text-body-secondary fw-medium">Pembayaran Tunai</span>
                            <h5 class="fw-bold mb-0 text-warning">
                                {{ $sales->whereIn('metode_pembayaran', ['tunai', 'cash', 'TUNAI', 'CASH'])->count() }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MAIN CARD --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 custom-card bg-body-tertiary">

            {{-- FILTER & SEARCH --}}
            <div class="card-header border-0 pt-4 px-4 pb-0 bg-transparent no-print">
                <form action="{{ route('penjualan.index') }}" method="GET">
                    <div class="row g-2 justify-content-between align-items-center">
                        <div class="col-md-5 col-lg-4">
                            <div class="input-group">
                                <span class="input-group-text border-end-0 bg-body rounded-start-pill ps-3 text-body-secondary">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control border-start-0 rounded-end-pill ps-0 bg-body text-body shadow-none"
                                    placeholder="Cari kode / kasir...">
                            </div>
                        </div>

                        <div class="col-md-7 col-lg-6 d-flex align-items-center justify-content-md-end gap-2">
                            <select name="metode" class="form-select bg-body text-body rounded-pill shadow-none w-auto"
                                onchange="this.form.submit()">
                                <option value="">Semua Metode</option>
                                <option value="tunai" {{ request('metode') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                <option value="qris" {{ request('metode') == 'qris' ? 'selected' : '' }}>QRIS</option>
                                <option value="transfer" {{ request('metode') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                            </select>

                            @if (request('search') || request('metode'))
                                <a href="{{ route('penjualan.index') }}" class="btn btn-sm btn-light border rounded-pill px-3">
                                    <i class="bi bi-x-circle me-1"></i>Reset
                                </a>
                            @endif
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
                                <th>TANGGAL & WAKTU</th>
                                <th>KASIR</th>
                                <th>TOTAL PEMBAYARAN</th>
                                <th>METODE</th>
                                <th>STATUS</th>
                                <th class="pe-4 text-end no-print" style="width: 15%;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sales as $sale)
                                <tr>
                                    <td class="ps-4 small fw-medium text-body-secondary">
                                        {{ method_exists($sales, 'firstItem') ? $sales->firstItem() + $loop->index : $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-clock-history text-primary"></i>
                                            <span class="fw-semibold text-body">
                                                {{ $sale->created_at ? $sale->created_at->translatedFormat('d M Y, H:i') : '-' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-2 py-1 rounded-pill fw-normal">
                                            <i class="bi bi-person-fill me-1"></i>{{ $sale->user->name ?? $sale->user->username ?? 'Sistem/Kasir' }}
                                        </span>
                                    </td>
                                    <td class="fw-bold small text-body">
                                        Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        @php $metode = strtolower($sale->metode_pembayaran ?? $sale->payment_method ?? 'cash'); @endphp
                                        @if (in_array($metode, ['qris', 'transfer']))
                                            <span class="badge bg-info bg-opacity-10 text-info border border-info-subtle px-3 py-1 rounded-pill fw-semibold">
                                                <i class="bi bi-qr-code-scan me-1"></i>{{ strtoupper($metode) }}
                                            </span>
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-1 rounded-pill fw-semibold">
                                                <i class="bi bi-cash-stack me-1"></i>{{ ucfirst($metode) }}
                                            </span>
                                        @endif
                                    </td>
                                   <td>
    @php $status = strtolower($sale->status ?? 'pending'); @endphp

    @if (in_array($status, ['selesai', 'success', 'lunas', 'closed', 'completed', 'paid']))
        {{-- STATUS SELESAI / LUNAS / COMPLETED --}}
        <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-3 py-1 rounded-pill fw-semibold">
            <i class="bi bi-check-circle-fill me-1"></i>Completed
        </span>
    @elseif (in_array($status, ['pending', 'proses', 'open', 'draft', 'unpaid']))
        {{-- STATUS PENDING / BELUM SELESAI --}}
        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning-subtle px-3 py-1 rounded-pill fw-semibold">
            <i class="bi bi-clock-history me-1"></i>Pending
        </span>
    @else
        {{-- STATUS GAGAL / BATAL / CANCELED --}}
        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle px-3 py-1 rounded-pill fw-semibold">
            <i class="bi bi-x-circle-fill me-1"></i>Canceled
        </span>
    @endif
</td>
                                    <td class="pe-4 text-end no-print">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('penjualan.show', $sale) }}"
                                                class="btn btn-action-info rounded-circle d-inline-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px;" title="Lihat Struk / Detail">
                                                <i class="bi bi-receipt"></i>
                                            </a>

                                            @can('update', $sale)
                                                <a href="{{ route('penjualan.edit', $sale) }}"
                                                    class="btn btn-action-edit rounded-circle d-inline-flex align-items-center justify-content-center"
                                                    style="width: 32px; height: 32px;" title="Edit Transaksi">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                            @endcan

                                            @can('delete', $sale)
                                                <form action="{{ route('penjualan.destroy', $sale) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-action-delete rounded-circle d-inline-flex align-items-center justify-content-center"
                                                        style="width: 32px; height: 32px;" title="Hapus Transaksi">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-body-secondary">
                                        <i class="bi bi-receipt fs-1 d-block mb-2 text-primary"></i>
                                        <span>Tidak ada data penjualan yang ditemukan.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- PAGINATION --}}
            @if (method_exists($sales, 'hasPages') && $sales->hasPages())
                <div class="card-footer border-top px-4 py-3 bg-transparent no-print">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                        <span class="small text-body-secondary">
                            Menampilkan {{ $sales->firstItem() }} - {{ $sales->lastItem() }} dari {{ $sales->total() }} transaksi
                        </span>
                        <div>
                            {{ $sales->links() }}
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>
@endsection