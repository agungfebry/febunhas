<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('M_profile');

		if ($this->session->userdata('status') != "telah_login") {
			redirect(base_url() . 'login?alert=belum_login');
		}
	}

	public function index()
	{
		$data['data_profile'] = $this->M_profile->get_data('profile')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('backend/profile/v_index', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('backend/profile/v_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function store()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		if ($this->form_validation->run() != false) {
			$image                   = 'profile-' . time() . '-' . $_FILES["sampul"]['name'];
			$config['file_name']     = $image;
			$config['upload_path']   = './gambar/';
			$config['allowed_types'] = 'gif|jpg|png';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('sampul')) {
				$gambar = $this->upload->data();
			}

			$data = [
				'profile_tanggal' => date('Y-m-d H:i:s'),
				'profile_judul'   => $this->input->post('judul'),
				'profile_content' => $this->input->post('konten'),
				'profile_slug'    => strtolower(url_title($this->input->post('judul'))),
				'profile_sampul'  => isset($gambar) ? $gambar['file_name'] : '',
				'profile_status'  => $this->input->post('status'),
				'id_pages'		  => 2
			];

			$this->M_profile->insert_data($data, 'profile');

			redirect(base_url() . 'backend/profile');
		} else {
			$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());
			$this->load->view('dashboard/v_header');
			$this->load->view('backend/profile/v_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function edit($id)
	{
		$where = ['profile_id' => $id];
		$data['profile'] = $this->M_profile->edit_data($where, 'profile')->row();
		$this->load->view('dashboard/v_header');
		$this->load->view('backend/profile/v_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function update()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$where = ['profile_id' => $id];

			$data = [
				'profile_tanggal' => date('Y-m-d H:i:s'),
				'profile_judul'   => $this->input->post('judul'),
				'profile_content' => $this->input->post('konten'),
				'profile_slug'    => strtolower(url_title($this->input->post('judul'))),
				'profile_status'  => $this->input->post('status'),
				'id_pages'		  => 2
			];

			$this->M_profile->update_data($where, $data, 'profile');


			if (!empty($_FILES['sampul']['name'])) {

				$where = ['profile_id' => $id];
				$single_data = $this->M_profile->edit_data($where, 'profile')->row();

				$path = "/gambar/";
				unlink(FCPATH . $path . $single_data->profile_sampul);

				$image                   = 'profile-' . time() . '-' . $_FILES["sampul"]['name'];
				$config['file_name']     = $image;
				$config['upload_path']   = './gambar/';
				$config['allowed_types'] = 'gif|jpg|png';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sampul')) {
					$gambar = $this->upload->data();
					$data = array(
						'profile_sampul' => $gambar['file_name']
					);

					$this->M_profile->update_data($where, $data, 'profile');

					redirect(base_url() . 'backend/profile');
				} else {
					$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

					$where = ['profile_id' => $id];

					$data['profile'] = $this->M_profile->edit_data($where, 'profile')->row();
					$this->load->view('dashboard/v_header');
					$this->load->view('backend/profile/v_edit', $data);
					$this->load->view('dashboard/v_footer');
				}
			} else {
				redirect(base_url() . 'backend/profile');
			}
		} else {
			$id = $this->input->post('id');
			$where = ['profile_id' => $id];
			$data['profile'] = $this->M_profile->edit_data($where, 'profile')->row();
			$this->load->view('dashboard/v_header');
			$this->load->view('backend/profile/v_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function hapus($id)
	{
		$where = ['profile_id' => $id];
		$single_data = $this->M_profile->edit_data($where, 'profile')->row();
		$path = "/gambar/";
		unlink(FCPATH . $path . $single_data->profile_sampul);

		$this->M_profile->delete_data($where, 'profile');

		redirect(base_url() . 'backend/profile');
	}
}
