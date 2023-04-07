<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akademik extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('M_akademik');

        if ($this->session->userdata('status') != "telah_login") {
            redirect(base_url() . 'login?alert=belum_login');
        }
    }

    public function index()
    {
        $data['data_akademik'] = $this->M_akademik->get_data('akademik')->result();
        $data['data_akademik_sub'] = $this->M_akademik->get_data('akademik_sub')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/akademik/v_index', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function tambah()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/akademik/v_tambah');
        $this->load->view('dashboard/v_footer');
    }

    public function tambah_sub()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/akademik/v_tambah_sub');
        $this->load->view('dashboard/v_footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {
            $image                   = 'akademik-' . time() . '-' . $_FILES["sampul"]['name'];
            $config['file_name']     = $image;
            $config['upload_path']   = './gambar/';
            $config['allowed_types'] = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('sampul')) {
                $gambar = $this->upload->data();
            }

            if ($this->input->post('akademik_id')) {
                $data = [
                    'akademik_id'          => $this->input->post('akademik_id'),
                    'akademik_sub_tanggal' => date('Y-m-d H:i:s'),
                    'akademik_sub_judul'   => $this->input->post('judul'),
                    'akademik_sub_content' => $this->input->post('konten'),
                    'akademik_sub_slug'    => strtolower(url_title($this->input->post('judul'))),
                    'akademik_sub_sampul'  => isset($gambar) ? $gambar['file_name'] : '',
                    'akademik_sub_status'  => $this->input->post('status'),
                    'id_pages'             => 4
                ];

                $this->M_akademik->insert_data($data, 'akademik_sub');
            } else {
                $data = [
                    'akademik_tanggal' => date('Y-m-d H:i:s'),
                    'akademik_judul'   => $this->input->post('judul'),
                    'akademik_content' => $this->input->post('konten'),
                    'akademik_slug'    => strtolower(url_title($this->input->post('judul'))),
                    'akademik_sampul'  => isset($gambar) ? $gambar['file_name'] : '',
                    'akademik_status'  => $this->input->post('status'),
                    'id_pages'          => 4
                ];

                $this->M_akademik->insert_data($data, 'akademik');
            }

            redirect(base_url() . 'backend/akademik');
        } else {
            $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/akademik/v_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }

    public function edit($id)
    {
        $where = ['akademik_id' => $id];
        $data['akademik'] = $this->M_akademik->edit_data($where, 'akademik')->row();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/akademik/v_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function edit_sub($id)
    {
        $where                = ['akademik_sub_id' => $id];
        $data['akademik_sub'] = $this->M_akademik->edit_data($where, 'akademik_sub')->row();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/akademik/v_edit_sub', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function update()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {

            if($this->input->post('id')){
                $id = $this->input->post('id');

                $where = ['akademik_id' => $id];

                $data = [
                    'akademik_tanggal' => date('Y-m-d H:i:s'),
                    'akademik_judul'   => $this->input->post('judul'),
                    'akademik_content' => $this->input->post('konten'),
                    'akademik_slug'    => strtolower(url_title($this->input->post('judul'))),
                    'akademik_status'  => $this->input->post('status'),
                    'id_pages'          => 4
                ];

                $this->M_akademik->update_data($where, $data, 'akademik');
            } else {
                $akademik_sub_id = $this->input->post('akademik_sub_id');

                $where = ['akademik_sub_id' => $akademik_sub_id];

                $data = [
                    'akademik_sub_tanggal' => date('Y-m-d H:i:s'),
                    'akademik_sub_judul'   => $this->input->post('judul'),
                    'akademik_sub_content' => $this->input->post('konten'),
                    'akademik_sub_slug'    => strtolower(url_title($this->input->post('judul'))),
                    'akademik_sub_status'  => $this->input->post('status'),
                    'id_pages'             => 4
                ];

                $this->M_akademik->update_data($where, $data, 'akademik_sub');
            }

            if (!empty($_FILES['sampul']['name'])) {

                $where = ['akademik_id' => $id];
                $single_data = $this->M_akademik->edit_data($where, 'akademik')->row();

                $path = "/gambar/";
                unlink(FCPATH . $path . $single_data->akademik_sampul);

                $image                   = 'akademik-' . time() . '-' . $_FILES["sampul"]['name'];
                $config['file_name']     = $image;
                $config['upload_path']   = './gambar/';
                $config['allowed_types'] = 'gif|jpg|png';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('sampul')) {
                    $gambar = $this->upload->data();

                    if($this->input->post('id')){
                        $data = array(
                            'akademik_sampul' => $gambar['file_name']
                        );

                        $this->M_akademik->update_data($where, $data, 'akademik');
                    } else {
                        $data = array(
                            'akademik_sub_sampul' => $gambar['file_name']
                        );

                        $this->M_akademik->update_data($where, $data, 'akademik_sub');
                    }

                    redirect(base_url() . 'backend/akademik');
                } else {
                    $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

                    $where = ['akademik_id' => $id];

                    $data['akademik'] = $this->M_akademik->edit_data($where, 'akademik')->row();
                    $this->load->view('dashboard/v_header');
                    $this->load->view('backend/akademik/v_edit', $data);
                    $this->load->view('dashboard/v_footer');
                }
            } else {
                redirect(base_url() . 'backend/akademik');
            }
        } else {
            $id = $this->input->post('id');
            $where = ['akademik_id' => $id];
            $data['akademik'] = $this->M_akademik->edit_data($where, 'akademik')->row();
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/akademik/v_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function hapus($id)
    {
        $where = ['akademik_id' => $id];
        $single_data = $this->M_akademik->edit_data($where, 'akademik')->row();
        $path = "/gambar/";
        unlink(FCPATH . $path . $single_data->akademik_sampul);

        $this->M_akademik->delete_data($where, 'akademik');

        redirect(base_url() . 'backend/akademik');
    }
    
    public function hapus_sub($id)
    {
        $where = ['akademik_sub_id' => $id];
        $single_data = $this->M_akademik->edit_data($where, 'akademik_sub')->row();
        $path = "/gambar/";
        unlink(FCPATH . $path . $single_data->akademik_sub_sampul);

        $this->M_akademik->delete_data($where, 'akademik_sub');

        redirect(base_url() . 'backend/akademik');
    }
}
