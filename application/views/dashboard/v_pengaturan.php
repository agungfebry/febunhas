<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pengaturan
			<small>Update Pengaturan Website</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Pengaturan</h3>
					</div>
					<div class="box-body">

						<?php
						if (isset($_GET['alert'])) {
							if ($_GET['alert'] == "sukses") {
								echo "<div class='alert alert-success'>Pengaturan telah diupdate!</div>";
							}
						}
						?>

						<?php foreach ($pengaturan as $p) { ?>

							<form method="post" action="<?php echo base_url('dashboard/pengaturan_update') ?>" enctype="multipart/form-data">
								<div class="box-body">
									<div class="form-group">
										<label>Nama Website</label>
										<input type="text" name="nama" class="form-control" placeholder="Masukkan nama website.." value="<?php echo $p->nama; ?>">
										<?php echo form_error('nama'); ?>
									</div>

									<div class="form-group">
										<label>Deskripsi Website</label>
										<input type="text" name="deskripsi" class="form-control" placeholder="Masukkan deskripsi .." value="<?php echo $p->deskripsi; ?>">
										<?php echo form_error('deskripsi'); ?>
									</div>

									<hr>

									<div class="form-group">
										<label>Banner Website</label>
										<input type="file" name="banner">
										<small>Kosongkan jika tidak ingin mengubah banner</small>
									</div>

									<div class="form-group">
										<label>Logo Website</label>
										<input type="file" name="logo">
										<small>Kosongkan jika tidak ingin mengubah logo</small>
									</div>

									<hr>
									<div class="form-group">
										<label>Alamat Lengkap</label>
										<input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat lengkap .." value="<?php echo $p->alamat; ?>">
										<?php echo form_error('alamat'); ?>
									</div>
									<div class="form-group">
										<label>Maps</label>
										<input type="text" name="maps" class="form-control" placeholder="Masukkan link google maps .." value="<?= $p->maps; ?>">
										<?php echo form_error('maps'); ?>
									</div>
									<div class="form-group">
										<label>Phone</label>
										<input type="text" name="phone" class="form-control" placeholder="Masukkan nomor telepon .." value="<?php echo $p->phone; ?>">
										<?php echo form_error('phone'); ?>
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="text" name="email" class="form-control" placeholder="Masukkan email .." value="<?php echo $p->email; ?>">
										<?php echo form_error('email'); ?>
									</div>
									<hr>

									<div class="form-group">
										<label>Link Facebook</label>
										<input type="text" name="link_facebook" class="form-control" placeholder="Masukkan link facebook .." value="<?php echo $p->link_facebook; ?>">
										<?php echo form_error('link_facebook'); ?>
									</div>

									<div class="form-group">
										<label>Link Twitter</label>
										<input type="text" name="link_twitter" class="form-control" placeholder="Masukkan link_twitter .." value="<?php echo $p->link_twitter; ?>">
										<?php echo form_error('link_twitter'); ?>
									</div>

									<div class="form-group">
										<label>Link Instagram</label>
										<input type="text" name="link_instagram" class="form-control" placeholder="Masukkan link_instagram .." value="<?php echo $p->link_instagram; ?>">
										<?php echo form_error('link_instagram'); ?>
									</div>

								</div>

								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Simpan">
								</div>
							</form>

						<?php } ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>