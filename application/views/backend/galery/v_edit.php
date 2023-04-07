<div class="content-wrapper">
    <section class="content-header">
        <h1>
            GALERY
            <small>Edit Galery Baru</small>
        </h1>
    </section>

    <section class="content">

        <a href="<?php echo base_url() . 'backend/galery'; ?>" class="btn btn-sm btn-primary">Kembali</a>

        <br />
        <br />

        <form method="post" action="<?php echo base_url('backend/galery/update/') ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-9">

                    <div class="box box-primary">
                        <div class="box-body">

                            <div class="box-body">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="hidden" name="id" value="<?php echo $galery->galery_id; ?>">
                                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul galery.." value="<?php echo $galery->galery_judul; ?>">
                                    <br />
                                    <?php echo form_error('judul'); ?>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group">
                                    <label>Konten</label>
                                    <?php echo form_error('konten'); ?>
                                    <br />
                                    <textarea class="form-control" id="editor" name="konten"> <?php echo $galery->galery_content; ?> </textarea>
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
                                <label>Gambar</label>

                                <input type="file" name="files[]" multiple accept="image/*">

                                <?php foreach ($galery_detail as $gd) : ?>
                                    <span class="text-danger"><?php echo $gd->galery_detail_file; ?></span> <br>
                                <?php endforeach ?>

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