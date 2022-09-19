	<nav class="navbar fixed-top navbar-light" style="background-color:#1494C6;color:white;">
		<a class="navbar-brand" href="#" style="color: white;">Profile</a>
	</nav>

	<div style="overflow-y: scroll;padding-top: 70px;padding-bottom: 100px;">
		<div class="container">
			<div class="row" style="padding-bottom: 40px;">
				<div class="card" style="width: 90%;padding-bottom: 20px;border-radius: 12px;display: block;margin-left: auto;margin-right: auto;">
					<div class="card-body">
						<div class="container">
							<div class="row">
								<div class="col-12">
									<b>
										<p style='color: black;'>Personal Information</p>
									</b>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<b>
										<p class="mb-0" style="text-align: left;color: black;">NIP</p>
									</b>
									<p class="mb-0" style="text-align: left;"><?php echo $my_nip; ?></p>
									<hr>
								</div>
								<div class="col-12">
									<b>
										<p class="mb-0" style="text-align: left;color: black;">Name</p>
									</b>
									<p class="mb-0" style="text-align: left;"><?php echo $my_name; ?></p>
									<hr>
								</div>
								<div class="col-12">
									<b>
										<p class="mb-0" style="text-align: left;color: black;">Email ID</p>
									</b>
									<p class="mb-0" style="text-align: left;"><?php echo $my_email; ?></p>
									<hr>
								</div>
								<div class="col-12">
									<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data" onclick="edit_password()"><i class="fa fa-edit"></i>&ensp;Edit Password</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="card" style="width: 90%;padding-bottom: 20px;border-radius: 12px;display: block;margin-left: auto;margin-right: auto;">
					<div class="card-body">
						<div class="container">
							<div class="row">
								<div class="col-12">
									<b>
										<p style='color: black;'>Other Information</p>
									</b>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<a href="<?php echo base_url() ?>Logout/" style='color: black;'><i class="fa fa-sign-out"></i> <span class="nav-label">&nbsp;Logout</span></a>
									<!-- <button type="button" class="btn btn-danger" href="<?php echo base_url() ?>Logout/" style='color: white;'><i class="fa fa-sign-out"></i> <span class="nav-label">&nbsp;Logout</span></button> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL GANTI PASSWORD -->
	<div class="modal inmodal" id="edit_password_mdl" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content animated flipInY">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="header_edit_password"></h4>
				</div>
				<form method="post" action="" enctype="multipart/form-data" id="myform_edit">
					<div class="modal-body">
						<div class="form-row" style="display: none;">
							<div class="form-group col">
								<strong>ID</strong>
								<input type="text" class="form-control" id="id_edit" name="id_edit" readonly="true">
							</div>
						</div>
						<div class="form-row" style="display: none;">
							<div class="form-group col">
								<strong>Username</strong>
								<input type="text" class="form-control" id="username_edit" name="username_edit" readonly="true">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<strong>Password</strong>
								<input type="text" class="form-control" id="password_edit" name="password_edit" required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" onclick="save_edit_password()">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>


	<!-- Mainly scripts -->
	<script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugins/toastr/toastr.min.js"></script>

	<!-- Custom and plugin javascript -->
	<script src="<?php echo base_url() ?>assets/js/inspinia.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugins/pace/pace.min.js"></script>

	<script src="<?php echo base_url() ?>assets/js/plugins/dataTables/datatables.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

	<!-- Page-Level Scripts -->

	<script>
		function edit_password() {
			$.ajax({
				type: 'GET',
				url: '<?php echo base_url() ?>Profile_mo/get_data_user/',
				dataType: 'json',
				success: function(data) {
					$('#id_edit').val(data.id);
					$('#username_edit').val(data.username);
					$('#password_edit').val(data.password);
					$('#header_edit_password').html('Edit Data <span class="text-info">' + data.id + '</span>');
					$('#edit_password_mdl').modal("show");
				}
			});
		}

		function save_edit_password() {
			var id_edit = $('#id_edit').val();
			// var username = $('#username_edit').val();
			var password = $('#password_edit').val();

			$.ajax({
				type: "POST",
				url: '<?php echo base_url() ?>Profile_mo/save_edit',
				data: {
					id_edit: id_edit,
					// username: username,
					password: password,

				},
				success: function(data) {
					console.log(data);
					if (data == 1) {
						toastr.success('Data berhasil diperbarui', 'Success');
						$('#edit_password_mdl').modal('hide');
					} else {
						toastr.error(data, 'Failed');
					}
				}
			});

		}
	</script>