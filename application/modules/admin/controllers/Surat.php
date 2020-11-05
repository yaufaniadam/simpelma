<?php defined('BASEPATH') or exit('No direct script access allowed');
class Surat extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('surat_model', 'surat_model');
		$this->load->model('notif/Notif_model', 'notif_model');
	}

	public function index($role = 0)
	{
		$data['query'] = $this->surat_model->get_surat($role);
		$data['title'] = 'Surat Admin';
		$data['view'] = 'surat/index';
		$this->load->view('layout/layout', $data);
	}
	public function detail($id_surat = 0)
	{
		$data['status'] = $this->surat_model->get_surat_status($id_surat);
		$data['surat'] = $this->surat_model->get_detail_surat($id_surat);
		$data['timeline'] = $this->surat_model->get_timeline($id_surat);

		//cek apakah admin atau pengguna prodi ( admin prodi, tu, kaprodi, kecuali mhs)
		if (($data['surat']['id_prodi'] == $this->session->userdata('id_prodi') && $this->session->userdata('role') !== 1) || $this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) {

			$data['title'] = 'Detail Surat';
			$data['view'] = 'surat/detail';
		} else {
			$data['title'] = 'Forbidden';
			$data['view'] = 'restricted';
		}

		$this->load->view('layout/layout', $data);
	}
	public function proses_surat($id_surat = 0)
	{
		$this->db->set('id_status', 2)
			->set('date', 'NOW()', FALSE)
			->set('id_surat', $id_surat)
			->insert('surat_status');

		redirect(base_url('admin/surat/detail/' . $id_surat));
	}
	public function verifikasi()
	{
		if ($this->input->post('submit')) {

			$verifikasi = $this->input->post('verifikasi'); //ambil nilai 
			$id_surat = $this->input->post('id_surat');
			$id_notif = $this->input->post('id_notif');
			//set status
			$this->db->set('id_status', $this->input->post('rev2'))
				->set('pic', $this->session->userdata('user_id'))
				->set('date', 'NOW()', FALSE)
				->set('id_surat', $id_surat)
				->insert('surat_status');

			foreach ($verifikasi as $id => $value_verifikasi) {

				$this->db->where(array('id_kat_keterangan_surat' => $id, 'id_surat' => $id_surat))
					->update(
						'keterangan_surat',
						array(
							'verifikasi' =>  $value_verifikasi,
						)
					);
			}

			if ($this->input->post('rev2') == 6) {
				$role = array(3, 2);
			} else if ($this->input->post('rev2') == 4) {
				$role = array(3, 2);
			} else if ($this->input->post('rev2') == 7) {
				$role = array(3, 6);
			}

			// buat notifikasi
			$data_notif = array(
				'id_surat' => $id_surat,
				'id_status' => $this->input->post('rev2'),
				'kepada' => $this->input->post('user_id'),
				'role' => $role
			);

			// hapus notifikasi "menunggu verifikasi"
			$set_notif = $this->db->set('status', 1)
				->set('dibaca', 'NOW()', FALSE)
				->where(array('id' => $id_notif, 'status' => 0))
				->update('notif');

			$result = $this->notif_model->send_notif($data_notif);

			if ($result) {
				$this->session->set_flashdata('msg', 'Surat sudah diperiksa oleh TU!');
				redirect(base_url('admin/surat/detail/' . $id_surat));
			}
		} else {
			$data['title'] = 'Forbidden';
			$data['view'] = 'restricted';
			$this->load->view('layout/layout', $data);
		}
	}

	public function disetujui()
	{
		if ($this->input->post('submit')) {

			if ($this->session->userdata('role') == 5) { // direktur
				$id_surat = $this->input->post('id_surat');
				$result = $this->db->set('id_status', 9)
					->set('date', 'NOW()', FALSE)
					->set('id_surat', $id_surat)
					->set('pic', $this->session->userdata('user_id'))
					->insert('surat_status');


				if ($result) {
					$data_notif = array(
						'id_surat' => $id_surat,
						'id_status' => 9,
						'kepada' => $this->input->post('user_id'),
						'role' => array(3, 1)
					);

					$result = $this->notif_model->send_notif($data_notif);

					$this->session->set_flashdata('msg', 'Surat sudah diberi persetujuan oleh Direktur Pascasarjana!');
					redirect(base_url('admin/surat/detail/' . $id_surat));
				}
			} elseif ($this->session->userdata('role') == 6 && $this->session->userdata('id_prodi') == $this->input->post('prodi')) { // kaprodi

				$id_surat = $this->input->post('id_surat');
				$result = $this->db->set('id_status', 8)
					->set('date', 'NOW()', FALSE)
					->set('id_surat', $id_surat)
					->set('pic', $this->session->userdata('user_id'))
					->insert('surat_status');

				if ($result) {
					$data_notif = array(
						'id_surat' => $id_surat,
						'id_status' => 8,
						'kepada' => $this->input->post('user_id'),
						'role' => array(3, 5)
					);


					$result = $this->notif_model->send_notif($data_notif);
					$this->session->set_flashdata('msg', 'Surat sudah diberi persetujuan oleh Kaprodi!');
					redirect(base_url('admin/surat/detail/' . $id_surat));
				}
			}
		}
	}

	public function terbitkan_surat()
	{
		if ($this->input->post('submit')) {
			$id_surat = $this->input->post('id_surat');
			$data = array(
				'id_surat' => $id_surat,
				'id_kategori_surat' => $this->input->post('id_kategori_surat'),
				'no_surat' => $this->input->post('no_surat'),
				'kat_tujuan_surat' => $this->input->post('kat_tujuan_surat'),
				'tujuan_surat' => $this->input->post('tujuan_surat'),
				'urusan_surat' => $this->input->post('urusan_surat'),
				'instansi' => $this->input->post('instansi'),
				'tanggal_terbit' => date('Y-m-d'),
			);

			$insert = $this->db->insert('no_surat', $data);
			if ($insert) {
				$this->db->set('id_status', 10)
					->set('date', 'NOW()', FALSE)
					->set('id_surat', $id_surat)
					->set('pic', $this->session->userdata('user_id'))
					->insert('surat_status');

				$data_notif = array(
					'id_surat' => $id_surat,
					'id_status' => 10,
					'kepada' => $this->input->post('user_id'),
					'role' => array(3, 1, 2, 5, 6)
				);

				$result = $this->notif_model->send_notif($data_notif);

				$this->session->set_flashdata('msg', 'Surat berhasil diterbitkan!');
				redirect(base_url('admin/surat/detail/' . $id_surat));
			}
		}
	}

	public function tampil_surat($id_surat)
	{

		$data['title'] = 'Tampil Surat';
		$data['surat'] = $this->surat_model->get_detail_surat($id_surat);
		$data['no_surat'] = $this->surat_model->get_no_surat($id_surat);
		$kategori = $data['surat']['kategori_surat'];
		$nim = $data['surat']['username'];

		//$this->load->view('admin/surat/tampil_surat', $data);

		$mpdf = new \Mpdf\Mpdf([
			'tempDir' => __DIR__ . '/pdfdata',
			'mode' => 'utf-8',
			// 'format' => [24, 24],
			'format' => 'A4',
			'margin_left' => 0,
			'margin_right' => 0,
			'margin_bottom' => 20,
			'margin_top' => 30,
			'float' => 'left'
		]);

		$view = $this->load->view('admin/surat/tampil_surat', $data, TRUE);

		$mpdf->SetHTMLHeader('
		<div style="text-align: left; margin-left:2cm">
				<img width="390" height="" src="' . base_url() . '/public/dist/img/logokop-pasca.jpg" />
		</div>');
		$mpdf->SetHTMLFooter('

		<div style="text-align:center; background:red;">
			<img width="" height="" src="' . base_url() . '/public/dist/img/footerkop-pasca.jpg" />
		</div>');

		$mpdf->WriteHTML($view);

		$mpdf->Output('Surat-' . $kategori . '-' . $nim . '.pdf', 'D');
	}

	public function get_tujuan_surat()
	{
		$kat_tujuan = $this->input->post('kat_tujuan_surat');
		$data = $this->db->query("SELECT * FROM tujuan_surat WHERE id_kat_tujuan_surat = $kat_tujuan")->result_array();
		echo json_encode($data);
	}
}
