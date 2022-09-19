<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

<style>
	#map {
		height: 200px;
		width: 100%;
	}

	#mapOut {
		height: 200px;
		width: 100%;
	}
</style>

<div id="dua">
	<h3 style="color:white;padding-top: 50px;text-align: center;"></h3>
</div>
<div id="tiga">
	<div style="overflow-y: scroll;">
		<div class="card" style="width: 90%;padding-bottom: 20px;border-radius: 12px;display: block;margin-left: auto;margin-right: auto;">
			<div class="card-header" style="text-align: left;">
				<p>Selamat Datang</p>
				<h3><?php echo ucfirst($my_name); ?></h3>
			</div>
			<div class="card-body">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<b>
								<p class="mb-0" style="text-align: left;"><?php echo $today; ?></p>
							</b>
							<p class="mb-10" style="text-align: left;">
								<b id="jam"></b> : <b id="menit"></b> : <b id="detik"></b>
							</p>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row mb-3">
						<div class="col-3">
							<button class="btn btn-primary" style="font-size: 24px;border-radius: 12px;" onclick="check_in()" <?php if ($checkArea == 0) echo "disabled"; ?>><i class="fa fa-sign-in"></i></button>
							<span class="small d-block">Check in</span>
						</div>
						<div class="col-3">
							<button class="btn btn-danger" style="font-size: 24px;border-radius: 12px;" onclick="check_out()" <?php if ($checkArea == 0) echo "disabled"; ?>><i class="fa fa-sign-out"></i></button>
							<span class="small d-block">Check out</span>
						</div>
						<div class="col-3">
							<a href="<?php echo base_url() ?>index.php/Lembur/"><button class="btn btn-warning" style="font-size: 24px;border-radius: 12px;"><i class="fa fa-clock-o"></i></button></a>
							<span class="small d-block">Lembur</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div style="padding-top: 20px;padding-left: 20px;">
						<b>
							<p class="mb-0" style="text-align: left;">Riwayat hari ini </p>
						</b>
					</div>
				</div>
			</div>
			<div style="padding-bottom: 100px;">
				<div id="data_absen">

				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal inmodal" id="check_in_mdl" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated flipInY">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Check In</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-6">
						<b>
							<p style='color: black;'>Check Lokasi</p>
						</b>
					</div>
					<div class="col-6">
						<div class="float-right">
							<button type="button" class="btn btn-white" onclick="refreshLocIn()"><i class="fa fa-location-arrow"></i></button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div id="statusLocation"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div id="map"></div>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" onclick="log_check_in()">Check In</button>
			</div>
		</div>
	</div>

</div>
<div class="modal inmodal" id="check_out_mdl" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated flipInY">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Check Out</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-6">
						<b>
							<p style='color: black;'>Check Lokasi</p>
						</b>
					</div>
					<div class="col-6">
						<div class="float-right">
							<button type="button" class="btn btn-white" onclick="refreshLocOut()"><i class="fa fa-location-arrow"></i></button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div id="statusLocationOut"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div id="mapOut"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" onclick="log_check_out()">Check Out</button>
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

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="">
</script>

<script>
	$(document).ready(function() {
		getdataabsen();
	});

	function getdataabsen() {
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url() ?>Absensi/get_data_absen',
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
	//view detail
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
	// Initiate Data For Check In / Check Out
	var log_latitude = "";
	var log_longitude = "";
	var id_log_area = null;
	var checkArea = 0;
	var checkFoto = 0;
	var canvasFoto = "";

	var log_latitude_out = "";
	var log_longitude_out = "";
	var id_log_area_out = null;
	var checkAreaOut = 0;
	var checkFotoOut = 0;
	var canvasFotoOut = "";


	window.setTimeout("waktu()", 1000);

	function waktu() {
		var waktu = new Date();
		setTimeout("waktu()", 1000);
		document.getElementById("jam").innerHTML = waktu.getHours();
		document.getElementById("menit").innerHTML = waktu.getMinutes();
		document.getElementById("detik").innerHTML = waktu.getSeconds();
	}

	var map = null;
	var mapOut = null;

	function check_in() {
		$('#check_in_mdl').modal('show');
		var curPosition = {};
		navigator.geolocation.getCurrentPosition(showPosition);
	}

	function check_out() {
		$('#check_out_mdl').modal('show');
		var curPositionOut = {};
		navigator.geolocation.getCurrentPosition(showPositionOut);
	}

	function refreshLocIn() {
		navigator.geolocation.getCurrentPosition(showPosition);
	}

	function refreshLocOut() {
		navigator.geolocation.getCurrentPosition(showPositionOut);
	}

	function showPosition(position) {
		if (map !== undefined && map !== null) {
			map.remove(); // should remove the map from UI and clean the inner children of DOM element
		}

		var dataArea = <?php echo json_encode($area, JSON_HEX_TAG); ?>;
		log_latitude = position.coords.latitude;
		log_longitude = position.coords.longitude;

		curPosition = [position.coords.latitude, position.coords.longitude];

		map = L.map('map').setView(curPosition, 16);
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

		L.marker(curPosition).addTo(map);

		// var circle;
		var jarakArr = [];
		var arrArea = [];

		for (const i in dataArea) {
			var circlePosition = [dataArea[i].latitude, dataArea[i].longitude];
			arrArea.push({
				id_area: dataArea[i].id_area,
				jarak: hitungRadius(curPosition, circlePosition),
				longtitude: dataArea[i].longitude,
				latitude: dataArea[i].latitude,
				radius: dataArea[i].radius
			});
			jarakArr.push(hitungRadius(curPosition, circlePosition));

			L.circle(circlePosition, {
				color: 'red',
				fillColor: '#f03',
				fillOpacity: 0.5,
				radius: dataArea[i].radius
			}).addTo(map);
		}
		var nearbyJarak = null;
		nearbyJarak = Math.min.apply(null, jarakArr);

		var nearbyRadius = null;
		var nearAreaId = null;
		for (const i in arrArea) {
			if (arrArea[i].jarak == nearbyJarak) {
				nearbyRadius = arrArea[i].radius;
				nearAreaId = arrArea[i].id_area;
			}
		}
		id_log_area = nearAreaId;
		var jarakMessage = "";
		let statusLocation = "";
		var jarakToRadius = numberWithCommas(nearbyJarak - nearbyRadius);
		if (nearbyJarak < nearbyRadius) {
			statusLocation = `<h3 class="text-success">Anda berada didalam area check-in/check-out</h3>`;
			checkArea = 1;
		} else {
			statusLocation = `<h3 class="text-danger">Anda berada diluar area check-in/check-out, mendekat ` + (jarakToRadius) + ` meter lagi ke area terdekat</h3>`;
			checkArea = 0;
		}
		$("#statusLocation").html(statusLocation);

	}

	function showPositionOut(position) {
		if (mapOut !== undefined && mapOut !== null) {
			mapOut.remove(); // should remove the map from UI and clean the inner children of DOM element
		}

		var dataArea = <?php echo json_encode($area, JSON_HEX_TAG); ?>;

		log_latitude_out = position.coords.latitude;
		log_longitude_out = position.coords.longitude;

		curPositionOut = [position.coords.latitude, position.coords.longitude];

		mapOut = L.map('mapOut').setView(curPositionOut, 16);
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapOut);

		L.marker(curPositionOut).addTo(mapOut);

		var jarakArr = [];
		var arrArea = [];

		for (const i in dataArea) {
			var circlePosition = [dataArea[i].latitude, dataArea[i].longitude];
			arrArea.push({
				id_area: dataArea[i].id_area,
				jarak: hitungRadius(curPositionOut, circlePosition),
				longtitude: dataArea[i].longitude,
				latitude: dataArea[i].latitude,
				radius: dataArea[i].radius
			});
			jarakArr.push(hitungRadius(curPositionOut, circlePosition));

			L.circle(circlePosition, {
				color: 'red',
				fillColor: '#f03',
				fillOpacity: 0.5,
				radius: dataArea[i].radius
			}).addTo(mapOut);
		}

		var nearbyJarak = null;
		nearbyJarak = Math.min.apply(null, jarakArr);

		var nearbyRadius = null;
		var nearAreaId = null;
		for (const i in arrArea) {
			if (arrArea[i].jarak == nearbyJarak) {
				nearbyRadius = arrArea[i].radius;
				nearAreaId = arrArea[i].id_area;
			}
		}
		id_log_area_out = nearAreaId;
		var jarakMessage = "";
		let statusLocation = "";
		var jarakToRadius = numberWithCommas(nearbyJarak - nearbyRadius);
		if (nearbyJarak < nearbyRadius) {
			statusLocation = `<h3 class="text-success">Anda berada didalam area check-in/check-out</h3>`;
			checkArea = 1;
		} else {
			statusLocation = `<h3 class="text-danger">Anda berada diluar area check-in/check-out, mendekat ` + (jarakToRadius) + ` meter lagi ke area terdekat</h3>`;
			checkArea == 0;
		}
		$("#statusLocationOut").html(statusLocation);

	}

	function log_check_in() {
		event.preventDefault();
		var currentdate = new Date();
		var datetime = currentdate.getFullYear() + "-" +
			(currentdate.getMonth() + 1) + "-" +
			currentdate.getDate() + " " +
			currentdate.getHours() + ":" +
			currentdate.getMinutes() + ":" +
			currentdate.getSeconds();

		if (checkArea == 0) {
			alert("Anda belum didalam area");
		} else {
			var fd = new FormData();
			fd.append('log_time', datetime);
			fd.append('latitude', log_latitude);
			fd.append('longitude', log_longitude);
			fd.append('id_area', id_log_area);
			fd.append('keterangan', "CHECK IN");

			$.ajax({
				url: '<?php echo base_url() ?>Absensi/checkInOut',
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(data) {
					console.log(data);
					if (data == 1) {
						toastr.success('Berhasil Check in', 'Success');
						$('#check_in_mdl').modal('hide');
						getdataabsen();
					} else {
						toastr.error(data, 'Failed');
					}
				}
			});
		}
	}

	function log_check_out() {
		event.preventDefault();
		var currentdate = new Date();
		var datetime = currentdate.getFullYear() + "-" +
			(currentdate.getMonth() + 1) + "-" +
			currentdate.getDate() + " " +
			currentdate.getHours() + ":" +
			currentdate.getMinutes() + ":" +
			currentdate.getSeconds();

		if (checkArea == 0) {
			alert("Anda belum didalam area");

		} else {
			var fd = new FormData();
			fd.append('log_time', datetime);
			fd.append('latitude', log_latitude_out);
			fd.append('longitude', log_longitude_out);
			fd.append('id_area', id_log_area_out);
			//fd.append('foto', $.base64ImageToBlob(canvasFotoOut));
			fd.append('keterangan', "CHECK OUT");

			$.ajax({
				url: '<?php echo base_url() ?>Absensi/checkInOut',
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(data) {
					console.log(data);
					if (data == 1) {
						toastr.success('Berhasil Check out', 'Success');
						$('#check_out_mdl').modal('hide');
						getdataabsen();
					} else {
						toastr.error(data, 'Failed');
					}
				}
			});
		}
	}

	function hitungRadius(curPosition, cirPosition) {
		var lt = curPosition[0];
		var lt1 = cirPosition[0];
		var ln = curPosition[1];
		var ln1 = cirPosition[1];
		var dLat = (lt - lt1) * Math.PI / 180;
		var dLon = (ln - ln1) * Math.PI / 180;
		var a = 0.5 - Math.cos(dLat) / 2 + Math.cos(lt1 * Math.PI / 180) * Math.cos(lt * Math.PI / 180) * (1 - Math.cos(dLon)) / 2;
		d = Math.round(6371000 * 2 * Math.asin(Math.sqrt(a)));

		return d;
	}

	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	$.base64ImageToBlob = function(str) {
		/** extract content type and base64 payload from original string **/
		var pos = str.indexOf(';base64,');
		var type = str.substring(5, pos);
		var b64 = str.substr(pos + 8);

		/* decode base64 */
		var imageContent = atob(b64);

		/* create an ArrayBuffer and a view (as unsigned 8-bit) */
		var buffer = new ArrayBuffer(imageContent.length);
		var view = new Uint8Array(buffer);

		/* fill the view, using the decoded base64 */
		for (var n = 0; n < imageContent.length; n++) {
			view[n] = imageContent.charCodeAt(n);
		}

		/* convert ArrayBuffer to Blob */
		var blob = new Blob([buffer], {
			type: type
		});

		return blob;
	}
</script>