<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Pengumuman
            <small>Edit Pengumuman Baru</small>
        </h1>
    </section>

    <section class="content">

        <a href="<?php echo base_url() . 'backend/pengumuman'; ?>" class="btn btn-sm btn-primary">Kembali</a>

        <br />
        <br />

        <form method="post" action="<?php echo base_url('backend/pengumuman/update/') ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-9">

                    <div class="box box-primary">
                        <div class="box-body">

                            <div class="box-body">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="hidden" name="id" value="<?php echo $pengumuman->pengumuman_id; ?>">
                                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul pengumuman.." value="<?php echo $pengumuman->pengumuman_judul; ?>">
                                    <br />
                                    <?php echo form_error('judul'); ?>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group">
                                    <label>Konten</label>
                                    <?php echo form_error('konten'); ?>
                                    <br />
                                    <textarea class="form-control" id="editor" name="konten"> <?php echo $pengumuman->pengumuman_content; ?> </textarea>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

                <div class="col-lg-3">
                    <div class="box box-primary">
                        <div class="box-body">
                            <br /><br />
                            <div class="form-group">
                                <label>Gambar Sampul</label>

                                <input type="file" name="sampul">

                                <span class="text-danger"><?php echo $pengumuman->pengumuman_sampul; ?></span>

                                <br />
                                <?php
                                if (isset($gambar_error)) {
                                    echo $gambar_error;
                                }
                                ?>
                                <?php echo form_error('sampul'); ?>
                            </div>

                            <br /><br />

                            <input type="submit" name="status" value="Draft" class="btn btn-warning btn-block">
                            <input type="submit" name="status" value="Publish" class="btn btn-success btn-block">

                        </div>
                    </div>

                </div>
            </div>
        </form>
    </section>

</div>