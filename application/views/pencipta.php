<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h2 class="text-center breadcrumb">Data Pencipta Arsip
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addpenc">Tambah</button>
</h2>
<div class="row">
    <div class="col-md-12" id="divtabelpenc">
    <table class="table table-bordered" name="vpenc" id="vpenc">
    <thead>
        <th>No</th>
        <th>Nama Pencipta</th>
        <th></th>
        <th></th>
    </thead>
    <?php
        if(isset($penc)){
            $no=1;
            foreach($penc as $u) {
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$u['nama_pencipta']."</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editpenc\" class='edpenc' href='#' id='".$u['id']."' >edit</a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delpenc\" class='delpenc' href='#' id='".$u['id']."' >delete</a></td>";
                echo "</tr>";
                $no++;
            }
        }
    ?>
    </table>
    </div>
</div>

<div class="modal fade" id="addpenc">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Tambah Pencipta Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="faddpenc" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/addpenc"); ?>">
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
        <button type="button" class="btn btn-primary" id="addpencgo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="editpenc">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Edit Pencipta Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fedpenc" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/edpenc"); ?>">
            <input type="hidden" name="id" id="edidpenc" value="">
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
        <button type="button" class="btn btn-primary" id="editpencgo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="delpenc">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete Pencipta Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fdelpenc" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/delpenc"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
            <input type="hidden" name="id" id="delidpenc" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delpencgo">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->