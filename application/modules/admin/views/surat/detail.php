<h1 class="h3 mb-4 text-gray-900"><?= $surat['kategori_surat']; ?> </h1>

<div class="row">
	<div class="col-8">
		<div class="card">
			<div class="card-header py-3">
				Keterangan
			</div>
			<div class="card-body">

				<?= ($surat['id_status'] == 1) ? '<a href="' . base_url('admin/surat/proses_surat/' . $surat['id']) . '" class="btn btn-warning btn-sm">Klik untuk Memproses</a>' : '' ?>

				<!--<pre><?php print_r($surat); ?></pre>-->

				<input type="hidden" name="id_surat" value="<?= $surat['id']; ?>">
				<?php $ket_surat = explode(',', $surat['kat_keterangan_surat']);

				foreach ($ket_surat as $ket_surat => $value) {
					$type = kat_keterangan_surat($value)['type'];
					$kat_keterangan_surat = kat_keterangan_surat($value)['kat_keterangan_surat']; ?>

					<div class="form-group row">
						<label class="col-md-5" for="dokumen[<?= $value; ?>]"><?= kat_keterangan_surat($value)['kat_keterangan_surat']; ?></label>
						<div class="col-md-7">
							<?php generate_keterangan_surat($value, $surat['id']); ?>
						</div>
					</div>



				<?php } ?>

			</div>
		</div>
	</div>
	<!-- /.col -->
	<div class="col-4">
		<div class="card">
			<div class="card-header py-3">
				Mahasiswa yang Mengajukan
			</div>
			<div class="card-body  pb-0">
				<table class="table table-bordered">
					<tr>
						<td>Nama</td>
						<td>
							<p class="mb-0 text-gray-800"> <?= $surat['nama']; ?></p>
						</td>
					</tr>
					<tr>
						<td>NIM</td>
						<td>
							<p class="mb-0 text-gray-800"> <?= $surat['nim']; ?></p>
						</td>
					</tr>


				</table>
			</div>
		</div>
		<div class="card mt-3">		
			<div class="card-header py-3">
				Status Surat
			</div>
			<div class="card-body">				
				<p class="h4 text-center pb-2"> <?= $surat['status']; ?> </p>
				<ul class="list-group">
					<?php foreach($status as $key => $value) {

						echo "<li class='list-group-item'>" . $value['status'] . "<span class='badge badge-warning float-right'>". $value['date'] ."</span></li	>";

					}
			
				

					?>
				</ul>				
			</div>
		</div>	
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->