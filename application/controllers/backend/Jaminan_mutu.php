<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jaminan_mutu extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('M_jaminan_mutu');

        if ($this->session->userdata('status') != "telah_login") {
            redirect(base_url() . 'login?alert=belum_login');
        }
    }

    public function index()
    {
        $data['data_jaminan_mutu'] = $this->M_jaminan_mutu->get_data('jaminan_mutu')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/jaminan_mutu/v_index', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function tambah()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/jaminan_mutu/v_tambah');
        $this->load->view('dashboard/v_footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {
            $image                   = 'jaminan_mutu-' . time() . '-' . $_FILES["sampul"]['name'];
            $config['file_name']     = $image;
            $config['upload_path']   = './gambar/';
            $config['allowed_types'] = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('sampul')) {
                $gambar = $this->upload->data();
            }

            $data = [
                'jaminan_mutu_tanggal' => date('Y-m-d H:i:s'),
                'jaminan_mutu_judul'   => $this->input->post('judul'),
                'jaminan_mutu_content' => $this->input->post('konten'),
                'jaminan_mutu_slug'    => strtolower(url_title($this->input->post('judul'))),
                'jaminan_mutu_sampul'  => isset($gambar) ? $gambar['file_name'] : '',
                'jaminan_mutu_status'  => $this->input->post('status'),
                'id_pages'             => 7
            ];

            $this->M_jaminan_mutu->insert_data($data, 'jaminan_mutu');

            redirect(base_url() . 'backend/jaminan_mutu');
        } else {
            $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/jaminan_mutu/v_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }

    public function edit($id)
    {
        $where = ['jaminan_mutu_id' => $id];
        $data['jaminan_mutu'] = $this->M_jaminan_mutu->edit_data($where, 'jaminan_mutu')->row();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/jaminan_mutu/v_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function update()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $where = ['jaminan_mutu_id' => $id];

            $data = [
                'jaminan_mutu_tanggal' => date('Y-m-d H:i:s'),
                'jaminan_mutu_judul'   => $this->input->post('judul'),
                'jaminan_mutu_content' => $this->input->post('konten'),
                'jaminan_mutu_slug'    => strtolower(url_title($this->input->post('judul'))),
                'jaminan_mutu_status'  => $this->input->post('status'),
                'id_pages'             => 7
            ];

            $this->M_jaminan_mutu->update_data($where, $data, 'jaminan_mutu');


            if (!empty($_FILES['sampul']['name'])) {
                $image                   = 'jaminan_mutu-' . time() . '-' . $_FILES["sampul"]['name'];
                $config['file_name']     = $image;
                $config['upload_path']   = './gambar/';
                $config['allowed_types'] = 'gif|jpg|png';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('sampul')) {

                    $single_data = $this->M_jaminan_mutu->edit_data($where, 'jaminan_mutu')->row();
                    $path = "/gambar/";
                    unlink(FCPATH . $path . $single_data->jaminan_mutu_sampul);

                    $gambar = $this->upload->data();
                    $data = array(
                        'jaminan_mutu_sampul' => $gambar['file_name'],
                    );

                    $this->M_jaminan_mutu->update_data($where, $data, 'jaminan_mutu');

                    redirect(base_url() . 'backend/jaminan_mutu');
                } else {
                    $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

                    $where = ['jaminan_mutu_id' => $id];

                    $data['jaminan_mutu'] = $this->M_jaminan_mutu->edit_data($where, 'jaminan_mutu')->row();
                    $this->load->view('dashboard/v_header');
                    $this->load->view('backend/jaminan_mutu/v_edit', $data);
                    $this->load->view('dashboard/v_footer');
                }
            } else {
                redirect(base_url() . 'backend/jaminan_mutu');
            }
        } else {
            $id = $this->input->post('id');
            $where = ['jaminan_mutu_id' => $id];
            $data['jaminan_mutu'] = $this->M_jaminan_mutu->edit_data($where, 'jaminan_mutu')->row();
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/jaminan_mutu/v_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function hapus($id)
    {
        $where = ['jaminan_mutu_id' => $id];
        $single_data = $this->M_jaminan_mutu->edit_data($where, 'jaminan_mutu')->row();
        $path = "/gambar/";
        unlink(FCPATH . $path . $single_data->jaminan_mutu_sampul);
        $this->M_jaminan_mutu->delete_data($where, 'jaminan_mutu');

        redirect(base_url() . 'backend/jaminan_mutu');
    }
}
