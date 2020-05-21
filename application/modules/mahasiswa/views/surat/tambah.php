<h1 class="h3 mb-4 text-gray-900"><?= $surat['kategori_surat']; ?> </h1>

<div class="row">
	<div class="col-8">
		<div class="card">
			<div class="card-header py-3">
				Keterangan
			</div>
			<div class="card-body">
				

				<?php if (isset($msg) || validation_errors() !== '') : ?>
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="fa fa-exclamation"></i> Terjadi Kesalahan</h4>
						<?= validation_errors(); ?>
						<?= isset($msg) ? $msg : ''; ?>
					</div>
				<?php endif; ?>
				<?php if ( $surat['id_status'] == '7') { ?>
					<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="fas fa-check-square"></i> Permohonan diterima. Surat dapat diunduh melalui tautan  di bawah.</strong></p>
			
				<?php } elseif( $surat['id_status'] == '6') { ?>
					<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="fas fa-ban"></i> Permohonan ditolak. Silakan mengajukan surat baru.</strong></p>
			
				<?php } elseif ( $surat['id_status'] == '5') { ?>
					<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="fas fa-exclamation-triangle"></i> Menunggu verifikasi hasil revisi oleh Tata Usaha.</strong></p>
			
				<?php } elseif ( $surat['id_status'] == '4') { ?>
					<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="fas fa-exclamation-triangle"></i> Perbaiki data yang belum sesuai <strong>yang diberi tanda merah.</strong></p>
				<?php } elseif ( $surat['id_status'] == '3') { ?>
					<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="fas fa-exclamation-triangle"></i> Menunggu Persetujuan Kepala Prodi</p>
				<?php } elseif ( $surat['id_status'] == '2') { ?>
					<p class="alert alert-<?= $surat['badge']; ?> mb-4"><i class="fas fa-exclamation-triangle"></i> Menunggu Verifikasi Staf Tata Usaha</p>	
				<?php } else { ?>
					<p class="alert alert-warning mb-4"><i class="fas fa-exclamation-triangle"></i> Lengkapi formulir di bawah ini.</p>
				<?php } ?>

				<?php echo form_open(base_url('mahasiswa/surat/tambah/' . $surat['id']), '') ?>

				<input type="hidden" name="id_surat" value="<?= $surat['id']; ?>">
				<?php $ket_surat = explode(',', $surat['kat_keterangan_surat']);

				foreach ($ket_surat as $ket_surat => $value) {
					$type = kat_keterangan_surat($value)['type'];
					$kat_keterangan_surat = kat_keterangan_surat($value)['kat_keterangan_surat']; ?>

					<div class="form-group row">
						<label class="col-md-5" for="dokumen[<?= $value; ?>]"><?= kat_keterangan_surat($value)['kat_keterangan_surat']; ?></label>
						<div class="col-md-7">
							<?php generate_form_field($value, $surat['id'], $surat['id_status']); ?>
						</div>
					</div>

				<?php } ?>

				<?php if($surat['id_status'] == 4) { ?>
					<input type="hidden" name="revisi" value="1">
					<input class="btn btn-lg btn-<?= $surat['badge']; ?> btn-block" type="submit" name="submit" value="<?= ($surat['id_status'] == '4') ? "Kirim Revisi Data" : "Ajukan Surat " . $surat['kategori_surat']; ?>" />

				<?php } elseif ($surat['id_status'] == 1) { ?>
					<input class="btn btn-lg btn-<?= $surat['badge']; ?> btn-block" type="submit" name="submit" value="Ajukan Surat <?= $surat['kategori_surat']; ?>" />
				<?php } ?>
				
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
	<div class="col-4">
		
		<div class="card">
			<div class="card-header py-3">
				Status Surat
			</div>
			<div class="card-body">
				<p class="h5 text-center pb-2 text-<?= $surat['badge']; ?>"> <?= $surat['status']; ?> </p>
				<ul class="list-group">

					<li class='list-group-item'>Tanggal masuk
						<span class='badge badge-warning float-right'><?= tgl_status_surat($surat['id'], '2')['date']; ?></span>
					</li>
					<li class='list-group-item'>Tanggal terbit</span>
						<span class='badge badge-success float-right'><?= tgl_status_surat($surat['id'], '5')['date']; ?></span>
					</li>


				</ul>
			</div>
		</div>
	</div>
	<!-- /.col -->
</div>

<?php fileUploaderModal(); ?>