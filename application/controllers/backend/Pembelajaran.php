<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelajaran extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('M_pembelajaran');

        if ($this->session->userdata('status') != "telah_login") {
            redirect(base_url() . 'login?alert=belum_login');
        }
    }

    public function index()
    {
        $data['data_pembelajaran'] = $this->M_pembelajaran->get_data('pembelajaran')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/pembelajaran/v_index', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function tambah()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/pembelajaran/v_tambah');
        $this->load->view('dashboard/v_footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {
            $image                   = 'pembelajaran-' . time() . '-' . $_FILES["sampul"]['name'];
            $config['file_name']     = $image;
            $config['upload_path']   = './gambar/';
            $config['allowed_types'] = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('sampul')) {
                $gambar = $this->upload->data();
            }

            $data = [
                'pembelajaran_tanggal' => date('Y-m-d H:i:s'),
                'pembelajaran_judul'   => $this->input->post('judul'),
                'pembelajaran_content' => $this->input->post('konten'),
                'pembelajaran_slug'    => strtolower(url_title($this->input->post('judul'))),
                'pembelajaran_sampul'  => isset($gambar) ? $gambar['file_name'] : '',
                'pembelajaran_status'  => $this->input->post('status'),
                'id_pages'             => 5
            ];

            $this->M_pembelajaran->insert_data($data, 'pembelajaran');

            redirect(base_url() . 'backend/pembelajaran');
        } else {
            $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/pembelajaran/v_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }

    public function edit($id)
    {
        $where = ['pembelajaran_id' => $id];
        $data['pembelajaran'] = $this->M_pembelajaran->edit_data($where, 'pembelajaran')->row();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/pembelajaran/v_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function update()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $where = ['pembelajaran_id' => $id];

            $data = [
                'pembelajaran_tanggal' => date('Y-m-d H:i:s'),
                'pembelajaran_judul'   => $this->input->post('judul'),
                'pembelajaran_content' => $this->input->post('konten'),
                'pembelajaran_slug'    => strtolower(url_title($this->input->post('judul'))),
                'pembelajaran_status'  => $this->input->post('status'),
                'id_pages'             => 5
            ];

            $this->M_pembelajaran->update_data($where, $data, 'pembelajaran');


            if (!empty($_FILES['sampul']['name'])) {
                $image                   = 'pembelajaran-' . time() . '-' . $_FILES["sampul"]['name'];
                $config['file_name']     = $image;
                $config['upload_path']   = './gambar/';
                $config['allowed_types'] = 'gif|jpg|png';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('sampul')) {

                    $single_data = $this->M_pembelajaran->edit_data($where, 'pembelajaran')->row();
                    $path = "/gambar/";
                    unlink(FCPATH . $path . $single_data->pembelajaran_sampul);

                    $gambar = $this->upload->data();
                    $data = array(
                        'pembelajaran_sampul' => $gambar['file_name'],
                    );

                    $this->M_pembelajaran->update_data($where, $data, 'pembelajaran');

                    redirect(base_url() . 'backend/pembelajaran');
                } else {
                    $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

                    $where = ['pembelajaran_id' => $id];

                    $data['pembelajaran'] = $this->M_pembelajaran->edit_data($where, 'pembelajaran')->row();
                    $this->load->view('dashboard/v_header');
                    $this->load->view('backend/pembelajaran/v_edit', $data);
                    $this->load->view('dashboard/v_footer');
                }
            } else {
                redirect(base_url() . 'backend/pembelajaran');
            }
        } else {
            $id = $this->input->post('id');
            $where = ['pembelajaran_id' => $id];
            $data['pembelajaran'] = $this->M_pembelajaran->edit_data($where, 'pembelajaran')->row();
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/pembelajaran/v_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function hapus($id)
    {
        $where = ['pembelajaran_id' => $id];
        $single_data = $this->M_pembelajaran->edit_data($where, 'pembelajaran')->row();
        $path = "/gambar/";
        unlink(FCPATH . $path . $single_data->pembelajaran_sampul);
        $this->M_pembelajaran->delete_data($where, 'pembelajaran');

        redirect(base_url() . 'backend/pembelajaran');
    }
}
