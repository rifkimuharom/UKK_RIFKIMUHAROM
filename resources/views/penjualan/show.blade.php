@extends('layouts.app')

@section('title', 'Detail Penjualan #' . ($penjualan->kode_transaksi ?? $penjualan->id))

@section('content')

    @php
        // Mengambil data setting dari database agar header & footer dinamis
        $setting = \App\Models\Setting::first();

        // Logika Pengecekan Status Transaksi
        $status = strtolower($penjualan->status ?? 'pending');
        $totalBayar = $penjualan->total_pembayaran ?? $penjualan->total_harga ?? 0;

        // Transaksi dianggap Lunas hanya jika status completed/lunas DAN nominal pembayaran > 0
        $isLunas = in_array($status, ['selesai', 'success', 'lunas', 'closed', 'completed', 'paid']) && $totalBayar > 0;
        $isPending = in_array($status, ['pending', 'proses', 'open', 'draft', 'unpaid']) || $totalBayar == 0;
    @endphp

    {{-- CSS Khusus Tampilan Screen & Print --}}
    <style>
        body {
            background-color: #f8fafc !important;
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif !important;
            color: #1e293b !important;
        }

        /* Card Modern UI */
        .card-modern {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
        }

        .invoice-header-banner {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            border-radius: 16px;
            color: #ffffff;
            padding: 1.75rem 2rem;
        }

        .stat-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1rem;
        }

        .table-modern thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
            padding: 0.85rem 1rem;
        }

        .table-modern tbody td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        /* Highlight Box Total Bayar Lunas */
        .total-box-highlight {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 1px dashed #86efac;
            border-radius: 12px;
            padding: 1.25rem;
        }

        /* Highlight Box Total Bayar Pending */
        .total-box-pending {
            background: linear-gradient(135deg, #fffbe3 0%, #fef3c7 100%);
            border: 1px dashed #fde047;
            border-radius: 12px;
            padding: 1.25rem;
        }

        /* Tampilan Khusus Format Struk Thermal Kertas */
        .thermal-receipt {
            display: none;
        }

        /* STYLING SAAT MENCETAK (MEDIA PRINT) */
        @media print {

            .no-print,
            .sidebar,
            .navbar,
            .btn,
            header,
            footer,
            aside {
                display: none !important;
            }

            body {
                background-color: #ffffff !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            /* Mode 1: Cetak Struk Thermal Kasir */
            body.print-mode-thermal .card-modern {
                display: none !important;
            }

            body.print-mode-thermal .thermal-receipt {
                display: block !important;
                width: 80mm;
                margin: 0 auto;
                padding: 10px;
                font-family: 'Courier New', Courier, monospace !important;
                font-size: 11px;
                color: #000;
            }

            body.print-mode-thermal .thermal-receipt .text-center {
                text-align: center;
            }

            body.print-mode-thermal .thermal-receipt .text-end {
                text-align: right;
            }

            body.print-mode-thermal .thermal-receipt .fw-bold {
                font-weight: bold;
            }

            body.print-mode-thermal .thermal-receipt .dashed-line {
                border-bottom: 1px dashed #000;
                margin: 8px 0;
            }

            body.print-mode-thermal .thermal-receipt .flex-between {
                display: flex;
                justify-content: space-between;
            }

            /* Mode 2: Cetak Invoice PDF (A4/Standar) */
            body.print-mode-pdf .thermal-receipt {
                display: none !important;
            }

            body.print-mode-pdf .card-modern {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
            }

            body.print-mode-pdf .invoice-header-banner,
            body.print-mode-pdf .total-box-highlight,
            body.print-mode-pdf .total-box-pending {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>

    {{-- SECTION TAMPILAN WEB / MONITOR --}}
    <div class="container py-4">

        {{-- BAR ATAS / ACTION BUTTONS --}}
        <div class="card-modern p-3 mb-4 no-print">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h4 class="fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-file-earmark-text-fill text-primary"></i> Detail Penjualan
                    </h4>
                    <p class="text-muted small mb-0">Rincian lengkap data transaksi penjualan pelanggan.</p>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <a href="{{ route('penjualan.index') }}"
                        class="btn btn-light border rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-arrow-left"></i>
                        <span>Kembali</span>
                    </a>

                    {{-- TOMBOL 1: CETAK INVOICE / PDF --}}
                    <button onclick="cetakDocument('pdf')"
                        class="btn btn-outline-primary rounded-pill px-3.5 fw-bold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-file-earmark-pdf-fill"></i>
                        <span>Cetak Invoice / PDF</span>
                    </button>

                    {{-- TOMBOL 2: CETAK STRUK THERMAL --}}
                    <button onclick="cetakDocument('thermal')"
                        class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                        <i class="bi bi-printer-fill"></i>
                        <span>Cetak Struk Thermal</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- INVOICE MODERN CARD --}}
        <div class="card-modern p-4 p-md-5">

            {{-- HEADER BANNER BRAND --}}
            <div class="invoice-header-banner mb-4 shadow-sm">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span
                                class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-black fs-5"
                                style="width:38px; height:38px;">R</span>
                            <h3 class="fw-black mb-0 tracking-wide">
                                {{ $setting->header_struk ?? 'KUDE POS' }}
                            </h3>
                        </div>
                        <p class="mb-0 opacity-75 small">Sistem Kasir & Manajemen Penjualan Modern</p>
                    </div>
                    <div class="text-md-end">
                        {{-- BADGE STATUS DINAMIS --}}
                        @if ($isLunas)
                            <span
                                class="badge bg-white text-success fw-bold px-3 py-2 rounded-pill shadow-sm mb-2 d-inline-block">
                                <i class="bi bi-check-circle-fill me-1"></i> TRANSAKSI LUNAS
                            </span>
                        @elseif ($isPending)
                            <span
                                class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill shadow-sm mb-2 d-inline-block">
                                <i class="bi bi-clock-history me-1"></i> TRANSAKSI PENDING
                            </span>
                        @else
                            <span
                                class="badge bg-danger text-white fw-bold px-3 py-2 rounded-pill shadow-sm mb-2 d-inline-block">
                                <i class="bi bi-x-circle-fill me-1"></i> TRANSAKSI BATAL
                            </span>
                        @endif

                        <div class="small opacity-75">
                            <i class="bi bi-clock me-1"></i>
                            {{ $penjualan->created_at ? \Carbon\Carbon::parse($penjualan->created_at)->translatedFormat('d M Y, H:i') : '-' }}
                            WIB
                        </div>
                    </div>
                </div>
            </div>

            {{-- METRIC STATS --}}
            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="stat-box h-100">
                        <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.7rem;">Kode
                            Transaksi</span>
                        <span class="fw-bold text-primary fs-6 font-monospace">
                            #{{ $penjualan->kode_transaksi ?? 'TRX-' . str_pad($penjualan->id, 5, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="stat-box h-100">
                        <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.7rem;">Kasir
                            Bertugas</span>
                        <span class="fw-bold text-dark fs-6 d-flex align-items-center gap-1.5">
                            <i class="bi bi-person-circle text-secondary"></i>
                            {{ $penjualan->user->name ?? $penjualan->user->username ?? 'Kasir' }}
                        </span>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="stat-box h-100">
                        <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.7rem;">Metode
                            Pembayaran</span>
                        <span class="fw-bold text-dark fs-6 d-flex align-items-center gap-1.5">
                            @php $metode = strtoupper($penjualan->payment_method ?? $penjualan->metode_pembayaran ?? 'TUNAI'); @endphp
                            @if(in_array($metode, ['CASH', 'TUNAI']))
                                <i class="bi bi-cash-stack text-success"></i> Tunai / Cash
                            @elseif($metode === 'QRIS')
                                <i class="bi bi-qr-code-scan text-primary"></i> QRIS
                            @else
                                <i class="bi bi-bank text-info"></i> {{ $metode }}
                            @endif
                        </span>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="stat-box h-100">
                        <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.7rem;">Total
                            Item</span>
                        <span class="fw-bold text-dark fs-6 d-flex align-items-center gap-1.5">
                            <i class="bi bi-box-seam text-warning"></i>
                            @php $items = $penjualan->itemPenjualan ?? $penjualan->details ?? collect([]); @endphp
                            {{ $items->sum('kuantitas') ?? $items->sum('jumlah') ?? 0 }} Barang
                        </span>
                    </div>
                </div>
            </div>

            {{-- TABEL DAFTAR ITEM --}}
            <div class="table-responsive mb-4">
                <table class="table table-modern w-100">
                    <thead>
                        <tr>
                            <th style="width: 5%;" class="text-center">NO</th>
                            <th>NAMA PRODUK</th>
                            <th class="text-end" style="width: 20%;">HARGA SATUAN</th>
                            <th class="text-center" style="width: 15%;">JUMLAH</th>
                            <th class="text-end" style="width: 20%;">SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $index => $item)
                            <tr>
                                <td class="text-center fw-semibold text-muted">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">
                                        {{ $item->produk->nama ?? $item->produk->nama_produk ?? 'Item Dihapus' }}
                                    </div>
                                    @if(isset($item->produk->kategori))
                                        <small class="text-muted">{{ $item->produk->kategori->nama }}</small>
                                    @endif
                                </td>
                                <td class="text-end text-muted font-monospace">
                                    Rp
                                    {{ number_format($item->harga_satuan ?? $item->harga ?? ($item->subtotal / max($item->kuantitas ?? $item->jumlah ?? 1, 1)), 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-2.5 py-1 rounded-pill fw-semibold">
                                        {{ $item->kuantitas ?? $item->jumlah ?? 0 }}
                                    </span>
                                </td>
                                <td class="text-end fw-bold text-dark font-monospace">
                                    Rp {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-1"></i>
                                    <span>Tidak ada item produk dalam transaksi ini.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- RINGKASAN TOTAL PEMBAYARAN --}}
            <div class="row justify-content-end mb-4">
                <div class="col-md-5 col-lg-4">
                    <div class="d-flex flex-column gap-2 mb-3 px-1">
                        <div class="d-flex justify-content-between text-muted small">
                            <span>Subtotal Produk</span>
                            <span class="fw-semibold text-dark font-monospace">
                                Rp {{ number_format($totalBayar, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between text-muted small">
                            <span>Pajak / Diskon</span>
                            <span class="fw-semibold text-dark font-monospace">Rp 0</span>
                        </div>
                    </div>

                    {{-- KOTAK HIGHLIGHT TOTAL DINAMIS --}}
                    <div class="{{ $isLunas ? 'total-box-highlight' : 'total-box-pending' }} text-end">
                        <span
                            class="small text-uppercase fw-bold {{ $isLunas ? 'text-success' : 'text-warning-emphasis' }} d-block mb-1"
                            style="letter-spacing: 0.5px;">Total Pembayaran</span>
                        <h2 class="fw-black {{ $isLunas ? 'text-success' : 'text-dark' }} mb-0 font-monospace"
                            style="font-size: 2rem;">
                            Rp {{ number_format($totalBayar, 0, ',', '.') }}
                        </h2>

                        @if ($isLunas)
                            <span class="badge bg-success text-white mt-1 px-2.5 py-1 rounded-pill small">
                                <i class="bi bi-check-lg me-1"></i> Lunas
                            </span>
                        @else
                            <span class="badge bg-warning text-dark mt-1 px-2.5 py-1 rounded-pill small">
                                <i class="bi bi-clock-history me-1"></i> Pending
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- FOOTER STRUK --}}
            <div class="text-center pt-4 border-top">
                <p class="fw-semibold text-dark mb-1">~ {{ $setting->footer_struk ?? 'Terima kasih atas kunjungan Anda' }} ~
                </p>
                <p class="text-muted small mb-0">Struk ini sah sebagai bukti pembayaran resmi yang dikeluarkan oleh sistem.
                </p>
            </div>

        </div>

    </div>

    {{-- FORMAT PRINT THERMAL KERTAS KASIR --}}
    <div class="thermal-receipt">
        <div class="text-center fw-bold" style="font-size: 13px; text-transform: uppercase;">
            {{ $setting->header_struk ?? 'Selamat Datang Di KUDE POS' }}
        </div>
        <div class="text-center" style="font-size: 10px; margin-top: 2px;">
            No: #{{ $penjualan->kode_transaksi ?? 'TRX-' . str_pad($penjualan->id, 5, '0', STR_PAD_LEFT) }}<br>
            Tgl: {{ \Carbon\Carbon::parse($penjualan->created_at)->format('d/m/Y H:i') }}<br>
            Kasir: {{ $penjualan->user->name ?? $penjualan->user->username ?? 'Admin' }}
        </div>

        <div class="dashed-line"></div>

        @foreach($items as $item)
            <div class="flex-between fw-bold">
                <span>{{ $item->produk->nama ?? $item->produk->nama_produk ?? 'Item' }}</span>
                <span>{{ number_format($item->subtotal ?? 0, 0, ',', '.') }}</span>
            </div>
            <div style="font-size: 10px; color: #333;">
                {{ $item->kuantitas ?? $item->jumlah ?? 0 }} x
                {{ number_format($item->harga_satuan ?? $item->harga ?? ($item->subtotal / max($item->kuantitas ?? $item->jumlah ?? 1, 1)), 0, ',', '.') }}
            </div>
        @endforeach

        <div class="dashed-line"></div>

        <div class="flex-between">
            <span>Subtotal</span>
            <span>{{ number_format($totalBayar, 0, ',', '.') }}</span>
        </div>
        <div class="flex-between fw-bold" style="font-size: 12px; margin-top: 4px;">
            <span>TOTAL</span>
            <span>Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
        </div>

        <div class="dashed-line"></div>

        <div class="text-center" style="font-size: 10px; font-style: italic; margin-top: 6px;">
            {{ $setting->footer_struk ?? 'Terima kasih atas kunjungan Anda' }}
        </div>
    </div>

    {{-- SCRIPT PENGATUR STRATEGI CETAK --}}
    <script>
        function cetakDocument(mode) {
            document.body.classList.remove('print-mode-pdf', 'print-mode-thermal');

            if (mode === 'thermal') {
                document.body.classList.add('print-mode-thermal');
            } else {
                document.body.classList.add('print-mode-pdf');
            }

            // Jalankan dialog print
            window.print();
        }

        // Hapus class mode print setelah selesai atau dibatalkan agar tampilan layar kembali bersih
        window.addEventListener('afterprint', function () {
            document.body.classList.remove('print-mode-pdf', 'print-mode-thermal');
        });
    </script>

@endsection