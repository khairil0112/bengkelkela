<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul ?? 'Sistem Bengkel' }}</title>
    <!-- jQuery (WAJIB sebelum Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        /* ========== RESET & FONT ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6366f1, #06b6d4);
            color: #fff;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #312e81, #4338ca, #06b6d4);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 5px 0 20px rgba(0, 0, 0, 0.2);
        }

        .sidebar h2 {
            text-align: center;
            padding: 25px 0;
            background: rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .nav {
            padding: 15px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .btn-link {
            background: none;
            border: none;
            color: #e0f2fe;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 12px;
            text-align: left;
            width: 100%;
            cursor: pointer;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
        }

        .btn-link:hover,
        .btn-link.active {
            background: linear-gradient(90deg, #06b6d4, #3b82f6);
            box-shadow: 0 0 10px rgba(6, 182, 212, 0.5);
            transform: translateX(8px);
        }

        .logout {
            padding: 15px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logout a {
            color: #fca5a5;
            text-decoration: none;
            font-weight: 600;
        }

        .logout a:hover {
            color: #ef4444;
        }

        /* ========== MAIN AREA ========== */
        .main {
            flex: 1;
            margin-left: 250px;
            padding: 40px;
            position: relative;
            z-index: 1;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 2em;
            background: linear-gradient(90deg, #38bdf8, #f3f1f4ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header p {
            font-weight: 500;
            color: #e0f2fe;
        }

        /* ========== DASHBOARD CARDS ========== */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 25px;
        }

        .card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 25px;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transition: 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            top: -30%;
            right: -30%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at top right, rgba(234, 231, 231, 0.1), transparent 70%);
            transform: rotate(25deg);
            pointer-events: none;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(59, 130, 246, 0.4);
        }

        .card h3 {
            font-size: 1.1em;
            color: #e0f2fe;
            margin-bottom: 8px;
        }

        .card p {
            font-size: 1em;
            font-weight: 600;
            color: #fff;
        }

        /* ========== STATS SECTION ========== */
        .stats {
            margin-top: 40px;
            background: rgba(255, 255, 255, 0.15);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .stats h2 {
            color: #f0f9ff;
            margin-bottom: 20px;
            border-left: 4px solid #06b6d4;
            padding-left: 10px;
        }

        .progress {
            margin-bottom: 15px;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            font-weight: 500;
            color: #e0f2fe;
            margin-bottom: 6px;
        }

        .progress-bar {
            height: 10px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-bar div {
            height: 100%;
            border-radius: 5px;
            background: linear-gradient(90deg, #3b82f6, #06b6d4);
            transition: width 0.6s;
        }

        /* ========== FOOTER ========== */
        footer {
            text-align: center;
            margin-top: 50px;
            font-size: 0.9em;
            color: #cbd5e1;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .nav a span {
                display: none;
            }

            .main {
                margin-left: 70px;
                padding: 20px;
            }
        }

        /* Supaya teks dalam modal terlihat jelas */
        .modal-content {
            color: #000 !important;
        }

        .modal-content .form-label {
            color: #000 !important;
            font-weight: 500;
        }

        /* ========== FORM EDIT STYLE ========== */
        .form-edit {
            background: #ffffff;
            padding: 30px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(79, 78, 78, 0.15);
            max-width: auto;
            margin: 0 auto;
        }

        .form-edit .form-label {
            color: #1e3a8a;
            font-weight: 600;
        }

        .form-edit .form-control,
        .form-edit select {
            border: 2px solid #cbd5e1;
            border-radius: 10px;
            padding: 10px 12px;
            transition: all 0.3s ease;
        }

        .form-edit .form-control:focus,
        .form-edit select:focus {
            border-color: #06b6d4;
            box-shadow: 0 0 8px rgba(6, 182, 212, 0.4);
        }

        .form-edit .btn {
            border-radius: 10px;
            padding: 10px 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        /* Style untuk input readonly */
        .form-control[readonly] {
            background-color: #f1f5f9 !important;
            /* abu-abu lembut */
            color: #000000ff;
            /* teks abu-abu sedang */
            border-color: #cbd5e1;
            cursor: not-allowed;
            /* ubah cursor jadi tanda tidak bisa klik */
            opacity: 0.9;
            /* sedikit fade */
        }

        .form-control[readonly]:focus {
            box-shadow: none;
            /* hilangkan efek fokus biru */
        }

        .form-edit .btn-primary {
            background: linear-gradient(90deg, #06b6d4, #3b82f6);
            border: none;
        }

        .form-edit .btn-primary:hover {
            background: linear-gradient(90deg, #3b82f6, #06b6d4);
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.5);
        }

        .form-edit .btn-secondary {
            background: #e2e8f0;
            color: #1e293b;
            border: none;
        }

        .form-edit .btn-secondary:hover {
            background: #cbd5e1;
        }

        .form-edit .row>div {
            margin-bottom: 15px;
        }

        .option {
            color: #000;
        }

        .select2-container .select2-selection--single {
            background-color: #fff !important;
            color: #000 !important;
            height: 38px;
            padding-top: 5px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #000 !important;
        }

        /* ========================================== FIX WARNA TEKS UNTUK SELECT2 ========================================== */
        .select2-container--default .select2-selection--single {
            background-color: #fff !important;
            border: 1px solid #cbd5e1 !important;
            height: 42px !important;
            display: flex;
            align-items: center;
        }

        /* warna teks yang tampil setelah memilih */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #000 !important;
        }

        /* warna placeholder */
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #555 !important;
        }

        /* warna teks di dropdown */
        .select2-container--default .select2-results__option {
            color: #000 !important;
        }
    </style>
</head>

<body>
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div>
            <h2 style="font-size: 1.5rem"><b>🧰 Bengkel Kelaa</b></h2>
            <div class="nav">
                <form action="{{ url('/') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-link {{ Request::is('/') ? 'active' : '' }}">
                        🏠 Dashboard
                    </button>
                </form>

                <form action="{{ url('pelanggan') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-link {{ Request::is('pelanggan') ? 'active' : '' }}">
                        👥 Pelanggan
                    </button>
                </form>

                <form action="{{ url('pemasok') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-link {{ Request::is('pemasok') ? 'active' : '' }}">
                        🚚 Pemasok
                    </button>
                </form>

                <form action="{{ url('part') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-link {{ Request::is('part') ? 'active' : '' }}">
                        🔩 Part
                    </button>
                </form>

                <form action="{{ url('/jasa') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-link {{ Request::is('jasa') ? 'active' : '' }}">
                        🛠️ Jasa
                    </button>
                </form>

                <form action="{{ url('/satuan') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-link {{ Request::is('satuan') ? 'active' : '' }}">
                        📦 Satuan
                    </button>
                </form>

                <form action="{{ url('/mekanik') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-link {{ Request::is('mekanik') ? 'active' : '' }}">
                        🪛 Mekanik
                    </button>
                </form>

                <form action="{{ url('/penjualan') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-link {{ Request::is('penjualan') ? 'active' : '' }}">
                        🛒⬅️ Penjualan
                    </button>
                </form>

                <form action="{{ url('laporan/rekap') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-link {{ Request::is('laporan/rekap') ? 'active' : '' }}">
                        📊 laporan penjualan
                    </button>
                </form>
                <form action="{{ url('/pembelian') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-link {{ Request::is('pembelian') ? 'active' : '' }}">
                        ➡️💵 pembelian
                    </button>

                </form>
            </div>
        </div>

        <div class="logout">
            <a href="#">🚪 Log Out</a>
        </div>
    </div>

    {{-- 🧾 MAIN CONTENT --}}
    <div class="main">
        @yield('content')

        {{-- ⚙️ FOOTER --}}
        <!-- <footer>
        <p class="mb-0">&copy; {{ date('Y') }} Sistem Bengkel | Dikembangkan oleh Khayla</p>
    </footer> -->

        {{-- Bootstrap JS --}}

        <footer>© 2025 Bengkel kela Dirancang oleh Khayla </footer>
    </div>

    <script>
        const tgl = new Date();
        document.getElementById("tanggal").textContent =
            tgl.toLocaleDateString("id-ID", {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
