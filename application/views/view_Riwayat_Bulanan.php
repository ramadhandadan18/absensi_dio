<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title" style="background-color:#1494C6;color:white;">
                    <h5>Report Bulanan</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up text-white"></i>
                        </a>
                    </div>
                </div>
                <br><br>
                <div class="form-row col-lg-12">
                    <div class="form-group col">
                        <label>Divisi</label>
                        <select class="form-control" id="fill_divisi" name="fill_divisi">
                            <option value="" disabled selected>Pilih...</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label>Tahun</label>
                        <select class="form-control" id="fill_tahun" name="fill_tahun">
                            <option value="" disabled selected>Pilih...</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label>Bulan</label>
                        <select class="form-control" id="fill_bulan" name="fill_bulan">
                            <option value="" disabled selected>Pilih...</option>
                        </select>
                    </div>
                </div>
                <div class="form-row col-lg">
                    <div class="form-group col">
                        <button type="button" class="btn btn-primary" onclick="search()">Search</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" width="100%" id="main-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Nopeg</th>
                                    <th width="20%">Name</th>
                                    <th width="20%">Tanggal</th>
                                    <th width="20%">Timetable</th>
                                    <th width="20%">On Duty</th>
                                    <th width="20%">off Duty</th>
                                    <th width="20%">Clock In</th>
                                    <th width="20%">Clock Out</th>
                                    <th width="20%">Early</th>
                                    <th width="20%">Late</th>
                                    <th width="20%">Overtime</th>
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
        getdatadivisi();
        getdatatahun();
        getdatabulan();
        // getMainTable();
    });

    // $('#fill_divisi').on('change', function() {
    //     getMainTable();
    // });

    // $('#fill_tahun').on('change', function() {
    //     getMainTable();
    // });

    // $('#fill_bulan').on('change', function() {
    //     getMainTable();
    // });

    function getdatadivisi() {
        $.ajax({
            url: '<?php echo base_url() ?>R_absensi/get_data_divisi',
            method: "POST",
            async: true,
            dataType: 'json',
            success: function(data) {

                var html = '';
                var i;
                html += '<option value="ALL">ALL</option>';
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].id_div + '>' + data[i].nama_div + '</option>';
                }
                $('#fill_divisi').html(html);
            }
        });
    }

    function getdatatahun() {
        $.ajax({
            url: '<?php echo base_url() ?>Riwayat_2/get_data_tahun',
            method: "POST",
            async: true,
            dataType: 'json',
            success: function(data) {

                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].tahun + '>' + data[i].tahun + '</option>';
                }
                $('#fill_tahun').html(html);
            }
        });
    }


    function getdatabulan() {
        $.ajax({
            url: '<?php echo base_url() ?>Riwayat_2/get_data_bulan',
            method: "POST",
            async: true,
            dataType: 'json',
            success: function(data) {

                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].bulan + '>' + data[i].bulan_desc + '</option>';
                }
                $('#fill_bulan').html(html);
            }
        });
    }

    function getMainTable() {
        var fill_divisi = $('#fill_divisi').val() == null ? 'ALL' : $('#fill_divisi').val();
        var fill_tahun = $('#fill_tahun').val() == null ? 'ALL' : $('#fill_tahun').val();
        var fill_bulan = $('#fill_bulan').val() == null ? 'ALL' : $('#fill_bulan').val();
        var oTable = $('#main-table').DataTable({
            processing: true,
            select: true,
            destroy: true,
            searching: true,
            lengthChange: true,
            pageLength: 50,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: {
                buttons: [{
                    extend: 'excel',
                    title: 'Report Bulanan',
                    text: '<i class="fa fa-download"></i>&ensp;Download Excel',
                }, ],
                dom: {
                    button: {
                        tag: "button",
                        className: "btn btn-danger btn-sm"
                    },
                    buttonLiner: {
                        tag: null
                    }
                },
            },
            ajax: {
                url: "<?= base_url('Riwayat_2/get_data_bulanan2/') ?>" + fill_divisi + '/' + fill_tahun + '/' + fill_bulan,
                // url: "<?= base_url('Riwayat_2/get_data_bulanan/') ?>" + fill_divisi + '/' + fill_tahun + '/' + fill_bulan,
                type: 'GET',
                dataSrc: function(json) {
                    var return_data = new Array()
                    $.each(json['response'], function(i, item) {
                        var btn_action = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data" onclick="log_id(\'' + item["log_id"] + '\')"><i class="fa fa-edit"></i>&ensp;Edit</button>' +
                            '</div>'

                        return_data.push({
                            'no': (i + 1),
                            'no_pegawai': item['no_pegawai'],
                            'nama_pegawai': item['nama_pegawai'],
                            'tanggal': item['tanggal'],
                            'check_in': item['check_in'],
                            'check_out': item['check_out'],
                            'timetable': item['status'],
                            'on_duty': item['on_duty'],
                            'off_duty': item['off_duty'],
                            'early': item['early'],
                            'late': item['late'],
                            'overtime': item['overtime'],
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
                    data: 'tanggal'
                },
                {
                    data: 'timetable'
                },
                {
                    data: 'on_duty'
                },
                {
                    data: 'off_duty'
                },

                {
                    data: 'check_in'
                },
                {
                    data: 'check_out'
                },
                {
                    data: 'early'
                },
                {
                    data: 'late'
                },
                {
                    data: 'overtime'
                }
            ]
        });
    }

    function search() {
        getMainTable()
        // location.reload();
    }

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>