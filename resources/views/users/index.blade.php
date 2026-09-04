@extends('layouts.app')

@section('title', 'Kelola Users')

@section('content')

    <style>
        :root {
            --bg-body: #f4f7fe;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --blue-primary: #2563eb;
            --danger: #ef4444;
        }

        .page-content-wrapper {
            background-color: var(--bg-body);
            min-height: calc(100vh - 70px);
            transition: all 0.3s ease;
            margin-left: 240px;
        }

        @media (max-width: 991.98px) {
            .page-content-wrapper {
                margin-left: 0 !important;
            }
        }

        .banner-blue-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
            color: #ffffff !important;
            border-radius: 20px !important;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.15) !important;
            padding: 1.75rem 2.25rem !important;
        }

        .stat-card {
            background-color: var(--card-bg) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 18px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02) !important;
        }

        .stat-card-title {
            color: var(--text-muted) !important;
            font-weight: 600 !important;
            font-size: 0.8rem !important;
            text-transform: uppercase;
        }

        .stat-card-number {
            color: var(--text-main) !important;
            font-weight: 800 !important;
            font-size: 1.5rem !important;
        }

        .custom-card {
            background-color: var(--card-bg) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 20px !important;
        }

        .bg-table-head {
            background-color: #f8fafc !important;
        }

        .table-head-text {
            color: var(--blue-primary) !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            font-size: 0.75rem !important;
        }

        .custom-table td {
            color: var(--text-main) !important;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9 !important;
        }

        .badge-role-admin {
            background-color: #eff6ff !important;
            color: #2563eb !important;
            border: 1px solid #bfdbfe !important;
        }

        .badge-role-kasir {
            background-color: #fdf2f8 !important;
            color: #db2777 !important;
            border: 1px solid #fbcfe8 !important;
        }

        .badge-soft-emerald {
            background-color: #f0fdf4 !important;
            color: #16a34a !important;
            border: 1px solid #bbf7d0 !important;
        }

        .bg-search {
            background-color: #f8fafc !important;
            border: 1px solid var(--border-color) !important;
            color: var(--text-main) !important;
        }

        .btn-cyan-accent {
            background: #0f172a !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            border-radius: 50rem !important;
        }

        .btn-edit-soft {
            background: rgba(37, 99, 235, 0.08) !important;
            color: var(--blue-primary) !important;
            border: 1px solid rgba(37, 99, 235, 0.15) !important;
        }

        .btn-delete-soft {
            background-color: rgba(239, 68, 68, 0.08) !important;
            color: var(--danger) !important;
            border: 1px solid rgba(239, 68, 68, 0.15) !important;
        }

        .user-table-avatar {
            width: 38px;
            height: 38px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>

    <div class="page-content-wrapper py-4 px-3 px-md-4">
        <div class="container-fluid">

            {{-- BANNER HEADER --}}
            <div class="banner-blue-gradient p-4 mb-4 position-relative overflow-hidden">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 position-relative"
                    style="z-index: 1;">
                    <div>
                        <h3 class="fw-bold mb-1 text-white d-flex align-items-center gap-2">
                            <i class="bi bi-people-fill"></i> Kelola Users
                        </h3>
                        <p class="small mb-0 text-white opacity-90">Atur hak akses, kredensial, dan kelola daftar pengguna
                            sistem POS Anda.</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button onclick="window.print()"
                            class="btn btn-light text-primary rounded-pill px-3 shadow-sm fw-semibold border-0 d-inline-flex align-items-center gap-2">
                            <i class="bi bi-printer-fill"></i>
                            <span>Cetak Data</span>
                        </button>

                        <a href="{{ route('admin.users.create') }}"
                            class="btn btn-cyan-accent px-4 shadow-sm d-inline-flex align-items-center gap-2">
                            <i class="bi bi-person-plus-fill"></i>
                            <span>Tambah User</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- RINGKASAN STATISTIK --}}
            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle p-3 d-flex align-items-center justify-content-center"
                                style="background: #eff6ff; color: #2563eb; width: 48px; height: 48px;">
                                <i class="bi bi-people fs-5"></i>
                            </div>
                            <div>
                                <span class="stat-card-title d-block">Total User</span>
                                <h4 class="stat-card-number mb-0">
                                    {{ method_exists($users, 'total') ? $users->total() : count($users) }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle p-3 d-flex align-items-center justify-content-center"
                                style="background: #eff6ff; color: #2563eb; width: 48px; height: 48px;">
                                <i class="bi bi-shield-lock fs-5"></i>
                            </div>
                            <div>
                                <span class="stat-card-title d-block">Administrator</span>
                                <h4 class="stat-card-number mb-0">
                                    {{ $users->filter(function ($u) {
        return strtolower(is_object($u->role) ? $u->role->name : ($u->role ?? '')) == 'admin'; })->count() }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle p-3 d-flex align-items-center justify-content-center"
                                style="background: #fdf2f8; color: #db2777; width: 48px; height: 48px;">
                                <i class="bi bi-person-badge fs-5"></i>
                            </div>
                            <div>
                                <span class="stat-card-title d-block">Petugas Kasir</span>
                                <h4 class="stat-card-number mb-0" style="color: #db2777 !important;">
                                    {{ $users->filter(function ($u) {
        return strtolower(is_object($u->role) ? $u->role->name : ($u->role ?? '')) != 'admin'; })->count() }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle p-3 d-flex align-items-center justify-content-center"
                                style="background: #f0fdf4; color: #16a34a; width: 48px; height: 48px;">
                                <i class="bi bi-check-circle fs-5"></i>
                            </div>
                            <div>
                                <span class="stat-card-title d-block">Status Sistem</span>
                                <h5 class="fw-bold mb-0 text-success fs-6">Aktif Normal</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABEL DATA USER --}}
            <div class="card custom-card overflow-hidden mb-4">
                <div class="card-header border-0 pt-4 px-4 pb-0 bg-transparent">
                    <form action="{{ route('admin.users') }}" method="GET">
                        <div class="row g-2 justify-content-between align-items-center">
                            <div class="col-md-5 col-lg-4">
                                <div class="input-group">
                                    <span
                                        class="input-group-text border-end-0 rounded-start-pill ps-3 bg-search text-muted">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control border-start-0 rounded-end-pill ps-0 bg-search shadow-none"
                                        placeholder="Cari nama atau email..." id="fastSearchInput">
                                </div>
                            </div>

                            <div class="col-md-7 col-lg-6 d-flex align-items-center justify-content-md-end gap-2">
                                <select name="role" class="form-select bg-search rounded-pill shadow-none w-auto"
                                    onchange="this.form.submit()">
                                    <option value="">Semua Role</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="kasir" {{ request('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                </select>

                                @if(request('search') || request('role'))
                                    <a href="{{ route('admin.users') }}"
                                        class="btn btn-sm btn-light border rounded-pill px-3 text-secondary">
                                        <i class="bi bi-x-circle me-1"></i>Reset
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0 mt-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 custom-table">
                            <thead class="bg-table-head">
                                <tr class="table-head-text">
                                    <th class="ps-4" style="width: 5%;">NO</th>
                                    <th>NAMA PENGGUNA</th>
                                    <th>EMAIL</th>
                                    <th>HAK AKSES / ROLE</th>
                                    <th>STATUS</th>
                                    <th class="pe-4 text-end" style="width: 15%;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    @php
                                        $roleName = is_object($user->role) ? ($user->role->name ?? 'User') : ($user->role ?? 'User');
                                    @endphp
                                    <tr>
                                        <td class="ps-4 small fw-semibold text-muted">
                                            {{ method_exists($users, 'firstItem') ? $users->firstItem() + $loop->index : $loop->iteration }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                {{-- Menampilkan foto profil jika ada, atau fallback ke huruf inisial --}}
                                                @if(!empty($user->photo) && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->photo))
                                                    <img src="{{ asset('storage/' . $user->photo) }}"
                                                        class="user-table-avatar shadow-sm" alt="{{ $user->name }}">
                                                @else
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm overflow-hidden"
                                                        style="width: 38px; height: 38px; flex-shrink: 0; background: #eff6ff;">
                                                        <span class="fw-bold text-primary" style="font-size: 0.9rem;">
                                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                @endif

                                                <div>
                                                    <span class="d-block fw-bold text-dark fs-6">{{ $user->name }}</span>
                                                    <span class="small text-muted">ID User: #{{ $user->id }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="small fw-semibold text-dark">
                                            <i class="bi bi-envelope text-muted me-1"></i> {{ $user->email }}
                                        </td>
                                        <td>
                                            @if(strtolower($roleName) == 'admin')
                                                <span class="badge badge-role-admin px-3 py-1.5 rounded-pill fw-semibold">
                                                    <i class="bi bi-shield-lock-fill me-1"></i> Admin
                                                </span>
                                            @else
                                                <span class="badge badge-role-kasir px-3 py-1.5 rounded-pill fw-semibold">
                                                    <i class="bi bi-person-badge me-1"></i> {{ ucfirst($roleName) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-soft-emerald px-2.5 py-1 rounded-pill fw-semibold small">
                                                • Aktif
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                    class="btn btn-edit-soft rounded-circle d-inline-flex align-items-center justify-content-center"
                                                    style="width: 34px; height: 34px;" title="Edit Akun">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>

                                                <button type="button"
                                                    class="btn btn-delete-soft rounded-circle d-inline-flex align-items-center justify-content-center"
                                                    style="width: 34px; height: 34px;" title="Hapus User"
                                                    onclick="triggerDeleteModal('{{ $user->id }}', '{{ $user->name }}')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="bi bi-people fs-1 d-block mb-2 opacity-50"></i>
                                            <span>Tidak ada data user yang ditemukan.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(method_exists($users, 'hasPages') && $users->hasPages())
                    <div class="card-footer border-0 px-4 py-3 border-top bg-transparent">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                            <span class="small text-muted">
                                Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} user
                            </span>
                            <div>
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div class="modal fade" id="globalDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden text-center p-3"
                style="background-color: #ffffff;">
                <div class="modal-body p-3">
                    <div class="rounded-circle bg-danger bg-opacity-10 text-danger mx-auto mb-3 d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px;">
                        <i class="bi bi-exclamation-triangle-fill fs-2"></i>
                    </div>
                    <h5 class="fw-bold mb-1 text-dark">Hapus User?</h5>
                    <p class="small text-muted mb-0">Apakah Anda yakin ingin menghapus user <strong id="deleteUserNameText"
                            class="text-dark"></strong>?</p>
                </div>
                <div class="d-flex gap-2 justify-content-center px-3 pb-2">
                    <button type="button" class="btn btn-light border rounded-pill px-3 fw-semibold w-50"
                        data-bs-dismiss="modal">Batal</button>
                    <form id="globalDeleteForm" action="" method="POST" class="w-50">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-pill px-3 fw-semibold w-100">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function triggerDeleteModal(userId, userName) {
            document.getElementById('deleteUserNameText').innerText = `"${userName}"`;
            document.getElementById('globalDeleteForm').action = `/admin/users/destroy/${userId}`;

            var myModal = new bootstrap.Modal(document.getElementById('globalDeleteModal'));
            myModal.show();
        }

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('fastSearchInput');
            const tableRows = document.querySelectorAll('.custom-table tbody tr');

            if (searchInput) {
                searchInput.addEventListener('keyup', function () {
                    const keyword = this.value.toLowerCase();
                    tableRows.forEach(row => {
                        const text = row.innerText.toLowerCase();
                        row.style.display = text.includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>

@endsection