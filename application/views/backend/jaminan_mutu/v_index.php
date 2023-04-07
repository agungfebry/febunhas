<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Jaminan Mutu
            <small>Manajemen Halaman Jaminan Mutu</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-lg-12">

                <a href="<?php echo base_url() . 'backend/jaminan_mutu/tambah'; ?>" class="btn btn-sm btn-primary">Tambah Jaminan Mutu</a>
                <br><br>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Jaminan Mutu</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="1%">NO</th>
                                    <th>JUDUL JAMINAN MUTU</th>
                                    <th>STATUS</th>
                                    <th width="15%">OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data_jaminan_mutu as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $value->jaminan_mutu_judul; ?></td>
                                        <td><?= $value->jaminan_mutu_status; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() . 'backend/jaminan_mutu/edit/' . $value->jaminan_mutu_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
                                            <a href="<?php echo base_url() . 'backend/jaminan_mutu/hapus/' . $value->jaminan_mutu_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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