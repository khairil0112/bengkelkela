<!-- Modal Tambah Part -->
<div class="modal fade" id="modalTambahPart" tabindex="-1" aria-labelledby="modalTambahPartLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalTambahPartLabel">Tambah Data Part</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="{{ url('part/store') }}" method="POST">
          @csrf
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Kode Part</label>
              <input type="text" name="kode" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Nama Part</label>
              <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Satuan</label>
              <select name="idsatuan" class="form-select" required>
                <option value="">-- Pilih Satuan --</option>
                @foreach ($satuan as $s)
                  <option value="{{ $s->idsatuan }}">{{ $s->nama }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">No Seri</label>
              <input type="text" name="noseri" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Stok Awal</label>
              <input type="number" name="stokawal" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
              <label for="idkategori" class="form-label">Kategori</label>
              <select name="idkategori" id="idkategori" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                <option value="{{ $k->idkategori }}"
                {{ old('idkategori', $part->idkategori ?? '') == $k->idkategori ? 'selected' : '' }}>
                {{ $k->nama }}
                </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Jenis</label>
              <select name="idjenis" class="form-select" required>
                <option value="">-- Pilih Jenis --</option>
                @foreach ($jenis as $j)
                  <option value="{{ $j->idjenis }}">{{ $j->nama }}</option>
                @endforeach
              </select>
            </div>            

            <div class="col-md-6 mb-3">
              <label class="form-label">Harga Awal</label>
              <input type="number" name="hargaawal" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Harga Rata-Rata</label>
              <input type="number" name="hargarata" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Harga Terakhir</label>
              <input type="number" name="hbterakhir" class="form-control" required>
            </div>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
