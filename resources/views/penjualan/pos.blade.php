@extends('layouts.app')

@section('title', 'Sistem Kasir (POS)')

@section('content')

    <style>
        /* 1. Base Body Light Mode Clean */
        body {
            background-color: #f1f5f9 !important;
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif !important;
            color: #1e293b !important;
        }

        /* 2. Banner Header Atas Solid Blue */
        .banner-dark-gradient {
            background: #0d6efd !important;
            border: none !important;
            border-radius: 12px !important;
        }

        .banner-dark-gradient * {
            color: #ffffff !important;
        }

        /* 3. Kartu Utama & Container Putih Solid Polos */
        .pos-card-white {
            background-color: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 14px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
        }

        .pos-card-white,
        .pos-card-white * {
            color: #1e293b !important;
        }

        .pos-card-white .text-price {
            color: #0d6efd !important;
            font-weight: 700 !important;
        }

        .pos-card-white .text-muted-custom,
        .pos-card-white small {
            color: #64748b !important;
        }

        /* 4. Input & Search Bar Clean */
        .input-pos-light {
            background-color: #f8fafc !important;
            border: 1px solid #cbd5e1 !important;
            color: #1e293b !important;
            border-radius: 8px !important;
        }

        .input-pos-light:focus {
            border-color: #0d6efd !important;
            background-color: #ffffff !important;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15) !important;
        }

        /* 5. Item Produk Katalog */
        .product-select-btn {
            background-color: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
        }

        .product-select-btn:hover {
            border-color: #0d6efd !important;
            background-color: #eff6ff !important;
        }

        /* 6. Box Total Belanja */
        .total-receipt-box-light {
            background-color: #f0f7ff !important;
            border: 1px solid #bfdbfe !important;
            border-radius: 10px !important;
        }

        .total-receipt-box-light * {
            color: #0d6efd !important;
        }

        /* 7. Tombol Utama Solid */
        .btn-cyan {
            background-color: #0d6efd !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            border: none !important;
            border-radius: 8px !important;
            transition: all 0.3s ease;
        }

        .btn-cyan:hover {
            background-color: #0b5ed7 !important;
        }

        /* Animasi Masuk Kartu Bank */
        @keyframes fadeInUpCard {
            from {
                opacity: 0;
                transform: translateY(12px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animated-bank-card {
            animation: fadeInUpCard 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Styling Kartu Bank Virtual */
        .virtual-credit-card {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 50%, #032830 100%);
            color: #ffffff;
            border-radius: 16px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(13, 110, 253, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .virtual-credit-card::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 50%;
            pointer-events: none;
        }

        .virtual-credit-card::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -30px;
            width: 180px;
            height: 180px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            pointer-events: none;
        }

        .chip-icon {
            width: 38px;
            height: 28px;
            background: linear-gradient(135deg, #fcd34d, #f59e0b);
            border-radius: 6px;
            position: relative;
            display: inline-block;
        }

        .btn-processing {
            pointer-events: none;
            opacity: 0.9;
        }

        @keyframes pulseEffect {
            0% { transform: scale(1); }
            50% { transform: scale(0.98); }
            100% { transform: scale(1); }
        }

        .animate-pulse {
            animation: pulseEffect 0.6s infinite ease-in-out;
        }
    </style>

    <div class="container py-4">

        {{-- HEADER BANNER GRADIENT --}}
        <div class="banner-dark-gradient p-4 p-md-5 rounded-4 mb-4 position-relative overflow-hidden shadow-sm">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 position-relative" style="z-index: 1;">
                <div>
                    <h2 class="fw-bold mb-1 d-flex align-items-center gap-2">
                        <i class="bi bi-calculator-fill fs-2" style="color: #34d399 !important;"></i> Transaksi Kasir (POS)
                    </h2>
                    <p class="opacity-75 small mb-0">Pilih item barang di sebelah kiri dan kelola keranjang belanja di sebelah kanan.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('penjualan.index') }}" class="btn btn-outline-light rounded-pill px-4 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-arrow-left"></i>
                        <span>Riwayat Transaksi</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4">

            {{-- KATALOG PRODUK --}}
            <div class="col-lg-6">
                <div class="pos-card-white p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-grid-fill" style="color: #10b981 !important;"></i> Katalog Produk
                        </h5>
                        <span class="badge bg-success text-white px-3 py-1 rounded-pill small">
                            {{ count($products) }} Barang
                        </span>
                    </div>

                    {{-- Form Pencarian Produk --}}
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 rounded-start-pill ps-3 bg-light" style="border: 1px solid #94a3b8; border-right: none;">
                                <i class="bi bi-search" style="color: #10b981 !important;"></i>
                            </span>
                            <input type="text" id="searchInput"
                                class="form-control border-start-0 rounded-end-pill ps-0 input-pos-light shadow-none"
                                placeholder="Cari nama produk..." onkeyup="filterProducts()">
                        </div>
                    </div>

                    <div class="pe-1" style="max-height: 60vh; overflow-y: auto;">
                        <div class="d-flex flex-column gap-2" id="productList">
                            @forelse($products as $product)
                                <div class="product-item" data-name="{{ strtolower($product->nama) }}">
                                    <form method="POST" action="{{ route('itempenjualan.store') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <div class="p-2.5 rounded-3 product-select-btn">
                                            <div class="row align-items-center g-2">
                                                <div class="col-7">
                                                    <div class="d-flex align-items-center gap-3">
                                                        @if($product->foto)
                                                            <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" class="rounded-3 shadow-sm border" style="width:44px; height:44px; object-fit:cover;">
                                                        @else
                                                            <div class="rounded-3 shadow-sm d-flex align-items-center justify-content-center bg-light border fw-bold" style="width:44px; height:44px;">
                                                                <i class="bi bi-box-seam fs-5" style="color: #10b981 !important;"></i>
                                                            </div>
                                                        @endif
                                                        <div class="text-truncate">
                                                            <div class="fw-bold text-truncate small">{{ $product->nama }}</div>
                                                            <div class="text-price small">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm text-center input-pos-light rounded-pill shadow-none">
                                                </div>

                                                <div class="col-2 text-end">
                                                    <button type="submit" class="btn btn-sm btn-cyan rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 34px; height: 34px;" title="Tambah ke Keranjang">
                                                        <i class="bi bi-plus-lg fw-bold" style="color: #ffffff !important;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted">
                                    <i class="bi bi-box-seam fs-1 d-block mb-2"></i>
                                    <span>Produk tidak ditemukan.</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- KERANJANG BELANJA --}}
            <div class="col-lg-6">
                <div class="pos-card-white p-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0 d-flex align-items-center gap-2">
                                <i class="bi bi-cart3" style="color: #10b981 !important;"></i> Keranjang
                                <span class="badge rounded-pill bg-danger fs-6 fw-normal px-2" style="font-size: 0.75rem !important;">
                                    {{ $sale->itemPenjualan->sum('kuantitas') }} Item
                                </span>
                            </h5>
                            <span class="badge bg-success text-white px-3 py-1 rounded-pill fw-semibold">
                                Transaksi #{{ $sale->id }}
                            </span>
                        </div>

                        {{-- Tabel Item Keranjang --}}
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr style="border-bottom: 2px solid #64748b;">
                                        <th class="ps-2">PRODUK</th>
                                        <th>HARGA</th>
                                        <th style="width: 20%;">QTY</th>
                                        <th>SUBTOTAL</th>
                                        <th class="pe-2 text-end" style="width: 10%;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sale->itemPenjualan as $item)
                                        <tr style="border-bottom: 1px solid #cbd5e1;">
                                            <td class="ps-2">
                                                <span class="fw-bold small d-block">{{ $item->produk->nama }}</span>
                                            </td>
                                            <td class="small text-muted-custom">
                                                Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="quantity" value="{{ $item->kuantitas }}" min="1" onchange="this.form.submit()" class="form-control form-control-sm text-center input-pos-light rounded-2 shadow-none">
                                                </form>
                                            </td>
                                            <td class="text-price small">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </td>
                                            <td class="pe-2 text-end">
                                                <form action="{{ route('itempenjualan.destroy', $item->id) }}" method="POST" class="d-inline delete-item-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle d-inline-flex align-items-center justify-content-center btn-delete-item" style="width: 32px; height: 32px;">
                                                        <i class="bi bi-trash-fill small"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="bi bi-cart-x fs-1 d-block mb-2"></i>
                                                <span>Keranjang belanja masih kosong.</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- TOTAL & CHECKOUT --}}
                    <div class="mt-4 pt-3 border-top" style="border-top-color: #cbd5e1 !important;">
                        <div class="total-receipt-box-light p-3 mb-3 text-center">
                            <span class="small text-uppercase fw-bold d-block mb-1 text-muted-custom">Total Pembayaran</span>
                            <h2 class="fw-bold mb-0 text-price" style="font-size: 2.2rem;">
                                Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                            </h2>
                        </div>

                        <form id="checkoutForm" method="POST" action="{{ route('penjualan.update', $sale->id) }}">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="bayar" id="inputBayarHidden" value="{{ $sale->total_pembayaran }}">

                            <div class="mb-3">
                                <select id="paymentMethodSelect" name="payment_method" onchange="handlePaymentMethodChange()" class="form-select input-pos-light rounded-pill px-3 shadow-none" required>
                                    <option value="">-- Pilih Metode Pembayaran --</option>
                                    <option value="CASH" @selected($sale->metode_pembayaran === 'CASH')>Cash / Tunai</option>
                                    <option value="QRIS" @selected($sale->metode_pembayaran === 'QRIS')>QRIS (Scan Barcode)</option>
                                    <option value="TRANSFER" @selected($sale->metode_pembayaran === 'TRANSFER')>Transfer Bank</option>
                                </select>
                            </div>

                            {{-- ANIMATED BANK CARD CONTAINER --}}
                            <div id="bankCardContainer" class="mb-3 d-none">
                                <div class="virtual-credit-card animated-bank-card">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="chip-icon"></div>
                                        <span class="fw-black fs-4 fst-italic tracking-wider text-white">BCA</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="d-block text-white-50 text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Nomor Rekening</span>
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <span class="fw-bold font-monospace fs-5 tracking-widest" id="accountNumber">8830-1928-3012</span>
                                            <button type="button" onclick="copyRekening()" class="btn btn-sm btn-light text-primary rounded-pill px-2.5 py-0.5 fw-semibold shadow-sm" style="font-size: 0.75rem;">
                                                <i class="bi bi-copy me-1"></i><span id="copyBtnText">Salin</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="pt-1">
                                        <span class="d-block text-white-50 text-uppercase" style="font-size: 0.65rem; letter-spacing: 1px;">Atas Nama</span>
                                        <span class="fw-semibold text-white small">POS STORE / KASIR UTAMA</span>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="btnCheckout" onclick="handleCheckout()" class="btn btn-cyan w-100 rounded-pill py-2.5 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2 position-relative overflow-hidden">
                                <i id="iconCheckout" class="bi bi-check-circle-fill text-white"></i>
                                <span id="textCheckout" class="text-white">Selesaikan & Checkout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- MODAL PEMBAYARAN CASH / TUNAI --}}
    <div class="modal fade" id="cashModal" tabindex="-1" aria-labelledby="cashModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="cashModalLabel">
                        <i class="bi bi-cash-stack text-success fs-4"></i> Pembayaran Tunai (Cash)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="total-receipt-box-light p-3 mb-3 text-center">
                        <span class="small text-uppercase fw-bold text-muted d-block">Total Harus Dibayar</span>
                        <h3 class="fw-bold text-primary mb-0">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</h3>
                    </div>

                    <div class="mb-3">
                        <label for="cashInput" class="form-label fw-bold small text-secondary">Nominal Uang Diterima (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text fw-bold bg-light">Rp</span>
                            <input type="number" id="cashInput" class="form-control form-control-lg fw-bold text-dark shadow-none" placeholder="0" oninput="calculateChange()">
                        </div>
                    </div>

                    {{-- Quick Money Buttons --}}
                    <div class="d-flex gap-2 mb-3 flex-wrap">
                        <button type="button" onclick="setCashAmount({{ $sale->total_pembayaran }})" class="btn btn-sm btn-outline-primary rounded-pill fw-semibold">Uang Pas</button>
                        <button type="button" onclick="setCashAmount(10000)" class="btn btn-sm btn-outline-secondary rounded-pill">10.000</button>
                        <button type="button" onclick="setCashAmount(20000)" class="btn btn-sm btn-outline-secondary rounded-pill">20.000</button>
                        <button type="button" onclick="setCashAmount(50000)" class="btn btn-sm btn-outline-secondary rounded-pill">50.000</button>
                        <button type="button" onclick="setCashAmount(100000)" class="btn btn-sm btn-outline-secondary rounded-pill">100.000</button>
                    </div>

                    {{-- Kembalian Display --}}
                    <div class="p-3 bg-light rounded-3 d-flex justify-content-between align-items-center border">
                        <span class="fw-bold text-muted small text-uppercase">Kembalian</span>
                        <span id="changeDisplay" class="fw-bold fs-5 text-danger">Rp 0</span>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4 d-flex gap-2">
                    <button type="button" class="btn btn-light rounded-pill w-50 py-2 fw-semibold" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="confirmCashBtn" onclick="confirmCashPayment()" class="btn btn-success rounded-pill w-50 py-2 fw-bold shadow-sm" disabled>Bayar Sekarang</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PEMBAYARAN QRIS --}}
    <div class="modal fade" id="qrisModal" tabindex="-1" aria-labelledby="qrisModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="qrisModalLabel">
                        <i class="bi bi-qr-code-scan text-primary fs-4"></i> Pembayaran QRIS
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <p class="text-muted small mb-2">Pindai kode QRIS berikut menggunakan E-Wallet atau M-Banking:</p>

                    <div class="p-3 bg-white d-inline-block rounded-4 border shadow-sm my-2">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=POS-PAYMENT-{{ $sale->id }}" alt="QRIS Code" class="img-fluid" style="width: 180px;">
                    </div>

                    <div class="mt-2">
                        <span class="small text-uppercase fw-bold text-muted d-block">Total Nominal</span>
                        <h3 class="fw-bold text-primary mb-0">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</h3>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4 justify-content-center d-flex gap-2">
                    <button type="button" class="btn btn-light rounded-pill w-50 py-2 fw-semibold" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick="confirmQrisPayment()" class="btn btn-success rounded-pill w-50 py-2 fw-bold shadow-sm">
                        <i class="bi bi-check-circle me-1"></i> Konfirmasi Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const totalAmount = {{ $sale->total_pembayaran }};

        function filterProducts() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const items = document.querySelectorAll('.product-item');

            items.forEach(item => {
                const name = item.getAttribute('data-name');
                if (name.includes(input)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        }

        function handlePaymentMethodChange() {
            const paymentMethod = document.getElementById('paymentMethodSelect').value;
            const bankCard = document.getElementById('bankCardContainer');

            if (paymentMethod === 'TRANSFER') {
                bankCard.classList.remove('d-none');
            } else {
                bankCard.classList.add('d-none');
            }
        }

        function copyRekening() {
            const accNum = document.getElementById('accountNumber').innerText.replace(/-/g, '');
            navigator.clipboard.writeText(accNum).then(() => {
                const copyBtnText = document.getElementById('copyBtnText');
                copyBtnText.innerText = 'Tersalin!';
                setTimeout(() => {
                    copyBtnText.innerText = 'Salin';
                }, 2000);
            });
        }

        function handleCheckout() {
            const paymentMethod = document.getElementById('paymentMethodSelect').value;

            if (!paymentMethod) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Silakan pilih metode pembayaran terlebih dahulu!',
                    confirmButtonColor: '#0d6efd'
                });
                return;
            }

            if (totalAmount <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Keranjang Kosong',
                    text: 'Silakan tambahkan minimal 1 produk ke keranjang.',
                    confirmButtonColor: '#0d6efd'
                });
                return;
            }

            if (paymentMethod === 'CASH') {
                const cashModal = new bootstrap.Modal(document.getElementById('cashModal'));
                document.getElementById('cashInput').value = '';
                calculateChange();
                cashModal.show();
            } else if (paymentMethod === 'QRIS') {
                const qrisModal = new bootstrap.Modal(document.getElementById('qrisModal'));
                qrisModal.show();
            } else if (paymentMethod === 'TRANSFER') {
                document.getElementById('inputBayarHidden').value = totalAmount;
                submitCheckoutForm();
            }
        }

        function setCashAmount(amount) {
            document.getElementById('cashInput').value = amount;
            calculateChange();
        }

        function calculateChange() {
            const cashVal = parseFloat(document.getElementById('cashInput').value) || 0;
            const change = cashVal - totalAmount;
            const changeDisplay = document.getElementById('changeDisplay');
            const confirmBtn = document.getElementById('confirmCashBtn');

            if (change >= 0) {
                changeDisplay.className = "fw-bold fs-5 text-success";
                changeDisplay.innerText = "Rp " + change.toLocaleString('id-ID');
                confirmBtn.disabled = false;
            } else {
                changeDisplay.className = "fw-bold fs-5 text-danger";
                changeDisplay.innerText = "Kurang Rp " + Math.abs(change).toLocaleString('id-ID');
                confirmBtn.disabled = true;
            }
        }

        function confirmCashPayment() {
            const cashVal = parseFloat(document.getElementById('cashInput').value) || 0;
            document.getElementById('inputBayarHidden').value = cashVal;
            submitCheckoutForm();
        }

        function confirmQrisPayment() {
            document.getElementById('inputBayarHidden').value = totalAmount;
            submitCheckoutForm();
        }

        function submitCheckoutForm() {
            const btn = document.getElementById('btnCheckout');
            btn.classList.add('btn-processing', 'animate-pulse');
            document.getElementById('textCheckout').innerText = "Memproses...";
            document.getElementById('checkoutForm').submit();
        }
    </script>
@endpush