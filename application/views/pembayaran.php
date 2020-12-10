<div class="row">
  <div class="col-sm-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Nomor Rekening Toko</h3>
      </div>
      <div class="card-body">
        <div class="form-group">
          <p>Silahkan Transfer Uang Kepada Ke Nomor Rekening Di Bawah Ini Sebesar : <h1 class="text-primary">Rp. <?= number_format($pesanan->total_bayar, 0, ',','.') ?>.-</h1> </p><br>
          <table class="table">
            <tr>
              <th>Bank</th>
              <th>Nomr Rekening</th>
              <th>Atas Nama</th>
            </tr>
            <?php foreach ($rekening as $key => $value): ?>
              <tr>
                <td><?= $value->nama_bank ?></td>
                <td><?= $value->no_rek ?></td>
                <td><?= $value->atas_nama ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Form Bukti Pembayaran</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <?php echo form_open_multipart('pesanan_saya/bayar/' .$pesanan->id_transaksi) ?>
        <div class="card-body">
          <div class="form-group">
            <label for="atas_nama">Atas Nama</label>
            <input type="text" class="form-control" placeholder="Atas Nama" name="atas_nama">
          </div>
          <div class="form-group">
            <label for="nama_bank">Nama Bank</label>
            <input type="text" class="form-control" placeholder="Nama Bank" name="nama_bank">
          </div>
          <div class="form-group">
            <label for="no_rek">Nomor Rekening</label>
            <input type="text" class="form-control" placeholder="Nomor Rekening" name="no_rek">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Bukti Bayar</label>
            <div class="input-group">
                <input type="file" name="bukti_bayar" required class="form-control">
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="<?php echo base_url('pesanan_saya') ?>" class="btn btn-success">Kembali</a>
        </div>
      <?php echo form_close() ?>
    </div>
    <!-- /.card -->
  </div>
</div>
