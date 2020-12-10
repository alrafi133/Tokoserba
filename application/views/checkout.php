<!-- Main content -->
<div class="invoice p-3 mb-3">
  <!-- title row -->
  <div class="row">
    <div class="col-12">
      <h4>
        <i class="fas fa-shopping-cart"></i> Tokoserba.
        <small class="float-right">Date: <?= date('d-m-Y') ?></small>
      </h4>
    </div>
    <!-- /.col -->
  </div>

  <!-- Table row -->
  <div class="row">
    <div class="col-12 table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Qty</th>
            <th>Barang</th>
            <th>Harga</th>
            <th>Subtotal</th>
            <th>Berat</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php
            $total_berat = 0;
           foreach ($this->cart->contents() as $items) {
             $barang = $this->m_home->detail_barang($items['id']);
             $berat = $items['qty'] * $barang->berat;
             $total_berat = $total_berat + $berat
          ?>
          <tr>
            <td><?php echo $items['qty'] ?></td>
            <td><?php echo $items['name'] ?></td>
            <td>Rp. <?php echo number_format($items['price'], 0, ',','.') ?></td>
            <td>Rp. <?php echo number_format($items['subtotal'], 0, ',','.') ?></td>
            <td><?php echo $berat ?>gr</td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <?php echo validation_errors('<div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="icon fas fa-ban"></i>','</div>'); ?>
  <?php echo form_open('belanja/checkout');
    $no_order = date('Ymd').strtoupper(random_string('alnum', 8));
   ?>
  <div class="row">
    <!-- accepted payments column -->
    <div class="col-sm-8 invoice-col">
      Tujuan :
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Provinsi</label>
            <select class="form-control" name="provinsi"></select>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
          <label>Kota/Kabupaten</label>
          <select class="form-control" name="kota"></select>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
          <label>Ekspedisi</label>
          <select class="form-control" name="expedisi"></select>
          </div>
        </div>

      <div class="col-sm-6">
        <div class="form-group">
        <label>Paket</label>
        <select class="form-control" name="paket"></select>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" name="alamat" required>
      </div>

    </div>

    <div class="col-sm-4">
      <div class="form-group">
      <label>Kode Pos</label>
      <input type="text" class="form-control" name="kode_pos" required>
    </div>

  </div>

      <div class="col-sm-6">
        <div class="form-group">
        <label>Nama Penerima</label>
        <input type="text" class="form-control" name="nama_penerima" required>
      </div>

    </div>

        <div class="col-sm-4">
          <div class="form-group">
          <label>Nomor Telepon Penerima</label>
          <input type="text" class="form-control" name="hp_penerima" required>
        </div>
      </div>

  </div>
    </div>
    <!-- /.col -->
    <div class="col-4">

      <div class="table-responsive">
        <table class="table">
          <tr>
            <th style="width:50%">Grandtotal:</th>
            <td>Rp. <?php echo number_format($this->cart->total(), 0, ',','.') ?></td>
          </tr>
          <tr>
            <th>Berat</th>
            <td><?php echo $total_berat ?>gr</td>
          </tr>
          <tr>
            <th>Ongkir:</th>
            <td><label id="ongkir"></label></td>
          </tr>
          <tr>
            <th>Total Bayar:</th>
            <td><label id="total_bayar"></label></td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appearSimpan Transaksi -->
  <input name="no_order" value="<?= $no_order ?>" hidden>
  <input name="estimasi" hidden>
  <input name="ongkir" hidden>
  <input name="berat" value="<?= $total_berat ?>" hidden><br>
  <input name="grand_total" value=" <?php echo ($this->cart->total()) ?>" hidden>
  <input name="total_bayar" hidden>

  <!-- Rinci Transaksi -->
  <?php $i = 1;
   foreach ($this->cart->contents() as $items) {
    echo form_hidden('qty'.$i++, $items['qty']);

  } ?>


  <div class="row no-print">
    <div class="col-12">
      <a href="<?= base_url('belanja') ?>" class="btn btn-warning"><i class="fas fa-backward"></i>&nbsp;Kembali</a>
      <button type="submit" class="btn btn-success float-right"><i class="fas fa-cash-register"></i>
        &nbsp;Proses Checkout
      </button>
    </div>
  </div>
  <?php echo form_close() ?>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    //Data Provinsi
    $.ajax({
      type: "POST",
      url: "<?= base_url('rajaongkir/provinsi') ?>",
      success : function(hasil_provinsi) {
          // console.log(hasil_provinsi);
          $("select[name = provinsi]").html(hasil_provinsi);
      }
    });
    //Data Kota/Kabupaten
    $("select[name = provinsi]").on("change", function() {
      var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
      $.ajax({
        type: "POST",
        url: "<?= base_url('rajaongkir/kota') ?>",
        data: 'id_provinsi='+ id_provinsi_terpilih,
        success: function(hasil_kota) {
        $("select[name = kota]").html(hasil_kota);
        }
      });
    });
      $("select[name = kota]").on("change", function() {
        $.ajax({
          type: "POST",
          url: "<?= base_url('rajaongkir/expedisi') ?>",
          success: function(hasil_expedisi) {
          $("select[name = expedisi]").html(hasil_expedisi);
          }
        });
      });

      //daftar paket
      $("select[name = expedisi]").on("change", function() {
        //mendapatkan expedisi Terpilih
        var expedisi_terpilih = $("select[name = expedisi]").val()
        //mendapatkan Id Kota Tujuan
        var id_kota_tujuan_terpilih = $("option:selected","select[name = kota]").attr('id_kota');
        //Mengambil data ongkos kirim
        var total_berat = <?php echo $total_berat ?>;

        $.ajax({
          type: "POST",
          url: "<?= base_url('rajaongkir/paket') ?>",
          data: 'expedisi='+expedisi_terpilih +'&id_kota='+id_kota_tujuan_terpilih +'&berat='+ total_berat,
          success: function(hasil_paket) {
            $("select[name = paket]").html(hasil_paket);
          }
        });
      });

      //data ongkir
      $("select[name=paket]").on("change", function() {
        //Menampilkan Total Bayar
        var dataongkir = $("option:selected", this).attr('ongkir');
        var	reverse = dataongkir.toString().split('').reverse().join(''),
          	ribuan_ongkir = reverse.match(/\d{1,3}/g);
          ribuan_ongkir	= ribuan_ongkir.join('.').split('').reverse().join('');
        $("#ongkir").html("Rp. " +ribuan_ongkir)
        //Menghitung Total Bayar
        var data_total_bayar = parseInt(dataongkir) + parseInt(<?php echo ($this->cart->total()) ?>);
        var	reverse2 = data_total_bayar.toString().split('').reverse().join(''),
          	ribuan_total_bayar = reverse2.match(/\d{1,3}/g);
          ribuan_total_bayar	= 	ribuan_total_bayar.join('.').split('').reverse().join('');
        $("#total_bayar").html("Rp. " +	ribuan_total_bayar);

        //estimasi dan ongkir
        var estimasi =  $("option:selected", this).attr('estimasi');
        $("input[name=estimasi]").val(estimasi);
        $("input[name=ongkir]").val(dataongkir);
        $("input[name=total_bayar]").val(data_total_bayar);
      });

  });
</script>
