<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
		<div class="sidebar-brand-icon">
			<img src="<?= base_url() ?>public/dist/img/logo.png" width="40px" height="" />
		</div>
		<div class="sidebar-brand-text mx-3">SIMPELMA</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item" id="menu_dashboard">
		<a class="nav-link" href="<?=base_url("admin/dashboard"); ?>">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Administrator
	</div>

	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item has_child" id="menu_surat">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sub_surat" aria-expanded="true"
			aria-controls="sub_surat">
			<i class="fas fa-fw fa-envelope"></i>
			<span>Surat</span>
		</a>
		<div id="sub_surat" class="collapse" aria-labelledby="heading_surat" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<!-- beri nama class yg sama dgn method/functionnya -->
				<a class="collapse-item index" href="<?=base_url("admin/surat"); ?>">Surat Masuk</a>
			</div>
		</div>
	</li>

	<li class="nav-item has_child" id="menu_mahasiswa">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sub_mahasiswa" aria-expanded="true"
			aria-controls="sub_mahasiswa">
			<i class="fas fa-fw fa-users"></i>
			<span>Mahasiswa</span>
		</a>
		<div id="sub_mahasiswa" class="collapse" aria-labelledby="heading_mahasiswa" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<!-- beri nama class yg sama dgn method/functionnya -->
				<a class="collapse-item index" href="<?=base_url("admin/mahasiswa"); ?>">Semua Mahasiswa</a>
				<a class="collapse-item add" href="<?=base_url("admin/mahasiswa/add"); ?>">Tambah Mahasiswa</a>
				<a class="collapse-item upload" href="<?=base_url("admin/mahasiswa/upload_mahasiswa"); ?>">Upload Mahasiswa</a>
			</div>
		</div>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
<!-- End of Sidebar -->
