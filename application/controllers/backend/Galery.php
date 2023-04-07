<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galery extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('M_galery');

        if ($this->session->userdata('status') != "telah_login") {
            redirect(base_url() . 'login?alert=belum_login');
        }
    }

    public function index()
    {
        $data['data_galery'] = $this->M_galery->get_data('galery')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/galery/v_index', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function tambah()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/galery/v_tambah');
        $this->load->view('dashboard/v_footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {

            $data = [
                'galery_tanggal' => date('Y-m-d H:i:s'),
                'galery_judul'   => $this->input->post('judul'),
                'galery_content' => $this->input->post('konten'),
                'galery_slug'    => strtolower(url_title($this->input->post('judul'))),
                'galery_status'  => $this->input->post('status'),
                'id_pages'       => 3
            ];

            $insert_id = $this->M_galery->insert_data($data, 'galery');

            $count = count($_FILES['files']['name']);

            for ($i = 0; $i < $count; $i++) {

                if (!empty($_FILES['files']['name'][$i])) {

                    $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                    $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                    $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                    $image                      = 'galery-' . time() . '-' . $_FILES["file"]['name'][$i];
                    $config['file_name']        = $image;
                    $config['upload_path']      = './gambar/';
                    $config['allowed_types'] = 'gif|jpg|png';


                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $data_galery = [
                            'galery_id' => $insert_id,
                            'galery_detail_file' => $uploadData['file_name']
                        ];
                        $this->M_galery->insert_galery($data_galery, 'galery_detail');
                    }
                }
            }

            redirect(base_url() . 'backend/galery');
        } else {
            $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/galery/v_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }

    public function edit($id)
    {
        $where = ['galery_id' => $id];
        $data['galery'] = $this->M_galery->edit_data($where, 'galery')->row();
        $data['galery_detail'] = $this->M_galery->edit_data($where, 'galery_detail')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/galery/v_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function update()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $where = ['galery_id' => $id];

            $data = [
                'galery_tanggal' => date('Y-m-d H:i:s'),
                'galery_judul'   => $this->input->post('judul'),
                'galery_content' => $this->input->post('konten'),
                'galery_slug'    => strtolower(url_title($this->input->post('judul'))),
                'galery_status'  => $this->input->post('status'),
                'id_pages'          => 3
            ];

            $this->M_galery->update_data($where, $data, 'galery');

            $count = count($_FILES['files']['name']);

            for ($i = 0; $i < $count; $i++) {

                if (!empty($_FILES['files']['name'][$i])) {

                    $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                    $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                    $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                    $image                      = 'galery-' . time() . '-' . $_FILES["file"]['name'][$i];
                    $config['file_name']        = $image;
                    $config['upload_path']      = './gambar/';
                    $config['allowed_types'] = 'gif|jpg|png';


                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $data_galery = [
                            'galery_id' => $id,
                            'galery_detail_file' => $uploadData['file_name']
                        ];
                        $this->M_galery->insert_galery($data_galery, 'galery_detail');
                    }
                }
            }

            redirect(base_url() . 'backend/galery');
        } else {
            $id = $this->input->post('id');
            $where = ['galery_id' => $id];
            $data['galery'] = $this->M_galery->edit_data($where, 'galery')->row();
            $data['galery_detail'] = $this->M_galery->edit_data($where, 'galery_detail')->result();
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/galery/v_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function hapus($id)
    {
        $where = ['galery_id' => $id];

        $single_data = $this->M_galery->edit_data($where, 'galery')->row();
        $arr_data = $this->M_galery->edit_data($where, 'galery_detail')->result();
        $path = "/gambar/";
        foreach ($arr_data as $key => $value) {
            unlink(FCPATH . $path . $value->galery_detail_file);
        }

        $this->M_galery->delete_data($where, 'galery');
        $this->M_galery->delete_data($where, 'galery_detail');

        redirect(base_url() . 'backend/galery');
    }
}
