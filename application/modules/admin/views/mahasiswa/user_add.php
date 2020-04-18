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

	<div class="col-md-6">
		<div class="card card-success card-outline">
			<div class="card-body box-profile">

				<?php echo form_open_multipart(base_url('admin/mahasiswa/add'), '' )?>
				<div class="form-group">
					<label for="username" class="control-label">Username</label>
					<div class="">
						<input type="text" name="username" class="form-control" id="username" placeholder="">
					</div>
				</div>

				<div class="form-group">
					<label for="email" class="control-label">Email</label>
					<div>
						<input type="email" name="email" class="form-control" id="email" placeholder="">
					</div>
				</div>

				<div class="form-group">
					<label for="password" class="control-label">Password</label>
					<div>
						<input type="password" name="password" class="form-control" id="password" placeholder="">
					</div>
				</div>

				<div class="form-group">
					<label for="role" class="control-label">Role</label>
					<div>
						<select name="role" class="form-control">
							<option value="">Pilih Role</option>
							<option value="4">Admin Divisi</option>
							<option value="2">Dosen Pembimbing</option>
							<option value="3">Residen</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<div>
						<input type="submit" name="submit" value="Tambah Mahasiswa" class="btn btn-md btn-perak">
			
					</div>
				</div>
				<?php echo form_close( ); ?>

			</div>
		</div>
	</div>

</div>