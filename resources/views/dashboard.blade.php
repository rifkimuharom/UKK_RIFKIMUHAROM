@extends('layouts.app')

@section('title', 'Dashboard - Point Of Sale')

@section('content')

    <style>
        :root {
            --bg-main: #f0f5ff;
            --bg-card: #ffffff;
            --bg-card-sub: #e6f0ff;
            --bg-banner: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 50%, #0a58ca 100%);
            --cyan-accent: #0d6efd;
            --cyan-hover: #0b5ed7;
            --text-primary: #1f3a60;
            --text-heading: #0a1c33;
            --text-muted: #6c757d;
            --border-color: #cce0ff;
            --table-hover: rgba(13, 110, 253, 0.06);
            --shadow-color: rgba(13, 110, 253, 0.08);
        }

        body.dark-theme {
            --bg-main: #0a192f;
            --bg-card: #112240;
            --bg-card-sub: #1e3a5f;
            --bg-banner: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            --cyan-accent: #3d8bfd;
            --cyan-hover: #0d6efd;
            --text-primary: #e2e8f0;
            --text-heading: #ffffff;
            --text-muted: #94a3b8;
            --border-color: #233554;
            --table-hover: rgba(61, 139, 253, 0.1);
            --shadow-color: rgba(0, 0, 0, 0.3);
        }

        body {
            background-color: var(--bg-main) !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text-primary);
        }

        .topbar-wrapper {
            background: var(--bg-card) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 16px;
            padding: 0.75rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px var(--shadow-color);
        }

        .topbar-search-box {
            position: relative;
            width: 320px;
        }

        .topbar-search-box input {
            background: var(--bg-main);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 0.5rem 0.75rem 0.5rem 2.3rem;
            font-size: 0.875rem;
            width: 100%;
            color: var(--text-heading);
            font-weight: 500;
        }

        .topbar-search-box input:focus {
            border-color: var(--cyan-accent);
            background: #ffffff;
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

        .topbar-search-box i {
            position: absolute;
            left: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .dashboard-header-banner {
            background: var(--bg-banner) !important;
            border-radius: 20px;
            padding: 2.5rem 2.25rem;
            color: #ffffff !important;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.25);
            position: relative;
            overflow: hidden;
            border: none;
        }

        .dashboard-header-banner::after {
            content: '';
            position: absolute;
            top: -40%;
            right: -8%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
        }

        .date-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            padding: 0.4rem 1rem;
            font-size: 0.825rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-date-input {
            position: relative;
            z-index: 10 !important;
            pointer-events: auto !important;
            cursor: pointer !important;
        }

        .dashboard-card {
            border-radius: 20px;
            border: 1px solid var(--border-color) !important;
            background: var(--bg-card) !important;
            box-shadow: 0 8px 25px var(--shadow-color);
            position: relative;
            overflow: hidden;
        }

        .card-top-accent {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--border-color);
        }

        .card-top-accent-accent {
            background: var(--cyan-accent) !important;
        }

        .icon-box-modern {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .bg-accent-subtle-custom {
            background-color: rgba(13, 110, 253, 0.1) !important;
            color: var(--cyan-accent) !important;
        }

        .bg-navy-subtle-custom {
            background-color: var(--bg-card-sub) !important;
            color: var(--cyan-accent) !important;
        }

        .section-title {
            color: var(--text-heading);
            font-weight: 800;
        }

        .table-custom {
            margin-bottom: 0;
            color: var(--text-primary) !important;
        }

        .table-custom thead {
            background-color: var(--bg-card-sub) !important;
        }

        .table-custom th {
            color: var(--cyan-accent) !important;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 700;
            padding: 0.875rem 1.25rem;
            border-bottom: 1px solid var(--border-color) !important;
        }

        .table-custom td {
            padding: 1rem 1.25rem;
            color: var(--text-primary) !important;
            border-bottom: 1px solid var(--border-color) !important;
            font-size: 0.9rem;
        }

        .text-heading-theme { color: var(--text-heading) !important; }
        .text-muted-theme { color: var(--text-muted) !important; }
        .bg-card-sub-theme { background-color: var(--bg-card-sub) !important; }

        @media(max-width: 768px) {
            .dashboard-header-banner { padding: 1.5rem; }
            .dashboard-header-banner h1 { font-size: 1.5rem !important; }
            .topbar-wrapper {
                flex-direction: column;
                gap: 0.75rem;
                align-items: stretch;
            }
            .topbar-search-box { width: 100%; }
        }
    </style>

    <div class="container py-4">

        <div class="topbar-wrapper">
            <form action="{{ route('dashboard') }}" method="GET" class="topbar-search-box">
                <i class="bi bi-search"></i>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk / no. transaksi...">
            </form>

            <div class="d-flex align-items-center justify-content-md-end gap-3">
                <div class="dropdown">
                    <button class="btn btn-light position-relative rounded-circle border p-2" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false" title="Notifikasi Stok"
                        style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; background: var(--bg-main); border-color: var(--border-color) !important;">
                        <i class="bi bi-bell text-secondary fs-6"></i>
                        @if(count($produkStokRendah) > 0 || count($produkStokHabis) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                        @endif
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2 mt-2" style="width: 280px; border-radius: 12px;">
                        <li class="dropdown-header fw-bold text-dark fs-6">Pemberitahuan Stok</li>
                        <li><hr class="dropdown-divider my-1"></li>

                        @if(count($produkStokRendah) > 0)
                            <li>
                                <a class="dropdown-item small text-warning d-flex align-items-center gap-2 rounded py-2" href="#">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <span>{{ count($produkStokRendah) }} Produk Stok Menipis</span>
                                </a>
                            </li>
                        @endif

                        @if(count($produkStokHabis) > 0)
                            <li>
                                <a class="dropdown-item small text-danger d-flex align-items-center gap-2 rounded py-2" href="#">
                                    <i class="bi bi-x-circle-fill"></i>
                                    <span>{{ count($produkStokHabis) }} Produk Stok Habis</span>
                                </a>
                            </li>
                        @endif

                        @if(count($produkStokRendah) == 0 && count($produkStokHabis) == 0)
                            <li><span class="dropdown-item small text-muted text-center py-2">Semua stok produk aman</span></li>
                        @endif
                    </ul>
                </div>

                <a href="{{ route('penjualan.index') }}"
                    class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2 rounded-3 fw-bold border-0 shadow-sm"
                    style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);">
                    <i class="bi bi-cart-plus-fill fs-6"></i>
                    <span>Buka Penjualan</span>
                </a>
            </div>
        </div>

        @if(request('q'))
            @php
                $hasilCariProduk = $hasilCariProduk ?? collect();
                $hasilCariTransaksi = $hasilCariTransaksi ?? collect();
            @endphp
            <div class="dashboard-card p-4 mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold text-heading-theme mb-0">Hasil pencarian: "{{ request('q') }}"</h5>
                    <a href="{{ route('dashboard') }}" class="small">Hapus pencarian</a>
                </div>

                <h6 class="fw-bold text-heading-theme mb-2">Produk</h6>
                @forelse($hasilCariProduk as $item)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <div class="fw-semibold text-heading-theme">{{ $item->nama }}</div>
                            <small class="text-muted-theme">Stok: {{ $item->stok }} unit</small>
                        </div>
                    </div>
                @empty
                    <p class="text-muted-theme mb-3">Produk tidak ditemukan.</p>
                @endforelse

                <h6 class="fw-bold text-heading-theme mt-3 mb-2">Transaksi</h6>
                @forelse($hasilCariTransaksi as $trx)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <div class="fw-semibold text-heading-theme">Transaksi #{{ $trx->id }}</div>
                            <small class="text-muted-theme">
                                Rp {{ number_format($trx->total_pembayaran ?? 0, 0, ',', '.') }}
                                • {{ $trx->status }}
                            </small>
                        </div>
                    </div>
                @empty
                    <p class="text-muted-theme mb-0">Transaksi tidak ditemukan.</p>
                @endforelse
            </div>
        @endif

        <div class="dashboard-header-banner mb-4">
            <div class="position-relative" style="z-index: 1;">
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    <div class="date-badge">
                        <i class="bi bi-calendar3"></i>
                        <span>Hari ini &bull; {{ $tanggalHariIni->translatedFormat('l, d F Y') }}</span>
                    </div>
                    <div class="date-badge">
                        <i class="bi bi-clock-history"></i>
                        <span id="liveClock">00:00:00 WIB</span>
                    </div>
                </div>
                <h1 class="fw-bold text-white mb-2 fs-2">Selamat Datang Di POS</h1>
                <p class="text-white-50 mb-0">Berikut adalah ringkasan aktivitas transaksi, inventaris, dan performa toko Anda.</p>
            </div>
        </div>

        <div class="dashboard-card p-3 mb-4" style="position: relative; z-index: 5;">
            <form action="{{ route('dashboard') }}" method="GET"
                class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <span class="fw-bold text-heading-theme fs-6"><i class="bi bi-funnel me-1 text-primary"></i> Filter Periode Laporan</span>
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <label class="small text-muted-theme fw-semibold">Dari:</label>
                        <input type="date" name="from_date" class="form-control form-control-sm rounded-2 filter-date-input"
                            value="{{ request('from_date', now()->subDays(30)->format('Y-m-d')) }}">
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <label class="small text-muted-theme fw-semibold">Sampai:</label>
                        <input type="date" name="to_date" class="form-control form-control-sm rounded-2 filter-date-input"
                            value="{{ request('to_date', now()->format('Y-m-d')) }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm px-3 fw-bold rounded-2">
                        <i class="bi bi-arrow-clockwise me-1"></i> Terapkan
                    </button>
                </div>
            </form>
        </div>

        {{-- ========== KARTU PENJUALAN (sudah dihilangkan @can) ========== --}}
        <div class="d-flex align-items-center mb-3">
            <div class="icon-box-modern bg-accent-subtle-custom me-3 shadow-sm">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
            <div>
                <h4 class="section-title mb-0 fs-5">Penjualan Hari Ini</h4>
                <span class="text-muted-theme small">Rincian performa keuangan harian</span>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="card dashboard-card h-100 p-3">
                    <div class="card-top-accent card-top-accent-accent"></div>
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted-theme small fw-bold text-uppercase">Total Pendapatan</span>
                            <div class="icon-box-modern bg-accent-subtle-custom">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-2 text-heading-theme fs-3">
                            Rp {{ number_format($ringkasan['total_penjualan'] ?? 0, 0, ',', '.') }}
                        </h3>
                        <span class="badge rounded-pill fw-semibold bg-accent-subtle-custom" style="font-size: 0.75rem;">
                            <i class="bi bi-arrow-up-short"></i> Omset Hari Ini
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <a href="{{ route('penjualan.index') }}" class="text-decoration-none">
                    <div class="card dashboard-card h-100 p-3">
                        <div class="card-top-accent"></div>
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-muted-theme small fw-bold text-uppercase">Jumlah Transaksi</span>
                                <div class="icon-box-modern bg-navy-subtle-custom">
                                    <i class="bi bi-receipt"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-2 text-heading-theme fs-3">
                                {{ number_format($ringkasan['total_transaksi'] ?? 0, 0, ',', '.') }}
                                <span class="fs-6 text-muted-theme fw-normal">Transaksi</span>
                            </h3>
                            <span class="small fw-bold" style="color: var(--cyan-accent);">Lihat Semua <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card dashboard-card h-100 p-3">
                    <div class="card-top-accent bg-success"></div>
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted-theme small fw-bold text-uppercase">Tunai (Cash)</span>
                            <div class="icon-box-modern bg-success-subtle text-success">
                                <i class="bi bi-wallet2"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold text-success mb-2 fs-3">
                            Rp {{ number_format($ringkasan['total_cash'] ?? 0, 0, ',', '.') }}
                        </h3>
                        <span class="text-muted-theme small">Uang di laci kasir</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card dashboard-card h-100 p-3">
                    <div class="card-top-accent bg-primary"></div>
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted-theme small fw-bold text-uppercase">Non Tunai (QRIS/TF)</span>
                            <div class="icon-box-modern bg-primary-subtle text-primary">
                                <i class="bi bi-credit-card"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold text-primary mb-2 fs-3">
                            Rp {{ number_format($ringkasan['total_non_tunai'] ?? 0, 0, ',', '.') }}
                        </h3>
                        <span class="text-muted-theme small">Transfer / QRIS</span>
                    </div>
                </div>
            </div>
        </div>
        {{-- ========== AKHIR KARTU PENJUALAN ========== --}}

        <div class="card dashboard-card mb-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box-modern bg-accent-subtle-custom" style="width: 42px; height: 42px; font-size: 1.1rem;">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-heading-theme fs-5">Produk Terlaris (Best Seller)</h5>
                        <span class="text-muted-theme small">Item dengan performa penjualan tertinggi</span>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 mt-2">
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Nama Produk</th>
                                <th>Sisa Stok Saat Ini</th>
                                <th class="pe-4 text-end">Total Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produkTerlaris as $produk)
                                <tr>
                                    <td class="fw-semibold text-heading-theme ps-4">
                                        <i class="bi bi-box-seam me-2 text-muted-theme"></i>{{ $produk->nama }}
                                    </td>
                                    <td>
                                        <span class="badge bg-card-sub-theme text-heading-theme border px-3 py-1 fw-normal rounded-pill"
                                            style="border-color: var(--border-color) !important;">
                                            {{ $produk->stok }} Unit Sisa
                                        </span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <span class="badge bg-accent-subtle-custom px-3 py-2 rounded-pill fw-bold">
                                            <i class="bi bi-bag-check-fill me-1"></i>
                                            {{ number_format($produk->total_terjual, 0, ',', '.') }} Terjual
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted-theme">
                                        Belum ada data penjualan produk terlaris
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center mb-3">
            <div class="icon-box-modern bg-warning-subtle text-warning me-3 shadow-sm">
                <i class="bi bi-box-seam-fill"></i>
            </div>
            <div>
                <h4 class="section-title mb-0 fs-5">Status Inventaris</h4>
                <span class="text-muted-theme small">Pantau ketersediaan produk di gudang</span>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="card dashboard-card h-100">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2 d-flex align-items-center justify-content-between">
                        <span class="fw-bold text-warning d-flex align-items-center gap-2 fs-6">
                            <i class="bi bi-exclamation-triangle-fill"></i> Stok Menipis
                        </span>
                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-1">
                            {{ method_exists($produkStokRendah, 'count') ? $produkStokRendah->count() : count($produkStokRendah) }} Produk
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-custom align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4" style="width: 60px;">#</th>
                                        <th>Produk</th>
                                        <th class="pe-4 text-end">Sisa Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($produkStokRendah as $index => $produk)
                                        <tr>
                                            <td class="ps-4 text-muted-theme small fw-semibold">{{ $loop->iteration }}</td>
                                            <td class="fw-semibold text-heading-theme">{{ $produk->nama }}</td>
                                            <td class="pe-4 text-end">
                                                <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-1 fw-bold">
                                                    {{ $produk->stok }} Unit
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-5 text-muted-theme">Stok barang masih dalam batas aman</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card dashboard-card h-100">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2 d-flex align-items-center justify-content-between">
                        <span class="fw-bold text-danger d-flex align-items-center gap-2 fs-6">
                            <i class="bi bi-x-circle-fill"></i> Stok Habis
                        </span>
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1">
                            {{ method_exists($produkStokHabis, 'count') ? $produkStokHabis->count() : count($produkStokHabis) }} Produk
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-custom align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4" style="width: 60px;">#</th>
                                        <th>Produk</th>
                                        <th class="pe-4 text-end">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($produkStokHabis as $index => $produk)
                                        <tr>
                                            <td class="ps-4 text-muted-theme small fw-semibold">{{ $loop->iteration }}</td>
                                            <td class="fw-semibold text-heading-theme">{{ $produk->nama }}</td>
                                            <td class="pe-4 text-end">
                                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-1 fw-bold">Habis (0)</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-5 text-muted-theme">Tidak ada stok produk yang habis</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const clockElem = document.getElementById('liveClock');
            if (clockElem) {
                clockElem.textContent = hours + ':' + minutes + ':' + seconds + ' WIB';
            }
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>

@endsection