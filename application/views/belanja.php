<div class="card card-solid">
  <div class="card-body pb-0">
    <div class="row">
      <div class="col-sm-12">
        <?php
          if ($this->session->flashdata('pesan')) {
            echo '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i></h5>';
            echo $this->session->flashdata('pesan');
            echo '</div>';
          }
        ?>
      </div>
      <div class="col-sm-12">
        <?php echo form_open('belanja/update') ?>
        <table cellpadding="6" cell-spacing="1" style="width:100%" class="table">
          <tr>
            <th width="80px">QTY</th>
            <th>Item Descripsion</th>
            <th style="text-align: right">Item Price</th>
            <th style="text-align: right">Sub-Total</th>
            <th style="text-align: center">Berat Barang</th>
            <th style="text-align: center">Action</th>
          </tr>
          <?php $i = 1; ?>
          <?php
            $total_berat = 0;
           foreach ($this->cart->contents() as $items){
            $barang = $this->m_home->detail_barang($items['id']);
            $berat = $items['qty'] * $barang->berat;
            $total_berat = $total_berat + $berat
           ?>
            <tr>
              <td><?php echo form_input(array('name' => $i. '[qty]', 'value' =>$items['qty'], 'maxlength' => '3', 'min' => '1' ,'size' => '5', 'type' => 'number', 'class' => 'form-control')) ?></td>
              <td>
                <?php echo $items['name'] ?>
              </td>
              <td style="text-align: right">Rp. <?php echo number_format($items['price'], 0, ',','.') ?></td>
              <td style="text-align: right">Rp. <?php echo number_format($items['subtotal'], 0, ',','.') ?></td>
              <td style="text-align: center"><?php echo $berat ?>gr</td>
              <td style="text-align: center">
                <a href="<?= base_url('belanja/delete/'.$items['rowid']) ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
            <?php $i++ ?>
          <?php } ?>
          <tr>
            <td class="right"><h4><strong>Total:</strong></h4></td>
            <td class="right"><h4>Rp. <?php echo number_format($this->cart->total(), 0, ',','.')  ?></h4></td>
            <th>Total Berat Barang: <?php echo $total_berat ?>gr</th>
            <td></td>
          </tr>
        </table>
        <button class="btn btn-primary" type="submit"><i class="fas fa-edit"></i>&nbsp;Update Your Cart</button>
        <a href="<?= base_url('belanja/clear') ?>" class="btn btn-danger btn-flat"><i class="fas fa-trash-alt"></i>&nbsp;Clear All Cart</a>
        <a href="<?= base_url('belanja/checkout') ?>" class="btn btn-primary btn-flat"><i class="fas fa-shopping-basket"></i>&nbsp;CheckOut</a>
      <?php echo form_close() ?>
      <br>
    </div>
  </div>
</div>
</div>
</div>
