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
		$this->datalist();
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

    protected function src()
    {
		// simple search
		$katakunci=$this->__sanitizeString($this->input->get('katakunci'));

		$w = array();
		if ($katakunci) {
		  // simple search
		  $w[] = " s.noarsip like '%".$katakunci."%'";
		  $w[] = " username_peminjam like '%".$katakunci."%'";
		  $w[] = " keperluan like '%".$katakunci."%'";
		}

		$sql = "SELECT s.*, u.username, 
		  (IF(CURDATE()>s.tgl_haruskembali, 'Terlambat', 'Dipinjam')) AS status 
		  FROM sirkulasi AS s 
          JOIN data_arsip AS a ON a.noarsip=s.noarsip
          JOIN master_user AS u ON s.username_peminjam=u.username";
        // die($sql);
        // row count
		$sql_row = "SELECT COUNT(*) AS total FROM sirkulasi AS s JOIN master_user AS u ON s.username_peminjam=u.username";
        // die($sql);

		if ($katakunci) {
		  $sql .= " WHERE".implode(" OR ",$w);
		  $sql_row .= " WHERE".implode(" OR ",$w);
        }
        return array($sql, $sql_row);
    }
    
	public function datalist($offset=0)
	{
		$qs = $this->src();
		$sql = $qs[0];
		$sql2 = $qs[1];

		$sql .= " LIMIT 20 ";
		if($offset>0) $sql .= "OFFSET $offset";
		$hsl = $this->db->query($sql);
		$data['data'] = $hsl->result_array();
		//$this->session->set_flashdata('zz', $q);
		$jmldata = $this->db->query($sql2)->row();
		$data['jml']=$jmldata->total;

		$this->load->library('pagination');
		$config['base_url'] = site_url('/home/search');
		$config['reuse_query_string'] = true;
		$config['total_rows'] = $data['jml'];
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
		if ($this->session->tipe == 'admin') {
			$data['admin'] = true;
		}
		$this->load->view('header',$data);
		$this->load->view($nview,$data);
		$this->load->view('footer');
	}
	
	public function entr()
	{
		$data["title"]="Tambah Data Peminjaman";
        $date = new DateTime();
        $data['now'] =$date->format('Y-m-d');
		// $q = "select distinct noarsip from data_arsip order by noarsip asc";
		// $data['noarsip2'] = $this->db->query($q)->result_array();
		// $q = "select username from master_user order by username asc";
		// $data['username2'] = $this->db->query($q)->result_array();
        
		$this->__output('sirkulasi/entri',$data);
	}

	public function gentr()
	{
        $date = new DateTime();
        $now = $date->format('Y-m-d H:i:s');
		$noarsip=$this->__sanitizeString($this->input->post('noarsip'));
		$username_peminjam=$this->__sanitizeString($this->input->post('username_peminjam'));
		$keperluan=$this->__sanitizeString($this->input->post('keperluan'));
		$tgl_pinjam=$this->__sanitizeString($this->input->post('tgl_pinjam'));
		$tgl_haruskembali=$this->__sanitizeString($this->input->post('tgl_haruskembali'));
		$tgl_transaksi=$now;

		$q = "INSERT INTO sirkulasi VALUES (NULL, '$noarsip','$username_peminjam','$keperluan','$tgl_pinjam',
            '$tgl_haruskembali', NULL, NOW());";
		//echo $q; die();
		$hsl = $this->db->query($q);
		//var_dump($row);
		redirect('/sirkulasi/', 'refresh');
	}

	public function vedit($id)
	{
		if($id!=""){
			$q = "select * from sirkulasi where id=$id";
			$hsl = $this->db->query($q);
			$row = $hsl->row_array();
			$previous = "";
			if(isset($_SERVER['HTTP_REFERER'])) {
				$previous = $_SERVER['HTTP_REFERER'];
				$row['previous'] = $previous;
			}
			$row["title"]="Update Data Peminjaman";
			$q = "select distinct noarsip from data_arsip order by noarsip asc";
			$row['noarsip2'] = $this->db->query($q)->result_array();
			$q = "select username from master_user order by username asc";
			$row['username2'] = $this->db->query($q)->result_array();
			if(count($row)>0) {
				$this->__output('sirkulasi/edit',$row);
			}else{
				redirect('/sirkulasi/', 'refresh');
			}
		}else {
			redirect('/sirkulasi/', 'refresh');
		}

	}

	public function update()
	{
		$id=$this->__sanitizeString($this->input->post('id'));
		$noarsip=$this->__sanitizeString($this->input->post('noarsip'));
		$username_peminjam=$this->__sanitizeString($this->input->post('username_peminjam'));
		$keperluan=$this->__sanitizeString($this->input->post('keperluan'));
		$tgl_pinjam=$this->__sanitizeString($this->input->post('tgl_pinjam'));
		$tgl_haruskembali=$this->__sanitizeString($this->input->post('tgl_haruskembali'));
		$previous = "";
		if(isset($_SERVER['HTTP_REFERER'])) {
			$previous = $_SERVER['HTTP_REFERER'];
			$row['previous'] = $previous;
		}
		if(isset($_POST)) {
			$q = "update sirkulasi set noarsip='$noarsip',username_peminjam='$username_peminjam',keperluan='$keperluan',tgl_pinjam='$tgl_pinjam',tgl_haruskembali='$tgl_haruskembali' where id=$id";
			$hsl = $this->db->query($q);
		}
		redirect('/sirkulasi', 'refresh');
		/* if($previous=="") {
			redirect('/sirkulasi', 'refresh');
		}else {
			header('Location: ' . $previous);
		} */
	}

	public function del()
	{
		$id=trim($this->input->post('id'));
		$q = "delete from sirkulasi where id=?";
		$hsl = $this->db->query($q, array($id));
	}
	
	public function kembalikan()
	{
		$id=trim($this->input->post('id'));
		$q = "update sirkulasi set tgl_pengembalian=now() where id=?";
		$hsl = $this->db->query($q, array($id));
	}

	public function xhr_arsip($keywords = '')
	{
		$data = array();
		$keywords = $this->__sanitizeString($keywords);
		if (!$keywords) {
			header('Content-Type: application/json');
			exit('[]');
		}

		$this->db->select('noarsip,kode,nobox');
		$this->db->like('noarsip', $keywords, 'after');
		$this->db->or_like('kode', $keywords, 'after');
		$this->db->limit(10);
		$hsl = $this->db->get('data_arsip')->result();
        foreach($hsl as $r) {
          $data[] = $r;
		}
		header('Content-Type: application/json');
		echo json_encode($data);
		exit();
	}

	public function xhr_user($keywords = '')
	{
		$data = array();
		$keywords = $this->__sanitizeString($keywords);
		if (!$keywords) {
			header('Content-Type: application/json');
			exit('[]');
		}

		$this->db->select('username,id,tipe,akses_klas');
		$this->db->like('username', $keywords, 'after');
		$this->db->limit(10);
		$hsl = $this->db->get('master_user')->result();
        foreach($hsl as $r) {
          $data[] = $r;
		}		
		header('Content-Type: application/json');		
		echo json_encode($data);
		exit();
	}
}