<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Jaminan Mutu
            <small>Tulis Jaminan Mutu Baru</small>
        </h1>
    </section>

    <section class="content">
        <a href="<?php echo base_url() . 'backend/jaminan_mutu'; ?>" class="btn btn-sm btn-primary">Kembali</a>
        <br />
        <br />
        <form method="post" action="<?php echo base_url('backend/jaminan_mutu/store') ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-9">

                    <div class="box box-primary">
                        <div class="box-body">

                            <div class="box-body">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul jaminan mutu.." value="<?php echo set_value('judul'); ?>">
                                    <br />
                                    <?php echo form_error('judul'); ?>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group">
                                    <label>Link Google Form</label>
                                    <input type="text" name="konten" class="form-control" placeholder="Masukkan link google form.." value="<?php echo set_value('konten'); ?>">
                                    <br />
                                    <?php echo form_error('judul'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                            </div>

                            <br /><br />

                            <div class="form-group">
                                <label>Gambar Sampul</label>

                                <input type="file" name="sampul">

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