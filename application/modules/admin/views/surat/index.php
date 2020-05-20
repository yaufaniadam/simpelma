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
			<div class="card-header">Inbox
			</div>
			<div class="card-body">
				<?php
				if ($query) {  ?>
					<table id="surat" class="table table-bordered tb-surat">
						<thead>
							<tr>
								<th>Perihal</th>
								<th>Mahasiswa</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($query as $surat) {  ?>
								<tr class="<?= ($surat['id_status'] == 3) ? 'proses' : ''; ?>">
									<td><a class="judul" href="<?= base_url('admin/surat/detail/' . $surat['id_surat']); ?>"><?= $surat['kategori_surat']; ?></a> <?= ($surat['id_status'] == 2) ? '<span class="float-right badge-sm badge badge-danger">Baru</span>' : ''; ?></td>
									<td><?= $surat['nama']; ?></td>
									<td>
										<?php
										echo $surat['date_full'];
										?>
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