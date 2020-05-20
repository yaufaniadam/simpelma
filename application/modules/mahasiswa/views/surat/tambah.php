<div class="row">
	<div class="col-12">
		<h2><?= $surat['kategori_surat']; ?></h2>

		<?php if(isset($msg) || validation_errors() !== ''): ?>
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="fa fa-exclamation"></i> Terjadi Kesalahan</h4>
			<?= validation_errors();?>
			<?= isset($msg)? $msg: ''; ?>
		</div>
		<?php endif; ?>
		
		<p>Lengkapi dokumen persyaratan berikut ini:</p>

		<?php echo form_open(base_url('mahasiswa/surat/tambah/'. $surat['id']), '') ?>

		<input type="hidden" name="id_surat" value="<?= $surat['id']; ?>">
		<?php $ket_surat = explode(',', $surat['kat_keterangan_surat']);

		foreach ($ket_surat as $ket_surat => $value) {
			$type = kat_keterangan_surat($value)['type'];
			$kat_keterangan_surat = kat_keterangan_surat($value)['kat_keterangan_surat']; ?>

			<div class="form-group row">
				<label class="col-md-3" for="dokumen[<?= $value; ?>]"><?= kat_keterangan_surat($value)['kat_keterangan_surat']; ?></label>
				<div class="col-md-6">
					<?php generate_form_field($value, $surat['id']); ?>
				</div>
			</div>



		<?php } ?>


		<input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Ajukan Surat <?= $surat['kategori_surat']; ?>" />
		<?php echo form_close(); ?>
	</div>
</div>

<?php fileUploaderModal(); ?>