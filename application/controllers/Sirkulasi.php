<?php
/**
 * This application is licensed under GNU General Public License version 3
 * Developers:
 * Syauqi Fuadi ( xfuadi@gmail.com )
 * Arie Nugraha ( dicarve@gmail.com )
 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Sirkulasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(!$this->session->tipe=='admin') {
			redirect('/home/login', 'refresh');
		}
	}

	public function index()
	{
		$this->list();
    }

    protected function src($srcdata=false)
    {
		// simple search
		$katakunci=trim($this->input->get('katakunci'));
		// advanced search
        $noarsip=trim($this->input->get('noarsip'));
		$tanggal=trim($this->input->get('tanggal'));
		$uraian=trim($this->input->get('uraian'));
		$ket=trim($this->input->get('ket'));
		$kode=trim($this->input->get('kode'));
		$retensi=trim($this->input->get('retensi'));
		$penc=trim($this->input->get('penc'));
		$peng=trim($this->input->get('peng'));
		$lok=trim($this->input->get('lok'));
		$med=trim($this->input->get('med'));

		$w = array();
		if ($katakunci) {
		  // simple search
		  $w[] = " noarsip like '%".$katakunci."%'";
		  $w[] = " uraian like '%".$katakunci."%'";
		} else {
			// advanced search
			if($noarsip!="") {
				$w[] = " noarsip like '%".$noarsip."%'";
			}
			if($tanggal!="") {
				$w[] = " tanggal like '%".$tanggal."%'";
			}
			if($kode!="" && $kode!="all") {
				$w[] = " kode like '%".$kode."%'";
			}
			if($ket!="" && $ket!="all") {
				$w[] = " ket='".$ket."'";
			}
			if($uraian!="") {
				$w[] = " uraian like '%".$uraian."%'";
			}
			if($retensi!="" && $retensi!="all") {
				$w[] = " f='".$retensi."'";
			}
			if($penc!="" && $penc!="all") {
				$w[] = " pencipta ='".$penc."'";
			}
			if($peng!="" && $peng!="all") {
				$w[] = " unit_pengolah ='".$peng."'";
			}
			if($lok!="" && $lok!="all") {
				$w[] = " lokasi ='".$lok."'";
			}
			if($med!="" && $med!="all") {
				$w[] = " media ='".$med."'";
			}
		}

		$q = "SELECT a.*, k.retensi, DATE_ADD(a.tanggal,INTERVAL k.retensi YEAR) AS b,
		  (IF(DATE_ADD(a.tanggal,INTERVAL k.retensi YEAR)<CURDATE(),'sudah','belum')) AS f 
		  FROM data_arsip AS a JOIN master_kode AS k ON k.kode=a.kode";
		// die($q);

		if ($katakunci) {
			$q .= " WHERE".implode(" OR ",$w);
            $src = array("noarsip"=>$katakunci,"tanggal"=>'',"uraian"=>$katakunci,"ket"=>'',"kode"=>'',"retensi"=>'',"penc"=>'',"peng"=>'',"lok"=>'',"med"=>'');
            $qq = array($q, $src);
			return $qq;
		} else {
			if(count($w) > 0) {
				$q .= " WHERE".implode(" AND ",$w);
			}
		}

        if($srcdata) {
            $src = array("noarsip"=>$noarsip,"tanggal"=>$tanggal,"uraian"=>$uraian,"ket"=>$ket,"kode"=>$kode,"retensi"=>$retensi,"penc"=>$penc,"peng"=>$peng,"lok"=>$lok,"med"=>$med);
            $qq = array($q, $src);
            return $qq;
        }else {
            return $q;
        }
        
    }
    
	public function list($offset=0)
	{
		$qq = $this->src(true); // var_dump($qq); die();
		$q = $qq[0];
        $data['src']=$qq[1];
        
		//echo $q;
		$q2 = $q;
		$q .= " LIMIT 20 ";
		if($offset>0) $q .= "OFFSET $offset";
		$hsl = $this->db->query($q);
		$data['data'] = $hsl->result_array();
		//$this->session->set_flashdata('zz', $q);
		$jmldata = $this->db->query($q2)->num_rows();
		$data['jml']=$jmldata;

		$q = "select distinct ket from data_arsip order by ket asc";
		$hsl = $this->db->query($q);
		$data['ket'] = $hsl->result_array();
		$q = "select kode,nama from master_kode order by kode asc";
		$hsl = $this->db->query($q);
		$data['kode'] = $hsl->result_array();
		$q = "select * from master_pencipta order by nama_pencipta asc";
		$hsl = $this->db->query($q);
		$data['penc'] = $hsl->result_array();
		$q = "select * from master_pengolah order by nama_pengolah asc";
		$hsl = $this->db->query($q);
		$data['peng'] = $hsl->result_array();
		$q = "select * from master_lokasi order by nama_lokasi asc";
		$hsl = $this->db->query($q);
		$data['lok'] = $hsl->result_array();
		$q = "select * from master_media order by nama_media asc";
		$hsl = $this->db->query($q);
		$data['med'] = $hsl->result_array();

		$this->load->library('pagination');
		$config['base_url'] = site_url('/home/search');
		$config['reuse_query_string'] = true;
		$config['total_rows'] = $jmldata;
		$config['per_page'] = 20;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript: void(0)" disabled>';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$this->pagination->initialize($config);
		$data['pages']=$this->pagination->create_links();

		$this->__output('sirkulasi/main',$data);
	}
    
	private function __output($nview,$data=null)
	{
		$this->load->view('header',$data);
		$this->load->view($nview,$data);
		$this->load->view('footer');
	}
	
	public function entr()
	{
		$data["title"]="Tambah Data Peminjaman";
		
		$this->__output('sirkulasi/entri',$data);
	}

	public function gentr()
	{
		$noarsip=trim($this->input->post('noarsip'));
		$tanggal=trim($this->input->post('tanggal'));
		$uraian=trim($this->input->post('uraian'));
		$kode=trim($this->input->post('kode'));
		$pencipta=trim($this->input->post('pencipta'));

		$q = "insert into data_arsip (noarsip,tanggal,uraian,kode,ket,nobox,file,jumlah,pencipta,unit_pengolah,lokasi,media,tgl_input) values ('$noarsip','$tanggal','$uraian','$kode','$ket','$nobox','$file','$jumlah',$pencipta,$unitpengolah,$lokasi,$media,now());";
		$hsl = $this->db->query($q);
		$q = "SELECT LAST_INSERT_ID() as vid;";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
		$v = $row['vid'];
		//var_dump($row);
		redirect('/sirkulasi/', 'refresh');
	}

	public function vedit($id)
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
			$row["title"]="Ubah Arsip";
			if(count($row)>0) {
				$this->__output('edit1',$row);
			}else{
				redirect('/home/', 'refresh');
			}
		}else {
			redirect('/home/', 'refresh');
		}

	}

	public function update()
	{
		$noarsip=trim($this->input->post('noarsip'));
		$tanggal=trim($this->input->post('tanggal'));
		$uraian=trim($this->input->post('uraian'));
		$kode=trim($this->input->post('kode'));
		$ket=trim($this->input->post('ket'));
		$pencipta=trim($this->input->post('pencipta'));
		$unitpengolah=trim($this->input->post('unitpengolah'));
		$lokasi=trim($this->input->post('lokasi'));
		$media=trim($this->input->post('media'));
		$nobox=trim($this->input->post('nobox'));
		$jumlah=trim($this->input->post('jumlah'));
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
			$q = "select file from data_arsip where id=$id";
			$d = $this->db->query($q)->row_array()['file'];
			$file=$d;
		}

		if(isset($_POST)) {
			$q = "update data_arsip set noarsip='$noarsip',tanggal='$tanggal',uraian='$uraian',kode='$kode',ket='$ket',nobox='$nobox',file='$file',jumlah='$jumlah',pencipta=$pencipta,unit_pengolah=$unitpengolah,lokasi=$lokasi,media=$media where id=$id";
			$hsl = $this->db->query($q);
		}
		if($previous=="") {
			redirect('/home/', 'refresh');
		}else {
			header('Location: ' . $previous);
		}
	}

	public function del()
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
}