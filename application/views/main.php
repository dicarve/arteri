<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<h2>Pencarian Data</h2>
	<hr>
	<?php echo $this->session->flashdata('zz'); ?>
	<form action="<?php echo site_url('/home/search'); ?>" method="get" id="srcmain">
		<div class = "input-group">
			<span class = "input-group-addon">Uraian</span>
			<input id="uraian" name="uraian" class="form-control input-md" type="text" value="<?php echo $src['uraian'] ?>">
			<span class = "input-group-addon">No Surat/Arsip</span>
			<input id="noarsip" name="noarsip" class="form-control input-md" type="text" value="<?php echo $src['noarsip'] ?>">
			<span class = "input-group-addon">Retensi</span>
			<select class="form-control" name="retensi" id="retensi">
				<option value="all" >Semua</option>
				<option value="sudah" <?php echo ($src['retensi']=='sudah'?'selected=selected':''); ?> >Sudah</option>
				<option value="belum" <?php echo ($src['retensi']=='belum'?'selected=selected':''); ?> >Belum</option>
			</select>
		</div>
		<br/>
		<div class = "input-group">
			<span class = "input-group-addon">Tanggal (yyyy-mm-dd)</span>
			<input id="tanggal" name="tanggal" class="form-control input-md" type="text" value="<?php echo $src['tanggal'] ?>">
			<span class = "input-group-addon">Ket</span>
			<select class="form-control" name="ket" id="ket">
				<option value="all" >Semua</option>
				<option value="asli" <?php echo ($src['ket']=='asli'?'selected=selected':''); ?> >Asli</option>
				<option value="copy" <?php echo ($src['ket']=='copy'?'selected=selected':''); ?> >Copy</option>
			</select>
			<span class = "input-group-addon">Kode Klasifikasi</span>
			<select class="form-control" name="kode" id="kode">
				<option value="all" >Semua</option>
				<?php
					if(isset($kode)) {
						foreach($kode as $p) {
							echo "<option value=\"".$p['kode']."\" ".($src['kode']==$p['kode']?"selected=selected":"").">".$p['kode']." - ".$p['nama']."</option>";
						}
					}
				?>
			</select>
			<span class="input-group-btn">
				<button class="btn btn-primary" type="submit" id="go">Mencari</button>
			</span>
		</div>
	</form>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Hasil Pencarian <span class='small'>(<?php echo number_format($jml); ?> data)</span>
                <a class="btn btn-primary" href="<?php echo site_url('/home/dl').($_SERVER['QUERY_STRING']? '?'.$_SERVER['QUERY_STRING'] : '') ?>
                                                 ">Download Data</a>
                </h3>
            </div>
        </div>
        <!-- /.row -->
        <!-- Page Features -->
        <div class="row" id="hslsrc">
			<table id="tblhslsrc" class="table table-bordered table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>No Arsip</th>
						<th>Tahun</th>
						<th>Tanggal</th>
						<th>Kode Klasifikasi</th>
						<th>Uraian</th>
						<th>Ket</th>
						<th>File</th>
						<th>Jumlah</th>
						<th>No. Box</th>
						<th>Retensi</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($data as $a) {
							echo "<tr>";
							echo "<td>".$a['noarsip']."</td>";
							echo "<td>".$a['tanggal']."</td>";
							echo "<td>".$a['kode']."</td>";
							echo "<td>".$a['uraian']."</td>";
							echo "<td>".$a['ket']."</td>";
							if($a['file']=="") {
								echo "<td></td>";
							}else {
								echo "<td><a href='".base_url('files/').$a['file']."'><span class='glyphicon glyphicon-save' aria-hidden='true'></span></a></td>";
							}
							echo "<td>".$a['jumlah']."</td>";
							echo "<td>".$a['nobox']."</td>";
							echo "<td ".($a['f']=='sudah'?"class='danger'":"").">".$a['b']."</td>";
							echo "<td>";
							if($this->session->tipe=='admin') {
								echo "<a href='".site_url('/admin/vedit/'.$a['id'])."'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>";
							}
							echo "</td>";
							echo "<td>";
							if($this->session->tipe=='admin') {
								echo "<a class='deldata' id='".$a['id']."' href='#' data-toggle=\"modal\" data-target=\"#deldata\"><span class='glyphicon glyphicon-remove ' style='color:red' aria-hidden='true'></span></a>";
							}
							echo "</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
        </div>
        <!-- /.row -->
<?php
echo $pages;
?>
<div class="modal fade" id="deldata">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete Data</h4>
      </div>
	  <div class="modal-body">
		<form id="fdeldata" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/del1"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus Data ini?</h4>
            <input type="hidden" name="id" id="deliddata" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deldatago">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->