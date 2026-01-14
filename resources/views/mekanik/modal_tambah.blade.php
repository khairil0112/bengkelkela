<!-- Modal Tambah Part -->
<div class="modal fade" id="modalTambahMekanik" tabindex="-1" aria-labelledby="modalTambahMekanikLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalTambahMekanikLabel">Tambah Data Mekanik</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="{{ url('mekanik/store') }}" method="POST">
          @csrf
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Kode</label>
              <input type="text" name="kode" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Nama Mekanik</label>
              <input type="text" name="namamk" id="namamk" class="form-control" required>
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
