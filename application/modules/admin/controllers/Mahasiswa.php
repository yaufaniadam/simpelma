<?php defined('BASEPATH') or exit('No direct script access allowed');
class Mahasiswa extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mahasiswa_model', 'mahasiswa_model');
		$this->load->model('profile/profile_model', 'profile_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index()
	{
		$data['mahasiswa'] = $this->mahasiswa_model->get_mahasiswa();	
		$data['title'] = 'Semua Mahasiswa'; 
		$data['view'] = 'admin/mahasiswa/mahasiswa_list';

		$this->load->view('layout/layout', $data);
	}

	public function add()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
		//	$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		//	$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			//$this->form_validation->set_rules('role', 'Role', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['title'] = 'Tambah Mahasiswa'; 
				$data['view'] = 'admin/mahasiswa/user_add';
				$this->load->view('layout/layout', $data);
			} else {
				
				$data = array(
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),			
					'role' => $this->input->post('role'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),			
				);

				$data = $this->security->xss_clean($data);
				$result = $this->mahasiswa_model->add_user($data);
				if ($result) {
					$this->session->set_flashdata('msg', 'Pengguna berhasil ditambahkan!');
					redirect(base_url('admin/mahasiswa'));
				}
			}
		} else {
			$data['title'] = 'Tambah Mahasiswa';
			$data['view'] = 'admin/mahasiswa/user_add';
			$this->load->view('layout/layout', $data);
		}
	}

	public function edit($id = 0)
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
		//	$this->form_validation->set_rules('firstname', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		//	$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->mahasiswa_model->get_user_by_id($id);
				$data['title'] = 'Edit Mahasiswa';
				$data['view'] = 'admin/mahasiswa/user_edit';
				$this->load->view('layout/layout', $data);
			} else {

				
				$data = array(
					'username' => $this->input->post('username'),
				//	'firstname' => $this->input->post('firstname'),
					'email' => $this->input->post('email'),
				//	'mobile_no' => $this->input->post('mobile_no'),
					'password' => ($this->input->post('password') !== "" ? password_hash($this->input->post('password'), PASSWORD_BCRYPT) : $this->input->post('password_hidden')),
					'updated_at' => date('Y-m-d : h:m:s'),
				//	'photo' => ($foto_profil['file_name']) !== "" ? $upload_path . '/' . $foto_profil['file_name'] : $this->input->post('foto_profil_hidden'),
				);

				$data = $this->security->xss_clean($data);
				$result = $this->mahasiswa_model->edit_user($data, $id);

				if ($result) {
					$this->session->set_flashdata('msg', 'Pengguna berhasil diubah!');
					redirect(base_url('admin/mahasiswa'));
				}
			}
		} else {
			$data['user'] = $this->mahasiswa_model->get_user_by_id($id);
			$data['title'] = 'Edit Mahasiswa';
			$data['view'] = 'admin/mahasiswa/user_edit';
			$this->load->view('layout/layout', $data);
		}
	}

	public function detail($id = 0)
	{
		$data['mahasiswa'] = $this->mahasiswa_model->get_user_by_id($id);
		$data['title'] = 'Detail Pengguna';
		$data['view'] = 'admin/mahasiswa/detail';
		$this->load->view('layout/layout', $data);
	}

	public function del($id)
	{
		$this->db->delete('ci_users', array('id' => $id));
		$this->session->set_flashdata('msg', 'Pengguna berhasil dihapus!');
		redirect(base_url('admin/mahasiswa'));
	}

	public function upload_mahasiswa()
	{

		if (isset($_POST['submit'])) {

			$upload_path = './uploads/mahasiswa';

			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0777, TRUE);
			}
		
			$config = array(
				'upload_path' => $upload_path,
				'allowed_types' => "xlsx",
				'overwrite' => FALSE,
			);

			$this->load->library('upload', $config);
			$this->upload->do_upload('file');
			$upload = $this->upload->data();


			if ($upload) { // Jika proses upload sukses			    	

				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('./uploads/mahasiswa' . $upload['file_name']); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

				$data['sheet'] = $sheet;
				$data['file_excel'] = $upload['file_name'];


				$data['view'] = 'upload_mahasiswa';
				$this->load->view('layout/layout', $data);
			} else {

				echo "gagal";
				$data['view'] = 'upload_mahasiswa';
				$this->load->view('layout/layout', $data);
			}
		} else {
			$data['title'] = 'Upload Mahasiswa';
			$data['view'] = 'admin/mahasiswa/upload_mahasiswa';
			$this->load->view('layout/layout', $data);
		}
	}

	public function import_mahasiswa($file_excel)
	{

		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('./uploads/mahasiswa/' . $file_excel); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

		$data = transposeData($sheet);

		$data2 = array();

			$numrow = 1;
			foreach ($sheet as $row) {

				if ($numrow > 1) {
					// Kita push (add) array data ke variabel data
					array_push($data2, array(
						'nim' => $row['A'], 
						'username' => $row['A'], 
						'nama' => $row['B'],
						'prodi' => $row['C'],
						'email' => $row['D'],
						'created_at' => date('Y-m-d : h:m:s'),						
					));
				}

				$numrow++; // Tambah 1 setiap kali looping
			}

	

		// Panggil fungsi insert_mahasiswa
		$this->mahasiswa_model->import_mahasiswa($data2);

		redirect("admin/mahasiswa"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
}
