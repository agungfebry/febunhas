<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengumuman extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('M_pengumuman');

        if ($this->session->userdata('status') != "telah_login") {
            redirect(base_url() . 'login?alert=belum_login');
        }
    }

    public function index()
    {
        $data['data_pengumuman'] = $this->M_pengumuman->get_data('pengumuman')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/pengumuman/v_index', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function tambah()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/pengumuman/v_tambah');
        $this->load->view('dashboard/v_footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {
            $image                   = 'pengumuman-' . time() . '-' . $_FILES["sampul"]['name'];
            $config['file_name']     = $image;
            $config['upload_path']   = './gambar/';
            $config['allowed_types'] = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('sampul')) {
                $gambar = $this->upload->data();
            }

            $data = [
                'pengumuman_tanggal' => date('Y-m-d H:i:s'),
                'pengumuman_judul'   => $this->input->post('judul'),
                'pengumuman_content' => $this->input->post('konten'),
                'pengumuman_slug'    => strtolower(url_title($this->input->post('judul'))),
                'pengumuman_sampul'  => isset($gambar) ? $gambar['file_name'] : '',
                'pengumuman_status'  => $this->input->post('status'),
                'id_pages'          => 2
            ];

            $this->M_pengumuman->insert_data($data, 'pengumuman');

            redirect(base_url() . 'backend/pengumuman');
        } else {
            $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/pengumuman/v_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }

    public function edit($id)
    {
        $where = ['pengumuman_id' => $id];
        $data['pengumuman'] = $this->M_pengumuman->edit_data($where, 'pengumuman')->row();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/pengumuman/v_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function update()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $where = ['pengumuman_id' => $id];

            $data = [
                'pengumuman_tanggal' => date('Y-m-d H:i:s'),
                'pengumuman_judul'   => $this->input->post('judul'),
                'pengumuman_content' => $this->input->post('konten'),
                'pengumuman_slug'    => strtolower(url_title($this->input->post('judul'))),
                'pengumuman_status'  => $this->input->post('status'),
                'id_pages'          => 2
            ];

            $this->M_pengumuman->update_data($where, $data, 'pengumuman');


            if (!empty($_FILES['sampul']['name'])) {

                $where = ['pengumuman_id' => $id];
                $single_data = $this->M_pengumuman->edit_data($where, 'pengumuman')->row();

                $path = "/gambar/";
                unlink(FCPATH . $path . $single_data->pengumuman_sampul);

                $image                   = 'pengumuman-' . time() . '-' . $_FILES["sampul"]['name'];
                $config['file_name']     = $image;
                $config['upload_path']   = './gambar/';
                $config['allowed_types'] = 'gif|jpg|png';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('sampul')) {
                    $gambar = $this->upload->data();
                    $data = array(
                        'pengumuman_sampul' => $gambar['file_name']
                    );

                    $this->M_pengumuman->update_data($where, $data, 'pengumuman');

                    redirect(base_url() . 'backend/pengumuman');
                } else {
                    $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

                    $where = ['pengumuman_id' => $id];

                    $data['pengumuman'] = $this->M_pengumuman->edit_data($where, 'pengumuman')->row();
                    $this->load->view('dashboard/v_header');
                    $this->load->view('backend/pengumuman/v_edit', $data);
                    $this->load->view('dashboard/v_footer');
                }
            } else {
                redirect(base_url() . 'backend/pengumuman');
            }
        } else {
            $id = $this->input->post('id');
            $where = ['pengumuman_id' => $id];
            $data['pengumuman'] = $this->M_pengumuman->edit_data($where, 'pengumuman')->row();
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/pengumuman/v_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function hapus($id)
    {
        $where = ['pengumuman_id' => $id];
        $single_data = $this->M_pengumuman->edit_data($where, 'pengumuman')->row();
        $path = "/gambar/";
        unlink(FCPATH . $path . $single_data->pengumuman_sampul);

        $this->M_pengumuman->delete_data($where, 'pengumuman');

        redirect(base_url() . 'backend/pengumuman');
    }
}
