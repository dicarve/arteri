<?php
/**
 * This application is licensed under GNU General Public License version 3
 * Developers:
 * Syauqi Fuadi ( xfuadi@gmail.com )
 * Arie Nugraha ( dicarve@gmail.com )
 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Controller class constructor
	 * 
	 */
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->tipe=='admin') {
			redirect('/home/login', 'refresh');
		}
	}

	/**
	 * Method to output complete page with header and footer
	 * 
	 */
	protected function __output($nview,$data=null)
	{
		$this->load->view('header',$data);
		$this->load->view($nview,$data);
		$this->load->view('footer');
	}

	/**
	 * Method to sanitize input data
	 * 
	 * @return String
	 * 
	 */
	protected function __sanitizeString($str)
	{
		// return filter_var($this->__sanitizeString( $str),FILTER_SANITIZE_STRING);
		//return $this->db->escape($this->__sanitizeString( $str));
		//return $this->db->escape(filter_var($str,FILTER_SANITIZE_STRING));
		return html_purify($str);
	}

	/**
	 * Method to compile SQL query for master data
	 * and return data in array format
	 * 
	 * @return Array
	 * 
	 */
	protected function masterlist($tipe)
	{
		$data;
		switch($tipe)
		{
			case "kode":
			$q = "SELECT * FROM master_kode ORDER BY kode ASC";
			$hsl = $this->db->query($q);
			$data = $hsl->result_array();
			break;
			case "pencipta":
			$q = "SELECT * FROM master_pencipta ORDER BY nama_pencipta ASC";
			$hsl = $this->db->query($q);
			$data = $hsl->result_array();
			break;
			case "unitpengolah":
			$q = "SELECT * FROM master_pengolah ORDER BY nama_pengolah ASC";
			$hsl = $this->db->query($q);
			$data = $hsl->result_array();
			break;
			case "lokasi":
			$q = "SELECT * FROM master_lokasi ORDER BY nama_lokasi ASC";
			$hsl = $this->db->query($q);
			$data = $hsl->result_array();
			break;
			case "media":
			$q = "SELECT * FROM master_media ORDER BY nama_media ASC";
			$hsl = $this->db->query($q);
			$data = $hsl->result_array();
			break;
		}
		
		return $data;
	}

	/**
	 * Show archive entry form
	 * 
	 */
	public function entr()
	{
		$data["kode"]=$this->masterlist("kode");
		$data["pencipta"]=$this->masterlist("pencipta");
		$data["unitpengolah"]=$this->masterlist("unitpengolah");
		$data["lokasi"]=$this->masterlist("lokasi");
		$data["media"]=$this->masterlist("media");
		$data["title"]="Tambah Arsip";
		
		$this->__output('entri1',$data);
	}

	/**
	 * Process input data from archive entry form
	 * 
	 */
	public function gentr()
	{
		$noarsip=$this->__sanitizeString($this->input->post('noarsip'));
		$tanggal=$this->__sanitizeString($this->input->post('tanggal'));
		$uraian=$this->__sanitizeString($this->input->post('uraian'));
		$kode=$this->__sanitizeString($this->input->post('kode'));
		$pencipta=$this->__sanitizeString($this->input->post('pencipta'));
		$unitpengolah=$this->__sanitizeString($this->input->post('unitpengolah'));
		$lokasi=$this->__sanitizeString($this->input->post('lokasi'));
		$media=$this->__sanitizeString($this->input->post('media'));
		$ket=$this->__sanitizeString($this->input->post('ket'));
		$nobox=$this->__sanitizeString($this->input->post('nobox'));
		$jumlah=$this->__sanitizeString($this->input->post('jumlah'));
		$file="";
		$config['upload_path'] = 'files/';
		$config['allowed_types'] = 'pdf|docx|doc';
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')) {
			$datafile=$this->upload->data();
			//$file = $datafile['full_path'];
			$file = $datafile['file_name'];
		} else {
			//echo $this->upload->display_errors();
			//echo $config['upload_path'];
			//die();
		}

		$q = "INSERT INTO data_arsip (noarsip,tanggal,uraian,kode,ket,nobox,file,jumlah,pencipta,unit_pengolah,lokasi,media,tgl_input) 
			VALUES ('$noarsip','$tanggal','$uraian','$kode','$ket','$nobox','$file','$jumlah',$pencipta,$unitpengolah,$lokasi,$media,now());";
		$hsl = $this->db->query($q);
		$q = "SELECT LAST_INSERT_ID() as vid;";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		$v = $row['vid'];
		//var_dump($row);
		redirect('/home/view/'.$v, 'refresh');
	}

	/**
	 * Edit archive data form
	 * 
	 * @param $id The ID of archive
	 * 
	 */
	public function vedit($id)
	{
		if($id!=""){
			$q = "SELECT * FROM data_arsip WHERE id=$id";
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
			$row["title"]="Ubah Arsip";
			if(count($row)>0) {
				$this->__output('edit1',$row);
			}else{
				redirect('/home/', 'refresh');
			}
		} else {
			redirect('/home/', 'refresh');
		}
	}

	/**
	 * Process input data from archive edit form
	 * 
	 */
	public function edit()
	{
		$noarsip=$this->__sanitizeString($this->input->post('noarsip'));
		$tanggal=$this->__sanitizeString($this->input->post('tanggal'));
		$uraian=$this->__sanitizeString($this->input->post('uraian'));
		$kode=$this->__sanitizeString($this->input->post('kode'));
		$ket=$this->__sanitizeString($this->input->post('ket'));
		$pencipta=$this->__sanitizeString($this->input->post('pencipta'));
		$unitpengolah=$this->__sanitizeString($this->input->post('unitpengolah'));
		$lokasi=$this->__sanitizeString($this->input->post('lokasi'));
		$media=$this->__sanitizeString($this->input->post('media'));
		$nobox=$this->__sanitizeString($this->input->post('nobox'));
		$jumlah=$this->__sanitizeString($this->input->post('jumlah'));
		$id=$this->__sanitizeString($this->input->post('id'));
		$previous=$this->__sanitizeString($this->input->post('previous'));
		$file="";
		$config['upload_path'] = 'files/';
		$config['allowed_types'] = 'pdf|docx|doc';
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')) {
			$datafile=$this->upload->data();
			//$file = $datafile['full_path'];
			$file = $datafile['file_name'];
		} else {
			$q = "SELECT file FROM data_arsip WHERE id=$id";
			$d = $this->db->query($q)->row_array()['file'];
			$file=$d;
		}

		if(isset($_POST)) {
			$q = "UPDATE data_arsip SET noarsip='$noarsip',tanggal='$tanggal',uraian='$uraian',kode='$kode',ket='$ket',nobox='$nobox',file='$file',jumlah='$jumlah',pencipta=$pencipta,unit_pengolah=$unitpengolah,lokasi=$lokasi,media=$media WHERE id=$id";
			$hsl = $this->db->query($q);
		}
		redirect('/home/view/'.$id, 'refresh');
		/* if($previous=="") {
			redirect('/home/view/'.$id, 'refresh');
		}else {
			header('Location: ' . $previous);
		} */
	}

	/**
	 * Delete archive file value in archive record
	 * 
	 */
	public function delfile()
	{
		$id=$this->__sanitizeString($this->input->post('id'));
		$q = "SELECT file FROM data_arsip WHERE id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array()['file'];
		if($row!=""){
			$alamat = ROOTPATH."/files/".$row;
			unlink($alamat);
		}
		$q = "UPDATE data_arsip SET file='' WHERE id=$id";
		$hsl = $this->db->query($q);
	}

	/**
	 * Delete archive file
	 * 
	 */
	public function del1()
	{
		$id=$this->__sanitizeString($this->input->post('id'));
		$q = "SELECT file FROM data_arsip WHERE id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array()['file'];
		if($row!=""){
			$alamat = ROOTPATH."/files/".$row;
			unlink($alamat);
		}
		$q = "DELETE FROM data_arsip WHERE id=$id";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Show classification data page
	 * 
	 */
	public function klas()
	{
		$katakunci = $this->__sanitizeString($this->input->get('katakunci'));

		$q = "SELECT * FROM master_kode "; 
		if ($katakunci) {
      $q .= ' WHERE kode LIKE \'%'.$katakunci.'%\' OR nama LIKE \'%'.$katakunci.'%\' ';
		}
		$q .= " ORDER BY kode ASC";
		$hsl = $this->db->query($q);
		$data['user'] = $hsl->result_array();
		$this->__output('klas',$data);
	}

	/**
	 * Add classification data and respond in JSON format
	 * 
	 */
	public function addkode()
	{
		$kode = $this->__sanitizeString($this->input->post('kode'));
		$nama = $this->__sanitizeString($this->input->post('nama'));
		$retensi = $this->__sanitizeString($this->input->post('retensi'));
		$q = "INSERT INTO master_kode (kode,nama,retensi) VALUES ($kode,$nama,$retensi)";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Update classification data and respond in JSON format
	 * 
	 */
	public function edkode()
	{
		$kode = $this->__sanitizeString($this->input->post('kode'));
		$nama = $this->__sanitizeString($this->input->post('nama'));
		$retensi = $this->__sanitizeString($this->input->post('retensi'));
		$id = $this->__sanitizeString($this->input->post('id'));
		$q = "UPDATE master_kode SET kode=$kode";
		$q .= ",nama=$nama";
		$q .= ",retensi=$retensi WHERE id=$id";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Delete classification data and respond in JSON format
	 * 
	 */
	public function delkode()
	{
		$id = $this->__sanitizeString($this->input->post('id'));
		$q = "DELETE FROM master_kode WHERE id=$id";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Get classification data and respond in JSON format
	 * 
	 */
	public function akode()
	{
		$id = $this->__sanitizeString($this->input->post('id'));
		$q = "SELECT * FROM master_kode WHERE id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		if($row) {
			echo json_encode($row);
		}	else {
			echo '[]';
		}
		exit();
	}

	/**
	 * AJAX reload for classification data
	 * 
	 */
	public function reloadkode()
	{
		$q = "SELECT * FROM master_kode ORDER BY kode ASC";
		$hsl = $this->db->query($q);
		$row = $hsl->result_array();
		if($row) {
			echo "<table class='table table-bordered' name='vkode' id='vkode'>
			<thead>
				<th>Kode</th>
				<th>Nama</th>
				<th>Retensi</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
			$no=1;
			foreach($row as $u) {
				echo "<tr>";
        echo "<td>".$u['kode']."</td>";
        echo "<td>".$u['nama']."</td>";
        echo "<td>".$u['retensi']." Tahun</td>";
        echo "<td><a data-toggle=\"modal\" data-target=\"#editkode\" class='edkode' href='#' id='".$u['id']."' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
        echo "<td><a data-toggle=\"modal\" data-target=\"#delkode\" class='delkode' href='#' id='".$u['id']."' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
        echo "</tr>";
        $no++;
			}
			echo "</table>";
		}
	}
	
	/**
	 * Show archive author/creator data page
	 * 
	 */
	public function penc()
	{
		$katakunci = $this->__sanitizeString( $this->input->get('katakunci'));

		$q = "SELECT * FROM master_pencipta ";
		if ($katakunci) {
		  $q .= ' WHERE nama_pencipta LIKE \'%'.$katakunci.'%\' OR id LIKE \'%'.$katakunci.'%\' ';
		}
		$q .= " ORDER BY nama_pencipta ASC";
		$hsl = $this->db->query($q);
		$data['penc'] = $hsl->result_array();
		$this->__output('pencipta',$data);
	}
	
	/**
	 * Add archive creator data and respond in JSON format
	 * 
	 */
	public function addpenc()
	{
		$nama = $this->__sanitizeString( $this->input->post('nama'));
		$q = "INSERT INTO master_pencipta (nama_pencipta) VALUES ($nama)";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Update archive creator data and respond in JSON format
	 * 
	 */
	public function edpenc()
	{
		$nama = $this->__sanitizeString( $this->input->post('nama'));
		$id = $this->__sanitizeString( $this->input->post('id'));
		$q = "UPDATE master_pencipta SET nama_pencipta=$nama";
		$q .= " WHERE id=$id";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Delete archive creator data and respond in JSON format
	 * 
	 */
	public function delpenc()
	{
		$id = $this->__sanitizeString( $this->input->post('id'));
		$q = "DELETE FROM master_pencipta WHERE id=$id";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Get archive creator data and respond in JSON format
	 * 
	 */
	public function apenc()
	{
		$id = $this->__sanitizeString( $this->input->post('id'));
		$q = "SELECT * FROM master_pencipta WHERE id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		if($row) {
			echo json_encode($row);
		}	else {
			echo '[]';
		}
		exit();
	}

	/**
	 * AJAX reload for archive creator
	 * 
	 */
	public function reloadpenc()
	{
		$q = "SELECT * FROM master_pencipta ORDER BY nama_pencipta ASC";
		$hsl = $this->db->query($q);
		$row = $hsl->result_array();
		if($row) {
			echo "<table class='table table-bordered' name='vpenc' id='vpenc'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Nama</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
			$no=1;
			foreach($row as $u) {
				echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$u['nama_pencipta']."</td>";
        echo "<td><a data-toggle=\"modal\" data-target=\"#editpenc\" class='edpenc' href='#' id='".$u['id']."' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
        echo "<td><a data-toggle=\"modal\" data-target=\"#delpenc\" class='delpenc' href='#' id='".$u['id']."' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
        echo "</tr>";
        echo "</tr>";
        $no++;
			}
			echo "</table>";
		}
	}

	/**
	 * Show archival unit/manager data page
	 * 
	 */
	public function pengolah()
	{
		$katakunci = $this->__sanitizeString( $this->input->get('katakunci'));

		$q = "SELECT * FROM master_pengolah ";
		if ($katakunci) {
		  $q .= ' WHERE nama_pengolah LIKE \'%'.$katakunci.'%\' OR id LIKE \'%'.$katakunci.'%\' ';
		}
		$q .= " ORDER BY nama_pengolah ASC";
		$hsl = $this->db->query($q);
		$data['peng'] = $hsl->result_array();
		$this->__output('pengolah',$data);
	}
	
	/**
	 * Add archival unit data and respond in JSON format
	 * 
	 */
	public function addpeng()
	{
		$nama = $this->__sanitizeString( $this->input->post('nama'));
		$q = "INSERT INTO master_pengolah (nama_pengolah) VALUES ($nama)";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Update archival unit data and respond in JSON format
	 * 
	 */
	public function edpeng()
	{
		$nama = $this->__sanitizeString( $this->input->post('nama'));
		$id = $this->__sanitizeString( $this->input->post('id'));
		$q = "UPDATE master_pengolah SET nama_pengolah=$nama";
		$q .= " WHERE id=$id";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Delete archival unit data and respond in JSON format
	 * 
	 */
	public function delpeng()
	{
		$id = $this->__sanitizeString( $this->input->post('id'));
		$q = "DELETE FROM master_pengolah WHERE id=$id";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Get archival unit data and respond in JSON format
	 * 
	 */
	public function apeng()
	{
		$id = $this->__sanitizeString( $this->input->post('id'));
		$q = "SELECT * FROM master_pengolah WHERE id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		if($row) {
			echo json_encode($row);
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * AJAX reload for archival unit data
	 * 
	 */
	public function reloadpeng()
	{
		$q = "SELECT * FROM master_pengolah ORDER BY nama_pengolah ASC";
		$hsl = $this->db->query($q);
		$row = $hsl->result_array();
		if($row) {
			echo "<table class='table table-bordered' name='vpeng' id='vpeng'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Nama</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
			$no=1;
			foreach($row as $u) {
				echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$u['nama_pengolah']."</td>";
        echo "<td><a data-toggle=\"modal\" data-target=\"#editpeng\" class='edpeng' href='#' id='".$u['id']."' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
        echo "<td><a data-toggle=\"modal\" data-target=\"#delpeng\" class='delpeng' href='#' id='".$u['id']."' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
        echo "</tr>";
        $no++;
			}
			echo "</table>";
		}
	}

	/**
	 * Show archive location data page
	 * 
	 */
	public function lokasi()
	{
		$katakunci = $this->__sanitizeString( $this->input->get('katakunci'));
		
		$q = "SELECT * FROM master_lokasi ";
		if ($katakunci) {
		  $q .= ' WHERE nama_lokasi LIKE \'%'.$katakunci.'%\' OR id LIKE \'%'.$katakunci.'%\' ';
		}
		$q .= " ORDER BY nama_lokasi ASC";
		$hsl = $this->db->query($q);
		$data['lok'] = $hsl->result_array();
		$this->__output('lokasi',$data);
	}
	
	/**
	 * Add archive location data and respond in JSON format
	 * 
	 */
	public function addlok()
	{
		$nama = $this->__sanitizeString( $this->input->post('nama'));
		$q = "INSERT INTO master_lokasi (nama_lokasi) VALUES ($nama)";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Update archive location data and respond in JSON format
	 * 
	 */
	public function edlok()
	{
		$nama = $this->__sanitizeString( $this->input->post('nama'));
		$id = $this->__sanitizeString( $this->input->post('id'));
		$q = "UPDATE master_lokasi SET nama_lokasi=$nama";
		$q .= " WHERE id=$id";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Delete archive location data and respond in JSON format
	 * 
	 */
	public function dellok()
	{
		$id = $this->__sanitizeString( $this->input->post('id'));
		$q = "DELETE FROM master_lokasi WHERE id=$id";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Get archive location data and respond in JSON format
	 * 
	 */
	public function alok()
	{
		$id = $this->__sanitizeString( $this->input->post('id'));
		$q = "SELECT * FROM master_lokasi WHERE id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		if($row) {
			echo json_encode($row);
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * AJAX reload for location data
	 * 
	 */
	public function reloadlok()
	{
		$q = "SELECT * FROM master_lokasi ORDER BY nama_lokasi ASC";
		$hsl = $this->db->query($q);
		$row = $hsl->result_array();
		if($row) {
			echo "<table class='table table-bordered' name='vlok' id='vlok'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Nama</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
			$no=1;
			foreach($row as $u) {
				echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$u['nama_lokasi']."</td>";
        echo "<td><a data-toggle=\"modal\" data-target=\"#editlok\" class='edlok' href='#' id='".$u['id']."' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
        echo "<td><a data-toggle=\"modal\" data-target=\"#dellok\" class='dellok' href='#' id='".$u['id']."' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
        echo "</tr>";
        $no++;
			}
			echo "</table>";
		}
	}
	
	/**
	 * Show media data page
	 * 
	 */
	public function media()
	{
		$katakunci = $this->__sanitizeString( $this->input->get('katakunci'));
		
		$q = "SELECT * FROM master_media ";
		if ($katakunci) {
		  $q .= ' WHERE nama_media LIKE \'%'.$katakunci.'%\' OR id LIKE \'%'.$katakunci.'%\' ';
		}
		$q .= " ORDER BY nama_media ASC";
		$hsl = $this->db->query($q);
		$data['med'] = $hsl->result_array();
		$this->__output('media',$data);
	}
	
	/**
	 * Add media data and respond in JSON format
	 * 
	 */
	public function addmed()
	{
		$nama = $this->__sanitizeString( $this->input->post('nama'));
		$q = "INSERT INTO master_media (nama_media) VALUES ($nama)";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Update media data and respond in JSON format
	 * 
	 */
	public function edmed()
	{
		$nama = $this->__sanitizeString( $this->input->post('nama'));
		$id = $this->__sanitizeString( $this->input->post('id'));
		$q = "UPDATE master_media SET nama_media=$nama";
		$q .= " WHERE id=$id";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Delete media data and respond in JSON format
	 * 
	 */
	public function delmed()
	{
		$id = $this->__sanitizeString( $this->input->post('id'));
		$q = "DELETE FROM master_media WHERE id=$id";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Get media data and respond in JSON format
	 * 
	 */
	public function amed()
	{
		$id = $this->__sanitizeString( $this->input->post('id'));
		$q = "SELECT * FROM master_media WHERE id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		if($row) {
			echo json_encode($row);
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * AJAX reload for media data
	 * 
	 */
	public function reloadmed()
	{
		$q = "SELECT * FROM master_media ORDER BY nama_media ASC";
		$hsl = $this->db->query($q);
		$row = $hsl->result_array();
		if($row) {
			echo "<table class='table table-bordered' name='vmed' id='vmed'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Nama</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
			$no=1;
			foreach($row as $u) {
				echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$u['nama_media']."</td>";
        echo "<td><a data-toggle=\"modal\" data-target=\"#editmed\" class='edmed' href='#' id='".$u['id']."' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
        echo "<td><a data-toggle=\"modal\" data-target=\"#delmed\" class='delmed' href='#' id='".$u['id']."' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
        echo "</tr>";
        $no++;
			}
			echo "</table>";
		}
	}

	/**
	 * Show user data page
	 * 
	 */
	public function vuser()
	{
		$katakunci = $this->__sanitizeString( $this->input->get('katakunci'));
		
		$q = "SELECT * FROM master_user ";
		if ($katakunci) {
		  $q .= ' WHERE username LIKE \'%'.$katakunci.'%\' OR tipe LIKE \'%'.$katakunci.'%\' ';
		}
		$q .= " ORDER BY username ASC";
		$hsl = $this->db->query($q);
		$data['user'] = $hsl->result_array();
		$this->__output('vuser',$data);
	}

	/**
	 * Check for user data and respond in JSON format
	 * 
	 */
	public function cekuser()
	{
		$username = $this->__sanitizeString($this->input->post('username'));
		$q = "SELECT username FROM master_user WHERE username=$username";
		$hsl = $this->db->query($q)->row_array();
		if($hsl['username']==$username) {
			echo json_encode(array('msg'=>'error'));
		}else {
			echo json_encode(array('msg'=>'ok'));
		}
	}

	/**
	 * Add user data and respond in JSON format
	 * 
	 */
	public function adduser()
	{
		$username = $this->__sanitizeString( $this->input->post('username'));
		$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		$tipe = $this->__sanitizeString( $this->input->post('tipe'));
		$akses_klas = $this->__sanitizeString( $this->input->post('akses_klas'));
		$akses_modul = json_encode($this->input->post('modul'));
		$q = "INSERT INTO master_user (username,password,tipe,akses_klas,akses_modul) VALUES ($username, '$password',$tipe,$akses_klas,'$akses_modul')";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Update user data and respond in JSON format
	 * 
	 */
	public function eduser()
	{
		$username = $this->__sanitizeString( $this->input->post('username'));
		$password = "";
		if($this->input->post('password')!="") {
			$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		}
		$tipe = $this->__sanitizeString( $this->input->post('tipe'));
		$akses_klas = $this->__sanitizeString( $this->input->post('akses_klas'));
		$akses_modul = json_encode($this->input->post('modul'));
		$id = $this->__sanitizeString( $this->input->post('id'));
		$q = "UPDATE master_user SET username=$username";
		if($password!="") $q .= ",password='$password'";
		$q .= ",tipe=$tipe,akses_klas=$akses_klas,akses_modul='$akses_modul' WHERE id=$id";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Delete user data and respond in JSON format
	 * 
	 */
	public function deluser()
	{
		$id = $this->__sanitizeString($this->input->post('id'));
		$q = "DELETE FROM master_user WHERE id=$id";
		$hsl = $this->db->query($q);
		if($hsl) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * Get user data in JSON format
	 * 
	 */
	public function auser()
	{
		$id = $this->__sanitizeString($this->input->post('id'));
		$q = "SELECT * FROM master_user WHERE id=$id";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		if($row) {
			echo json_encode($row);
		} else {
			echo '[]';
		}
		exit();
	}

	/**
	 * AJAX reload for user data
	 * 
	 */
	public function reloaduser()
	{
		$q = "SELECT * FROM master_user";
		$hsl = $this->db->query($q);
		$row = $hsl->result_array();
		if($row) {
			echo "<table class='table table-bordered' name='vuser' id='vuser'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Username</th>
				<th>Akses Klasifikasi</th>
				<th>Akses Modul</th>
				<th>Tipe</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
			$no=1;
			foreach($row as $u) {
				echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$u['username']."</td>";
        echo "<td>".$u['akses_klas']."</td>";
        echo "<td>";
				$mm = $u['akses_modul'];
				if($mm!="") {
					$mm = json_decode($mm);
					if($mm) {
						foreach($mm as $key=>$val) {
							echo $key.",";
						}
					}
				}
				echo "</td>";
				echo "<td>".$u['tipe']."</td>";
        echo "<td><a data-toggle=\"modal\" data-target=\"#edituser\" class='eduser' href='#' id='".$u['id']."' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
        echo "<td><a data-toggle=\"modal\" data-target=\"#deluser\" class='deluser' href='#' id='".$u['id']."' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
        echo "</tr>";
        $no++;
			}
			echo "</table>";
		}
	}

	/**
	 * Export/import data page
	 * 
	 */
	public function eximp()
	{
		$this->__output('eximp');
	}

	/**
	 * Export data to Excel file
	 * 
	 */
	public function exportdata()
	{
		include('dbimexport.php');
		$db_config = array(
			'dbtype' => "MYSQL",
			'host' => $this->db->hostname,
			'database' => $this->db->database,
			'user' => $this->db->username,
			'password' => $this->db->password,
		);
		$dbimexport = new dbimexport($db_config);
		$dbimexport->download_path = "";
		$dbimexport->download = true;
		$dbimexport->file_name = "backup_data_".date("Y-m-d_H-i-s");
		$dbimexport->export();
	}

	/**
	 * Import data from Excel file
	 * 
	 */
	public function importdata()
	{
		if($_FILES["up_file"]["name"])
		{
			include('dbimexport.php');
			$db_config = array(
				'dbtype' => "MYSQL",
				'host' => $this->db->hostname,
				'database' => $this->db->database,
				'user' => $this->db->username,
				'password' => $this->db->password,
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