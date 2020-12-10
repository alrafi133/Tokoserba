<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4">
    <div class="register-box">
      <div class="register-logo">
      <b>Login</b>Pelanggan
      </div>

      <div class="card">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Login From</p>

          <?php

          echo validation_errors('<div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>', '</div>');
          if ($this->session->flashdata('pesan')) {
            echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success!</h5>';
            echo $this->session->flashdata('pesan');
            echo "</div>";
          }
          if ($this->session->flashdata('error')) {
            echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Gagal!</h5>';
            echo $this->session->flashdata('error');
            echo "</div>";
          }
          echo form_open('pelanggan/login') ?>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo set_value('email') ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo set_value('password') ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">

            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
          <?php echo form_close() ?>

          <a href="<?= base_url('pelanggan/register') ?>" class="text-center"><b>Belum Punya Akun?</b>&nbsp;Daftar</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
  </div>
</div>
</div>
