<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title" style="background-color:#1494C6;color:white;">
                    <h5>Master Pegawai</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up text-white"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" width="100%" id="main-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">No Pegawai</th>
                                    <th width="10%">Nama</th>
                                    <th width="10%">TTL</th>
                                    <th width="10%">Dusun</th>
                                    <th width="10%">RT/RW</th>
                                    <th width="10%">Desa</th>
                                    <th width="10%">Kecamatan</th>
                                    <th width="10%">Kabupaten</th>
                                    <th width="10%">Provinsi</th>
                                    <th width="10%">Jenis Kelamin</th>
                                    <th width="10%">No KTP</th>
                                    <th width="10%">Email</th>
                                    <th width="10%">Divisi</th>
                                    <th width="10%">Sub Divisi</th>
                                    <th width="10%">Assign Area</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL ADD -->
<div class="modal inmodal" id="add_pegawai_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <form method="post" action="" enctype="multipart/form-data" id="myform">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>NIK</strong>
                            <input type="number" class="form-control" id="no_ktp" name="no_ktp" placeholder="3525xxx" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Nama Lengkap</strong>
                            <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="Nama" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>No telp</strong>
                            <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="NO Telp" required>
                        </div>
                        <div class="form-group col">
                            <strong>Email</strong>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Divisi</strong>
                            <select class="form-control" id="id_div" name="id_div" required>
                                <option value="" disabled selected>Pilih...</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <strong>Sub Divisi</strong>
                            <select class="form-control" id="id_sub_div" name="id_sub_div" required>
                                <option value="" disabled selected>Pilih...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Tempat Lahir</strong>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required>
                        </div>
                        <div class="form-group col">
                            <strong>Tanggal Lahir</strong>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                        </div>
                        <div class="form-group col">
                            <strong>Jenis Kelamin</strong>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="1">Laki - Laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Dusun</strong>
                            <input type="text" class="form-control" id="dusun" name="dusun" placeholder="Dusun" required>
                        </div>
                        <div class="form-group col">
                            <strong>RT</strong>
                            <input type="number" class="form-control" id="rt" name="rt" placeholder="RT" required>
                        </div>
                        <div class="form-group col">
                            <strong>RW</strong>
                            <input type="number" class="form-control" id="rw" name="rw" placeholder="RW" required>
                        </div>
                        <div class="form-group col">
                            <strong>kelurahan</strong>
                            <input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="kelurahan" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Kecamatan</strong>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan" required>
                        </div>
                        <div class="form-group col">
                            <strong>Kabupaten</strong>
                            <input type="text" class="form-control" id="kabupaten" name="abupaten" placeholder="Kabupaten" required>
                        </div>
                        <div class="form-group col">
                            <strong>Provinsi</strong>
                            <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Provinsi" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save_add_pegawai()">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal inmodal" id="edit_pegawai_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_edit_pegawai"></h4>
            </div>
            <form method="post" action="" enctype="multipart/form-data" id="myform_edit">
                <div class="modal-body">
                    <div class="form-row" hidden>
                        <div class="form-group col">
                            <input type="text" class="form-control" id="id_pegawai_edit" name="id_pegawai_edit" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>NIK</strong>
                            <input type="text" class="form-control" id="no_ktp_edit" name="no_ktp_edit" placeholder="3525xxx" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Nama Lengkap</strong>
                            <input type="text" class="form-control" id="nama_pegawai_edit" name="nama_pegawai_edit" placeholder="Nama" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>No telp</strong>
                            <input type="text" class="form-control" id="no_telp_edit" name="no_telp_edit" placeholder="NO Telp" required>
                        </div>
                        <div class="form-group col">
                            <strong>Email</strong>
                            <input type="email" class="form-control" id="email_edit" name="email_edit" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Divisi</strong>
                            <select class="form-control" id="id_div_edit" name="id_div_edit" required>
                                <option value="" disabled selected>Pilih...</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <strong>Sub Divisi</strong>
                            <select class="form-control" id="id_sub_div_edit" name="id_sub_div_edit" required>
                                <option value="" disabled selected>Pilih...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Tempat Lahir</strong>
                            <input type="text" class="form-control" id="tempat_lahir_edit" name="tempat_lahir_edit" placeholder="Tempat Lahir" required>
                        </div>
                        <div class="form-group col">
                            <strong>Tanggal Lahir</strong>
                            <input type="date" class="form-control" id="tanggal_lahir_edit" name="tanggal_lahir_edit" placeholder="Tanggal Lahir" required>
                        </div>
                        <div class="form-group col">
                            <strong>Jenis Kelamin</strong>
                            <select class="form-control" id="jenis_kelamin_edit" name="jenis_kelamin_edit" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="1">Laki - Laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Dusun</strong>
                            <input type="text" class="form-control" id="dusun_edit" name="dusun_edit" placeholder="Dusun" required>
                        </div>
                        <div class="form-group col">
                            <strong>RT</strong>
                            <input type="text" class="form-control" id="rt_edit" name="rt_edit" placeholder="RT" required>
                        </div>
                        <div class="form-group col">
                            <strong>RW</strong>
                            <input type="text" class="form-control" id="rw_edit" name="rw_edit" placeholder="RW" required>
                        </div>
                        <div class="form-group col">
                            <strong>kelurahan</strong>
                            <input type="text" class="form-control" id="kelurahan_edit" name="kelurahan_edit" placeholder="kelurahan" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Kecamatan</strong>
                            <input type="text" class="form-control" id="kecamatan_edit" name="kecamatan_edit" placeholder="Kecamatan" required>
                        </div>
                        <div class="form-group col">
                            <strong>Kabupaten</strong>
                            <input type="text" class="form-control" id="kabupaten_edit" name="kabupaten_edit" placeholder="Kabupaten" required>
                        </div>
                        <div class="form-group col">
                            <strong>Provinsi</strong>
                            <input type="text" class="form-control" id="provinsi_edit" name="provinsi_edit" placeholder="Provinsi" required>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_edit_pegawai()">Save changes</button>
            </div>
        </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT AREA -->
<div class="modal inmodal" id="edit_area_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_edit_area"></h4>
            </div>
            <form method="post" action="" enctype="multipart/form-data" id="myform_edit">
                <div class="modal-body">
                    <div class="form-row" style="display: none;">
                        <div class="form-group col">
                            <strong>ID</strong>
                            <input type="text" class="form-control" id="id_pegawai_edit_area" name="id_pegawai" readonly="true">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Area</strong>
                            <select class="form-control" id="id_area_edit" name="id_area_edit" required>
                                <option value="" disabled selected>Pilih...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <button type="button" class="btn btn-primary" onclick="save_edit_area()">Add</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" width="100%" id="area-table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Nama Area</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DELETE PEGAWAI -->
<div class="modal inmodal" id="confirm_delete_pegawai_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_delete_pegawai"></h4>
            </div>
            <div class="modal-body">
                <div class="form-row" style="display: none;">
                    <div class="form-group col">
                        <strong>ID</strong>
                        <input type="text" class="form-control" id="id_delete" name="id_delete" placeholder="...">
                    </div>
                </div>
                <div>
                    <span>
                        Apakah anda yakin?
                    </span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="save_delete_pegawai()">Yes</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT JAM -->
<div class="modal inmodal" id="edit_jam_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_edit_jam"></h4>
            </div>
            <form method="post" action="" enctype="multipart/form-data" id="myform_edit">
                <div class="modal-body">
                    <div class="form-row" style="display: none;">
                        <div class="form-group col">
                            <strong>ID</strong>
                            <input type="text" class="form-control" id="id_pegawai_jam" name="id_pegawai" readonly="true">
                        </div>
                    </div>
                    <h3><strong>Hari Kerja</strong></h3>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Check in</strong>
                            <input type="text" class="form-control" id="in_day_jam" name="in_day_jam" placeholder="ex : 08.00" required>
                        </div>
                        <div class="form-group col">
                            <strong>Check out</strong>
                            <input type="text" class="form-control" id="out_day_jam" name="out_day_jam" placeholder="ex : 16.00" required>
                        </div>
                    </div>
                    <br>
                    <h3> <strong>Hari Libur</strong></h3>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Check in</strong>
                            <input type="text" class="form-control" id="in_day_off_jam" name="in_day_off_jam" placeholder="ex : 08.00" required>
                        </div>
                        <div class="form-group col">
                            <strong>Check out</strong>
                            <input type="text" class="form-control" id="out_day_off_jam" name="out_day_off_jam" placeholder="ex : 16.00" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save_edit_jam()">Save changes</button>
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
    $(document).ready(function() {

        getMainTable();
        getdatadivisi();
        getdataarea();
    });

    function getdatadivisi() {
        $.ajax({
            url: '<?php echo base_url() ?>Pegawai/get_data_divisi',
            method: "POST",
            async: true,
            dataType: 'json',
            success: function(data) {

                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].id_div + '>' + data[i].nama_div + '</option>';
                }
                $('#id_div').html(html);
                $('#id_div_edit').html(html);
            }
        });
    }

    function getdata_subdivisi(id_div, id_sub_div) {
        $.ajax({
            url: '<?php echo base_url() ?>Pegawai/get_data_sub_divisi/' + id_div,
            method: "POST",
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    if (data[i].id_sub_div == id_sub_div)
                        html += '<option value=' + data[i].id_sub_div + ' selected>' + data[i].nama_sub_div + '</option>';
                    else
                        html += '<option value=' + data[i].id_sub_div + '>' + data[i].nama_sub_div + '</option>';
                }
                $('#id_sub_div_edit').html(html);
            }
        });
    }

    $('#id_div').change(function() {
        var id_div = $('#id_div').val();
        $.ajax({
            url: '<?php echo base_url() ?>Pegawai/get_data_sub_divisi/' + id_div,
            method: "POST",
            async: true,
            dataType: 'json',
            success: function(data) {

                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].id_sub_div + '>' + data[i].nama_sub_div + '</option>';
                }
                $('#id_sub_div').html(html);
            }
        });
    });

    $('#id_div_edit').change(function() {
        var id_div = $('#id_div_edit').val();
        $.ajax({
            url: '<?php echo base_url() ?>Pegawai/get_data_sub_divisi/' + id_div,
            method: "POST",
            async: true,
            dataType: 'json',
            success: function(data) {

                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].id_sub_div + '>' + data[i].nama_sub_div + '</option>';
                }
                $('#id_sub_div_edit').html(html);
            }
        });
    });

    function getdataarea() {
        $.ajax({
            url: '<?php echo base_url() ?>Pegawai/get_data_area',
            method: "POST",
            async: true,
            dataType: 'json',
            success: function(data) {

                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].id_area + '>' + data[i].nama_area + '</option>';
                }
                $('#id_area_edit').html(html);
            }
        });
    }

    function getMainTable() {
        var oTable = $('#main-table').DataTable({
            processing: true,
            select: true,
            destroy: true,
            searching: true,
            lengthChange: true,
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: {
                buttons: [{
                    text: '<i class="fa fa-plus-square"></i>&ensp;Tambah Data',
                    action: function(e, dt, node, config) {
                        add_pegawai();
                    }
                }, ],
                dom: {
                    button: {
                        tag: "button",
                        className: "btn btn-primary btn-sm"
                    },
                    buttonLiner: {
                        tag: null
                    }
                }
            },
            ajax: {
                url: "<?= base_url('Pegawai/get_data') ?>",
                type: 'GET',
                dataSrc: function(json) {
                    var return_data = new Array()
                    $.each(json['response'], function(i, item) {
                        var button = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data" onclick="edit_pegawai(\'' + item["id_pegawai"] + '\')"><i class="fa fa-edit"></i>&ensp;Edit</button>' +
                            // '<button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Data" onclick="confirm_delete_pegawai(\'' + item["id_pegawai"] + '\')"><i class="fa fa-trash"></i>&ensp;Delete</button>' +
                            '</div>';
                        var btn_jam = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data" onclick="jam(\'' + item["id_pegawai"] + '\')"><i class="fa fa-edit"></i>&ensp;Detail</button>'
                        '</div>';
                        var btn_area1 = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data" onclick="edit_area(\'' + item["id_pegawai"] + '\')"><i class="fa fa-edit"></i>&ensp;Detail</button>'
                        '</div>';
                        var btn_area2 = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Edit Data" onclick="edit_area(\'' + item["id_pegawai"] + '\')"><i class="fa fa-plus-square"></i>&ensp;Add</button>'
                        '</div>';
                        return_data.push({
                            'no': (i + 1),
                            'no_pegawai': item['no_pegawai'],
                            'nama_pegawai': item['nama_pegawai'],
                            'lahir': item['lahir'],
                            'dusun': item['dusun'],
                            'rt': item['rt'],
                            'kelurahan': item['kelurahan'],
                            'kecamatan': item['kecamatan'],
                            'kabupaten': item['kabupaten'],
                            'provinsi': item['provinsi'],
                            'jenis_kelamin': item['jenis_kelamin'],
                            'no_ktp': item['no_ktp'],
                            'no_telp': item['no_telp'],
                            'email': item['email'],
                            'nama_div': item['nama_div'],
                            'nama_sub_div': item['nama_sub_div'],
                            'area': item['id_pegawai'] != '' ? (item['status_area'] == '1' ? btn_area1 : btn_area2) : '',
                            'action': item['id_pegawai'] != '' ? button : ''
                        })
                    })
                    return return_data
                }
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'no_pegawai'
                },
                {
                    data: 'nama_pegawai'
                },
                {
                    data: 'lahir'
                },
                {
                    data: 'dusun'
                },
                {
                    data: 'rt'
                },
                {
                    data: 'kelurahan'
                },
                {
                    data: 'kecamatan'
                },
                {
                    data: 'kabupaten'
                },
                {
                    data: 'provinsi'
                },
                {
                    data: 'jenis_kelamin'
                },
                {
                    data: 'no_ktp'
                },
                {
                    data: 'email'
                },
                {
                    data: 'nama_div'
                },
                {
                    data: 'nama_sub_div'
                },
                {
                    data: 'area'
                },
                {
                    data: 'action'
                }
            ]
        });
    }

    function get_area_table(id) {
        var oTable = $('#area-table').DataTable({
            processing: true,
            select: true,
            destroy: true,
            searching: true,
            lengthChange: true,
            pageLength: 10,
            responsive: true,
            ajax: {
                url: "<?= base_url('Pegawai/get_table_area/') ?>" + id,
                type: 'GET',
                dataSrc: function(json) {
                    var return_data = new Array()
                    $.each(json['response'], function(i, item) {
                        var button = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Data" onclick="delete_area(\'' + item['id_data_area'] + '\',\'' + id + '\')"><i class="fa fa-trash"></i>&ensp;Delete</button>' +
                            '</div>';
                        return_data.push({
                            'no': (i + 1),
                            'nama_area': item['nama_area'],
                            'action': item['id_data_area'] != '' ? button : ''
                        })
                    })
                    return return_data
                }
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'nama_area'
                },
                {
                    data: 'action'
                }
            ]
        });
    }

    function add_pegawai() {
        $('#no_ktp').val('');
        $('#nama_pegawai').val('');
        $('#no_telp').val('');
        $('#email').val('');
        $('#id_div').val('');
        $('#id_sub_div').val('');
        $('#tempat_lahir').val('');
        $('#tanggal_lahir').val('');
        $('#jenis_kelamin').val('');
        $('#rt').val('');
        $('#rw').val('');
        $('#kelurahan').val('');
        $('#kecamatan').val('');
        $('#kabupaten').val('');
        $('#provinsi').val('');
        $('#add_pegawai_mdl').modal('show');
    }

    function save_add_pegawai() {
        var no_ktp = $('#no_ktp').val();
        var nama_pegawai = $('#nama_pegawai').val();
        var no_telp = $('#no_telp').val();
        var email = $('#email').val();
        var id_div = $('#id_div').val();
        var id_sub_div = $('#id_sub_div').val();
        var tempat_lahir = $('#tempat_lahir').val();
        var tanggal_lahir = $('#tanggal_lahir').val();
        var jenis_kelamin = $('#jenis_kelamin').val();
        var rt = $('#rt').val();
        var rw = $('#rw').val();
        var dusun = $('#dusun').val();
        var kelurahan = $('#kelurahan').val();
        var kecamatan = $('#kecamatan').val();
        var kabupaten = $('#kabupaten').val();
        var provinsi = $('#provinsi').val();
        var fd = new FormData();

        fd.append('no_ktp', no_ktp);
        fd.append('nama_pegawai', nama_pegawai);
        fd.append('no_telp', no_telp);
        fd.append('email', email);
        fd.append('id_div', id_div);
        fd.append('id_sub_div', id_sub_div);
        fd.append('tempat_lahir', tempat_lahir);
        fd.append('tanggal_lahir', tanggal_lahir);
        fd.append('jenis_kelamin', jenis_kelamin);
        fd.append('rt', rt);
        fd.append('rw', rw);
        fd.append('dusun', dusun);
        fd.append('kelurahan', kelurahan);
        fd.append('kecamatan', kecamatan);
        fd.append('kabupaten', kabupaten);
        fd.append('provinsi', provinsi);

        $.ajax({
            url: '<?php echo base_url() ?>Pegawai/save_add',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#add_pegawai_mdl').modal('hide');
                    getMainTable();
                } else {
                    toastr.error(data, 'Failed');
                }
            }
        });

    }

    function edit_pegawai(id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>pegawai/get_data_by_id/' + id,
            dataType: 'json',
            success: function(data) {
                $('#id_pegawai_edit').val(data.id_pegawai);
                $('#no_ktp_edit').val(data.no_ktp);
                $('#nama_pegawai_edit').val(data.nama_pegawai);
                $('#no_telp_edit').val(data.no_telp);
                $('#email_edit').val(data.email);
                $('#id_div_edit').val(data.id_div).change();
                edit_pegawai_mdl
                getdata_subdivisi(data.id_div, data.id_sub_div);
                // $('#id_sub_div_edit').val(data.id_sub_div);
                $('#tempat_lahir_edit').val(data.tempat_lahir);
                $('#tanggal_lahir_edit').val(data.tanggal_lahir);
                $('#jenis_kelamin_edit').val(data.jenis_kelamin);
                $('#rt_edit').val(data.rt);
                $('#rw_edit').val(data.rw);
                $('#dusun_edit').val(data.dusun);
                $('#kelurahan_edit').val(data.kelurahan);
                $('#kecamatan_edit').val(data.kecamatan);
                $('#kabupaten_edit').val(data.kabupaten);
                $('#provinsi_edit').val(data.provinsi);

                $('#header_edit_pegawai').html('Edit Data <span class="text-info">' + data.nama_pegawai + '</span>');
                $('#edit_pegawai_mdl').modal("show");
            }
        });
    }

    function edit_area(id) {
        get_area_table(id);
        getdataarea();
        $('#id_pegawai_edit_area').val(id);
        $('#header_edit_area').html('Assign Area');
        $('#edit_area_mdl').modal("show");
    }

    function save_edit_pegawai() {
        var id_pegawai = $('#id_pegawai_edit').val();
        var no_ktp = $('#no_ktp_edit').val();
        var nama_pegawai = $('#nama_pegawai_edit').val();
        var no_telp = $('#no_telp_edit').val();
        var email = $('#email_edit').val();
        var id_div = $('#id_div_edit').val();
        var id_sub_div = $('#id_sub_div_edit').val();
        var tempat_lahir = $('#tempat_lahir_edit').val();
        var tanggal_lahir = $('#tanggal_lahir_edit').val();
        var jenis_kelamin = $('#jenis_kelamin_edit').val();
        var rt = $('#rt_edit').val();
        var rw = $('#rw_edit').val();
        var dusun = $('#dusun_edit').val();
        var kelurahan = $('#kelurahan_edit').val();
        var kecamatan = $('#kecamatan_edit').val();
        var kabupaten = $('#kabupaten_edit').val();
        var provinsi = $('#provinsi_edit').val();

        var fd = new FormData();
        fd.append('id_pegawai', id_pegawai);
        fd.append('no_ktp', no_ktp);
        fd.append('nama_pegawai', nama_pegawai);
        fd.append('no_telp', no_telp);
        fd.append('email', email);
        fd.append('id_div', id_div);
        fd.append('id_sub_div', id_sub_div);
        fd.append('tempat_lahir', tempat_lahir);
        fd.append('tanggal_lahir', tanggal_lahir);
        fd.append('jenis_kelamin', jenis_kelamin);
        fd.append('rt', rt);
        fd.append('rw', rw);
        fd.append('dusun', dusun);
        fd.append('kelurahan', kelurahan);
        fd.append('kecamatan', kecamatan);
        fd.append('kabupaten', kabupaten);
        fd.append('provinsi', provinsi);

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Pegawai/save_edit',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#edit_pegawai_mdl').modal('hide');
                    getMainTable();
                } else {
                    toastr.error(data, 'Failed');
                }
            }
        });

    }

    function save_edit_area() {
        var id_pegawai = $('#id_pegawai_edit_area').val();
        var id_area = $('#id_area_edit').val();
        var fd = new FormData();
        fd.append('id_pegawai', id_pegawai);
        fd.append('id_area', id_area);

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Pegawai/save_edit_area',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    get_area_table(id_pegawai);
                    getMainTable();
                } else {
                    toastr.error(data, 'Failed');
                }
            }
        });

    }

    function confirm_delete_pegawai(id) {

        $('#id_delete').val(id);

        $('#header_delete_pegawai').html('Confirm Delete Data');

        $('#confirm_delete_pegawai_mdl').modal('show');

    }

    function save_delete_pegawai() {
        var id = $('#id_delete').val();

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Pegawai/save_delete',
            data: {
                id: id,
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#confirm_delete_pegawai_mdl').modal('hide');
                    getMainTable();
                } else {
                    toastr.error("Data gagal diperbarui", 'Failed');
                }
            }
        });

    }

    function delete_area(id, id_pegawai) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Pegawai/save_delete_area',
            data: {
                id: id,
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    get_area_table(id_pegawai);
                    getMainTable();
                } else {
                    toastr.error("Data gagal diperbarui", 'Failed');
                }
            }
        });

    }

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>