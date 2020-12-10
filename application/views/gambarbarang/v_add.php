<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add Foto Barang : <?= $barang->nama_barang ?></h3>

      <div class="card-tools">
        <a href="<?= base_url('barang/add') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Barang</a>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php
        if ($this->session->flashdata('pesan')) {
          echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i></h5>';
          echo $this->session->flashdata('pesan');
          echo '</div>';
        }
      ?>
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
      echo form_open_multipart('gambarbarang/add/'.$barang->id_barang) ?>
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label>Keterangan Foto</label>
            <input type="text" class="form-control" placeholder="Keterangan Foto" name="ket" value="<?= set_value('ket') ?>">
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>Gambar Barang</label>
            <input type="file" class="form-control" name="gambar" required id="preview_gambar">
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <img src="<?= base_url('assets/uploads/no-photo.jpeg') ?>" width="200" id="gambar_load">
          </div>
        </div>
      </div>
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-sm btn-primary">Simpan Data</button>
        <a href="<?= base_url('gambarbarang') ?>" class="btn btn-sm btn-warning">Kembali</a>
      </div>

      <?php echo form_close() ?>
      <hr>
      <div class="row">
        <?php foreach ($gambarbarang as $key => $value): ?>
          <div class="col-sm-3">
            <div class="form-group">
              <img src="<?= base_url('assets/gambar/'.$value->gambar) ?>" width="200" id="gambar_load">
            </div>
            <p>Keterangan Foto : <?= $value->ket ?></p>
          <button class="btn btn-danger btn-xs btn-block" data-toggle="modal" data-target="#delete<?= $value->id_gambar ?>"><i class="fas fa-trash-alt"></i></button>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->

<!-- Modal Delete -->
<?php foreach ($gambarbarang as $key => $value): ?>
  <div class="modal fade" id="delete<?= $value->id_gambar ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete&nbsp;<?= $value->ket ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
          <img src="<?= base_url('assets/gambar/'.$value->gambar) ?>" width="200" id="gambar_load">
          </div>
          <h4>Apakah Anda Yakin Ingin Hapus Foto Ini?</h4>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="<?= base_url('gambarbarang/delete/'.$value->id_barang.'/'.$value->id_gambar)?>" class="btn btn-sm btn-danger">Delete</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php endforeach; ?>
<!-- /.modal delete -->

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
