<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
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
      <a class="navbar-brand" href="#">Entry Data Arsip</a>
    </div>  
  	  
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="module-submenu">
      <ul class="nav navbar-nav navbar-right">
		  <li><a href="#" class="trigger-submit"><i class="glyphicon glyphicon-save"></i> Simpan</a></li>
		  <li><a href="<?php echo site_url('/sirkulasi/'); ?>"><i class="glyphicon glyphicon-search"></i> Data Peminjaman</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<form class="form-horizontal" data-toggle="validator" action="<?php echo site_url('/sirkulasi/update'); ?>" method="post" enctype="multipart/form-data">

<!-- Form Name -->
<div class="container">
<div class="col-md-12"> <!-- 1st column -->
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="form-group">
	<label class="col-md-2 control-label" for="noarsip">Nomor Arsip</label>
	<div class="col-md-8">
	<input type="text" value="<?php echo $noarsip ?>" id="snoarsip" name="noarsip" class="form-control disabled xhr"
	  placeholder="Ketikan 3 huruf/angka pertama kode arsip atau klasifikasi arsip" 
	  data-xhr="<?php echo site_url('/sirkulasi/xhr_arsip'); ?>" autocomplete="off" disabled required />
	</div>
	<div class="col-md-2">
	  <button id="singlebutton" name="singlebutton" type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</button>
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label" for="username_peminjam">Username Peminjam</label>
	<div class="col-md-8">
	<input type="text" value="<?php echo $username_peminjam ?>" id="username_peminjam" name="username_peminjam" class="form-control xhr" 
	  placeholder="Ketikan 3 huruf pertama username yang akan meminjam"
	  data-xhr="<?php echo site_url('/sirkulasi/xhr_user'); ?>" autocomplete="off" disabled required />
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label" for="keperluan">Alasan keperluan peminjaman</label>
	<div class="col-md-8">
	<textarea id="keperluan" name="keperluan" class="form-control" row="3" disabled required><?php echo $keperluan; ?></textarea>
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label" for="tgl_pinjam">Tanggal Peminjaman</label>
	<div class="col-md-8">
  <div class="input-group">
    <div class="input-group-addon">(yyyy-mm-dd)</div>
    <input id="tgl_pinjam" name="tgl_pinjam" class="form-control input-md" type="text" value="<?php print $tgl_pinjam; ?>" disabled required>
	</div>
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label" for="tgl_haruskembali">Tanggal Harus Kembali</label>
	<div class="col-md-8">
  <div class="input-group">
    <div class="input-group-addon">(yyyy-mm-dd)</div>
    <input id="tgl_haruskembali" name="tgl_haruskembali" class="form-control input-md" value="<?php print $tgl_haruskembali; ?>" type="text" disabled required>
	</div>
	</div>
</div>

</div><!-- /1st column -->
</div><!-- /.row -->

</form>
</div>
