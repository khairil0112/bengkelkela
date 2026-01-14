<!-- Modal Tambah Part -->
<div class="modal fade" id="modalTambahPelanggan" tabindex="-1" aria-labelledby="modalTambahPelangganLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalTambahPelangganLabel">Tambah Data Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="{{ url('pelanggan/store') }}" method="POST">
          @csrf
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Kode Pelanggan</label>
              <input type="text" name="kode" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Nama Pelanggan</label>
              <input type="text" name="nama" id="nama" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Nama Motor</label>
              <input type="text" name="namamotor" id="namamotor" class="form-control" required>
            </div>
            
            <div class="col-md-6 mb-3">
              <label class="form-label">No Polisi</label>
              <input type="text" name="nopol" id="nopol" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Tahun</label>
              <input type="number" name="tahun" id="tahun" class="form-control" required>
            </div>                            

            <div class="col-md-6 mb-3">
              <label class="form-label">Alamat</label>
              <input type="text" name="alamat" id="alamat" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">No Hp</label>
              <input type="number" name="hp" id="hp" class="form-control" required>
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
