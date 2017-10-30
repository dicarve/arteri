<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h2 class="text-center breadcrumb">Data Lokasi Arsip
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addlok">Tambah</button>
</h2>
<div class="row">
    <div class="col-md-12" id="divtabellok">
    <table class="table table-bordered" name="vlok" id="vlok">
    <thead>
        <th>No</th>
        <th>Nama Lokasi</th>
        <th></th>
        <th></th>
    </thead>
    <?php
        if(isset($lok)){
            $no=1;
            foreach($lok as $u) {
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$u['nama_lokasi']."</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editlok\" class='edlok' href='#' id='".$u['id']."' >edit</a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#dellok\" class='dellok' href='#' id='".$u['id']."' >delete</a></td>";
                echo "</tr>";
                $no++;
            }
        }
    ?>
    </table>
    </div>
</div>

<div class="modal fade" id="addlok">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Tambah Lokasi Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="faddlok" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/addlok"); ?>">
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
        <button type="button" class="btn btn-primary" id="addlokgo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="editlok">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Edit Lokasi Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fedlok" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/edlok"); ?>">
            <input type="hidden" name="id" id="edidlok" value="">
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
        <button type="button" class="btn btn-primary" id="editlokgo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="dellok">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete Lokasi Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fdellok" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/dellok"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
            <input type="hidden" name="id" id="delidlok" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="dellokgo">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->