<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Akademik
            <small>Manajemen Akademik</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-lg-12 mb-5">
                <a href="<?php echo base_url() . 'backend/akademik/tambah'; ?>" class="btn btn-sm btn-primary">Tambah Akademik</a>
                <br><br>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Akademik</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="1%">NO</th>
                                    <th>JUDUL AKADEMIK</th>
                                    <th>STATUS</th>
                                    <th width="15%">OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data_akademik as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $value->akademik_judul; ?></td>
                                        <td><?= $value->akademik_status; ?></td>
                                        <td>
                                            <?php if($value->akademik_id!=3): ?>
                                            <a href="<?php echo base_url() . 'backend/akademik/edit/' . $value->akademik_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
                                            <a href="<?php echo base_url() . 'backend/akademik/hapus/' . $value->akademik_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <a href="<?php echo base_url() . 'backend/akademik/tambah_sub'; ?>" class="btn btn-sm btn-primary">Tambah Sub Akademik</a>
                <br><br>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Penyelenggaraan kegiatan akademik</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="1%">NO</th>
                                    <th>JUDUL SUB AKADEMIK</th>
                                    <th>STATUS</th>
                                    <th width="15%">OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data_akademik_sub as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $value->akademik_sub_judul; ?></td>
                                        <td><?= $value->akademik_sub_status; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() . 'backend/akademik/edit_sub/' . $value->akademik_sub_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
                                            <a href="<?php echo base_url() . 'backend/akademik/hapus_sub/' . $value->akademik_sub_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>