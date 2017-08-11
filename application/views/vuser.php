<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h2 class="text-center breadcrumb">Data User
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#adduser">Tambah</button>
</h2>
<div class="row">
    <div class="col-md-12" id="divtabeluser">
    <table class="table table-bordered" name="vuser" id="vuser">
    <thead>
        <th>No</th>
        <th>Username</th>
        <th>Tipe</th>
        <th></th>
        <th></th>
    </thead>
    <?php
        if(isset($user)){
            $no=1;
            foreach($user as $u) {
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$u['username']."</td>";
                echo "<td>".$u['tipe']."</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#edituser\" class='eduser' href='#' id='".$u['id']."' >edit</a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#deluser\" class='deluser' href='#' id='".$u['id']."' >delete</a></td>";
                echo "</tr>";
                $no++;
            }
        }
    ?>
    </table>
    </div>
</div>

<div class="modal fade" id="adduser">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Tambah User</h4>
      </div>
	  <div class="modal-body">
		<form id="fadduser" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/adduser"); ?>">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="username">username</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="username" name="username" />
				</div>
			</div>
            <div class="form-group">
				<label class="col-sm-2 control-label" for="password">password</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="password" name="password" />
				</div>
			</div>
            <div class="form-group">
				<label class="col-sm-2 control-label" for="tipe">Tipe</label>
				<div class="col-sm-10">
					<select id="tipe" name="tipe" class="form-control">
                        <option value="admin" >Admin</option>
                        <option value="user" >User</option>
                    </select>
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addusergo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="edituser">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Edit User</h4>
      </div>
	  <div class="modal-body">
		<form id="feduser" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/eduser"); ?>">
            <input type="hidden" name="id" id="ediduser" value="">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="username">username</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="eusername" name="username" />
				</div>
			</div>
            <div class="form-group">
				<label class="col-sm-2 control-label" for="password">password</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="epassword" name="password" />
				</div>
			</div>
            <div class="form-group">
				<label class="col-sm-2 control-label" for="tipe">Tipe</label>
				<div class="col-sm-10">
					<select id="etipe" name="tipe" class="form-control">
                        <option value="admin" >Admin</option>
                        <option value="user" >User</option>
                    </select>
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editusergo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="deluser">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete User</h4>
      </div>
	  <div class="modal-body">
		<form id="fdeluser" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/deluser"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
            <input type="hidden" name="id" id="deliduser" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delusergo">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->