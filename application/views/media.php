<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h2 class="text-center breadcrumb">Data Media Arsip
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addmed">Tambah</button>
</h2>
<div class="row">
    <div class="col-md-12" id="divtabelmed">
    <table class="table table-bordered" name="vmed" id="vmed">
    <thead>
        <th>No</th>
        <th>Nama Media</th>
        <th></th>
        <th></th>
    </thead>
    <?php
        if(isset($med)){
            $no=1;
            foreach($med as $u) {
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$u['nama_media']."</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editmed\" class='edmed' href='#' id='".$u['id']."' >edit</a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delmed\" class='delmed' href='#' id='".$u['id']."' >delete</a></td>";
                echo "</tr>";
                $no++;
            }
        }
    ?>
    </table>
    </div>
</div>

<div class="modal fade" id="addmed">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Tambah Media Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="faddmed" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/addmed"); ?>">
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
        <button type="button" class="btn btn-primary" id="addmedgo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="editmed">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Edit Media Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fedmed" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/edmed"); ?>">
            <input type="hidden" name="id" id="edidmed" value="">
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
        <button type="button" class="btn btn-primary" id="editmedgo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="delmed">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete Media Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fdelmed" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/delmed"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
            <input type="hidden" name="id" id="delidmed" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delmedgo">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->