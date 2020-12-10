<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Foto Barang</h3>

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
      <table class="table table-bordered table-hover text-center table-striped" id="example1">
        <thead class="thead-dark">
          <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Cover</th>
            <th>Jumlah Foto Barang</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($gambarbarang as $key => $value): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $value->nama_barang ?></td>
              <td><img src="<?= base_url('assets/uploads/'.$value->gambar) ?>" width="100"></td>
              <td><span class="badge bg-primary"><?= $value->total_gambar ?></span></td>
              <td>
                <a href="<?= base_url('gambarbarang/add/'.$value->id_barang) ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>&nbsp;Tambah Data Gambar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->
