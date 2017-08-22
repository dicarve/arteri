<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(!$this->session->tipe=='admin') {
			redirect('/home/login', 'refresh');
		}
	}

	function __output($nview,$data=null)
	{
		$this->load->view('header',$data);
		$this->load->view($nview,$data);
		$this->load->view('footer');
	}
	
	function masterlist($tipe)
	{
		$data;
		switch($tipe)
		{
			case "kode":
			$q = "select * from master_kode order by kode asc";
			$hsl = $this->db->query($q);
			$data = $hsl->result_array();
			break;
			case "pencipta":
			$q = "select * from master_pencipta order by nama_pencipta asc";
			$hsl = $this->db->query($q);
			$data = $hsl->result_array();
			break;
			case "unitpengolah":
			$q = "select * from master_pengolah order by nama_pengolah asc";
			$hsl = $this->db->query($q);
			$data = $hsl->result_array();
			break;
			case "lokasi":
			$q = "select * from master_lokasi order by nama_lokasi asc";
			$hsl = $this->db->query($q);
			$data = $hsl->result_array();
			break;
			case "media":
			$q = "select * from master_media order by nama_media asc";
			$hsl = $this->db->query($q);
			$data = $hsl->result_array();
			break;
		}
		
		return $data;
	}
	
	function entr()
	{
		$data["kode"]=$this->masterlist("kode");
		$data["pencipta"]=$this->masterlist("pencipta");
		$data["unitpengolah"]=$this->masterlist("unitpengolah");
		$data["lokasi"]=$this->masterlist("lokasi");
		$data["media"]=$this->masterlist("media");
		
		$this->__output('entri1',$data);
	}

	function gentr()
	{
		$noarsip=trim($this->input->post('noarsip'));
		$tanggal=trim($this->input->post('tanggal'));
		$uraian=trim($this->input->post('uraian'));
		$kode=trim($this->input->post('kode'));
		$ket=trim($this->input->post('ket'));
		$nobox=trim($this->input->post('nobox'));
		$file="";
		$config['upload_path'] = 'files/';
		$config['allowed_types'] = 'pdf|docx|doc';
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')) {
			$datafile=$this->upload->data();
			//$file = $datafile['full_path'];
			$file = $datafile['file_name'];
		}else {
			//echo $this->upload->display_errors();
			//echo $config['upload_path'];
			//die();
		}

		$q = "insert into data_arsip (noarsip,tanggal,uraian,kode,ket,nobox,file) values ('$noarsip','$tanggal','$uraian','$kode','$ket','$nobox','$file');";
		$hsl = $this->db->query($q);
		$q = "SELECT LAST_INSERT_ID() as vid;";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		$v = $row['vid'];
		//var_dump($row);
		redirect('/home/', 'refresh');
	}

	function vedit($id)
	{
		if($id!=""){
			$q = "select * from data_arsip where id=$id";
			$hsl = $this->db->query($q);
			$row = $hsl->row_array();
			$previous = "";
			if(isset($_SERVER['HTTP_REFERER'])) {
				$previous = $_SERVER['HTTP_REFERER'];
				$row['previous'] = $previous;
			}
			$row["kode2"]=$this->masterlist("kode");
			$row["pencipta2"]=$this->masterlist("pencipta");
			$row["unitpengolah2"]=$this->masterlist("unitpengolah");
			$row["lokasi2"]=$this->masterlist("lokasi");
			$row["media2"]=$this->masterlist("media");
			if(count($row)>0) {
				$this->__output('edit1',$row);
			}else{
				redirect('/home/', 'refresh');
			}
		}else {
			redirect('/home/', 'refresh');
		}

	}

	function edit1()
	{
		$noarsip=trim($this->input->post('noarsip'));
		$tanggal=trim($this->input->post('tanggal'));
		$uraian=trim($this->input->post('uraian'));
		$kode=trim($this->input->post('kode'));
		$ket=trim($this->input->post('ket'));
		$nobox=trim($this->input->post('nobox'));
		$id=trim($this->input->post('id'));
		$previous=trim($this->input->post('previous'));
		$file="";
		$config['upload_path'] = 'files/';
		$config['allowed_types'] = 'pdf|docx|doc';
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')) {
			$datafile=$this->upload->data();
			//$file = $datafile['full_path'];
			$file = $datafile['file_name'];
		}else {
			//echo $this->upload->display_errors();
			//echo $this->input->post('nobox');
			//die();
		}

		if(isset($_POST)) {
			$q = "update data_arsip set noarsip='$noarsip',tanggal='$tanggal',uraian='$uraian',kode='$kode',ket='$ket',nobox='$nobox',file='$file' where id=$id";
			$hsl = $this->db->query($q);
		}
		if($previous=="") {
			redirect('/home/', 'refresh');
		}else {
			header('Location: ' . $previous);
		}
	}

	function delfile()
	{
		$id=trim($this->input->post('id'));
		$q = "select file from data_arsip where id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array()['file'];
		if($row!=""){
			$alamat = ROOTPATH."/files/".$row;
			unlink($alamat);
		}
		$q = "update data_arsip set file='' where id=$id";
		$hsl = $this->db->query($q);
	}

	function del1()
	{
		$id=trim($this->input->post('id'));
		$q = "select file from data_arsip where id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array()['file'];
		if($row!=""){
			$alamat = ROOTPATH."/files/".$row;
			unlink($alamat);
		}
		$q = "delete from data_arsip where id=$id";
		$hsl = $this->db->query($q);
	}

	function klas()
	{
		$q = "select * from master_kode order by kode asc";
		$hsl = $this->db->query($q);
		$data['user'] = $hsl->result_array();
		$this->__output('klas',$data);
	}

	function addkode()
	{
		$kode = trim($this->input->post('kode'));
		$nama = trim($this->input->post('nama'));
		$retensi = trim($this->input->post('retensi'));
		$q = "insert into master_kode (kode,nama,retensi) values ('$kode','$nama',$retensi)";
		$hsl = $this->db->query($q);
	}

	function edkode()
	{
		$kode = trim($this->input->post('kode'));
		$nama = trim($this->input->post('nama'));
		$retensi = trim($this->input->post('retensi'));
		$id = trim($this->input->post('id'));
		$q = "update master_kode set kode='$kode'";
		$q .= ",nama='$nama'";
		$q .= ",retensi=$retensi where id=$id";
		$hsl = $this->db->query($q);
	}

	function delkode()
	{
		$id = trim($this->input->post('id'));
		$q = "delete from master_kode where id=$id";
		$hsl = $this->db->query($q);
	}

	function akode()
	{
		$id = trim($this->input->post('id'));
		$q = "select * from master_kode where id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		if($row) {
			echo json_encode($row);
		}
	}

	function reloadkode()
	{
		$q = "select * from master_kode order by kode asc";
		$hsl = $this->db->query($q);
		$row = $hsl->result_array();
		if($row) {
			echo "<table class='table table-bordered' name='vkode' id='vkode'>
			<thead>
				<th>Kode</th>
				<th>Nama</th>
				<th>Retensi</th>
				<th></th>
				<th></th>
			</thead>";
			$no=1;
			foreach($row as $u) {
				echo "<tr>";
                echo "<td>".$u['kode']."</td>";
                echo "<td>".$u['nama']."</td>";
                echo "<td>".$u['retensi']." Tahun</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editkode\" class='edkode' href='#' id='".$u['id']."' >edit</a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delkode\" class='delkode' href='#' id='".$u['id']."' >delete</a></td>";
                echo "</tr>";
                $no++;
			}
			echo "</table>";
		}
	}
	
	function penc()
	{
		$q = "select * from master_pencipta order by nama_pencipta asc";
		$hsl = $this->db->query($q);
		$data['penc'] = $hsl->result_array();
		$this->__output('pencipta',$data);
	}
	
	function addpenc()
	{
		$nama = trim($this->input->post('nama'));
		$q = "insert into master_pencipta (nama_pencipta) values ('$nama')";
		$hsl = $this->db->query($q);
	}

	function edpenc()
	{
		$nama = trim($this->input->post('nama'));
		$id = trim($this->input->post('id'));
		$q = "update master_pencipta set nama_pencipta='$nama'";
		$q .= " where id=$id";
		$hsl = $this->db->query($q);
	}

	function delpenc()
	{
		$id = trim($this->input->post('id'));
		$q = "delete from master_pencipta where id=$id";
		$hsl = $this->db->query($q);
	}

	function apenc()
	{
		$id = trim($this->input->post('id'));
		$q = "select * from master_pencipta where id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		if($row) {
			echo json_encode($row);
		}
	}

	function reloadpenc()
	{
		$q = "select * from master_pencipta order by nama_pencipta asc";
		$hsl = $this->db->query($q);
		$row = $hsl->result_array();
		if($row) {
			echo "<table class='table table-bordered' name='vpenc' id='vpenc'>
			<thead>
				<th>No</th>
				<th>Nama</th>
				<th></th>
				<th></th>
			</thead>";
			$no=1;
			foreach($row as $u) {
				echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$u['nama_pencipta']."</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editpenc\" class='edpenc' href='#' id='".$u['id']."' >edit</a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delpenc\" class='delpenc' href='#' id='".$u['id']."' >delete</a></td>";
                echo "</tr>";
                $no++;
			}
			echo "</table>";
		}
	}
	
	function pengolah()
	{
		$q = "select * from master_pengolah order by nama_pengolah asc";
		$hsl = $this->db->query($q);
		$data['peng'] = $hsl->result_array();
		$this->__output('pengolah',$data);
	}
	
	function addpeng()
	{
		$nama = trim($this->input->post('nama'));
		$q = "insert into master_pengolah (nama_pengolah) values ('$nama')";
		$hsl = $this->db->query($q);
	}

	function edpeng()
	{
		$nama = trim($this->input->post('nama'));
		$id = trim($this->input->post('id'));
		$q = "update master_pengolah set nama_pengolah='$nama'";
		$q .= " where id=$id";
		$hsl = $this->db->query($q);
	}

	function delpeng()
	{
		$id = trim($this->input->post('id'));
		$q = "delete from master_pengolah where id=$id";
		$hsl = $this->db->query($q);
	}

	function apeng()
	{
		$id = trim($this->input->post('id'));
		$q = "select * from master_pengolah where id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		if($row) {
			echo json_encode($row);
		}
	}

	function reloadpeng()
	{
		$q = "select * from master_pengolah order by nama_pengolah asc";
		$hsl = $this->db->query($q);
		$row = $hsl->result_array();
		if($row) {
			echo "<table class='table table-bordered' name='vpeng' id='vpeng'>
			<thead>
				<th>No</th>
				<th>Nama</th>
				<th></th>
				<th></th>
			</thead>";
			$no=1;
			foreach($row as $u) {
				echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$u['nama_pengolah']."</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editpeng\" class='edpeng' href='#' id='".$u['id']."' >edit</a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delpeng\" class='delpeng' href='#' id='".$u['id']."' >delete</a></td>";
                echo "</tr>";
                $no++;
			}
			echo "</table>";
		}
	}
	
	function lokasi()
	{
		$q = "select * from master_lokasi order by nama_lokasi asc";
		$hsl = $this->db->query($q);
		$data['lok'] = $hsl->result_array();
		$this->__output('lokasi',$data);
	}
	
	function addlok()
	{
		$nama = trim($this->input->post('nama'));
		$q = "insert into master_lokasi (nama_lokasi) values ('$nama')";
		$hsl = $this->db->query($q);
	}

	function edlok()
	{
		$nama = trim($this->input->post('nama'));
		$id = trim($this->input->post('id'));
		$q = "update master_lokasi set nama_lokasi='$nama'";
		$q .= " where id=$id";
		$hsl = $this->db->query($q);
	}

	function dellok()
	{
		$id = trim($this->input->post('id'));
		$q = "delete from master_lokasi where id=$id";
		$hsl = $this->db->query($q);
	}

	function alok()
	{
		$id = trim($this->input->post('id'));
		$q = "select * from master_lokasi where id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		if($row) {
			echo json_encode($row);
		}
	}

	function reloadlok()
	{
		$q = "select * from master_lokasi order by nama_lokasi asc";
		$hsl = $this->db->query($q);
		$row = $hsl->result_array();
		if($row) {
			echo "<table class='table table-bordered' name='vlok' id='vlok'>
			<thead>
				<th>No</th>
				<th>Nama</th>
				<th></th>
				<th></th>
			</thead>";
			$no=1;
			foreach($row as $u) {
				echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$u['nama_lokasi']."</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editlok\" class='edlok' href='#' id='".$u['id']."' >edit</a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#dellok\" class='dellok' href='#' id='".$u['id']."' >delete</a></td>";
                echo "</tr>";
                $no++;
			}
			echo "</table>";
		}
	}
	
	function media()
	{
		$q = "select * from master_media order by nama_media asc";
		$hsl = $this->db->query($q);
		$data['med'] = $hsl->result_array();
		$this->__output('media',$data);
	}
	
	function addmed()
	{
		$nama = trim($this->input->post('nama'));
		$q = "insert into master_media (nama_media) values ('$nama')";
		$hsl = $this->db->query($q);
	}

	function edmed()
	{
		$nama = trim($this->input->post('nama'));
		$id = trim($this->input->post('id'));
		$q = "update master_media set nama_media='$nama'";
		$q .= " where id=$id";
		$hsl = $this->db->query($q);
	}

	function delmed()
	{
		$id = trim($this->input->post('id'));
		$q = "delete from master_media where id=$id";
		$hsl = $this->db->query($q);
	}

	function amed()
	{
		$id = trim($this->input->post('id'));
		$q = "select * from master_media where id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		if($row) {
			echo json_encode($row);
		}
	}

	function reloadmed()
	{
		$q = "select * from master_media order by nama_media asc";
		$hsl = $this->db->query($q);
		$row = $hsl->result_array();
		if($row) {
			echo "<table class='table table-bordered' name='vmed' id='vmed'>
			<thead>
				<th>No</th>
				<th>Nama</th>
				<th></th>
				<th></th>
			</thead>";
			$no=1;
			foreach($row as $u) {
				echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$u['nama_media']."</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editmed\" class='edmed' href='#' id='".$u['id']."' >edit</a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delmed\" class='delmed' href='#' id='".$u['id']."' >delete</a></td>";
                echo "</tr>";
                $no++;
			}
			echo "</table>";
		}
	}

	function vuser()
	{
		$q = "select * from master_user";
		$hsl = $this->db->query($q);
		$data['user'] = $hsl->result_array();
		$this->__output('vuser',$data);

	}

	function adduser()
	{
		$username = trim($this->input->post('username'));
		$password = trim($this->input->post('password'));
		$tipe = trim($this->input->post('tipe'));
		$q = "insert into master_user (username,password,tipe) values ('$username',md5('$password'),'$tipe')";
		$hsl = $this->db->query($q);

	}

	function eduser()
	{
		$username = trim($this->input->post('username'));
		$password = trim($this->input->post('password'));
		$tipe = trim($this->input->post('tipe'));
		$id = trim($this->input->post('id'));
		$q = "update master_user set username='$username'";
		if($password!="") $q .= ",password=md5('$password')";
		$q .= ",tipe='$tipe' where id=$id";
		$hsl = $this->db->query($q);
	}

	function deluser()
	{
		$id = trim($this->input->post('id'));
		$q = "delete from master_user where id=$id";
		$hsl = $this->db->query($q);
	}

	function auser()
	{
		$id = trim($this->input->post('id'));
		$q = "select * from master_user where id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		if($row) {
			echo json_encode($row);
		}
	}

	function reloaduser()
	{
		$q = "select * from master_user";
		$hsl = $this->db->query($q);
		$row = $hsl->result_array();
		if($row) {
			echo "<table class='table table-bordered' name='vuser' id='vuser'>
			<thead>
				<th>No</th>
				<th>Username</th>
				<th>Tipe</th>
				<th></th>
				<th></th>
			</thead>";
			$no=1;
			foreach($row as $u) {
				echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$u['username']."</td>";
                echo "<td>".$u['tipe']."</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#edituser\" class='eduser' href='#' id='".$u['id']."' >edit</a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#deluser\" class='deluser' href='#' id='".$u['id']."' >delete</a></td>";
                echo "</tr>";
                $no++;
			}
			echo "</table>";
		}
	}

	function eximp()
	{
		$this->__output('eximp');
	}

	function exportdata()
	{
		include('dbimexport.php');
		$db_config = Array
					(
						'dbtype' => "MYSQL",
						'host' => "localhost",
						'database' => "db1",
						'user' => "root",
						'password' => "",
					);
		$dbimexport = new dbimexport($db_config);
		$dbimexport->download_path = "";
		$dbimexport->download = true;
		$dbimexport->file_name = "backup_data_".date("Y-m-d_H-i-s");
		$dbimexport->export();
	}

	function importdata()
	{
		if($_FILES["up_file"]["name"])
		{
			include('dbimexport.php');
			$db_config = Array
						(
							'dbtype' => "MYSQL",
							'host' => "localhost",
							'database' => "db1",
							'user' => "root",
							'password' => "",
						);
			$dbimexport = new dbimexport($db_config);
			$filename = $_FILES["up_file"]["name"];
			$source = $_FILES["up_file"]["tmp_name"];
			$dbimexport->import_path = $source;
			$dbimexport->import();
			$this->session->set_flashdata('zz', "Data berhasil diimport");
			redirect('/admin/eximp', 'refresh');
		}else {
			$this->session->set_flashdata('zz', "Tidak ada file yang diupload");
			redirect('/admin/eximp', 'refresh');
		}
	}

}