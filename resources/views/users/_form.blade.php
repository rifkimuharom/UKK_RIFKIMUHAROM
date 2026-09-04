@csrf

<style>
    /* ==========================================================
       VARIAEL TEMA ROYAL BLUE MODERN (SERAGAM KUDE POS)
    ========================================================== */
    :root {
        --bg-body-soft: #f0f5ff;       /* Background Halaman Soft Light Blue */
        --card-white: #ffffff;         /* Background Card/Form Putih */
        --input-bg: #f8fafc;          /* Background Input Soft */
        --border-soft: #cbd5e1;        /* Border Soft Slate */
        --royal-blue: #0d6efd;         /* Biru Royal Utama */
        --royal-blue-hover: #0b5ed7;   /* Biru Royal Hover */
        --text-dark: #0f172a;          /* Teks Utama Gelap Kontras */
        --text-muted: #64748b;         /* Sub-teks */
    }

    /* Form Text & Labels */
    .form-label-custom {
        font-weight: 700;
        color: var(--text-dark);
        font-size: 0.875rem;
        margin-bottom: 0.35rem;
    }

    /* Inputs & Selects Theme */
    .form-control-custom, .form-select-custom {
        background-color: var(--input-bg) !important;
        border: 1px solid var(--border-soft) !important;
        color: var(--text-dark) !important;
        border-radius: 12px;
        padding: 0.65rem 0.9rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .form-control-custom::placeholder {
        color: var(--text-muted) !important;
        font-weight: 400;
    }

    .form-control-custom:focus, .form-select-custom:focus {
        background-color: #ffffff !important;
        border-color: var(--royal-blue) !important;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15) !important;
        color: var(--text-dark) !important;
    }

    /* Dropdown Options */
    .form-select-custom option {
        background-color: #ffffff;
        color: var(--text-dark);
    }

    /* Input Icons Styling */
    .input-group-text-custom {
        background-color: #e0f2fe !important;
        border: 1px solid #bae6fd !important;
        border-right: none !important;
        color: var(--royal-blue) !important;
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    /* Button Gradient Submit (Aksen Royal Blue) */
    button.btn-gradient-submit {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
        border: none !important;
        color: #ffffff !important;
        padding: 0.65rem 1.75rem;
        border-radius: 50px;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.25);
        transition: all 0.3s ease;
    }

    .btn-gradient-submit:hover {
        background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.35);
        color: #ffffff !important;
    }

    /* Button Secondary Soft */
    a.btn-soft-secondary {
        background-color: #f1f5f9 !important;
        color: var(--text-muted) !important;
        border: 1px solid var(--border-soft) !important;
        padding: 0.65rem 1.75rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-soft-secondary:hover {
        background-color: #e2e8f0 !important;
        color: var(--text-dark) !important;
        border-color: #cbd5e1 !important;
        transform: translateY(-2px);
    }

    /* Avatar Upload Preview Box */
    .avatar-upload-box {
        position: relative;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid var(--royal-blue);
        box-shadow: 0 0 15px rgba(13, 110, 253, 0.2);
        background-color: #f8fafc;
    }

    .avatar-preview-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<div class="row g-3">
    {{-- UPLOAD FOTO PROFIL --}}
    <div class="col-12 mb-2">
        <label class="form-label-custom d-block">Foto Profil</label>
        <div class="d-flex align-items-center gap-3">
            <div class="avatar-upload-box flex-shrink-0">
                <img id="imagePreview"
                     src="{{ isset($user) && $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'User') . '&background=112240&color=64ffda' }}"
                     alt="Preview Foto"
                     class="avatar-preview-img">
            </div>
            <div class="flex-grow-1">
                <input type="file"
                       name="photo"
                       id="photoInput"
                       class="form-control form-control-custom @error('photo') is-invalid @enderror"
                       accept="image/*"
                       onchange="previewPhoto(event)">
                <small style="color: var(--text-slate)" class="d-block mt-1">Format: JPG, JPEG, PNG, WEBP (Maksimal 2MB)</small>
                @error('photo')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    {{-- NAMA USER --}}
    <div class="col-12">
        <label class="form-label-custom">Nama Lengkap</label>
        <div class="input-group">
            <span class="input-group-text input-group-text-custom">
                <i class="bi bi-person-fill"></i>
            </span>
            <input type="text"
                   name="name"
                   class="form-control form-control-custom border-start-0 @error('name') is-invalid @enderror"
                   placeholder="Masukkan nama pengguna..."
                   value="{{ old('name', $user->name ?? '') }}">
        </div>
        @error('name')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- EMAIL --}}
    <div class="col-md-6">
        <label class="form-label-custom">Alamat Email</label>
        <div class="input-group">
            <span class="input-group-text input-group-text-custom">
                <i class="bi bi-envelope-fill"></i>
            </span>
            <input type="email"
                   name="email"
                   class="form-control form-control-custom border-start-0 @error('email') is-invalid @enderror"
                   placeholder="contoh@domain.com"
                   value="{{ old('email', $user->email ?? '') }}">
        </div>
        @error('email')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- PASSWORD --}}
    <div class="col-md-6">
        <label class="form-label-custom">Password</label>
        <div class="input-group">
            <span class="input-group-text input-group-text-custom">
                <i class="bi bi-key-fill"></i>
            </span>
            <input type="password"
                   name="password"
                   class="form-control form-control-custom border-start-0 @error('password') is-invalid @enderror"
                   placeholder="{{ isset($user) ? 'Kosongkan jika tidak diubah' : 'Masukkan password...' }}">
        </div>
        @if(isset($user))
            <small style="color: var(--text-slate)" class="d-block mt-1">Biarkan kosong jika tidak ingin mengganti password.</small>
        @endif
        @error('password')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- ROLE --}}
    <div class="col-12">
        <label class="form-label-custom">Role Access</label>
        <div class="input-group">
            <span class="input-group-text input-group-text-custom">
                <i class="bi bi-shield-lock-fill"></i>
            </span>
            <select name="role_id"
                    class="form-select form-select-custom border-start-0 @error('role_id') is-invalid @enderror">
                <option value="">-- Pilih Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}"
                        @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('role_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- TOMBOL AKSI --}}
<div class="d-flex align-items-center gap-2 mt-4 pt-3 border-top" style="border-color: var(--bg-light-navy) !important;">
    <button class="btn btn-gradient-submit d-inline-flex align-items-center gap-2" type="submit">
        <i class="bi bi-check-circle-fill"></i>
        <span>Simpan User</span>
    </button>
    <a href="{{ route('admin.users') }}" class="btn btn-soft-secondary d-inline-flex align-items-center gap-2">
        <i class="bi bi-arrow-left"></i>
        <span>Kembali</span>
    </a>
</div>

{{-- SCRIPT PREVIEW FOTO --}}
<script>
    function previewPhoto(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
