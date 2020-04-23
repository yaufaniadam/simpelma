<div class="row">
	<div class="col-md-12">
		<?php foreach ($kategori_surat as $kategori) : ?>
		    <a class="btn btn-block btn-md btn-ijomuda" href="<?= base_url('mahasiswa/surat/buat_surat/'.$kategori['id']); ?>"><?= $kategori['kategori_surat']; ?></a>
		<?php endforeach; ?>
	</div>
</div>
