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
      <a class="navbar-brand" href="<?php echo site_url('/home/'); ?>">Entry Data Arsip</a>
    </div>  
  	  
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="module-submenu">
      <ul class="nav navbar-nav navbar-right">
		  <li><a href="#" class="trigger-submit"><i class="glyphicon glyphicon-save"></i> Simpan</a></li>
		  <li><a href="<?php echo site_url('/home/'); ?>"><i class="glyphicon glyphicon-search"></i> Lihat Data Arsip</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<form class="form-horizontal" data-toggle="validator" action="<?php echo site_url('/admin/gentr'); ?>" method="post" enctype="multipart/form-data">

<!-- Form Name -->
<div class="row">
<div class="col-md-6"> <!-- 1st column -->

<div class="form-group">
	<label class="col-md-4 control-label" for="noarsip">Nomor Arsip</label>
	<div class="col-md-8">
	<input id="noarsip" name="noarsip" class="form-control input-md" type="text" required>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="tanggal">Tanggal Penciptaan</label>
	<div class="col-md-8">
  <div class="input-group">
    <div class="input-group-addon">(yyyy-mm-dd)</div>
    <input id="tanggal" name="tanggal" class="form-control input-md" type="text" required>
	</div>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="pencipta">Pencipta Arsip</label>
	<div class="col-md-8">
	<select id="pencipta" name="pencipta" class="form-control input-md chosen">
	<?php
		if(isset($pencipta)){
			foreach($pencipta as $k) {
				echo "<option value='".$k['id']."' >".$k['nama_pencipta']."</option>";
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="unitpengolah">Unit Pengolah</label>
	<div class="col-md-8">
	<select id="unitpengolah" name="unitpengolah" class="form-control input-md chosen">
	<?php
		if(isset($unitpengolah)){
			foreach($unitpengolah as $k) {
				echo "<option value='".$k['id']."' >".$k['nama_pengolah']."</option>";
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="kode">Kode Klasifikasi</label>
	<div class="col-md-8">
	<select id="kode" name="kode" class="form-control input-md chosen">
	<?php
		if(isset($kode)){
			foreach($kode as $k) {
				echo "<option value='".$k['id']."' >".$k['nama']." - ".$k['kode']."</option>";
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="uraian">Uraian</label>
	<div class="col-md-8">
  <textarea id="uraian" name="uraian" class="form-control" rows="3"></textarea>
	</div>
</div>

</div><!-- /1st column -->

<div class="col-md-6"><!-- 2nd column -->
<div class="form-group">
	<label class="col-md-4 control-label" for="lokasi">Lokasi Arsip</label>
	<div class="col-md-8">
	<select id="lokasi" name="lokasi" class="form-control input-md chosen">
	<?php
		if(isset($lokasi)){
			foreach($lokasi as $k) {
				echo "<option value='".$k['id']."' >".$k['nama_lokasi']."</option>";
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="media">Jenis Media</label>
	<div class="col-md-8">
	<select id="media" name="media" class="form-control input-md chosen">
	<?php
		if(isset($media)){
			foreach($media as $k) {
				echo "<option value='".$k['id']."' >".$k['nama_media']."</option>";
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="ket">Keterangan Keaslian</label>
	<div class="col-md-8">
	<select class="form-control" name="ket" id="ket">
      <option value="asli" >Asli</option>
      <option value="copy" >Copy</option>
    </select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="jumlah">Jumlah</label>
	<div class="col-md-8">
	<input id="jumlah" name="jumlah" class="form-control input-md" type="text" value="1">
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="nobox">Nomor Box</label>
	<div class="col-md-8">
	<input id="nobox" name="nobox" class="form-control input-md" type="text">
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="nobox">File</label>
	<div class="col-md-8">
	<input type="file" id="file" name="file" accept=".doc,.docx,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf">
	<p class="help-block">Ukuran Maksimal <?php echo number_format(ceil(max_file_upload_in_bytes()/1000)); ?> MB</p>
	</div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-8">
    <button id="singlebutton" name="singlebutton" type="submit" class="btn btn-success">Simpan</button>
  </div>
</div>

</div><!-- /2nd column -->
</div><!-- /.row -->

</form>
</div>

<?php
function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
	$val = (int)trim($val);
    switch($last)
    {
        case 'g':
        $val *= 1024;
        case 'm':
        $val *= 1024;
        case 'k':
        $val *= 1024;
    }
    return $val;
}

function max_file_upload_in_bytes() {
    //select maximum upload size
    $max_upload = return_bytes(ini_get('upload_max_filesize'));
    //select post limit
    $max_post = return_bytes(ini_get('post_max_size'));
    //select memory limit
    $memory_limit = return_bytes(ini_get('memory_limit'));
    // return the smallest of them, this defines the real limit
    return min($max_upload, $max_post, $memory_limit);
}