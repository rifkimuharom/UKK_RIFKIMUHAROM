@extends('layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>

    <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="p-6 bg-slate-50 min-h-screen font-sans space-y-6">

            @if(session('success'))
                <div class="p-4 bg-green-100 border border-green-300 text-green-800 rounded-xl flex justify-between items-center text-sm font-semibold">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="text-green-800 font-bold">×</button>
                </div>
            @endif

            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Pengaturan Aplikasi & Brand</h1>
                    <p class="text-sm text-gray-500">Sesuaikan identitas toko, informasi struk, dan perpajakan</p>
                </div>
                <button type="submit"
                    class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-xl shadow-md transition active:scale-95 cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
                <div class="xl:col-span-3 bg-white p-3 rounded-2xl border border-gray-100 shadow-sm space-y-1 h-fit">
                    <button type="button" onclick="switchTab('toko')" id="tab-toko"
                        class="tab-btn w-full text-left px-4 py-2.5 rounded-xl text-sm font-semibold bg-blue-50 text-blue-600 transition">
                        Profil Toko
                    </button>
                    <button type="button" onclick="switchTab('logos')" id="tab-logos"
                        class="tab-btn w-full text-left px-4 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                        Logo Aplikasi
                    </button>
                    <button type="button" onclick="switchTab('struk')" id="tab-struk"
                        class="tab-btn w-full text-left px-4 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                        Tampilan Struk & Pajak
                    </button>
                </div>

                <div class="xl:col-span-6 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <div id="content-toko" class="tab-content space-y-4">
                        <div class="border-b border-gray-100 pb-3">
                            <h2 class="text-lg font-bold text-gray-800">Identitas Toko</h2>
                            <p class="text-xs text-gray-500">Informasi utama mengenai unit usaha Anda</p>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Toko / Brand</label>
                                <input type="text" name="nama_toko"
                                    value="{{ old('nama_toko', $setting->nama_toko) }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Alamat Toko</label>
                                <textarea name="alamat" rows="3"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('alamat', $setting->alamat) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor Telepon / WhatsApp</label>
                                <input type="text" name="telepon"
                                    value="{{ old('telepon', $setting->telepon) }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <div id="content-logos" class="tab-content hidden space-y-4">
                        <div class="border-b border-gray-100 pb-3">
                            <h2 class="text-lg font-bold text-gray-800">Logo Aplikasi</h2>
                            <p class="text-xs text-gray-500">Upload logo utama toko Anda</p>
                        </div>
                        @if ($setting->logo)
                            <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo toko" class="h-16 object-contain mb-3">
                        @endif
                        <label class="block border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer hover:border-blue-500 transition bg-slate-50">
                            <p class="text-sm font-semibold text-gray-600" id="dropzone-text">Klik untuk upload Logo Toko Baru</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG up to 2MB</p>
                            <input name="logo" type="file" class="hidden" accept="image/*" onchange="previewImage(this)">
                        </label>
                    </div>

                    <div id="content-struk" class="tab-content hidden space-y-4">
                        <div class="border-b border-gray-100 pb-3">
                            <h2 class="text-lg font-bold text-gray-800">Tampilan Struk & Perpajakan</h2>
                            <p class="text-xs text-gray-500">Atur pesan nota dan persentase pajak</p>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Pajak Pertambahan Nilai / PPN (%)</label>
                                <input type="number" step="0.1" name="ppn"
                                    value="{{ old('ppn', $setting->ppn) }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Footer Struk</label>
                                <input type="text" name="footer_struk"
                                    value="{{ old('footer_struk', $setting->footer_struk) }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="xl:col-span-3 bg-white p-5 rounded-2xl border border-gray-100 shadow-sm h-fit space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse"></span>
                        <span class="text-xs font-bold text-gray-400 uppercase">Live Preview Struk</span>
                    </div>
                    <div class="bg-slate-100 p-3 rounded-xl">
                        <div class="bg-white p-4 rounded-t-sm shadow font-mono text-[11px] text-gray-700 space-y-2 border-t-4 border-blue-600">
                            <div class="text-center space-y-0.5">
                                <p class="font-bold text-xs uppercase text-gray-900" id="preview-nama-toko">{{ $setting->nama_toko }}</p>
                                <p class="text-[9px] text-gray-500 leading-tight" id="preview-alamat">{{ $setting->alamat }}</p>
                                <p class="text-[9px] text-gray-500" id="preview-telepon">Telp: {{ $setting->telepon }}</p>
                                <div class="border-b border-dashed border-gray-300 my-1"></div>
                                <p class="font-semibold text-[10px]">Selamat Datang Di {{ $setting->nama_toko }}</p>
                            </div>
                            <div class="border-b border-dashed border-gray-300 my-2"></div>
                            <div class="space-y-1">
                                <div class="flex justify-between"><span>Kopi Susu</span><span>18.000</span></div>
                                <div class="flex justify-between"><span>Roti Bakar</span><span>15.000</span></div>
                            </div>
                            <div class="border-b border-dashed border-gray-300 my-2"></div>
                            <div class="space-y-1 text-[10px]">
                                <div class="flex justify-between text-gray-500"><span>Subtotal</span><span>33.000</span></div>
                                <div class="flex justify-between text-gray-500">
                                    <span id="preview-pajak-label">Pajak ({{ $setting->ppn }}%)</span>
                                    <span id="preview-pajak-val">0</span>
                                </div>
                                <div class="flex justify-between font-bold text-xs text-gray-900 pt-1 border-t border-gray-200">
                                    <span>TOTAL</span>
                                    <span id="preview-total">33.000</span>
                                </div>
                            </div>
                            <div class="border-b border-dashed border-gray-300 my-2"></div>
                            <div class="text-center pt-1">
                                <p class="text-[10px] italic text-gray-600" id="preview-footer">{{ $setting->footer_struk }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function switchTab(tabName) {
            ['toko', 'logos', 'struk'].forEach(t => {
                const btn = document.getElementById(`tab-${t}`);
                const content = document.getElementById(`content-${t}`);
                if (t === tabName) {
                    btn.className = "tab-btn w-full text-left px-4 py-2.5 rounded-xl text-sm font-semibold bg-blue-50 text-blue-600 transition";
                    content.classList.remove('hidden');
                } else {
                    btn.className = "tab-btn w-full text-left px-4 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition";
                    content.classList.add('hidden');
                }
            });
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                document.getElementById('dropzone-text').innerText = 'Terpilih: ' + input.files[0].name;
            }
        }

        const map = {
            'nama_toko': 'preview-nama-toko',
            'alamat': 'preview-alamat',
            'footer_struk': 'preview-footer'
        };

        Object.keys(map).forEach(key => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input) {
                input.addEventListener('input', (e) => {
                    document.getElementById(map[key]).innerText = e.target.value || '-';
                });
            }
        });

        const telpInput = document.querySelector('[name="telepon"]');
        if (telpInput) {
            telpInput.addEventListener('input', (e) => {
                document.getElementById('preview-telepon').innerText = 'Telp: ' + (e.target.value || '-');
            });
        }

        const pajakInput = document.querySelector('[name="ppn"]');
        if (pajakInput) {
            const refreshTax = () => {
                const rate = parseFloat(pajakInput.value) || 0;
                const sub = 33000;
                const tax = Math.round(sub * (rate / 100));
                document.getElementById('preview-pajak-label').innerText = `Pajak (${rate}%)`;
                document.getElementById('preview-pajak-val').innerText = tax.toLocaleString('id-ID');
                document.getElementById('preview-total').innerText = (sub + tax).toLocaleString('id-ID');
            };
            pajakInput.addEventListener('input', refreshTax);
            refreshTax();
        }
    </script>
@endsection