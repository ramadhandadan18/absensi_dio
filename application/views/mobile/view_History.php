	<nav class="navbar fixed-top navbar-light" style="background-color:#1494C6;color:white;">
		<a class="navbar-brand" href="#" style="color: white;">History</a>
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
				<div id="data_absen">

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
								<p class="mb-0" style="text-align: left;" id="nama_pegawai"></p>
								<hr>
							</div>
							<div class="col-12">
								<b>
									<p class="mb-0" style="text-align: left;color: black;">Log ID</p>
								</b>
								<p class="mb-0" style="text-align: left;" id="id_log"></p>
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
								<p class="mb-0" style="text-align: left;" id="nama_area"></p>
								<hr>
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
		});

		function getdataabsen(date = '') {
			$.ajax({
				type: 'GET',
				url: '<?php echo base_url() ?>History_mo/get_data_absen/' + date,
				dataType: 'json',
				success: function(data) {
					var data_absen = '';
					var i;
					for (i = 0; i < data.length; i++) {
						data_absen += '' +
							'<div class="row" style="padding-left: 20px;">' +
							'<div class="col-8">' +
							'<div class="row">' +
							'<div class="col-12">' +
							data[i].keterangan +
							'</div>' +
							'<div class="col-12">' +
							data[i].log_time +
							'</div>' +
							'</div>' +
							'</div>' +
							'<div class="col-4">' +
							data[i].id_log +
							'</div>' +
							'</div>' +
							'<hr>';
					}
					$('#data_absen').html(data_absen);
				}
			})
		}
		$('#tanggal').change(function() {
			var tanggal = $('#tanggal').val();
			getdataabsen(tanggal);
		});

		function view(id_log) {
			$.ajax({
				type: 'GET',
				url: '<?php echo base_url() ?>Absensi/get_data_by_id/' + id_log,
				dataType: 'json',
				success: function(data) {
					$('#id_log').html(data.id_log);
					$('#log_time').html(data.log_time);
					$('#nama_area').html(data.nama_area);
					$('#nama_pegawai').html(data.nama_pegawai);
					$('#header_view').html('Data <span class="text-info">' + data.keterangan + '</span>');
					$('#view_mdl').modal('show');
				}
			})
		}
	</script>