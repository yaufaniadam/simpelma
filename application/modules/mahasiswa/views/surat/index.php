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
				<?php 
				echo "<pre>";
				print_r($query);
				echo "</pre>";
				
				/*
				foreach ($query as $surat) { 
					 ?>
					<tr>
						<td><a href="<?=base_url('mahasiswa/surat/detail/'.$surat['id']); ?>"><?=$surat['kategori_surat']; ?></a> <?=($surat['id_status'] == 2) ? '<span class="badge badge-danger">Baru</span>' : ''; ?></td>
						
						<td><?php if( $surat['id_status'] == 1) { ?> 
							<?= $surat['status']; ?> <a class="btn btn-warning btn-sm" href="<?= base_url('mahasiswa/surat/tambah/'.$surat['id']); ?>">Lengkapi</a>

							<a href="" style="color:#fff;" title="Hapus"
									class="delete btn btn-sm  btn-circle btn-danger"
									data-href="<?= base_url('mahasiswa/surat/hapus/' . $surat['id']); ?>"
									data-toggle="modal" data-target="#confirm-delete"> <i
										class="fa fa-trash-alt"></i></a>
						<?php } else {
							echo $surat['status'];
						} ?>
						
						</td>
					</tr>
					<?php }  */ ?>
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