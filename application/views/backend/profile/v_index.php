<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Profile
            <small>Manajemen Halaman Profile</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-lg-12">

                <a href="<?php echo base_url() . 'backend/profile/tambah'; ?>" class="btn btn-sm btn-primary">Tambah Profile</a>
                <br><br>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Profile</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="1%">NO</th>
                                    <th>JUDUL PROFILE</th>
                                    <th>STATUS</th>
                                    <th width="15%">OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data_profile as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $value->profile_judul; ?></td>
                                        <td><?= $value->profile_status; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() . 'backend/profile/edit/' . $value->profile_id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> </a>
                                            <a href="<?php echo base_url() . 'backend/profile/hapus/' . $value->profile_id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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