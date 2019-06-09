<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-inverse navbar-submenu">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#module-submenu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo site_url('/admin/vuser'); ?>">Data User</a>
    </div>
    <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/admin/vuser'); ?>">
    	  <div class="input-group width-full">
    	  <input type="text" name="katakunci" class="form-control" placeholder="kata kunci username" value="<?php echo $this->input->get('katakunci') ?>"/><span class="input-group-btn">
    	  	<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button></span>
        </div>
    </form>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="module-submenu">
      <ul class="nav navbar-nav navbar-right">
	       <?php if(isset($_SESSION['akses_modul']['user']) && $_SESSION['akses_modul']['user']=='on') : ?>
	       <li><a href="#" data-toggle="modal" data-target="#adduser"><i class="glyphicon glyphicon-plus"></i> Entry User Baru</a></li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="row">
    <div class="col-md-12" id="divtabeluser">
    <table class="table table-bordered" name="vuser" id="vuser">
    <thead>
        <th class="width-sm">No</th>
        <th>Username</th>
        <th>Akses Klasifikasi</th>
        <th>Akses Modul</th>
        <th>Tipe</th>
        <th class="width-sm"></th>
        <th class="width-sm"></th>
    </thead>
    <?php
        if(isset($user)){
            $no=1;
            foreach($user as $u) {
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$u['username']."</td>";
                echo "<td>".$u['akses_klas']."</td>";
                echo "<td>";
				$mm = $u['akses_modul'];
				if($mm!="") {
					$mm = json_decode($mm);
					if($mm) {
						foreach($mm as $key=>$val) {
							echo $key.",";
						}
					}
				}
				echo "</td>";
				echo "<td>".$u['tipe']."</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#edituser\" class='eduser' href='#' id='".$u['id']."' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#deluser\" class='deluser' href='#' id='".$u['id']."' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
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
				<label class="col-sm-2 control-label" for="conf_password">Konfirmasi password</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="conf_password" name="conf_password" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="username">Hak Akses Klasifikasi</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="akses_klas" name="akses_klas" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="username">Hak Akses Modul</label>
				<div class="col-sm-10">
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="modul1" name="modul[entridata]">
						Entri Data
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="modul2" name="modul[sirkulasi]">
						Sirkulasi
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="modul3" name="modul[klasifikasi]">
						Klasifikasi
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="modul4" name="modul[pencipta]">
						Pencipta Arsip
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="modul5" name="modul[pengolah]">
						Pengolah Arsip
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="modul6" name="modul[lokasi]">
						Lokasi Arsip
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="modul7" name="modul[media]">
						Media Arsip
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="modul8" name="modul[user]">
						User
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="modul9" name="modul[import]">
						Import Data
					</label>
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
				<label class="col-sm-2 control-label" for="username">Hak Akses Klasifikasi</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="eakses_klas" name="akses_klas" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="username">Hak Akses Modul</label>
				<div class="col-sm-10">
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="emodul1" name="modul[entridata]">
						Entri Data
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="emodul2" name="modul[sirkulasi]">
						Sirkulasi
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="emodul3" name="modul[klasifikasi]">
						Klasifikasi
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="emodul4" name="modul[pencipta]">
						Pencipta Arsip
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="emodul5" name="modul[pengolah]">
						Pengolah Arsip
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="emodul6" name="modul[lokasi]">
						Lokasi Arsip
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="emodul7" name="modul[media]">
						Media Arsip
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="emodul8" name="modul[user]">
						User
					</label>
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" id="emodul9" name="modul[import]">
						Import Data
					</label>
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