<div class="row">
	<div class="col-12">
		<!-- fash message yang muncul ketika proses penghapusan data berhasil dilakukan -->
		<?php if ($this->session->flashdata('msg') != '') : ?>
		<div class="alert alert-success flash-msg alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4>Success!</h4>
			<?= $this->session->flashdata('msg'); ?>
		</div>
		<?php endif; ?>


		<div class="card shadow">
			<div class="card-header py-3">
              Filter
            </div>

			<div class="card-body">

				<table id="tb_penelitian" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th style="width:80%">Kategori Surat</th>
							<th style="width:80%">Yang Mengajukan</th>
							<th style="width:80%">Status</th>
							<th style="width:80%">Tanggal</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($query as $surat) {  ?>
						<tr>
							<td><?= $surat['kategori_surat']; ?></td>

							<td class="text-center">
								<a class="btn btn-default btn-sm">
									<i class="fa fa-search" style="color:;"></i>
								</a>
								<a class="btn btn-default btn-sm">
									<i class="fas fa-pencil-alt" style="color:;"></i>
								</a>
								<a href="" style="color:#fff;" title="Hapus" class="delete btn btn-sm btn-danger"
									data-toggle="modal" data-target="#confirm-delete"> <i
										class="fa fa-trash-alt"></i></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
					</tfoot>
				</table>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
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
