<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Data User</h3>

      <div class="card-tools">
        <button data-toggle="modal" data-target="#add" type="button" class="btn btn-primary btn-sm">
          <i class="fas fa-plus"></i> Add User
        </button>
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
            <th>Nama User</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role Id</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($user as $key => $value): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $value->nama_user ?></td>
              <td><?= $value->username ?></td>
              <td><?= $value->password ?></td>
              <td>
                <?php
                if ( $value->level_user == 1) {
                  echo '<span class="badge bg-primary">Admin</span>';
                }else {
                  echo '<span class="badge bg-info">User</span>';
                }
                ?>
              </td>
              <td>
                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value->id_user ?>"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value->id_user ?>"><i class="fas fa-trash-alt"></i></button>
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

<!-- Modal Add -->
<div class="modal fade" id="add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add user</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        echo form_open('user/add')
        ?>
        <div class="form-group">
          <label>Nama User</label>
          <input type="text" class="form-control" id="nama_user" placeholder="Nama User" name="nama_user" required>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
        </div>
        <div class="form-group">
          <label>Level User</label>
          <select class="form-control" name="level_user">
            <option value="1" selected>Admin</option>
            <option value="2">User</option>
          </select>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      <?php
      echo form_close();
      ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Edit -->
<?php foreach ($user as $key => $value): ?>
  <div class="modal fade" id="edit<?= $value->id_user ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit user</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
          echo form_open('user/edit/'.$value->id_user)
          ?>
          <div class="form-group">
            <label>Nama User</label>
            <input type="text" class="form-control" id="nama_user" placeholder="Nama User" name="nama_user" value="<?= $value->nama_user ?>" required>
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?= $value->username ?>" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?= $value->password ?>" required>
          </div>
          <div class="form-group">
            <label>Level User</label>
            <select class="form-control" name="level_user">
              <option value="1" <?php
                if ( $value->level_user == 1 ) {
                  echo "selected";
                }
               ?>>Admin</option>
              <option value="2" <?php
                if ( $value->level_user == 2 ) {
                  echo "selected";
                }
               ?>>User</option>
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        <?php
        echo form_close();
        ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php endforeach; ?>
<!-- /.modal edit -->

<!-- Modal Delete -->
<?php foreach ($user as $key => $value): ?>
  <div class="modal fade" id="delete<?= $value->id_user ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete&nbsp;<?= $value->nama_user ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4>Apakah Anda Yakin Ingin Hapus Data Ini?</h4>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="<?= base_url('user/delete/'.$value->id_user)?>" class="btn btn-sm btn-danger">Delete</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php endforeach; ?>
<!-- /.modal delete -->
