<!-- Brand Logo -->
<a href="<?= base_url() ?>admin/dashboard" class="brand-link navbar-light">
	<img src="<?= base_url() ?>public/dist/img/logo.png" alt="SIMPELMA PPS UMY" class="brand-image">
	<span class="brand-text font-weight-light">&nbsp;</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
	<!-- Sidebar Menu -->
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
			data-accordion="false">
			<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
			<li class="nav-item" id="beranda">
				<a href="<?= base_url() ?>residen/dashboard" class="nav-link">
					<i class="nav-icon fas fa-home"></i>
					<p>
						Beranda Residen
					</p>
				</a>
			</li>

			<li class="nav-header">ILMIAH</li>
			<li class="nav-item" id="tahap1">
				<a href="<?=base_url('residen/ilmiah/tahap/1'); ?>" class="nav-link">
					<i class="fas fa-book nav-icon"></i>
					<p>Tahap 1</p>
				</a>
			</li>
			<li class="nav-item has-treeview" id="ilmiah">
				<a href="#" class="nav-link">
					<i class="nav-icon fas fa-book"></i>
					<p>
						Tahap 2
						<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item index">
						<a href="<?=base_url('admin/ilmiah/'); ?>" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Divisi</p>
						</a>
					</li>
				</ul>

			</li>

			<li class="nav-item has-treeview" id="residen">
				<a href="#" class="nav-link">
					<i class="nav-icon fas fa-users"></i>
					<p>
						Residen
						<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item index">
						<a href="<?=base_url('admin/residen/'); ?>" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Semua Residen</p>
						</a>
					</li>
					<li class="nav-item residen-tahap">
						<a href="<?=base_url('admin/residen/tahap'); ?>" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Residen by Tahap</p>
						</a>
					</li>
					<li class="nav-item tahap-residen">
						<a href="<?=base_url('admin/residen/tahap_by_residen/1'); ?>" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Tahap spesifik Residen</p>
						</a>
					</li>
					<li class="nav-item residen-divisi">
						<a href="<?=base_url('admin/residen/divisi'); ?>" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Residen by Divisi</p>
						</a>
					</li>
					<li class="nav-item divisi-residen">
						<a href="<?=base_url('admin/residen/divisi_by_residen/1'); ?>" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Divisi spesifik Residen</p>
						</a>
					</li>
				</ul>
			</li>

			

		</ul>

	</nav>
	<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
