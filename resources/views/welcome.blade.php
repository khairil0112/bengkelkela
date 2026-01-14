<!-- SIDEBAR -->
  <!-- <div class="sidebar">
    <div>
      <h2>🧰 Bengkel Kelaa</h2>
      <div class="nav">
        <form action="{{ url('/') }}" method="POST">
          @csrf
          <button type="submit" class="btn-link active">🏠 Dashboard</button>
        </form>

        <form action="{{ url('pelanggan') }}" method="get">
          @csrf
          <button type="submit" class="btn-link">👥 Pelanggan</button>
        </form>

        <form action="#" method="POST">
          @csrf
          <button type="submit" class="btn-link">🚚 Pemasok</button>
        </form>

        <form action="{{ url('part') }}" method="POST">
          @csrf
          <button type="submit" class="btn-link">🔩 Part</button>
        </form>

        <form action="#" method="POST">
          @csrf
          <button type="submit" class="btn-link">🛠️ Jasa</button>
        </form>

        <form action="#" method="POST">
          @csrf
          <button type="submit" class="btn-link">📦 Satuan</button>
        </form>
      </div>
    </div>

    <div class="logout">
      <a href="#">🚪 Log Out</a>
    </div>
  </div> -->
@extends('layouts.app')

@section('content')
  <!-- MAIN -->
    <div class="header">
      <h1>Selamat Datang di Bengkel Kami 🌸</h1>
      <p><strong>Tanggal:</strong> <span id="tanggal"></span></p>
    </div>

    <div class="cards">
      <div class="card">
        <h3>Total Pelanggan</h3>
        <p>125 Terdaftar</p>
      </div>
      <div class="card">
        <h3>Total Pemasok</h3>
        <p>12 Aktif</p>
      </div>
      <div class="card">
        <h3>Jumlah Part</h3>
        <p>350 Item</p>
      </div>
      <div class="card">
        <h3>Jenis Jasa</h3>
        <p>25 Layanan</p>
      </div>
      <div class="card">
        <h3>Transaksi Hari Ini</h3>
        <p>18 Selesai</p>
      </div>
    </div>

    
    
</body>
</html>
@endsection
