@extends('layouts.app')

@section('content')
    <style>
        :root {
            --kude-primary: #0d6efd;
            --kude-primary-hover: #0b5ed7;
            --kude-gradient: linear-gradient(135deg, #2563eb 0%, #1d4ed8 50%, #1e40af 100%);
            --kude-soft-bg: #f8fafc;
            --kude-card-border: #e2e8f0;
            --kude-text-dark: #0f172a;
            --kude-text-muted: #64748b;
        }

        body {
            background-color: var(--kude-soft-bg) !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* Banner Header Modern */
        .page-header-banner {
            background: var(--kude-gradient);
            border-radius: 20px;
            padding: 2rem 2.25rem;
            color: #ffffff;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.3);
            position: relative;
            overflow: hidden;
        }

        .page-header-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Stat Card Modern */
        .stat-card {
            background: #ffffff;
            border: 1px solid var(--kude-card-border);
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -6px rgba(15, 23, 42, 0.08);
            border-color: #cbd5e1;
        }

        .stat-icon-wrapper {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        /* Table Card Container */
        .table-container-card {
            background: #ffffff;
            border: 1px solid var(--kude-card-border);
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
            overflow: hidden;
        }

        .table-custom {
            margin-bottom: 0;
        }

        .table-custom thead th {
            background-color: #f8fafc;
            color: var(--kude-text-muted);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--kude-card-border);
        }

        .table-custom tbody tr {
            transition: background-color 0.15s ease;
        }

        .table-custom tbody tr:hover {
            background-color: #f1f5f9;
        }

        .table-custom td {
            padding: 1.1rem 1.5rem;
            color: var(--kude-text-dark);
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.92rem;
        }

        /* Badges */
        .badge-category-pill {
            padding: 7px 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .badge-admin-pill {
            background: #f1f5f9;
            color: #334155;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            border: 1px solid #e2e8f0;
        }

        /* Action Buttons */
        .btn-action-delete {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fef2f2;
            color: #ef4444;
            border: 1px solid #fecaca;
            transition: all 0.2s ease;
        }

        .btn-action-delete:hover {
            background: #ef4444;
            color: #ffffff;
            border-color: #ef4444;
            transform: scale(1.08);
        }

        .btn-banner-action {
            background: #ffffff;
            color: #1d4ed8;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 700;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .btn-banner-action:hover {
            background: #f8fafc;
            color: #1e40af;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        /* Modal Custom */
        .modal-content-modern {
            border-radius: 20px;
            border: none;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .modal-header-modern {
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.25rem 1.75rem;
        }

        .form-control-modern {
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 0.7rem 1rem;
            font-size: 0.92rem;
            transition: all 0.2s ease;
        }

        .form-control-modern:focus {
            border-color: var(--kude-primary);
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.12);
        }
    </style>

    <div class="container-fluid py-4 px-4">

        {{-- BANNER HEADER --}}
<div class="page-header-banner mb-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-white text-primary rounded-pill px-3 py-2 text-uppercase fw-bold shadow-sm" style="letter-spacing: 0.5px; font-size: 0.75rem;">
                    <i class="bi bi-grid-fill me-1"></i> Inventaris Produk
                </span>
            </div>
            <h2 class="fw-bold text-white mb-1">Manajemen Kategori</h2>
            <p class="text-white-50 mb-0">Kelola dan kelompokkan kategori produk untuk mempermudah transaksi kasir.</p>
        </div>
        <button class="btn btn-banner-action d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
            <i class="bi bi-plus-circle-fill fs-5"></i>
            <span>Tambah Kategori Baru</span>
        </button>
    </div>
</div>

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 alert-dismissible fade show mb-4 d-flex align-items-center gap-3 p-3"
                role="alert">
                <div class="p-2 bg-success bg-opacity-10 rounded-3 text-success">
                    <i class="bi bi-check-circle-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0 text-success">Berhasil!</h6>
                    <small class="text-muted">{{ session('success') }}</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- STAT CARDS --}}
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-4">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-tags-fill"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block fw-semibold">Total Kategori</span>
                        <h3 class="fw-bold mb-0 text-dark">{{ count($kategori) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-success bg-opacity-10 text-success">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block fw-semibold">Status Sistem</span>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 fw-semibold">Aktif &
                            Siap</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block fw-semibold">Terakhir Diperbarui</span>
                        <span class="fw-bold text-dark fs-6">{{ date('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABLE CARD --}}
        <div class="table-container-card">
            <div
                class="p-3 border-bottom bg-white d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                <div class="input-group input-group-sm" style="max-width: 340px;">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted ps-3">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="searchKategori"
                        class="form-control bg-light border-start-0 rounded-end-3 shadow-none py-2"
                        placeholder="Cari nama kategori...">
                </div>
                <div class="text-muted small">
                    Menampilkan <span class="fw-bold text-dark">{{ count($kategori) }}</span> data kategori
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-custom align-middle" id="tableKategori">
                    <thead>
                        <tr>
                            <th width="70" class="text-center">NO</th>
                            <th>NAMA KATEGORI</th>
                            <th>DIBUAT OLEH</th>
                            <th>DESKRIPSI</th>
                            <th width="120" class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategori as $index => $item)
                            @php
                                $colors = [
                                    ['bg' => 'rgba(13, 110, 253, 0.1)', 'color' => '#0d6efd', 'icon' => 'bi-cup-hot-fill'],
                                    ['bg' => 'rgba(25, 135, 84, 0.1)', 'color' => '#198754', 'icon' => 'bi-bag-check-fill'],
                                    ['bg' => 'rgba(255, 193, 7, 0.15)', 'color' => '#d97706', 'icon' => 'bi-box-seam-fill'],
                                    ['bg' => 'rgba(111, 66, 193, 0.1)', 'color' => '#6f42c1', 'icon' => 'bi-basket2-fill'],
                                    ['bg' => 'rgba(220, 53, 69, 0.1)', 'color' => '#dc3545', 'icon' => 'bi-tag-fill']
                                ];
                                $theme = $colors[$index % count($colors)];
                            @endphp
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                                <td>
                                    <div class="badge-category-pill"
                                        style="background: {{ $theme['bg'] }}; color: {{ $theme['color'] }};">
                                        <i class="bi {{ $theme['icon'] }}"></i>
                                        <span>{{ $item->nama }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="badge-admin-pill">
                                        <i class="bi bi-person-circle text-primary"></i>
                                        <span>{{ $item->user->name ?? $item->created_by ?? auth()->user()->name ?? 'Admin' }}</span>
                                    </div>
                                </td>
                                <td class="text-secondary">
                                    @if($item->deskripsi)
                                        <span>{{ $item->deskripsi }}</span>
                                    @else
                                        <span class="text-muted italic small"><i class="bi bi-dash"></i> Tidak ada deskripsi</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('kategori.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $item->nama }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-delete" title="Hapus Kategori">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="py-4">
                                        <div class="p-3 bg-light rounded-circle d-inline-block mb-3">
                                            <i class="bi bi-folder-x text-muted display-4"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark">Belum Ada Data Kategori</h5>
                                        <p class="text-muted small mb-3">Silakan tambahkan kategori produk baru untuk kasir
                                            Anda.</p>
                                        <button class="btn btn-primary px-4 py-2 rounded-3 fw-semibold" data-bs-toggle="modal"
                                            data-bs-target="#modalTambahKategori">
                                            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori Sekarang
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH KATEGORI --}}
    <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-modern">
                <div class="modal-header modal-header-modern">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-2 rounded-3 bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-folder-plus fs-4"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-dark mb-0">Tambah Kategori Baru</h5>
                            <small class="text-muted">Buat kelompok produk baru</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark small mb-1">
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama" class="form-control form-control-modern" required
                                placeholder="Contoh: Makanan, Minuman, Snaking">
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold text-dark small mb-1">
                                Deskripsi Kategori <span class="text-muted fw-normal">(Opsional)</span>
                            </label>
                            <textarea name="deskripsi" class="form-control form-control-modern" rows="3"
                                placeholder="Tuliskan catatan singkat mengenai kategori ini..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer bg-light border-0 px-4 py-3">
                        <button type="button" class="btn btn-link text-decoration-none text-muted fw-semibold"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 rounded-3 fw-semibold">
                            <i class="bi bi-check-lg me-1"></i> Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modalTambah = document.getElementById('modalTambahKategori');
            if (modalTambah) {
                modalTambah.addEventListener('shown.bs.modal', function () {
                    var inputNama = modalTambah.querySelector('input[name="nama"]');
                    if (inputNama) {
                        inputNama.focus();
                    }
                });
            }

            const searchInput = document.getElementById('searchKategori');
            const tableRows = document.querySelectorAll('#tableKategori tbody tr');

            if (searchInput) {
                searchInput.addEventListener('keyup', function () {
                    const query = searchInput.value.toLowerCase();
                    tableRows.forEach(row => {
                        const text = row.innerText.toLowerCase();
                        row.style.display = text.includes(query) ? '' : 'none';
                    });
                });
            }
        });
    </script>
@endsection