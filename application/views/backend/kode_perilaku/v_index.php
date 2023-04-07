<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Kode Perilaku dan Sanksi
            <small>Manajemen Halaman Kode Perilaku dan Sanksi</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-lg-12">

                <!-- <a href="<?php echo base_url() . 'backend/kode_perilaku/tambah'; ?>" class="btn btn-sm btn-primary">Tambah Kode Perilaku dan Sanksi</a> -->
                <br><br>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Kode Perilaku dan Sanksi</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="1%">NO</th>
                                    <th>JUDUL</th>
                                    <th>STATUS</th>
                                    <th width="15%">OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data_kode_perilaku as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $value->kode_perilaku_judul; ?></td>
                                        <td><?= $value->kode_perilaku_status; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() . 'backend/kode_perilaku/edit/' . $value->kode_perilaku_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
                                            <!-- <a href="<?php echo base_url() . 'backend/kode_perilaku/hapus/' . $value->kode_perilaku_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a> -->
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