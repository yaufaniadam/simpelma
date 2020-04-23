
<h1 class="h3 mb-0 text-gray-800"><?= $surat['kategori_surat']; ?></h1>
<div class="row">
	<div class="col-12">	

	<p><i class="far fa-calendar"></i> <?= $surat['date']; ?> <?=($surat['id_status'] == 1) ? '<span class="badge badge-danger">Baru</span>' : ''; ?></p>
		
	
	<pre><?php print_r($surat); ?></pre>	
		
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
