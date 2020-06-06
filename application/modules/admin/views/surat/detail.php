<h1 class="h3 mb-4 text-gray-900"><?= $surat['kategori_surat']; ?> </h1>

<div class="row">
	<div class="col-8">
		<!-- fash message yang muncul ketika proses penghapusan data berhasil dilakukan -->
		<?php if ($this->session->flashdata('msg') != '') : ?>
			<div class="alert alert-success flash-msg alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>Sukses!</h4>
				<?= $this->session->flashdata('msg'); ?>
			</div>
		<?php endif; ?>

		<?php if (($surat['id_status'] == 3 || $surat['id_status'] == 7) && $this->session->userdata('role') == 6) { ?>

			<div class="card shadow mb-3">
				<a href="#collPengantar" class="d-block card-header pt-3 pb-2 bg-tosca" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collPengantar">
					<p class="h6 font-weight-bold text-white">Pengantar</p>
				</a>
				<div class="collapse show" id="collPengantar">
					<div class="card-body">
						<p class="font-italic">Assalamu'alaikum warahmatullahi wabarakatuh</p>
						<p> Kepada Yth. Kepala Program Studi <?= $surat['prodi']; ?>, mohon kesediaanya untuk memberikan persetujuan pada Surat <strong><?= $surat['kategori_surat']; ?></strong> yang diajukan oleh Saudara <strong><?= $surat['nama']; ?> (NIM : <?= $surat['nim']; ?>)</strong>. </p>

						<p> Adapun kelengkapan administratif yang dibutuhkan sudah diverifikasi kebenarannya oleh staf Tata Usaha <?= $surat['prodi']; ?>.</p>

						<p>Demikian pengatar dari kami, atas perhatiannya kami ucapkan terima kasih.</p>
						<p class="font-italic">Wassalamu'alaikum warahmatullahi wabarakatuh</p>
					</div>
				</div>
			</div>
		<?php } ?>

		<?php if (($surat['id_status'] == 8) && $this->session->userdata('role') == 5) { ?>

			<div class="card shadow mb-3">
				<a href="#collPengantar" class="d-block card-header pt-3 pb-2 bg-tosca" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collPengantar">
					<p class="h6 font-weight-bold text-white">Pengantar</p>
				</a>
				<div class="collapse show" id="collPengantar">
					<div class="card-body">
						<p class="font-italic">Assalamu'alaikum warahmatullahi wabarakatuh</p>
						<p> Kepada Yth. Direktur Program Pascasarjana UMY <?= $surat['prodi']; ?>, mohon kesediaanya untuk memberikan persetujuan pada Surat yang diajukan oleh: </p>

						<table class="mb-3 ml-3 table-striped" style="width:95%">
							<tr>
								<td style="width:150px;">Nama</td>
								<td> : <?= $surat['nama']; ?></td>
							</tr>
							<tr>
								<td>NIM</td>
								<td> : <?= $surat['nim']; ?></td>
							</tr>
							<tr>
								<td>Program Studi</td>
								<td> : <?= $surat['prodi']; ?></td>
							</tr>
							<tr>
								<td>Jenis Surat</td>
								<td> : <?= $surat['kategori_surat']; ?></td>
							</tr>
						</table>


						<p> Adapun kelengkapan administratif yang dibutuhkan sudah diverifikasi kebenarannya oleh staf Tata Usaha <?= $surat['prodi']; ?>.</p>

						<p>Demikian pengatar dari kami, atas perhatiannya kami ucapkan terima kasih.</p>
						<p class="font-italic">Wassalamu'alaikum warahmatullahi wabarakatuh</p>
					</div>
				</div>
			</div>
		<?php } ?>

		<div class="card shadow">
			<a href="#collKeterangan" class="d-block card-header pt-3 pb-2 bg-abumuda <?= ($surat['id_status'] == 9 && $this->session->userdata('role') == 1) ? "collapsed" : "" ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collKeterangan">
				<p class="h6 font-weight-bold text-white">Keterangan</p>
			</a>
			<div class="collapse<?= ($surat['id_status'] == 9 && $this->session->userdata('role') == 1) ? "" : " show" ?>" id="collKeterangan">
				<div class="card-body">
					<?php
					if ($surat['id_status'] == 8 && ($this->session->userdata('role') == 5 || $this->session->userdata('role') == 6)) {
						echo form_open('admin/surat/disetujui');
					}

					if (($surat['id_status'] == 2 || $surat['id_status'] == 5) && $this->session->userdata('role') == 2) {
						echo form_open('admin/surat/verifikasi');
					}


					?>
					<?= ($surat['id_status'] == 1) ? '<a href="' . base_url('admin/surat/proses_surat/' . $surat['id']) . '" class="btn btn-warning btn-sm">Klik untuk Memproses</a>' : '' ?>

					<input type="hidden" name="id_surat" value="<?= $surat['id']; ?>">
					<?php $ket_surat = explode(',', $surat['kat_keterangan_surat']);

					foreach ($ket_surat as $ket_surat => $value) {
						$type = kat_keterangan_surat($value)['type'];
						$kat_keterangan_surat = kat_keterangan_surat($value)['kat_keterangan_surat']; ?>

						<div class="form-row">
							<label class="col-md-5" for="dokumen[<?= $value; ?>]"><?= kat_keterangan_surat($value)['kat_keterangan_surat']; ?></label>
							<div class="col-md-7">
								<?php generate_keterangan_surat($value, $surat['id'], $surat['id_status']); ?>
							</div>
						</div>

					<?php } ?>

					<?php if ($surat['id_status'] == 2 && $this->session->userdata('role') == 2) { ?>
						<div class="form-row pt-3">
							<div class="col-md-12">
								<span class="pl-2 mb-2 d-inline-block"><input type="checkbox" name="" id="sudahPeriksa"> Data
									di atas sudah diperiksa secara seksama</span> <a class="help" data-toggle="tooltip" data-placement="top" title="Centang jika data sudah diperiksa"><i class="fa fa-info-circle"></i></a>
								<input type="submit" id="sub1" value="Kirim Hasil Verifikasi" name="submit" class="btn btn-<?= $surat['badge']; ?> btn-md btn-block" disabled>
							</div>
						</div>
					<?php }

					if ($surat['id_status'] == 5 && $this->session->userdata('role') == 2) { ?>
						<div class="form-row pt-3">
							<div class="col-md-12">
								<input type="hidden" name="rev2" value="1" />
								<!--tanda kalau sudah revisi 2x -->
								<span class="pl-2 mb-2 d-inline-block"><input type="checkbox" name="" id="sudahPeriksa"> Data di atas sudah diperiksa secara seksama</span> <a class="help" data-toggle="tooltip" data-placement="top" title="Centang jika data sudah diperiksa"><i class="fa fa-info-circle"></i></a>
								<input type="submit" id="sub1" value="Kirim Hasil Verifikasi (2)" name="submit" class="btn btn-<?= $surat['badge']; ?> btn-md btn-block" disabled>
							</div>
						</div>
					<?php }

					if ($surat['id_status'] == 4 && $this->session->userdata('role') == 2) { ?>
						<div class="form-row pt-3">
							<div class="col-md-12">
								<input type="submit" id="sub1" value="Menunggu perbaikan kelengkapan administrasi" name="submit" class="btn btn-perak btn-md btn-block" disabled>
							</div>
						</div>
					<?php }

					if ($surat['id_status'] == 7 && $this->session->userdata('role') == 6) { ?>
						<div class="form-row pt-3">
							<div class="col-md-12">
								<span class="pl-2 mb-2 d-inline-block"><input type="checkbox" name="" id="sudahPeriksa"> Saya telah membaca dengan seksama.</span> <a class="help" data-toggle="tooltip" data-placement="top" title="Centang dahulu sebelum menekan tombol"><i class="fa fa-info-circle"></i></a>
								<input type="hidden" name="prodi" value="<?= $surat['id_prodi']; ?>" />
								<input type="submit" id="sub1" value="Beri Persetujuan" name="submit" class="btn btn-<?= $surat['badge']; ?> btn-md btn-block" disabled>
							</div>
						</div>
					<?php }

					if ($surat['id_status'] == 8 && $this->session->userdata('role') == 5) { ?>
						<div class="form-row pt-3">
							<div class="col-md-12">
								<span class="pl-2 mb-2 d-inline-block"><input type="checkbox" name="" id="sudahPeriksa"> Saya telah membaca dengan seksama.</span> <a class="help" data-toggle="tooltip" data-placement="top" title="Centang dahulu sebelum menekan tombol"><i class="fa fa-info-circle"></i></a>

								<input type="submit" id="sub1" value="Beri Persetujuan" name="submit" class="btn btn-<?= $surat['badge']; ?> btn-md btn-block" disabled>
							</div>
						</div>
					<?php }

					form_close(); ?>
				</div>
			</div>
		</div>

		<?php if ($surat['id_status'] == 9 && $this->session->userdata('role') == 1) { ?>
			<div class="card shadow mt-3">
				<a href="#collterbit" class="d-block card-header pt-3 pb-2 bg-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collterbit">
					<p class="h6 font-weight-bold text-white">Terbitkan Surat</p>
				</a>
				<div class="collapse show" id="collterbit">
					<div class="card-body pb-3">
						<p>Lakukan pengaturan di bawah ini sebelum surat diterbitkan</p>
						<?php echo form_open('admin/surat/terbitkan_surat'); ?>

						<input type="submit" id="sub1" value="Terbitkan Sekarang" name="submit" class="btn btn-<?= $surat['badge']; ?> btn-md btn-block">
						<?php form_close(); ?>
					</div>
				</div>
			</div>
		<?php } ?>
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
		<div class="card shadow">
			<a href="#collMhs" class="d-block card-header pt-3 pb-2 bg-warning" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collMhs">
				<p class="h6 font-weight-bold text-white">Pemohon</p>
			</a>
			<div class="collapse show" id="collMhs">
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
		</div>
		<div class="card shadow mt-3">
			<a href="#collStatus" class="d-block card-header pt-3 pb-2 bg-<?= $surat['badge']; ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collStatus">
				<p class="h5 text-center font-weight-bold text-white"> <?= $surat['status']; ?> </p>
			</a>
			<div class="collapse show" id="collStatus">
				<div class="card-body pl-2">
					<ul class="timeline">
						<?php foreach ($timeline as $tl) { ?>
							<li>
								<span class="badge badge-<?= $tl['badge']; ?>"><?= $tl['status']; ?></span>
								<span class="badge badge-secondary"><?= $tl['date']; ?></span>
								<span class="badge badge-perak"><?= $tl['time']; ?></span>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->