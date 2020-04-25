<div class="row">
	<div class="col-md-12">
		<p><i class="fa fa-exclamation-triangle"></i> Sebelum mengajukan surat, pastikan semua persyaratan yang
			dibutuhkan sudah dilengkapi.</p>
		<?php if (isset($msg) || validation_errors() !== '') : ?>
		<div class="alert alert-warning alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fas fa-exclamation-triangle"></i> Alert!</h4>
			<?= validation_errors(); ?>
			<?= isset($msg) ? $msg : ''; ?>
		</div>
		<?php endif; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
	
		<?php echo form_open_multipart(base_url('mahasiswa/surat/upload_image'), '') ?>
		<div class="card card-secondary">

			<div class="card-body">
				<div class="form-group">
					<input type="file" name="filefoto" class="dropify" data-height="200">
				</div>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>

	<div class="col-md-12 py-4">
		<a href="" title="Hapus" class="delete btn btn-ijomuda"
			data-href="<?= base_url('mahasiswa/surat/hapus/' . $surat['id']); ?>" data-toggle="modal"
			data-target="#confirm-delete"> Batal</a> &nbsp;
		<input type="submit" name="submit" value="Ajukan Surat" class="btn btn-success">
	</div>
	<?php echo form_close(); ?>

	<?php 
        echo "<pre>";
        print_r($surat); 
        echo "</pre>";
	?>
		
</div>

<div class="modal fade" id="confirm-delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Perhatian</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Tutuo">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Yakin ingin menghapus surat ini?&hellip;</p>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
				<a class="btn btn-danger btn-ok">Hapus</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
