<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('M_profile');
        $this->load->model('m_data');
    }

    public function profile($slug)
    {
        $where                    = ['profile_slug' => $slug];
        $data['profile']          = $this->m_data->get_detail($where, 'profile')->row();
        $data['berita']           = $this->m_data->get_data('artikel')->result();
        $data['title']            = 'PROFILE';
        // data pengaturan website
        $data['pengaturan']       = $this->m_data->get_data('pengaturan')->row();
        // SEO META
        $data['meta_keyword']     = $data['pengaturan']->nama;
        $data['meta_description'] = $data['pengaturan']->deskripsi;

        $this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_profile', $data);
        $this->load->view('frontend/v_footer', $data);
    }

    public function berita($slug = NULL)
    {
        if ($slug != NULL) {
            $where           = ['artikel_slug' => $slug];
            $data['artikel'] = $this->m_data->get_detail($where, 'artikel')->row();
            $upd             = ['artikel_view' => $data['artikel']->artikel_view + 1];
            $this->m_data->update_data($where, $upd, 'artikel');
        } else {
            $data['artikel']           = $this->m_data->get_data('artikel')->result();
        }

        $data['berita']           = $this->m_data->get_data('artikel')->result();
        $data['title']            = 'BERITA';
        // data pengaturan website
        $data['pengaturan']       = $this->m_data->get_data('pengaturan')->row();
        // SEO META
        $data['meta_keyword']     = $data['pengaturan']->nama;
        $data['meta_description'] = $data['pengaturan']->deskripsi;

        $this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_berita', $data);
        $this->load->view('frontend/v_footer', $data);
    }

    public function event($slug = NULL)
    {
        if ($slug != NULL) {
            $where                = ['event_slug' => $slug];
            $data['event']   = $this->m_data->get_detail($where, 'event')->row();
        } else {
            $data['event']   = $this->m_data->get_data('event')->result();
        }

        $data['berita']           = $this->m_data->get_data('artikel')->result();
        $data['title']            = 'EVENT';
        // data pengaturan website
        $data['pengaturan']       = $this->m_data->get_data('pengaturan')->row();
        // SEO META
        $data['meta_keyword']     = $data['pengaturan']->nama;
        $data['meta_description'] = $data['pengaturan']->deskripsi;

        $this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_event', $data);
        $this->load->view('frontend/v_footer', $data);
    }


    public function pengumuman($slug = NULL)
    {
        if ($slug != NULL) {
            $where                = ['pengumuman_slug' => $slug];
            $data['pengumuman']   = $this->m_data->get_detail($where, 'pengumuman')->row();
        } else {
            $data['pengumuman']   = $this->m_data->get_data('pengumuman')->result();
        }

        $data['berita']           = $this->m_data->get_data('artikel')->result();
        $data['title']            = 'PENGUMUMAN';
        // data pengaturan website
        $data['pengaturan']       = $this->m_data->get_data('pengaturan')->row();
        // SEO META
        $data['meta_keyword']     = $data['pengaturan']->nama;
        $data['meta_description'] = $data['pengaturan']->deskripsi;

        $this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_pengumuman', $data);
        $this->load->view('frontend/v_footer', $data);
    }

    public function galery($slug = NULL)
    {
        if ($slug != NULL) {
            $where          = ['galery_slug' => $slug];
            $galery         = $this->m_data->get_detail($where, 'galery')->row();

            $gd             = $this->db->query("SELECT * FROM galery_detail WHERE galery_id = '$galery->galery_id' ")->result();
            $data['galery'] = [
                'parent' => $galery,
                'sub'    => $gd,
            ];
            array_push($data['galery'], ['page' => 'detail']);
        } else {
            
            $galery         = $this->m_data->get_data('galery')->result();
            $temp           = [];
            $data['galery'] = [];
            

            foreach ($galery as $key => $value) {
                $gd             = $this->db->query("SELECT * FROM galery_detail WHERE galery_id = '$value->galery_id' ")->result();
                $temp['parent'] = $value;
                $temp['sub']    = $gd;
                $temp['page']   = 'show';

                array_push($data['galery'], $temp);
            }

        }

        $data['berita']        = $this->m_data->get_data('artikel')->result();
        $data['title']         = 'GALERY';
        // data pengaturan website
        $data['pengaturan']       = $this->m_data->get_data('pengaturan')->row();
        // SEO META
        $data['meta_keyword']     = $data['pengaturan']->nama;
        $data['meta_description'] = $data['pengaturan']->deskripsi;

        $this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_galery', $data);
        $this->load->view('frontend/v_footer', $data);
    }

    public function pembelajaran($slug)
    {
        $where                    = ['pembelajaran_slug' => $slug];
        $data['pembelajaran']     = $this->m_data->get_detail($where, 'pembelajaran')->row();
        $data['berita']           = $this->m_data->get_data('artikel')->result();
        $data['title']            = 'PEMBELAJARAN';
        $data['pengaturan']       = $this->m_data->get_data('pengaturan')->row();
        $data['meta_keyword']     = $data['pengaturan']->nama;
        $data['meta_description'] = $data['pengaturan']->deskripsi;

        $this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_pembelajaran', $data);
        $this->load->view('frontend/v_footer', $data);
    }

    public function kode_perilaku()
    {
        $data['kode_perilaku']     = $this->m_data->get_data('kode_perilaku')->row();
        $data['berita']           = $this->m_data->get_data('artikel')->result();
        $data['title']            = 'KODE PERILAKU';
        $data['pengaturan']       = $this->m_data->get_data('pengaturan')->row();
        $data['meta_keyword']     = $data['pengaturan']->nama;
        $data['meta_description'] = $data['pengaturan']->deskripsi;

        $this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_kode_perilaku', $data);
        $this->load->view('frontend/v_footer', $data);
    }

    public function jaminan_mutu($slug)
    {
        $where                    = ['jaminan_mutu_slug' => $slug];
        $data['jaminan_mutu']     = $this->m_data->get_detail($where, 'jaminan_mutu')->row();
        $data['berita']           = $this->m_data->get_data('artikel')->result();
        $data['title']            = 'JAMINAN MUTU';
        $data['pengaturan']       = $this->m_data->get_data('pengaturan')->row();
        $data['meta_keyword']     = $data['pengaturan']->nama;
        $data['meta_description'] = $data['pengaturan']->deskripsi;

        $this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_jaminan_mutu', $data);
        $this->load->view('frontend/v_footer', $data);
    }

    public function dokumen()
    {
        $data['dokumen']          = $this->m_data->get_data('dokumen')->result();
        $data['berita']           = $this->m_data->get_data('artikel')->result();
        $data['title']            = 'DOKUMEN';
        $data['pengaturan']       = $this->m_data->get_data('pengaturan')->row();
        $data['meta_keyword']     = $data['pengaturan']->nama;
        $data['meta_description'] = $data['pengaturan']->deskripsi;

        $this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_dokumen', $data);
        $this->load->view('frontend/v_footer', $data);
    }
}
