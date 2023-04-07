<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?php echo $pengaturan->nama ?> - <?php echo $pengaturan->deskripsi ?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="<?php echo $meta_keyword ?>" name="keywords">
  <meta content="<?php echo $meta_description ?>" name="description">

  <!-- Favicons -->
  <link href="<?php echo base_url() . '/gambar/website/' . $pengaturan->logo; ?>" rel="icon">
  <link href="<?php echo base_url(); ?>assets_frontend/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap CSS File -->
  <link href="<?php echo base_url(); ?>assets_frontend/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url(); ?>assets_frontend/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets_frontend/lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets_frontend/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets_frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets_frontend/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url(); ?>assets_frontend/css/style.css" rel="stylesheet">

  <!-- font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&display=swap" rel="stylesheet">

  <style>
    * {
      font-family: 'Nunito', sans-serif;
    }
  </style>
  <!-- =======================================================
    Theme Name: DevFolio
    Theme URL: https://bootstrapmade.com/devfolio-bootstrap-portfolio-html-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body id="page-top">

  <!--/ Nav Star /-->
  <nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" id="mainNav">
    <div class="container">

      <img src="<?php echo base_url() . '/gambar/website/' . $pengaturan->logo; ?>" width="30px" class="mr-2">

      <a class="navbar-brand js-scroll" href="#page-top"><?php echo $pengaturan->nama ?> </a>

      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
        <ul class="navbar-nav">

          <?php
          $menu = menu_header();
          $submenu = sub_menu_header();
          foreach ($menu as $key => $value) : ?>

            <!-- Kode perilaku dan sanksi -->
            <?php if ($value->halaman_id == 1) : ?>
              <li class="nav-item dropdown">
                <a class="nav-link" style="font-size: 13px;" href="<?= base_url() ?>"><?= $value->halaman_judul; ?></a>
              </li>
            <?php elseif ($value->halaman_id == 6 || $value->halaman_id == 8) : ?>
              <li class="nav-item">
                <a class="nav-link" style="font-size: 13px;" href="<?= base_url('page/') . $value->halaman_slug ?>"><?= $value->halaman_judul; ?></a>
              </li>
            <?php else : ?>
              <li class="nav-item dropdown">
                <a class="nav-link" style="font-size: 13px;" href="#" id="dropdown<?= $value->halaman_slug ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $value->halaman_judul; ?></a>

                <!-- profile -->
                <?php if ($value->halaman_id == 2) : ?>
                  <div class="dropdown-menu border-0 shadow rounded py-0" aria-labelledby="dropdown<?= $value->halaman_slug ?>" style="overflow: hidden;">
                    <?php foreach ($submenu['profile'] as $prf) : ?>
                      <a class="dropdown-item px-3" style="font-size: 13px;" href="<?= base_url('page/profile/' . $prf->profile_slug) ?>"><?= $prf->profile_judul; ?></a>
                    <?php endforeach ?>
                  </div>
                <?php endif ?>

                <?php if ($value->halaman_id == 3) : ?>
                  <div class="dropdown-menu border-0 shadow rounded py-0" aria-labelledby="dropdown<?= $value->halaman_slug ?>" style="overflow: hidden;">
                    <a class="dropdown-item px-3" style="font-size: 13px;" href="<?= base_url('page/berita') ?>">Berita</a>
                    <a class="dropdown-item px-3" style="font-size: 13px;" href="<?= base_url('page/event') ?>">Event</a>
                    <a class="dropdown-item px-3" style="font-size: 13px;" href="<?= base_url('page/pengumuman') ?>">Pengumuman</a>
                    <a class="dropdown-item px-3" style="font-size: 13px;" href="<?= base_url('page/galery') ?>">Galery</a>
                  </div>
                <?php endif ?>

                <!-- akademik  -->
                <?php if ($value->halaman_id == 4) : ?>
                  <div class="dropdown-menu border-0 shadow rounded py-0" aria-labelledby="dropdown<?= $value->halaman_slug ?>" style="overflow: hidden;">
                    <?php foreach ($submenu['akademik'] as $akd) : ?>
                      <?php if ($akd->akademik_id != 3) : ?>
                        <a class="dropdown-item px-3" style="font-size: 13px;" href="<?= base_url('page/akademik/' . $akd->akademik_slug) ?>"><?= $akd->akademik_judul; ?></a>
                      <?php else : ?>
                        <div class="dropdown">
                          <div class="dropdown-item px-3 " style="font-size: 13px;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $akd->akademik_judul; ?></div>
                          <div class="dropdown-menu border-0 shadow rounded py-0" aria-labelledby="dropdownMenuButton" style="overflow: hidden;">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                          </div>
                        </div>

                      <?php endif ?>
                    <?php endforeach ?>
                  </div>
                <?php endif ?>

                <!-- pembelajaran -->
                <?php if ($value->halaman_id == 5) : ?>
                  <div class="dropdown-menu border-0 shadow rounded py-0" aria-labelledby="dropdown<?= $value->halaman_slug ?>" style="overflow: hidden;">
                    <?php foreach ($submenu['pembelajaran'] as $pmb) : ?>
                      <a class="dropdown-item px-3" style="font-size: 13px ;" href="<?= base_url('page/pembelajaran/' . $pmb->pembelajaran_slug) ?>"><?= $pmb->pembelajaran_judul; ?></a>
                    <?php endforeach ?>
                  </div>
                <?php endif ?>

                <!-- jaminan mutu -->
                <?php if ($value->halaman_id == 7) : ?>
                  <div class="dropdown-menu border-0 shadow rounded py-0" aria-labelledby="dropdown<?= $value->halaman_slug ?>" style="overflow: hidden;">
                    <?php foreach ($submenu['jaminan_mutu'] as $pmb) : ?>
                      <a class="dropdown-item px-3" style="font-size: 13px;" href="<?= base_url('page/jaminan_mutu/' . $pmb->jaminan_mutu_slug) ?>"><?= $pmb->jaminan_mutu_judul; ?></a>
                    <?php endforeach ?>
                  </div>
                <?php endif ?>

              </li>
            <?php endif ?>
          <?php endforeach ?>
        </ul>
      </div>
  </nav>
  <!--/ Nav End /-->