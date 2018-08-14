<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
<nav class="navbar navbar-inverse navbar-submenu">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#module-submenu" aria-expanded="false">
      </button>
      <a class="navbar-brand" href="#">Data Arsip</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="module-submenu">
      <ul class="nav navbar-nav navbar-right">
		  <li><a href="<?php echo site_url('/admin/vedit/'.$id); ?>"><i class="glyphicon glyphicon-pencil"></i> Edit Arsip</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- Form Name -->
<div class="row">
<div class="col-md-6"> <!-- 1st column -->

<div class="view-group row">
	<label class="col-md-6 control-label" for="noarsip">Nomor Arsip</label>
	<label class="col-md-6 isi"><?php echo $noarsip; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="tanggal">Tanggal Penciptaan</label>
	<label class="col-md-6 isi"><?php echo  date_format(date_create($tanggal),'d-M-Y');
		if($f=='sudah') {
			echo "<br /><b>Retensi Sudah Lewat : ".date_format(date_create($b),'d-M-Y')."</b>";
		}else {
			echo "<br />Retensi tanggal : ".date_format(date_create($b),'d-M-Y');
		}
	?>
	</label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="pencipta">Pencipta Arsip</label>
	<label class="col-md-6 isi"><?php echo $nama_pencipta; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="unitpengolah">Unit Pengolah</label>
	<label class="col-md-6 isi"><?php echo $nama_pengolah; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="kode">Kode Klasifikasi</label>
	<label class="col-md-6 isi"><?php echo $nama_kode." - ".$nama; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="uraian">Uraian</label>
	<label class="col-md-6 isi"><?php echo $uraian; ?></label>
</div>

</div><!-- /1st column -->

<div class="col-md-6"><!-- 2nd column -->
<div class="view-group row">
	<label class="col-md-6 control-label" for="lokasi">Lokasi Arsip</label>
	<label class="col-md-6 isi"><?php echo $nama_lokasi; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="media">Jenis Media</label>
	<label class="col-md-6 isi"><?php echo $nama_media; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="ket">Keterangan Keaslian</label>
	<label class="col-md-6 isi"><?php echo $ket; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="jumlah">Jumlah</label>
	<label class="col-md-6 isi"><?php echo $jumlah; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="nobox">Nomor Box</label>
	<label class="col-md-6 isi"><?php echo $nobox; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="nobox">File</label>
	<label class="col-md-6 isi"><?php echo ($file==""?"":"<a href='".base_url('files/'.$file)."' target='_blank'>".$file."</a>"); ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="nobox">Nama penginput</label>
	<label class="col-md-6 isi"><?php echo $username; ?></label>
</div>

</div><!-- /2nd column -->
</div><!-- /.row -->

</div>