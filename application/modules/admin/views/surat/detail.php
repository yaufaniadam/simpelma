<h1 class="h3 mb-4 text-gray-900"><?= $surat['kategori_surat']; ?> </h1>

<div class="row">
	<div class="col-8">
		<div class="card">
			<div class="card-header py-3">
				Keterangan
			</div>
			<div class="card-body">
				<?php echo form_open('admin/surat/verifikasi') ?>
				<?= ($surat['id_status'] == 1) ? '<a href="' . base_url('admin/surat/proses_surat/' . $surat['id']) . '" class="btn btn-warning btn-sm">Klik untuk Memproses</a>' : '' ?>

				<input type="hidden" name="id_surat" value="<?= $surat['id']; ?>">
				<?php $ket_surat = explode(',', $surat['kat_keterangan_surat']);

				foreach ($ket_surat as $ket_surat => $value) {
					$type = kat_keterangan_surat($value)['type'];
					$kat_keterangan_surat = kat_keterangan_surat($value)['kat_keterangan_surat']; ?>

					<div class="form-row">
						<label class="col-md-5" for="dokumen[<?= $value; ?>]"><?= kat_keterangan_surat($value)['kat_keterangan_surat']; ?></label>
						<div class="col-md-7">
							<?php generate_keterangan_surat($value, $surat['id']); ?>
						</div>
					</div>

				<?php } ?>

				<?php if ($surat['id_status'] == 2) { ?>
					<div class="form-row pt-3">
						<div class="col-md-12">
							<span class="pl-2 mb-2 d-inline-block"><input type="checkbox" name="" id="sudahPeriksa"> Data
								di atas sudah diperiksa secara seksama</span> <a class="help" data-toggle="tooltip" data-placement="top" title="Centang jika data sudah diperiksa"><i class="fa fa-info-circle"></i></a>
							<input type="submit" id="sub1" value="Kirim Hasil Verifikasi" name="submit" class="btn btn-<?= $surat['badge']; ?> btn-md btn-block" disabled>
						</div>
					</div>
				<?php } elseif ($surat['id_status'] == 5) { ?>
					<div class="form-row pt-3">
						<div class="col-md-12">
							<input type="hidden" name="rev2" value="1" />
							<!--tanda kalau sudah revisi 2x -->
							<span class="pl-2 mb-2 d-inline-block"><input type="checkbox" name="" id="sudahPeriksa"> Data di atas sudah diperiksa secara seksama</span> <a class="help" data-toggle="tooltip" data-placement="top" title="Centang jika data sudah diperiksa"><i class="fa fa-info-circle"></i></a>
							<input type="submit" id="sub1" value="Kirim Hasil Verifikasi (2)" name="submit" class="btn btn-<?= $surat['badge']; ?> btn-md btn-block" disabled>
						</div>
					</div>
				<?php } elseif ($surat['id_status'] == 4) { ?>
					<div class="form-row pt-3">
						<div class="col-md-12">
							<input type="submit" id="sub1" value="Menunggu perbaikan kelengkapan administrasi" name="submit" class="btn btn-perak btn-md btn-block" disabled>
						</div>
					</div>
				<?php }

				form_close(); ?>
			</div>
		</div>
	</div>

	<script>
		$(function() {
			$('#sudahPeriksa').click(function(e) {
				if ($(this).is(':checked')) {
					$('#sub1').removeAttr('disabled');
				} else {
					$('#sub1').attr('disabled', 'disabled');
				}
			});
		});
	</script>

	<!-- /.col -->
	<div class="col-4">
		<div class="card">
			<div class="card-header py-3 bg-success">
				<span class="text-light">Mahasiswa yang Mengajukan</span>
			</div>
			<div class="card-body pb-3">
				<div class="media">
					<?php if ($surat['photo'] == '') { ?>

						<img class="profile-user-img img-circle mr-3" width="60" src="<?= base_url(); ?>public/dist/img/nophoto.png" alt="User profile picture">

					<?php } else { ?>

						<img class="profile-user-img img-circle mr-3" width="60" src="<?= base_url($user['photo']); ?>">

					<?php } ?>

					<div class="media-body">
						<h5 class="mt-0 text-gray-900 mb-0 font-weight-bold"><?= $surat['nama']; ?></h5>
						<span class="mb-0 badge badge-ijomuda"> <?= $surat['nim']; ?></span>
						<p class="mb-0 text-gray-800"> <?= $surat['prodi']; ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="card mt-3">
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
<!-- /.row -->