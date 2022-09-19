<nav class="navbar fixed-top navbar-light" style="background-color:#1494C6;color:white;">
    <a class="navbar-brand" href="#" style="color: white;">Lembur</a>
</nav>

<div style="overflow-y: scroll;padding-top: 70px;padding-bottom: 100px;">
    <div style="padding-bottom: 100px;">
        <div class="container">
            <div class="table-responsive">
                <form id="frm-example" action="" method="POST">
                    <div class="container">
                        <div class="row" style="padding-bottom: 20px;">
                            <div class="col-12">
                                <button type="button" class="btn" onclick="add_lembur()" style="color:white; background-color:#2EB086">Tambah data</button>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row" style="padding-bottom: 20px;">
                            <div class="col-12">
                                <strong>Tanggal</strong>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example" width="100%" id="lembur-table">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th width="5%">ID</th>
                                <th width="10%">Tanggal</th>
                                <th width="10%">Shift</th>
                                <th width="10%">Jam mulai</th>
                                <th width="10%">Jam selesai</th>
                                <th width="10%">Jumlah Jam</th>
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

<!-- MODAL ADD  -->
<div class="modal inmodal" id="add_lembur_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="container">
                <div class="panel-body">
                    <span id="success_result"></span>
                    <!-- <div class="form-row">
                        <div class="form-group col">
                            <strong hidden>ID</strong>
                            <input type="date" class="form-control" id="id_pegawai" name="id_pegawai" hidden>
                        </div>
                    </div> -->
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Tanggal</strong>
                            <input type="date" class="form-control" id="tgl_lembur" name="tgl_lembur" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Shift</strong>
                            <select class="form-control" id="shift" name="shift" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="1">Shift 1</option>
                                <option value="2">Shift 2</option>
                                <option value="3">Shift 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Jam Mulai</strong>
                            <input type="time" class="form-control" id="jam_fr" name="jam_fr" required>
                        </div>
                        <div class="form-group col">
                            <strong>s/d</strong>
                            <input type="number" class="form-control" id="jam_to" name="jam_to" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Jumlah Jam</strong>
                            <input type="number" class="form-control" id="jumlah_jam" name="jumlah_jam" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Pekerjaan</strong>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save_add_lembur()">Save changes</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        </form>
    </div>
</div>

<!-- DELETE MODAL -->
<div class="modal inmodal" id="confirm_delete_lembur_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_delete_lembur"></h4>
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
                <button type="button" class="btn btn-danger" onclick="save_delete_lembur()">Yes</button>
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
        getData();
    });

    function getData() {
        var tgl_lembur = $('#tanggal').val();
        var oTable = $('#lembur-table').DataTable({
            processing: true,
            select: true,
            destroy: true,
            searching: true,
            lengthChange: false,
            pageLength: 10,
            responsive: true,
            ajax: {
                url: "<?= base_url('Lembur/get_data_lembur/') ?>" + tgl_lembur,
                type: 'GET',
                dataSrc: function(json) {
                    var return_data = new Array()
                    $.each(json['response'], function(i, item) {
                        var button = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Data" onclick="confirm_delete_lembur(\'' + item["id_lembur"] + '\')"><i class="fa fa-trash"></i>&ensp;Delete</button>' +
                            '</div>';
                        return_data.push({
                            'no': (i + 1),
                            'id': item['id_lembur'],
                            'tanggal': item['tgl_lembur'],
                            'shift': item['shift'],
                            'jam_fr': item['jam_fr'],
                            'jam_to': item['jam_to'],
                            'jumlah_jam': item['jumlah_jam'],
                            'status': item['lembur_status'],
                            'action': item['lembur_flag'] == '1' ? button : ''
                        })
                    })
                    return return_data
                }
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'id'
                },
                {
                    data: 'tanggal'
                },
                {
                    data: 'shift'
                },
                {
                    data: 'jam_fr'
                },
                {
                    data: 'jam_to'
                },
                {
                    data: 'jumlah_jam'
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
        getData(tanggal);
    });

    function add_lembur() {
        //$('#id_pegawai').val('');
        $('#tgl_lembur').val('');
        $('#shift').val('');
        $('#pekerjaan').val('');
        $('#jam_fr').val('');
        $('#jam_to').val('');
        $('#jumlah_jam').val('');
        $('#add_lembur_mdl').modal('show');
    }

    function save_add_lembur() {
        var tanggal = $('#tanggal').val();

        //var id_pegawai = $('#id_pegawai').val();
        var tgl_lembur = $('#tgl_lembur').val();
        var shift = $('#shift').val();
        var jam_fr = $('#jam_fr').val();
        var jam_to = $('#jam_to').val();
        var jumlah_jam = $('#jumlah_jam').val();
        var pekerjaan = $('#pekerjaan').val();

        var fd = new FormData();
        //fd.append('id_pegwai', id_pegwai);
        fd.append('tgl_lembur', tgl_lembur);
        fd.append('shift', shift);
        fd.append('jam_fr', jam_fr);
        fd.append('jam_to', jam_to);
        fd.append('jumlah_jam', jumlah_jam);
        fd.append('pekerjaan', pekerjaan);

        $.ajax({
            url: '<?php echo base_url() ?>Lembur/save_add',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#add_lembur_mdl').modal('hide');
                    getData(tanggal);
                } else {
                    toastr.error(data, 'Failed');
                }
            }
        });

    }

    function confirm_delete_lembur(id) {

        $('#id_delete').val(id);
        $('#header_delete_lembur').html('Confirm Delete Data Area');
        $('#confirm_delete_lembur_mdl').modal('show');
    }

    function save_delete_lembur() {
        var id_lembur = $('#id_delete').val();
        var tanggal = $('#tanggal').val();


        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Lembur/save_delete',
            data: {
                id_lembur: id_lembur,
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#confirm_delete_lembur_mdl').modal('hide');
                    getData(tanggal);
                } else {
                    toastr.error("Data gagal diperbarui", 'Failed');
                }
            }
        });
    }
</script>