<!--/ Intro Skew Star /-->
<div class="intro intro-single route bg-image" style="background-image: url(img/overlay-bg.jpg)">
    <div class="overlay-mf"></div>
    <div class="intro-content display-table">
        <div class="table-cell">
            <div class="container">
                <h2 class="intro-title mb-4"><?= $title; ?></h2>
                <ol class="breadcrumb d-flex justify-content-center">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active"><?= $title; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="blog-wrapper sect-pt4 mb-5" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-3">
                <div class="card shadow-md border-0">
                    <?php if (isset($kode_perilaku->kode_perilaku_sampul) == 1) : ?>
                        <div class="card-header border-0 p-0" style="overflow: hidden;">
                            <img src="<?= base_url('gambar/' . $kode_perilaku->kode_perilaku_sampul) ?>" class="w-100" alt="<?= $kode_perilaku->kode_perilaku_judul ?>" style="object-fit: cover; max-height: 50vh;">
                        </div>
                    <?php endif ?>
                    <div class="card-body">
                        <h1 class="h5 text-uppercase" style="letter-spacing: .5px;"><?= $kode_perilaku->kode_perilaku_judul ?></h1>
                        <span class="text-muted" style="font-style: italic; font-size: 12px;"><?= date('d M Y', strtotime($kode_perilaku->kode_perilaku_tanggal)) ?></span> <br>
                        <article class="mt-4" style="font-size: 15px;"><?= $kode_perilaku->kode_perilaku_content ?></article>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-md border-0">
                    <div class="card-header bg-white">
                        <h6 class="mt-3">INFORMASI TERBARU</h6>
                    </div>
                    <div class="card-body">

                        <ul class="list-unstyled">
                            <?php $no = 1;
                            foreach (array_reverse($berita) as $key => $value) : ?>
                                <?php if ($no <= 5) : ?>
                                    <li class="media mb-3">
                                        <img class="mr-3 rounded" src="<?= base_url('gambar/artikel/' . $value->artikel_sampul) ?>" height="60" width="100" alt="<?= $value->artikel_sampul ?>">
                                        <div class="media-body">
                                            <a href="<?= base_url('page/berita/' . $value->artikel_slug) ?>" class="mt-0 mb-1" style="font-size: 14px; font-weight: 500;"><?= $value->artikel_judul ?></a>
                                        </div>
                                    </li>
                                <?php endif ?>
                            <?php $no++;
                            endforeach ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
</section>