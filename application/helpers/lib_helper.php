<?php

function menu_header()
{
    $ci = &get_instance();
    $ci->load->database();

    $data = $ci->db->query('SELECT * FROM halaman')->result();

    return $data;
}

function sub_menu_header()
{
    $ci = &get_instance();
    $ci->load->database();

    $profile      = $ci->db->get_where('profile', ['profile_status'           => 'Publish'])->result();
    $pembelajaran = $ci->db->get_where('pembelajaran', ['pembelajaran_status' => 'Publish'])->result();
    $jaminan_mutu = $ci->db->get_where('jaminan_mutu', ['jaminan_mutu_status' => 'Publish'])->result();
    $akademik     = $ci->db->get_where('akademik', ['akademik_status'         => 'Publish'])->result();
    $akademik_sub = $ci->db->get_where('akademik_sub', ['akademik_sub_status' => 'Publish'])->result();

    $data = [
        'profile'      => $profile,
        'pembelajaran' => $pembelajaran,
        'jaminan_mutu' => $jaminan_mutu,
        'akademik'     => $akademik,
        'akademik_sub' => $akademik_sub
    ];

    return $data;
}
