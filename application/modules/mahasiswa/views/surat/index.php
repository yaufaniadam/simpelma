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
		<?php
			if ($query) {  ?>
		<table id="datatablse" class="table table-bordered">
			<tbody>
				<?php // print_r($query);
				foreach ($query as $surat) {  ?>
					<tr>
						<td><a href="<?=base_url('mahasiswa/surat/detail/'.$surat['id']); ?>"><?=$surat['kategori_surat']; ?></a> <?=($surat['id_status'] == 1) ? '<span class="badge badge-danger">Baru</span>' : ''; ?></td>
						
						<td><?=$surat['date']; ?> </td>
					</tr>
				<?php } ?>
			</tbody>
			</tfoot>
		</table>
		<?php } else { ?>

			<p class="lead">Belum ada Surat</p>
			
		<?php } ?>			
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