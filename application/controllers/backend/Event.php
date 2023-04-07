<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('M_event');

        if ($this->session->userdata('status') != "telah_login") {
            redirect(base_url() . 'login?alert=belum_login');
        }
    }

    public function index()
    {
        $data['data_event'] = $this->M_event->get_data('event')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/event/v_index', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function tambah()
    {
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/event/v_tambah');
        $this->load->view('dashboard/v_footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {
            $image                   = 'event-' . time() . '-' . $_FILES["sampul"]['name'];
            $config['file_name']     = $image;
            $config['upload_path']   = './gambar/';
            $config['allowed_types'] = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('sampul')) {
                $gambar = $this->upload->data();
            }

            $data = [
                'event_tanggal' => date('Y-m-d H:i:s'),
                'event_judul'   => $this->input->post('judul'),
                'event_content' => $this->input->post('konten'),
                'event_slug'    => strtolower(url_title($this->input->post('judul'))),
                'event_sampul'  => isset($gambar) ? $gambar['file_name'] : '',
                'event_status'  => $this->input->post('status'),
                'id_pages'          => 2
            ];

            $this->M_event->insert_data($data, 'event');

            redirect(base_url() . 'backend/event');
        } else {
            $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/event/v_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }

    public function edit($id)
    {
        $where = ['event_id' => $id];
        $data['event'] = $this->M_event->edit_data($where, 'event')->row();
        $this->load->view('dashboard/v_header');
        $this->load->view('backend/event/v_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function update()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $where = ['event_id' => $id];

            $data = [
                'event_tanggal' => date('Y-m-d H:i:s'),
                'event_judul'   => $this->input->post('judul'),
                'event_content' => $this->input->post('konten'),
                'event_slug'    => strtolower(url_title($this->input->post('judul'))),
                'event_status'  => $this->input->post('status'),
                'id_pages'          => 2
            ];

            $this->M_event->update_data($where, $data, 'event');


            if (!empty($_FILES['sampul']['name'])) {

                $where = ['event_id' => $id];
                $single_data = $this->M_event->edit_data($where, 'event')->row();

                $path = "/gambar/";
                unlink(FCPATH . $path . $single_data->event_sampul);

                $image                   = 'event-' . time() . '-' . $_FILES["sampul"]['name'];
                $config['file_name']     = $image;
                $config['upload_path']   = './gambar/';
                $config['allowed_types'] = 'gif|jpg|png';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('sampul')) {
                    $gambar = $this->upload->data();
                    $data = array(
                        'event_sampul' => $gambar['file_name']
                    );

                    $this->M_event->update_data($where, $data, 'event');

                    redirect(base_url() . 'backend/event');
                } else {
                    $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

                    $where = ['event_id' => $id];

                    $data['event'] = $this->M_event->edit_data($where, 'event')->row();
                    $this->load->view('dashboard/v_header');
                    $this->load->view('backend/event/v_edit', $data);
                    $this->load->view('dashboard/v_footer');
                }
            } else {
                redirect(base_url() . 'backend/event');
            }
        } else {
            $id = $this->input->post('id');
            $where = ['event_id' => $id];
            $data['event'] = $this->M_event->edit_data($where, 'event')->row();
            $this->load->view('dashboard/v_header');
            $this->load->view('backend/event/v_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function hapus($id)
    {
        $where = ['event_id' => $id];
        $single_data = $this->M_event->edit_data($where, 'event')->row();
        $path = "/gambar/";
        unlink(FCPATH . $path . $single_data->event_sampul);

        $this->M_event->delete_data($where, 'event');

        redirect(base_url() . 'backend/event');
    }
}
