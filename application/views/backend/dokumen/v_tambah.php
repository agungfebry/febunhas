<div class="content-wrapper">
    <section class="content-header">
        <h1>
            DOKUMEN
            <small>Tulis Dokumen Baru</small>
        </h1>
    </section>

    <section class="content">
        <a href="<?php echo base_url() . 'backend/dokumen'; ?>" class="btn btn-sm btn-primary">Kembali</a>
        <br />
        <br />
        <form method="post" action="<?php echo base_url('backend/dokumen/store') ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-9">

                    <div class="box box-primary">
                        <div class="box-body">

                            <div class="box-body">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul dokumen.." value="<?php echo set_value('judul'); ?>">
                                    <br />
                                    <?php echo form_error('judul'); ?>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group">
                                    <label>File Dokumen</label>
                                    <input type="file" name="konten" class="form-control">
                                    <br />
                                    <?php echo form_error('konten'); ?>
                                    <?php
                                    if (isset($dokumen_error)) {
                                        echo $dokumen_error;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="box box-primary">
                        <div class="box-body">
                            <input type="submit" name="status" value="Draft" class="btn btn-warning btn-block">
                            <input type="submit" name="status" value="Publish" class="btn btn-success btn-block">
                        </div>
                    </div>

                </div>
            </div>
        </form>

    </section>

</div>