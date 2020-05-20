<div class="row">
	<div class="col-md-12">

		<?php if(isset($msg) || validation_errors() !== ''): ?>
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="fa fa-exclamation"></i> Terjadi Kesalahan</h4>
			<?= validation_errors();?>
			<?= isset($msg)? $msg: ''; ?>
		</div>
		<?php endif; ?>

	</div>

	<!-- <div class="col-md-2">
            <div class="card card-success card-outline">
              <div class="card-body box-profile">
                 <?php if($user['photo'] == '' ) { ?>
                     
                      <img class="profile-user-img img-fluid img-circle"
                            src="<?=base_url(); ?>public/dist/img/avatar5.png"
                            alt="User profile picture">

                    <?php } else { ?>

                      <img class="profile-user-img img-fluid img-circle"
                            src="<?=base_url($user['photo'] ); ?>">

                    <?php } ?>

              </div>
            </div>
          </div>-->

	<div class="col-md-5">
		<div class="card card-success card-outline">
			<div class="card-body box-profile">

				<?php echo form_open_multipart(base_url('admin/pengguna/edit/'.$user['id']), 'class="form-horizontal"');  ?>

				<div class="form-group">
					<label for="username" class="control-label">Username</label>
					<div class="">
						<input type="text" value="<?=$user['username']; ?>"  class="form-control" disabled id="username"
							placeholder="">

					</div>
				</div>
				<?php /*
				<div class="form-group">
					<label for="nim" class="control-label">NIM</label>
					<div class="">
						<input type="text" value="<?=$user['nim']; ?>" name="nim" class="form-control" id="NIM"
							placeholder="">

					</div>
				</div>
				<div class="form-group">
					<label for="nama" class="control-label">Nama Lengkap</label>
					<div class="">
						<input type="text" value="<?=$user['nama']; ?>" name="nama" class="form-control" id="nama"
							placeholder="">

					</div>
				</div> */ ?>
				
				<div class="form-group">
					<label for="email" class="control-label">Email</label>
					<div>
						<input type="email" value="<?=$user['email']; ?>" name="email" class="form-control" id="email"
							placeholder="">
					</div>
				</div>

				<div class="form-group">
					<label for="password" class="control-label">Password</label>
					<div>
						<input type="password" name="password" class="form-control" id="password" placeholder="">
						<input type="hidden" name="password_hidden" value="<?=$user['password']; ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="nama" class="control-label">Prodi</label>
					<div class="">
						

					</div>
				</div>

				<div class="form-group">
					<div>
						<input type="submit" name="submit" value="Edit Mahasiswa" class="btn btn-perak">
					</div>
				</div>

				<?php echo form_close( ); ?>

			</div>
		</div>
	</div>


</div>
