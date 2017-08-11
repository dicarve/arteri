<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h2 class="text-center breadcrumb">Data Klasifikasi
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addkode">Tambah</button>
</h2>
<div class="row">
    <div class="col-md-12" id="divtabelkode">
    <table class="table table-bordered" name="vkode" id="vkode">
    <thead>
        <th>Kode</th>
        <th>Nama</th>
        <th>Retensi</th>
        <th></th>
        <th></th>
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
                echo "<td><a data-toggle=\"modal\" data-target=\"#editkode\" class='edkode' href='#' id='".$u['id']."' >edit</a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delkode\" class='delkode' href='#' id='".$u['id']."' >delete</a></td>";
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
					<input type="text" class="form-control" id="kode" name="kode" />
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