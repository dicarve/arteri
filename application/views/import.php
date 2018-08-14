<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<h2>Import Data</h2>
<hr>
<?php
if ($this->session->flashdata('zz')) {
    echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('zz') . '</div>';
}
?>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">Export data</div>
  		<div class="panel-body"><a href="<?php echo site_url('/home/dl') ?>" class="btn btn-success" id="export">Export</a></div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Import data <a href="<?php echo base_url('/public/template import arteri.xlsx') ?>" class="btn btn-success btn-sm" id="export">File template</a></div>
		<div class="panel-body">
			<form id="import_data" action="<?php echo site_url('/admin/importdata') ?>" enctype="multipart/form-data" class="form-horizontal" method="post" role="form">
				<label class="control-label" for="up_file">Upload</label>
				<input type="file" name="up_file" id="up_file" required/>
				<input type="submit" value="Upload" class="submit" />
			</form>
		</div>
	</div>
</div>