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
      <a class="navbar-brand" href="<?php echo site_url('/admin/klas'); ?>">Data Klasifikasi</a>
    </div>
    <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/admin/klas'); ?>">
    	  <div class="input-group width-full">
    	  <input type="text" name="katakunci" class="form-control" placeholder="kata kunci nama/kode" value="<?php echo $this->input->get('katakunci') ?>" /><span class="input-group-btn">
    	  	<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button></span>
        </div>
    </form>
  
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="module-submenu">
      <ul class="nav navbar-nav navbar-right">
	       <?php if(isset($_SESSION['akses_modul']['klasifikasi']) && $_SESSION['akses_modul']['klasifikasi']=='on') : ?>
	       <li><a href="#" data-toggle="modal" data-target="#addkode"><i class="glyphicon glyphicon-plus"></i> Entry Data Baru</a></li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="row">
    <div class="col-md-12" id="divtabelkode">
    <table class="table table-bordered" name="vkode" id="vkode">
    <thead>
        <th>Kode</th>
        <th>Nama</th>
        <th>Retensi</th>
        <th class="width-sm"></th>
        <th class="width-sm"></th>
    </thead>
    <?php
        if(isset($user)){
            $no=1;
            foreach($user as $u) {
                echo "<tr>";
                //echo "<td>".$no."</td>";
                echo "<td>".$u['kode']."</td>";
                echo "<td>".$u['nama']."</td>";
                echo "<td>".$u['retensi']." Tahun</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editkode\" class='edkode' href='#' id='".$u['id']."' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delkode\" class='delkode' href='#' id='".$u['id']."' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
        }
    ?>
    </table>
    </div>
</div>

<div class="modal fade" id="addkode">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Tambah Klasifikasi</h4>
      </div>
	  <div class="modal-body">
		<form id="faddkode" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/addkode"); ?>">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="kode">Kode</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="adkode" name="kode" />
				</div>
			</div>
            <div class="form-group">
				<label class="col-sm-2 control-label" for="nama">Nama</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nama" name="nama" />
				</div>
			</div>
            <div class="form-group">
				<label class="col-sm-2 control-label" for="retensi">Retensi</label>
				<div class="col-sm-10">
                    <div class="input-group">
                        <input type="text" class="form-control" id="retensi" name="retensi" />
                        <span class = "input-group-addon">Tahun</span>
                    </div>
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addkodego">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="editkode">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Edit Klasifikasi</h4>
      </div>
	  <div class="modal-body">
		<form id="fedkode" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/edkode"); ?>">
            <input type="hidden" name="id" id="edidkode" value="">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="kode">Kode</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="ekode" name="kode" />
				</div>
			</div>
            <div class="form-group">
				<label class="col-sm-2 control-label" for="nama">Nama</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="enama" name="nama" />
				</div>
			</div>
            <div class="form-group">
				<label class="col-sm-2 control-label" for="retensi">Retensi</label>
				<div class="col-sm-10">
					<div class="input-group">
                        <input type="text" class="form-control" id="eretensi" name="retensi" />
                        <span class = "input-group-addon">Tahun</span>
                    </div>
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editkodego">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="delkode">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete Klasifikasi</h4>
      </div>
	  <div class="modal-body">
		<form id="fdelkode" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/delkode"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
            <input type="hidden" name="id" id="delidkode" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delkodego">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->