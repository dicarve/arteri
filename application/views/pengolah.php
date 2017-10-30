<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h2 class="text-center breadcrumb">Data Unit Pengolah Arsip
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addpeng">Tambah</button>
</h2>
<div class="row">
    <div class="col-md-12" id="divtabelpeng">
    <table class="table table-bordered" name="vpeng" id="vpeng">
    <thead>
        <th>No</th>
        <th>Nama Unit Pengolah</th>
        <th></th>
        <th></th>
    </thead>
    <?php
        if(isset($peng)){
            $no=1;
            foreach($peng as $u) {
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$u['nama_pengolah']."</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editpeng\" class='edpeng' href='#' id='".$u['id']."' >edit</a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delpeng\" class='delpeng' href='#' id='".$u['id']."' >delete</a></td>";
                echo "</tr>";
                $no++;
            }
        }
    ?>
    </table>
    </div>
</div>

<div class="modal fade" id="addpeng">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Tambah Pengolah Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="faddpeng" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/addpeng"); ?>">
            <div class="form-group">
				<label class="col-sm-2 control-label" for="nama">Nama</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nama" name="nama" />
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addpenggo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="editpeng">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Edit Pengolah Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fedpeng" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/edpeng"); ?>">
            <input type="hidden" name="id" id="edidpeng" value="">
            <div class="form-group">
				<label class="col-sm-2 control-label" for="nama">Nama</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="enama" name="nama" />
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editpenggo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="delpeng">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete Pengolah Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fdelpeng" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/delpeng"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
            <input type="hidden" name="id" id="delidpeng" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delpenggo">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->