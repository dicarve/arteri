<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form class="form-horizontal" data-toggle="validator" action="<?php echo site_url('/admin/gentr'); ?>" method="post" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>Entri Data</legend>

<div class="form-group">
	<label class="col-md-4 control-label" for="noarsip">Nomor Arsip</label>
	<div class="col-md-4">
	<input id="noarsip" name="noarsip" class="form-control input-md" type="text" required>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="tahun">Tahun</label>
	<div class="col-md-4">
	<input id="tahun" name="tahun" class="form-control input-md" type="text" required>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="tanggal">Tanggal</label>
	<div class="col-md-4">
  <div class="input-group">
    <div class="input-group-addon">(yyyy-mm-dd)</div>
    <input id="tanggal" name="tanggal" class="form-control input-md" type="text" required>
	</div>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="kode">Kode Klasifikasi</label>
	<div class="col-md-4">
	<select id="kode" name="kode" class="form-control input-md">
	<?php
		if(isset($kode)){
			foreach($kode as $k) {
				echo "<option value='".$k['kode']."' >".$k['nama']." - ".$k['kode']."</option>";
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="uraian">Uraian</label>
	<div class="col-md-4">
  <textarea id="uraian" name="uraian" class="form-control" rows="3"></textarea>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="ket">Keterangan Keaslian</label>
	<div class="col-md-4">
	<select class="form-control" name="ket" id="ket">
      <option value="asli" >Asli</option>
      <option value="copy" >Copy</option>
    </select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="jumlah">Jumlah</label>
	<div class="col-md-4">
	<input id="jumlah" name="jumlah" class="form-control input-md" type="text" value="1">
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="nobox">Nomor Box</label>
	<div class="col-md-4">
	<input id="nobox" name="nobox" class="form-control input-md" type="text">
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="nobox">File</label>
	<div class="col-md-4">
	<input type="file" id="file" name="file" accept=".doc,.docx,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf">
	<p class="help-block">Ukuran Maksimal <?php echo number_format(ceil(max_file_upload_in_bytes()/1000)); ?> MB</p>
	</div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Simpan</button>
  </div>
</div>


</fieldset>
</form>
<?php
function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
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