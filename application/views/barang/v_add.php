<div class="col-md-12">
  <!-- general form elements disabled -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Form Add Barang</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php
        echo validation_errors('<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i>','</h5> </div>');
        //Gagal Upload
        if (isset($error_upload)) {
          echo '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i>'.$error_upload . '</h5> </div>';
        }
      echo form_open_multipart('barang/add') ?>
      <div class="form-group">
        <label>Nama Barang</label>
        <input type="text" class="form-control" placeholder="Nama Barang..." name="nama_barang" value="<?= set_value('nama_barang') ?>">
      </div>
      <div class="row">
        <div class="col-sm-4">
          <!-- text input -->
          <div class="form-group">
            <label>Kategori</label>
            <select class="form-control" name="id_kategori">
              <option value="">-- Pilih Kategori --</option>
              <?php foreach ($kategori as $key => $value): ?>
                <option value="<?= $value->id_kategori ?>"><?= $value->nama_kategori ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>Harga Barang</label>
            <input type="text" class="form-control" placeholder="Harga Barang..." name="harga" value="<?= set_value('harga') ?>">
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>Berat Barang (gr)</label>
            <input type="number" min="0" class="form-control" placeholder="Berat Barang Dalam Satuan Gram..." name="berat" value="<?= set_value('berat') ?>">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>Deskripsi Barang</label>
        <textarea name="deskripsi" cols="80" rows="5" class="form-control"><?= set_value('deskripsi') ?></textarea>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Gambar Barang</label>
            <input type="file" class="form-control" name="gambar" required id="preview_gambar">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <img src="<?= base_url('assets/uploads/no-photo.jpeg') ?>" width="200" id="gambar_load">
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-sm btn-primary">Simpan Data</button>
          <a href="<?= base_url('barang') ?>" class="btn btn-sm btn-warning">Kembali</a>
        </div>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  function bacaGambar(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#gambar_load').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#preview_gambar").change(function () {
    bacaGambar(this);
  })
</script>
