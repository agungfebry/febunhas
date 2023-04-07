<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Galery
            <small>Manajemen Galery</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-lg-12">

                <a href="<?php echo base_url() . 'backend/galery/tambah'; ?>" class="btn btn-sm btn-primary">Tambah Galery</a>
                <br><br>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Galery</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="1%">NO</th>
                                    <th>JUDUL GALERY</th>
                                    <th>STATUS</th>
                                    <th width="15%">OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data_galery as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $value->galery_judul; ?></td>
                                        <td><?= $value->galery_status; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() . 'backend/galery/edit/' . $value->galery_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
                                            <a href="<?php echo base_url() . 'backend/galery/hapus/' . $value->galery_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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