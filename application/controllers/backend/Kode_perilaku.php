<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kode_perilaku extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('M_kode_perilaku');

        if ($this->session->userdata('status') != "telah_login") {
            redirect(base_url() . 'login?alert=belum_login');
        }
    }

    public function index()
    {
        $data['data_kode_perilaku'] = $this->M_kode_perilaku->get_data('kode_perilaku')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/kode_perilaku/v_index', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function tambah()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/kode_perilaku/v_tambah');
        $this->load->view('dashboard/v_footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {
            $image                   = 'kode_perilaku-' . time() . '-' . $_FILES["sampul"]['name'];
            $config['file_name']     = $image;
            $config['upload_path']   = './gambar/';
            $config['allowed_types'] = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('sampul')) {
                $gambar = $this->upload->data();
            }

            $data = [
                'kode_perilaku_tanggal' => date('Y-m-d H:i:s'),
                'kode_perilaku_judul'   => $this->input->post('judul'),
                'kode_perilaku_content' => $this->input->post('konten'),
                'kode_perilaku_slug'    => strtolower(url_title($this->input->post('judul'))),
                'kode_perilaku_sampul'  => isset($gambar) ? $gambar['file_name'] : '',
                'kode_perilaku_status'  => $this->input->post('status'),
                'id_pages'             => 6
            ];

            $this->M_kode_perilaku->insert_data($data, 'kode_perilaku');

            redirect(base_url() . 'backend/kode_perilaku');
        } else {
            $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/kode_perilaku/v_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }

    public function edit($id)
    {
        $where = ['kode_perilaku_id' => $id];
        $data['kode_perilaku'] = $this->M_kode_perilaku->edit_data($where, 'kode_perilaku')->row();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/kode_perilaku/v_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function update()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $where = ['kode_perilaku_id' => $id];

            $data = [
                'kode_perilaku_tanggal' => date('Y-m-d H:i:s'),
                'kode_perilaku_judul'   => $this->input->post('judul'),
                'kode_perilaku_content' => $this->input->post('konten'),
                'kode_perilaku_slug'    => strtolower(url_title($this->input->post('judul'))),
                'kode_perilaku_status'  => $this->input->post('status'),
                'id_pages'             => 6
            ];

            $this->M_kode_perilaku->update_data($where, $data, 'kode_perilaku');


            if (!empty($_FILES['sampul']['name'])) {
                $image                   = 'kode_perilaku-' . time() . '-' . $_FILES["sampul"]['name'];
                $config['file_name']     = $image;
                $config['upload_path']   = './gambar/';
                $config['allowed_types'] = 'gif|jpg|png';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('sampul')) {

                    $single_data = $this->M_kode_perilaku->edit_data($where, 'kode_perilaku')->row();
                    $path = "/gambar/";
                    unlink(FCPATH . $path . $single_data->kode_perilaku_sampul);

                    $gambar = $this->upload->data();
                    $data = array(
                        'kode_perilaku_sampul' => $gambar['file_name'],
                    );

                    $this->M_kode_perilaku->update_data($where, $data, 'kode_perilaku');

                    redirect(base_url() . 'backend/kode_perilaku');
                } else {
                    $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

                    $where = ['kode_perilaku_id' => $id];

                    $data['kode_perilaku'] = $this->M_kode_perilaku->edit_data($where, 'kode_perilaku')->row();
                    $this->load->view('dashboard/v_header');
                    $this->load->view('backend/kode_perilaku/v_edit', $data);
                    $this->load->view('dashboard/v_footer');
                }
            } else {
                redirect(base_url() . 'backend/kode_perilaku');
            }
        } else {
            $id = $this->input->post('id');
            $where = ['kode_perilaku_id' => $id];
            $data['kode_perilaku'] = $this->M_kode_perilaku->edit_data($where, 'kode_perilaku')->row();
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/kode_perilaku/v_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function hapus($id)
    {
        $where = ['kode_perilaku_id' => $id];
        $single_data = $this->M_kode_perilaku->edit_data($where, 'kode_perilaku')->row();
        $path = "/gambar/";
        unlink(FCPATH . $path . $single_data->kode_perilaku_sampul);
        $this->M_kode_perilaku->delete_data($where, 'kode_perilaku');

        redirect(base_url() . 'backend/kode_perilaku');
    }
}
