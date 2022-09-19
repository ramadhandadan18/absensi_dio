	<nav class="navbar fixed-top navbar-light" style="background-color:#1494C6;color:white;">
		<a class="navbar-brand" href="#" style="color: white;">Approval</a>
	</nav>

	<div style="overflow-y: scroll;padding-top: 70px;padding-bottom: 100px;">
		<div class="container">
			<div class="row" style="padding-bottom: 20px;">
				<div class="col-12">
					<label>Tanggal</label>
					<input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
				</div>
			</div>
		</div>
		<div style="padding-bottom: 100px;">
			<div class="container">
				<div class="table-responsive">
					<form id="frm-example" action="" method="POST">
						<div class="container">
							<div class="row" style="padding-bottom: 20px;">
								<div class="col-12">
									<button type="button" class="btn" onclick="confirm_update_approve()" style="color:white; background-color:#2EB086">Approve All</button>
									<button type="button" class="btn btn-danger" onclick="confirm_update_reject()">Reject All</button>
								</div>
							</div>
							<div class="row" style="padding-bottom: 20px;">
								<div class="col-12">
									<button type="button" onclick="confirm_update_approve_sel()" class="btn" style="color:white; background-color:#2EB086">Approve Selected</button>
									<button type="button" onclick="confirm_update_reject_sel()" class="btn btn-danger">Reject Selected</button>
								</div>
							</div>
						</div>
						<table class="table table-striped table-bordered table-hover dataTables-example" width="100%" id="approval-table">
							<thead>
								<tr>
									<th width="5%"></th>
									<th width="5%">No</th>
									<th width="10%">Keterangan</th>
									<th width="10%">Nama Pegawai</th>
									<th width="10%">Nama Area</th>
									<th width="10%">Log Time</th>
									<th width="10%">Status</th>
									<th width="5%">Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</from>
				</div>
			</div>
		</div>
	</div>

	<div class="modal inmodal" id="view_mdl" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content animated flipInY">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="header_view"></h4>
				</div>
				<div class="modal-body">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<b>
									<p style='color: black;'>Log Information</p>
								</b>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<b>
									<p class="mb-0" style="text-align: left;color: black;">Name</p>
								</b>
								<p class="mb-0" style="text-align: left;" id="pegawai_nama"></p>
								<hr>
							</div>
							<div class="col-12">
								<b>
									<p class="mb-0" style="text-align: left;color: black;">Log ID</p>
								</b>
								<p class="mb-0" style="text-align: left;" id="log_id"></p>
								<hr>
							</div>
							<div class="col-12">
								<b>
									<p class="mb-0" style="text-align: left;color: black;">Log Time</p>
								</b>
								<p class="mb-0" style="text-align: left;" id="log_time"></p>
								<hr>
							</div>
							<div class="col-12">
								<b>
									<p class="mb-0" style="text-align: left;color: black;">Log Area</p>
								</b>
								<p class="mb-0" style="text-align: left;" id="area_nama"></p>
								<hr>
							</div>
							<div class="col-12">
								<b>
									<p class="mb-0" style="text-align: left;color: black;">Log Status</p>
								</b>
								<p class="mb-0" style="text-align: left;" id="status"></p>
								<hr>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="row">
							<div class="col-12">
								<b>
									<p style='color: black;'>Log Foto</p>
								</b>
							</div>
							<div class="col-12">
								<div id="fotoView"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- APP ALL MODAL -->
	<div class="modal inmodal" id="confirm_app_all_mdl" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content animated flipInY">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="header_app_all"></h4>
				</div>
				<div class="modal-body">
					<div>
						<span>
							Apakah anda yakin Approve All data?
						</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger" onclick="update_approve()">Yes</button>
				</div>
			</div>
		</div>
	</div>

	<!-- REJ ALL MODAL -->
	<div class="modal inmodal" id="confirm_rej_all_mdl" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content animated flipInY">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="header_rej_all"></h4>
				</div>
				<div class="modal-body">
					<div>
						<span>
							Apakah anda yakin Reject All data?
						</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger" onclick="update_reject()">Yes</button>
				</div>
			</div>
		</div>
	</div>

	<!-- APP SEL MODAL -->
	<div class="modal inmodal" id="confirm_app_sel_mdl" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content animated flipInY">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="header_app_sel"></h4>
				</div>
				<div class="modal-body">
					<div>
						<span>
							Apakah anda yakin Approve Selected data?
						</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger" id="upd_app">Yes</button>
				</div>
			</div>
		</div>
	</div>

	<!-- REJ SEL MODAL -->
	<div class="modal inmodal" id="confirm_rej_sel_mdl" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content animated flipInY">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="header_rej_sel"></h4>
				</div>
				<div class="modal-body">
					<div>
						<span>
							Apakah anda yakin Reject Selected data?
						</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger" id="upd_rej">Yes</button>
				</div>
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
		$(document).ready(function() {
			getdataabsen();
			var approve = '';
		});

		function confirm_update_approve_sel() {
			$('#header_app_sel').html('Confirm Approve Selected Data');
			$('#confirm_app_sel_mdl').modal('show');
		}

		function confirm_update_reject_sel() {
			$('#header_rej_sel').html('Confirm Reject Selected Data');
			$('#confirm_rej_sel_mdl').modal('show');
		}

		$('#upd_app').on('click', function() {
			approve = '1';
			$('#frm-example').submit();
		});

		$('#upd_rej').on('click', function() {
			approve = '2';
			$('#frm-example').submit()
		});

		$('#frm-example').on('submit', function(event) {
			var tanggal = $('#tanggal').val();
			event.preventDefault();
			var form_data = $(this).serializeArray();
			form_data.push({
				name: "status",
				value: approve
			});
			form_data.push({
				name: "tanggal",
				value: tanggal
			});
			$.ajax({
				url: '<?php echo base_url() ?>Approval/update_approve_sel',
				method: "POST",
				data: form_data,
				success: function(data) {
					console.log(data);
					if (data == 1) {
						toastr.success('Data berhasil diperbarui', 'Success');
						$('#confirm_app_sel_mdl').modal('hide');
						$('#confirm_rej_sel_mdl').modal('hide');
						getdataabsen(tanggal);
					} else {
						toastr.error(data, 'Failed');
					}
				}
			});

		});

		function getdataabsen(date = '') {
			var oTable = $('#approval-table').DataTable({
				processing: true,
				select: true,
				destroy: true,
				searching: true,
				lengthChange: false,
				pageLength: 10,
				responsive: true,
				ajax: {
					url: "<?= base_url('Approval/get_data_approval/') ?>" + date,
					type: 'GET',
					dataSrc: function(json) {
						var return_data = new Array()
						$.each(json['response'], function(i, item) {
							return_data.push({
								'check': item['check'],
								'no': (i + 1),
								'pegawai_nama': item['pegawai_nama'],
								'area_nama': item['area_nama'],
								'log_time': item['log_time'],
								'keterangan': item['keterangan'],
								'status': item['status'],
								'action': item['button']
							})
						})
						return return_data
					}
				},
				columns: [{
						data: 'check'
					},
					{
						data: 'no'
					},
					{
						data: 'keterangan'
					},
					{
						data: 'pegawai_nama'
					},
					{
						data: 'area_nama'
					},
					{
						data: 'log_time'
					},
					{
						data: 'status'
					},
					{
						data: 'action'
					}
				]
			});
		}
		$('#tanggal').change(function() {
			var tanggal = $('#tanggal').val();
			getdataabsen(tanggal);
		});

		function view(log_id) {
			$.ajax({
				type: 'GET',
				url: '<?php echo base_url() ?>Absensi/get_data_by_id/' + log_id,
				dataType: 'json',
				success: function(data) {
					$('#log_id').html(data.log_id);
					$('#log_time').html(data.log_time);
					$('#area_nama').html(data.area_nama);
					$('#pegawai_nama').html(data.pegawai_nama);
					$('#status').html(data.status);
					var html = 'Data is null ..';
					if (data.log_foto != null) {
						html = "<center><img style='width:100%;height:100%' src='" + '<?php echo base_url() ?>/assets/images/' + data.log_foto + "' /></center>";
						$('#fotoView').html(html);
					} else
						$('#fotoView').html(html);
					$('#header_view').html('Data <span class="text-info">' + data.keterangan + '</span>');
					$('#view_mdl').modal('show');
				}
			})
		}

		function confirm_update_approve() {
			$('#header_app_all').html('Confirm Approve All Data');
			$('#confirm_app_all_mdl').modal('show');
		}

		function update_approve() {
			var tanggal = $('#tanggal').val();
			var status = '1';
			var fd = new FormData();
			fd.append('status', status);
			fd.append('tanggal', tanggal);
			$.ajax({
				type: "POST",
				url: '<?php echo base_url() ?>Approval/update_approve',
				data: fd,
				contentType: false,
				processData: false,
				success: function(data) {
					console.log(data);
					if (data == 1) {
						toastr.success('Data berhasil diperbarui', 'Success');
						$('#confirm_app_all_mdl').modal('hide');
						getdataabsen(tanggal);
					} else {
						toastr.error(data, 'Failed');
					}
				}
			});
		}

		function confirm_update_reject() {
			$('#header_rej_all').html('Confirm Reject All Data');
			$('#confirm_rej_all_mdl').modal('show');
		}

		function update_reject() {
			var tanggal = $('#tanggal').val();
			var status = '2';
			var fd = new FormData();
			fd.append('status', status);
			fd.append('tanggal', tanggal);
			$.ajax({
				type: "POST",
				url: '<?php echo base_url() ?>Approval/update_approve',
				data: fd,
				contentType: false,
				processData: false,
				success: function(data) {
					console.log(data);
					if (data == 1) {
						toastr.success('Data berhasil diperbarui', 'Success');
						$('#confirm_rej_all_mdl').modal('hide');
						getdataabsen(tanggal);
					} else {
						toastr.error(data, 'Failed');
					}
				}
			});
		}
	</script>