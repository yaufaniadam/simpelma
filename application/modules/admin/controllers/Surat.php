<?php defined('BASEPATH') or exit('No direct script access allowed');
class Surat extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();			
		$this->load->model('surat_model', 'surat_model');
	}
 
	public function index()
	{				
		$data['query'] = $this->surat_model->get_surat();
		$data['title'] = 'Surat';
		$data['view'] = 'surat/index';
		$this->load->view('layout/layout', $data);
	}
	public function detail($id_surat=0)
	{				
		$data['status'] = $this->surat_model->get_surat_status($id_surat);
		$data['surat'] = $this->surat_model->get_detail_surat($id_surat);
		$data['title'] = 'Detail Surat';
		$data['view'] = 'surat/detail';
		$this->load->view('layout/layout', $data);
	}
	public function proses_surat($id_surat=0)
	{				
		$this->db->set('id_status', 2);			
		$this->db->set('date', 'NOW()', FALSE);		
		$this->db->set('id_surat', $id_surat);	
		$this->db->insert('surat_status');

		redirect(base_url('admin/surat/detail/'.$id_surat));
	}
	
	
	
}
