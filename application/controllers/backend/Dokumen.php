<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokumen extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('M_dokumen');

        if ($this->session->userdata('status') != "telah_login") {
            redirect(base_url() . 'login?alert=belum_login');
        }
    }

    public function index()
    {
        $data['data_dokumen'] = $this->M_dokumen->get_data('dokumen')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/dokumen/v_index', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function tambah()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/dokumen/v_tambah');
        $this->load->view('dashboard/v_footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {
            if (!empty($_FILES['konten']['name'])) {
                $doc                     = 'dokumen-' . time() . '-' . $_FILES["konten"]['name'];
                $config['file_name']     = $doc;
                $config['upload_path']   = './gambar/';
                $config['allowed_types'] = 'pdf';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('konten')) {

                    $gambar = $this->upload->data();

                    $data = [
                        'dokumen_tanggal' => date('Y-m-d H:i:s'),
                        'dokumen_judul'   => $this->input->post('judul'),
                        'dokumen_content' => $gambar['file_name'],
                        'dokumen_slug'    => strtolower(url_title($this->input->post('judul'))),
                        'dokumen_status'  => $this->input->post('status'),
                        'id_pages'        => 8
                    ];

                    $this->M_dokumen->insert_data($data, 'dokumen');

                    redirect(base_url() . 'backend/dokumen');
                } else {
                    $this->form_validation->set_message('sampul', $data['dokumen_error'] = $this->upload->display_errors());

                    $where = ['dokumen_id' => $id];

                    $data['dokumen'] = $this->M_dokumen->edit_data($where, 'dokumen')->row();
                    $this->load->view('dashboard/v_header');
                    $this->load->view('backend/dokumen/v_edit', $data);
                    $this->load->view('dashboard/v_footer');
                }
            } else {
                redirect(base_url() . 'backend/dokumen');
            }
            redirect(base_url() . 'backend/dokumen');
        } else {
            $this->form_validation->set_message('dokumen', $data['dokumen_error'] = $this->upload->display_errors());
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/dokumen/v_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }

    public function edit($id)
    {
        $where = ['dokumen_id' => $id];
        $data['dokumen'] = $this->M_dokumen->edit_data($where, 'dokumen')->row();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/dokumen/v_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function update()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $where = ['dokumen_id' => $id];

            $data = [
                'dokumen_tanggal' => date('Y-m-d H:i:s'),
                'dokumen_judul'   => $this->input->post('judul'),
                'dokumen_slug'    => strtolower(url_title($this->input->post('judul'))),
                'dokumen_status'  => $this->input->post('status'),
                'id_pages'             => 8
            ];

            $this->M_dokumen->update_data($where, $data, 'dokumen');


            if (!empty($_FILES['konten']['name'])) {
                $doc                   = 'dokumen-' . time() . '-' . $_FILES["konten"]['name'];
                $config['file_name']     = $doc;
                $config['upload_path']   = './gambar/';
                $config['allowed_types'] = 'pdf';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('konten')) {

                    $single_data = $this->M_dokumen->edit_data($where, 'dokumen')->row();
                    $path = "/gambar/";
                    unlink(FCPATH . $path . $single_data->dokumen_content);

                    $gambar = $this->upload->data();
                    $data = array(
                        'dokumen_content' => $gambar['file_name']
                    );

                    $this->M_dokumen->update_data($where, $data, 'dokumen');

                    redirect(base_url() . 'backend/dokumen');
                } else {
                    $this->form_validation->set_message('sampul', $data['dokumen_error'] = $this->upload->display_errors());

                    $where = ['dokumen_id' => $id];

                    $data['dokumen'] = $this->M_dokumen->edit_data($where, 'dokumen')->row();
                    $this->load->view('dashboard/v_header');
                    $this->load->view('backend/dokumen/v_edit', $data);
                    $this->load->view('dashboard/v_footer');
                }
            } else {
                redirect(base_url() . 'backend/dokumen');
            }
        } else {
            $id = $this->input->post('id');
            $where = ['dokumen_id' => $id];
            $data['dokumen'] = $this->M_dokumen->edit_data($where, 'dokumen')->row();
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/dokumen/v_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function hapus($id)
    {
        $where = ['dokumen_id' => $id];
        $single_data = $this->M_dokumen->edit_data($where, 'dokumen')->row();
        $path = "/gambar/";
        unlink(FCPATH . $path . $single_data->dokumen_content);
        $this->M_dokumen->delete_data($where, 'dokumen');

        redirect(base_url() . 'backend/dokumen');
    }
}
