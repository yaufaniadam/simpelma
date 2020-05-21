<?php
/*
	echo "<pre>";				
		print_r($query);
	echo "</pre>"; 
*/
?>
<div class="row">
	<div class="col-12">

		<div class="card card-success card-outline">
			<div class="card-header">Surat Masuk
			</div>
			<div class="card-body">
				<?php
				if ($query) {  ?>
					<table id="surat" class="table table-bordered tb-surat">
						<thead>
							<tr>
								<th>Perihal</th>
								<th>Mahasiswa</th>
								<th>Tanggal</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($query as $surat) {  ?>
								<tr class="<?= ($surat['id_status'] == 2) ? 'proses' : ''; ?> <?= ($surat['id_status'] == 4) ? 'perlu-revisi' : ''; ?>">
									<td><a class="judul" href="<?= base_url('admin/surat/detail/' . $surat['id_surat']); ?>"><?= $surat['kategori_surat']; ?></a> <?php echo badge_status($surat['id_status']); ?>
									<br />
									<?= ($surat['id_status']== 4) ? "<span class='badge badge-danger'><i class='fas fa-exclamation-triangle'></i> Persyaratan perlu diperbaiki</span>" : ""; ?>
								</td>
									<td>
										<p class="m-0"><?= $surat['nama']; ?></p>
										<p class="badge m-0 badge-ijomuda"><?= $surat['prodi']; ?></p>
									</td>
									<td>
										<p class="m-0"><?= $surat['date_full'];	?></p>
										<p class="badge m-0 badge-warning"><?= $surat['time']; ?></p>
									</td>
									</td>
								</tr>
							<?php } ?>
						</tbody>
						</tfoot>
					</table>
				<?php } else { ?>

					<p class="lead">Belum ada Surat</p>

				<?php }
				?>
			</div><!-- /.card-body -->
		</div><!-- /.card -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->


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
				<p>Yakin ingin menghapus data ini?&hellip;</p>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<a class="btn btn-danger btn-ok">Hapus</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- DataTables -->
<script src="<?= base_url() ?>/public/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/public/vendor/datatables/dataTables.bootstrap4.min.js"></script>


<script>
	$('#surat').dataTable({
		"ordering": false
	});
</script>