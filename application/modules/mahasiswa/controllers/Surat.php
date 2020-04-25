<?php defined('BASEPATH') or exit('No direct script access allowed');
class Surat extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('surat_model', 'surat_model');
		$this->load->library('upload');
	}

	public function index()
	{

		$data['query'] = $this->surat_model->get_surat_bymahasiswa($this->session->userdata('user_id'));
		$data['title'] = 'Surat Saya';
		$data['view'] = 'surat/index';
		$this->load->view('layout/layout', $data);		
       
	}
	public function detail($id_surat = 0)
	{
		$data['surat'] = $this->surat_model->get_detail_surat($id_surat);
		$data['title'] = 'Detail Surat';
		$data['view'] = 'surat/detail';
		$this->load->view('layout/layout', $data);
	}

	public function ajukan($id_kategori = 0)
	{
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
		$this->db->set('id_status', 4);
		$this->db->set('date', 'NOW()', FALSE);
		$this->db->insert('surat_status');

		if ($result) {
			$this->session->set_flashdata('msg', 'Berhasil!');
			redirect(base_url('mahasiswa/surat/tambah/' . $insert_id));
		}
	}

	public function tambah($id_surat = 0)
	{
		$data['kategori_surat'] = $this->surat_model->get_kategori_surat('m');
		$data['surat'] = $this->surat_model->get_detail_surat($id_surat);
		$data['title'] = 'Ajukan Surat';
		$data['view'] = 'surat/tambah';
		$this->load->view('layout/layout', $data);
	}
	function upload_image()
	{
		$config['upload_path'] = './assets/images/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				$gambar = $gbr['file_name']; //Mengambil file name dari gambar yang diupload
				$judul = strip_tags($this->input->post('judul'));

				echo judul;
				//$this->surat_model->simpan_upload($judul, $gambar);
				echo "Upload Berhasil";

			} else {
				echo "Gambar Gagal Upload. Gambar harus bertipe gif|jpg|png|jpeg|bmp";
			}
		} else {
			echo "Gagal, gambar belum di pilih";
		}
	}

	public function edit()
	{
		$data['query'] = $this->surat_model->get_surat();
		$data['title'] = 'Ajukan Surat';
		$data['view'] = 'surat/tambah';
		$this->load->view('layout/layout', $data);
	}
	public function hapus($id = 0)
	{
		$this->db->delete('surat', array('id' => $id));
		$this->session->set_flashdata('msg', 'Surat berhasil dihapus');
		redirect(base_url('mahasiswa/surat'));
	}
}
