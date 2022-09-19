<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title" style="background-color:#1494C6;color:white;">
                    <h5>Report Absensi Harian</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up text-white"></i>
                        </a>
                    </div>
                </div>
                <br><br>
                <div class="form-row col-lg-6">
                    <div class="form-group col">
                        <label>Divisi</label>
                        <select class="form-control" id="fill_divisi" name="fill_divisi">
                            <option value="" disabled selected>Pilih...</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" id="fill_tanggal" name="fill_tanggal" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" width="100%" id="main-table">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Nama Pegawai</th>
                                    <th width="20%">Check in</th>
                                    <th width="20%">Check out</th>
                                    <th width="20%">Keterangan</th>
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

<div class="modal inmodal" id="foto_pegawai_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_foto"></h4>
            </div>
            <div class="modal-body">
                <div id="fotoView">

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

        getMainTable();
        getdatadivisi()
    });

    $('#fill_divisi').on('change', function() {
        getMainTable();
    });

    $('#fill_tanggal').on('change', function() {
        getMainTable();
    });

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

    function getMainTable() {
        var fill_divisi = $('#fill_divisi').val() == null ? 'ALL' : $('#fill_divisi').val();
        var fill_tanggal = $('#fill_tanggal').val() == '' ? 'ALL' : $('#fill_tanggal').val();
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
                    title: 'Report Absensi Harian',
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
                }
            },
            ajax: {
                url: "<?= base_url('R_absensi/get_data/') ?>" + fill_divisi + '/' + fill_tanggal,
                type: 'GET',
                dataSrc: function(json) {
                    var return_data = new Array()
                    $.each(json['response'], function(i, item) {
                        var btn_foto = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Foto Pegawai" onclick="foto_pegawai(\'' + item["log_id"] + '\')"><i class="fa fa-edit"></i>&ensp;Detail</button>'
                        '</div>';
                        return_data.push({
                            'no': (i + 1),
                            'nama_pegawai': item['nama_pegawai'],
                            'check_in': item['check_in'],
                            'check_out': item['check_out'],
                            'status': item['status']
                        })
                    })
                    return return_data
                }
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'nama_pegawai'
                },
                {
                    data: 'check_in'
                },
                {
                    data: 'check_out'
                },
                {
                    data: 'status'
                },
            ]
        });
    }

    function foto_pegawai(id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>R_absensi/get_data_by_id/' + id,
            dataType: 'json',
            success: function(data) {
                var html = 'Data is null';
                if (data.log_foto != null) {
                    html = "<center><img style='width:400px;height:400px' src='" + '<?php echo base_url() ?>/assets/images/' + data.log_foto + "' /></center>";
                    $('#fotoView').html(html);
                } else
                    $('#fotoView').html(html);

                $('#header_foto').html('Foto <span class="text-info">' + data.log_id + '</span>');
                $('#foto_pegawai_mdl').modal("show");
            }
        });

    }

    function refresh() {
        location.reload();
    }

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>