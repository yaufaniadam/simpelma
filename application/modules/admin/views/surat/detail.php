
<h1 class="h3 mb-2 text-gray-800"><?= $surat['kategori_surat']; ?> </h1>
<p class="mb-2 text-gray-800"><i class="fas fa-user"></i> <?= $surat['nama']; ?> (<?= $surat['nim']; ?>)</p>
<div class="row">
	<div class="col-12">
	
	<?=($surat['id_status'] == 1) ? '<a href="'.base_url('admin/surat/proses_surat/'.$surat['id']) .'" class="btn btn-warning btn-sm">Klik untuk Memproses</a>' : '' ?>
	
	<pre><?php print_r($surat); ?></pre>	
		
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
