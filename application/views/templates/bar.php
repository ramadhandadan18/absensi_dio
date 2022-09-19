<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>PT DIO</title>

	<link href="<?php echo base_url() ?>assets/images/favicon-16x16.png" rel="shortcut icon">

	<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

	<link href="<?php echo base_url() ?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

	<link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">

	<link href="<?php echo base_url() ?>assets/css/select2/select2.min.css" rel="stylesheet" />

	<link href="<?php echo base_url() ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">

</head>

<body>

	<div id="wrapper">

		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header">
						<div class="dropdown profile-element">
							<img alt="image" style="width: 100px;" src="<?php echo base_url() ?>assets/images/dio.png" />
							<span class="block m-t-xs font-bold">as <?= $this->session->userdata('username') ?></span>
						</div>
						<div class="logo-element">
							PT DIO
						</div>
					<li>
						<?php if ($_SESSION['role'] == 1) { ?>
							<a href="#"><i class="fa fa-database"></i> <span class="nav-label">Master Data </span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="<?php echo base_url() ?>Pegawai/"><i class="fa fa-address-card-o"></i> <span class="nav-label">Data Pegawai</span></a>
								</li>
								<li>
									<a href="<?php echo base_url() ?>Divisi/"><i class="fa fa-users"></i> <span class="nav-label">Master Divisi</span></a>
								</li>
								<li>
									<a href="<?php echo base_url() ?>Sub_divisi/"><i class="fa fa-user"></i> <span class="nav-label">Master Sub Divisi</span></a>
								</li>
								<li>
									<a href="<?php echo base_url() ?>Area/"><i class="fa fa-map-marker"></i> <span class="nav-label">Master Area</span></a>
								</li>
								<li>
									<a href="<?php echo base_url() ?>Admin/"><i class="fa fa-user-plus"></i> <span class="nav-label">Role User</span></a>
								</li>
							</ul>
					</li>
					<li>
						<a href="<?php echo base_url() ?>Ver_lembur/"><i class="fa fa-clock-o"></i> <span class="nav-label">Data Lembur</span></a>

					</li>
					<li>
						<a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">Data LOG</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level collapse">

							<li>
								<a href="<?php echo base_url() ?>Riwayat_2/"><i class="fa fa-calendar"></i> <span class="nav-label">Absensi</span></a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-address-book"></i> <span class="nav-label">Report</span><span class="fa arrow"></span></a>
						<ul class="nav nav-second-level collapse">
							<li>
								<a href="<?php echo base_url() ?>R_absensi/"><i class="fa fa-calendar-o"></i> <span class="nav-label">Report Harian</span></a>
							</li>
							<li>
								<a href="<?php echo base_url() ?>Riwayat_2/index1"><i class="fa fa-calendar"></i> <span class="nav-label">Report Bulanan</span></a>
							</li>
							<li>
								<a href="<?php echo base_url() ?>Riwayat_2/index2"><i class="fa fa-calendar-times-o"></i> <span class="nav-label">Rekap Bulanan</span></a>
							</li>
						</ul>
					</li>
					<li class="<?= ($this->uri->segment(1) === 'Logout') ? 'landing_link' : '' ?>">
						<a href="<?php echo base_url() ?>Logout/"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
					</li>

				<?php } else { ?>

					<li>
						<a href="<?php echo base_url() ?>R_absensi/"><i class="fa fa-calendar-o"></i> <span class="nav-label">Report Harian</span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>Riwayat_2/index1"><i class="fa fa-calendar"></i> <span class="nav-label">Report Bulanan</span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>Riwayat_2/index2"><i class="fa fa-calendar-times-o"></i> <span class="nav-label">Rekap Bulanan</span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>Ver_lembur/"><i class="fa fa-clock-o"></i> <span class="nav-label">Data Lembur</span></a>
					</li>


					<!-- <li class="<?= ($this->uri->segment(1) === 'R_absensi') ? 'landing_link' : '' ?>">
						<a href="<?php echo base_url() ?>R_absensi/"><i class="fa fa-calendar-o"></i> <span class="nav-label">Report Harian</span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>Riwayat_2/index1"><i class="fa fa-calendar"></i> <span class="nav-label">Report Bulanan</span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>Riwayat_2/index2"><i class="fa fa-calendar-times-o"></i> <span class="nav-label">Rekap Bulanan</span></a>
					</li>
					<li>
						<a href="<?php echo base_url() ?>Ver_lembur/"><i class="fa fa-clock-o"></i> <span class="nav-label">Data Lembur</span></a>
					</li> -->

					<li class="<?= ($this->uri->segment(1) === 'Logout') ? 'landing_link' : '' ?>">
						<a href="<?php echo base_url() ?>Logout/"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
					</li>
				<?php } ?>
				</ul>
			</div>
		</nav>

		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn " href="#" style="background-color:#1494C6;color:white;"><i class="fa fa-bars"></i> </a>
					</div>
				</nav>
			</div>