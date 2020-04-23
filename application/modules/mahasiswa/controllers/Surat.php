<?php defined('BASEPATH') or exit('No direct script access allowed');
class Surat extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();			
		$this->load->model('surat_model', 'surat_model');
	}
 
	public function index()
	{		
		
		$data['query'] = $this->surat_model->get_surat_bymahasiswa($this->session->userdata('user_id'));
		$data['title'] = 'Surat Saya';
		$data['view'] = 'surat/index';
		$this->load->view('layout/layout', $data);
	}
	public function detail($id_surat=0)
	{				
		$data['surat'] = $this->surat_model->get_detail_surat($id_surat);
		$data['title'] = 'Detail Surat';
		$data['view'] = 'surat/detail';
		$this->load->view('layout/layout', $data);
	}

	public function ajukan($id_kategori=0) {
		$data['kategori_surat'] = $this->surat_model->get_kategori_surat('m');
		$data['title'] = 'Ajukan Surat';
		$data['view'] = 'surat/ajukan';
		$this->load->view('layout/layout', $data);
	}

	public function buat_surat($id)
	{
		$data = array(
			'id_kategori_surat' => $id,
			'id_mahasiswa' => $this->session->userdata('user_id'),
		);

		$data = $this->security->xss_clean($data);
				$result = $this->surat_model->tambah($data);
				
				$insert_id = $this->db->insert_id();

				$this->db->set('id_surat', $insert_id);
				$this->db->set('id_status', 1);			
				$this->db->set('date', 'NOW()', FALSE);			
				$this->db->insert('surat_status');

				if($result){
					$this->session->set_flashdata('msg', 'Berhasil!');
					redirect(base_url('mahasiswa/surat/lengkapi_surat/'.$insert_id));
				}
	
	}


	public function lengkapi_surat($id_surat=0)
	{		
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('kategori_surat', 'Kategori Surat', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['kategori_surat'] = $this->surat_model->get_kategori_surat('m');
				$data['surat'] = $this->surat_model->get_detail_surat($id_surat);
				$data['title'] = 'Ajukan Surat';
				$data['view'] = 'surat/tambah';
				$this->load->view('layout/layout', $data);
			}
			else{
				$data = array(
					'id_kategori_surat' => $this->input->post('kategori_surat'),
					'id_mahasiswa' => $this->session->userdata('user_id'),
					'keterangan' => $this->input->post('keterangan'),				
				);
				
				$data = $this->security->xss_clean($data);
				$result = $this->surat_model->tambah($data);
				
				$this->db->set('id_surat', $this->db->insert_id());
				$this->db->set('id_status', 1);			
				$this->db->set('date', 'NOW()', FALSE);			
				$this->db->insert('surat_status');

				if($result){
					$this->session->set_flashdata('msg', 'Berhasil!');
					redirect(base_url('mahasiswa/surat'));
				}
			}
		}
		else{
			$data['kategori_surat'] = $this->surat_model->get_kategori_surat('m');
			$data['surat'] = $this->surat_model->get_detail_surat($id_surat);
			$data['title'] = 'Ajukan Surat';
			$data['view'] = 'surat/tambah';
			$this->load->view('layout/layout', $data);
		}
	}

	public function edit()
	{				
		$data['query'] = $this->surat_model->get_surat();
		$data['title'] = 'Ajukan Surat';
		$data['view'] = 'surat/tambah';
		$this->load->view('layout/layout', $data);
	}
	public function hapus()
	{		
		$data['query'] = $this->surat_model->get_surat();
		$data['title'] = 'Ajukan Surat';
		$data['view'] = 'surat/tambah';
		$this->load->view('layout/layout', $data);
	}
	
	
	
}
