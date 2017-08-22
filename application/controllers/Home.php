<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(!$this->session->username && $this->uri->segment(2)!='login' && $this->uri->segment(2)!='gologin') {
			redirect('/home/login', 'refresh');
		}
	}

	public function index()
	{
		$this->search();
	}

	function __output($nview,$data=null)
	{
		$this->load->view('header',$data);
		$this->load->view($nview,$data);
		$this->load->view('footer');
	}
    
    function src($srcdata=false)
    {
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

		$w = [];
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

		$q = "select a.*,k.retensi,date_add(a.tanggal,interval k.retensi year) b,
		(if(date_add(a.tanggal,interval k.retensi year)<curdate(),'sudah','belum')) f from data_arsip a join master_kode k on k.kode=a.kode";
		if(count($w) > 0) {
			$q .= " having".implode(" and ",$w);
		}
        
        if($srcdata) {
            $src = ["noarsip"=>$noarsip,"tanggal"=>$tanggal,"uraian"=>$uraian,"ket"=>$ket,"kode"=>$kode,"retensi"=>$retensi,"penc"=>$penc,"peng"=>$peng,"lok"=>$lok,"med"=>$med];
            $qq = [$q,$src];
            return $qq;
        }else {
            return $q;
        }
        
    }
    
	function search($offset=0)
	{
		$qq = $this->src(true);
        $q = $qq[0];
        $data['src']=$qq[1];
        
		//echo $q;
		$q2 = $q;
		$q .= " limit 20 ";
		if($offset>0) $q .= "offset $offset";
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

		$this->__output('main',$data);
	}
    
    function dl()
    {
        $q = $this->src();
        $hsl = $this->db->query($q);
		$data = $hsl->result_array();
        ///
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        //$this->excel->getActiveSheet()->setTitle('test worksheet');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Data Arsip');
        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to D1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, 'No.Arsip');
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, 2, 'Tanggal');
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, 2, 'Kode Klasifikasi');
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, 2, 'Uraian');
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, 2, 'Ket');
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, 2, 'Jumlah');
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, 2, 'No.Box');
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, 2, 'Retensi');
        
        $row=3;
        $redblock = array('fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FF0000')));
        foreach($data as $d) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $d['noarsip']);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $d['tanggal']);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $d['kode']);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $d['uraian']);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $d['ket']);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $d['jumlah']);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $d['nobox']);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $d['b']);
            if($d['f']=='sudah') {
                $this->excel->getActiveSheet()->getStyleByColumnAndRow(8, $row)->applyFromArray($redblock);
            } 
            $row++;
        }
        
        
        $filename='Data Arsip Bina Konstruksi.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
        $objWriter->save('php://output');
    }

	function login()
	{
		$data=[];
		if(isset($_SERVER['HTTP_REFERER'])) {
			$previous = $_SERVER['HTTP_REFERER'];
			$data['previous'] = $previous;
		}
		$this->load->view('login',$data);
	}

	function gologin()
	{
		$username=trim($this->input->post('username'));
        $password=md5($this->input->post('password'));
        $previous=trim($this->input->post('previous'));
		$q = "select * from master_user where username='$username' and password='$password'";
		$hsl = $this->db->query($q);
		$row = $hsl->row_array();
        if($row) {
            $_SESSION['username'] = $username;
            $_SESSION['id_user'] = $row['id'];
            $_SESSION['tipe'] = $row['tipe'];
			if($previous=="") {
				redirect('/home', 'refresh');
			}else {
				header('Location: ' . $previous);
			}
        }else {
            //echo "error login";
			$this->session->set_flashdata('erorlogin', 'salah password atau username');
			redirect('/home/login', 'refresh');
        }
	}

	function logout()
	{
		unset($_SESSION['username']);
		unset($_SESSION['id_user']);
		redirect('/home', 'refresh');
	}

}






