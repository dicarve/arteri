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
          <a class="navbar-brand" href="<?php echo site_url('/sirkulasi/datalist'); ?>">Data Sirkulasi</a>
        </div>

		<form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/sirkulasi/datalist'); ?>">
			<div class="input-group width-full">
			<input type="text" name="katakunci" class="form-control" placeholder="nomor arsip/kode user" /><span class="input-group-btn">
				<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button></span>
		    </div>
		</form>
		  
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="module-submenu">
          <ul class="nav navbar-nav navbar-right">
			      <?php if(isset($_SESSION['akses_modul']['sirkulasi']) && $_SESSION['akses_modul']['sirkulasi']=='on') : ?>
			      <li><a href="<?php echo site_url('/sirkulasi/entr'); ?>"><i class="glyphicon glyphicon-plus"></i> Peminjaman Baru</a></li>
            <?php endif; ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <!-- Title -->
    <div class="well well-sm">
		  <div class="row">
            <div class="col-xs-9">Ditemukan data sebanyak : <em class='small'>(<?php echo number_format($jml); ?>)</em> peminjaman arsip</div>
		    <div class="col-xs-3 text-right"></div>
		  </div>
        </div>
        <!-- /.row -->
      <!-- Page Features -->
      <div class="row" id="hslsrc">
			<table id="tblhslsrc" class="table table-bordered table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>No Arsip</th>
						<th>Peminjam</th>
						<th>Keperluan</th>
						<th>Tgl. Pinjam</th>
						<th>Tgl. Harus Kembali</th>
						<th>Tgl. Pengembalian</th>
						<?php if (isset($admin) && $admin && isset($_SESSION['akses_modul']['sirkulasi']) && $_SESSION['akses_modul']['sirkulasi']=='on') : ?>
						<th class="width-sm"></th>
						<th class="width-sm"></th>
            <?php endif; ?>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($data as $a) {
							echo "<tr>";
							echo "<td>".$a['noarsip']."</td>";
							echo "<td>".$a['username_peminjam']."</td>";
							echo "<td>".$a['keperluan']."</td>";
							echo "<td>".$a['tgl_pinjam']."</td>";
							echo "<td>".$a['tgl_haruskembali']."</td>";
							echo "<td>";
							// hanya user admin bisa mengubah data sirkulasi
							if(isset($admin) && $admin && isset($_SESSION['akses_modul']['sirkulasi']) && $_SESSION['akses_modul']['sirkulasi']=='on') {
								if($a['tgl_pengembalian']==null) {
									echo "<a href='#' id='".$a['id']."' data-toggle=\"modal\" data-target=\"#arsipkembali\" class='btn btn-primary btn-xs kemdata' >Kembalikan</a>";
								}else {
									echo $a['tgl_pengembalian'];
								}
								echo "</td>";
								echo "<td>";
								echo "<a href='".site_url('/sirkulasi/vedit/'.$a['id'])."'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>";
								echo "</td>";
								echo "<td>";
								echo "<a class='sdeldata' id='".$a['id']."' href='#' data-toggle=\"modal\" data-target=\"#deldata\"><i class=\"glyphicon glyphicon-trash\"></i></a>";
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
		<form id="fsdeldata" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/sirkulasi/del"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus Data ini?</h4>
            <input type="hidden" name="id" id="deliddata" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="sdeldatago">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.pengembalian arsip -->
<div class="modal fade" id="arsipkembali">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Kembalikan Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fkemarsip" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/sirkulasi/kembalikan"); ?>">
			<h4 class="modal-title">Yakin ingin kembalikan arsip ini?</h4>
            <input type="hidden" name="id" id="kemid" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="kemarsipgo">Kembalikan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->