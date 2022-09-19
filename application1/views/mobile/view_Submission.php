<nav class="navbar fixed-top navbar-light" style="background-color:#1494C6;color:white;">
    <a class="navbar-brand" href="#" style="color: white;">Submission</a>
</nav>

<div style="overflow-y: scroll;padding-top: 70px;padding-bottom: 100px;">
    <div style="padding-bottom: 100px;">
        <div class="container">
            <div class="table-responsive">
                <form id="frm-example" action="" method="POST">
                    <div class="container">
                        <div class="row" style="padding-bottom: 20px;">
                            <div class="col-12">
                                <button type="button" class="btn" onclick="add_submission()" style="color:white; background-color:#2EB086">Tambah data</button>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row" style="padding-bottom: 20px;">
                            <div class="col-12">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example" width="100%" id="submission-table">
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th width="5%">ID</th>
                                <th width="10%">Tanggal</th>
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

<!-- MODAL ADD AREA -->
<div class="modal inmodal" id="add_submission_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="container">
                <div class="panel-body">
                    <span id="success_result"></span>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Permohonan</label>
                            <select class="form-control" id="submission_ket" name="submission_ket" required>
                                <option value="1">Perubahan Shift</option>
                                <option value="2">Perubahan Libur</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Tanggal Permintaan</label>
                            <input type="date" class="form-control" id="submission_tanggal" name="submission_tanggal" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Tanggal Pengganti</label>
                            <input type="date" class="form-control" id="submission_tanggal_tukar" name="submission_tanggal_tukar" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Pegawai Pengganti</label>
                            <select class="form-control" id="submission_pegawai" name="submission_pegawai" required>
                                <option value="" disabled selected>Pilih...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Jam Kerja (in)</label>
                            <select class="form-control" id="submission_jam_1" name="submission_jam_1" required>
                                <?php for ($i = 1; $i <= 24; $i++) {
                                    $a =  str_pad($i, "2", "0", STR_PAD_LEFT);
                                ?>
                                    <option value="<?php echo $a . ':00'; ?>"><?php echo $a . ':00'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label>Jam Kerja (out)</label>
                            <select class="form-control" id="submission_jam_2" name="submission_jam_2" required>
                                <?php for ($i = 1; $i <= 24; $i++) {
                                    $a =  str_pad($i, "2", "0", STR_PAD_LEFT);
                                ?>
                                    <option value="<?php echo $a . ':00'; ?>"><?php echo $a . ':00'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Tujuan</label>
                            <input type="text" class="form-control" id="submission_tujuan" name="submission_tujuan" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>No Telepon Pemohon</label>
                            <input type="text" class="form-control" id="submission_no_hp" name="submission_no_hp" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>No Telepon Pengganti</label>
                            <input type="text" class="form-control" id="submission_no_hp_2" name="submission_no_hp_2" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save_add_submission()">Save changes</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        </form>
    </div>
</div>

<div class="modal inmodal" id="edit_submission_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_edit_submission"></h4>
            </div>
            <form method="post" action="" enctype="multipart/form-data" id="myform_edit">
                <div class="panel-body">
                    <span id="success_result"></span>
                    <div class="form-row" style="display: none;">
                        <div class="form-group col">
                            <label>ID</label>
                            <input type="text" class="form-control" id="submission_id_edit" name="submission_id_edit" readonly="true">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Permohonan</label>
                            <select class="form-control" id="submission_ket_edit" name="submission_ket_edit" required>
                                <option value="1">Perubahan Shift</option>
                                <option value="2">Perubahan Libur</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Tanggal Permintaan</label>
                            <input type="date" class="form-control" id="submission_tanggal_edit" name="submission_tanggal_edit" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Tanggal Pengganti</label>
                            <input type="date" class="form-control" id="submission_tanggal_tukar_edit" name="submission_tanggal_tukar_edit" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Pegawai Pengganti</label>
                            <select class="form-control" id="submission_pegawai_edit" name="submission_pegawai_edit" required>
                                <option value="" disabled selected>Pilih...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Jam Kerja (in)</label>
                            <select class="form-control" id="submission_jam_1_edit" name="submission_jam_1_edit" required>
                                <?php for ($i = 1; $i <= 24; $i++) {
                                    $a =  str_pad($i, "2", "0", STR_PAD_LEFT);
                                ?>
                                    <option value="<?php echo $a . ':00'; ?>"><?php echo $a . ':00'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label>Jam Kerja (out)</label>
                            <select class="form-control" id="submission_jam_2_edit" name="submission_jam_2_edit" required>
                                <?php for ($i = 1; $i <= 24; $i++) {
                                    $a =  str_pad($i, "2", "0", STR_PAD_LEFT);
                                ?>
                                    <option value="<?php echo $a . ':00'; ?>"><?php echo $a . ':00'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Tujuan</label>
                            <input type="text" class="form-control" id="submission_tujuan_edit" name="submission_tujuan_edit" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>No Telepon Pemohon</label>
                            <input type="text" class="form-control" id="submission_no_hp_edit" name="submission_no_hp_edit" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>No Telepon Pengganti</label>
                            <input type="text" class="form-control" id="submission_no_hp_2_edit" name="submission_no_hp_2_edit" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="save_edit_submission()">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div class="modal inmodal" id="confirm_delete_submission_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_delete_submission"></h4>
            </div>
            <div class="modal-body">
                <div class="form-row" style="display: none;">
                    <div class="form-group col">
                        <label>ID</label>
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
                <button type="button" class="btn btn-danger" onclick="save_delete_submission()">Yes</button>
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
        getdatapeagawai();
    });

    function getdatapeagawai() {
        $.ajax({
            url: '<?php echo base_url() ?>Submission/get_data_pegawai',
            method: "POST",
            async: true,
            dataType: 'json',
            success: function(data) {

                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].pegawai_id + '>' + data[i].pegawai_nama + '</option>';
                }
                $('#submission_pegawai').html(html);
                $('#submission_pegawai_edit').html(html);
            }
        });
    }

    function getData(date = '') {
        var oTable = $('#submission-table').DataTable({
            processing: true,
            select: true,
            destroy: true,
            searching: true,
            lengthChange: false,
            pageLength: 10,
            responsive: true,
            ajax: {
                url: "<?= base_url('Submission/get_data_submission/') ?>" + date,
                type: 'GET',
                dataSrc: function(json) {
                    var return_data = new Array()
                    $.each(json['response'], function(i, item) {
                        var button = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data" onclick="edit_submission(\'' + item["submission_id"] + '\')"><i class="fa fa-edit"></i>&ensp;Edit</button>' +
                            '<button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Data" onclick="confirm_delete_submission(\'' + item["submission_id"] + '\')"><i class="fa fa-trash"></i>&ensp;Delete</button>' +
                            '</div>';
                        return_data.push({
                            'no': (i + 1),
                            'id': item['submission_id'],
                            'tanggal': item['submission_tanggal'],
                            'status': item['submission_status'],
                            'action': item['submission_flag'] == '1' ? button : ''
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

    function add_submission() {
        $('#submission_tanggal').val('');
        $('#submission_tanggal_tukar').val('');
        $('#submission_pegawai').val('');
        $('#submission_jam_1').val('');
        $('#submission_jam_2').val('');
        $('#submission_tujuan').val('');
        $('#submission_no_hp').val('');
        $('#submission_no_hp_2').val('');
        $('#add_submission_mdl').modal('show');
    }

    function save_add_submission() {
        var tanggal = $('#tanggal').val();
        var submission_ket = $('#submission_ket').val();
        var submission_tanggal = $('#submission_tanggal').val();
        var submission_tanggal_tukar = $('#submission_tanggal_tukar').val();
        var submission_pegawai = $('#submission_pegawai').val();
        var submission_jam_1 = $('#submission_jam_1').val();
        var submission_jam_2 = $('#submission_jam_2').val();
        var submission_tujuan = $('#submission_tujuan').val();
        var submission_no_hp = $('#submission_no_hp').val();
        var submission_no_hp_2 = $('#submission_no_hp_2').val();

        var fd = new FormData();
        fd.append('submission_ket', submission_ket);
        fd.append('submission_tanggal', submission_tanggal);
        fd.append('submission_tanggal_tukar', submission_tanggal_tukar);
        fd.append('submission_pegawai', submission_pegawai);
        fd.append('submission_jam_1', submission_jam_1);
        fd.append('submission_jam_2', submission_jam_2);
        fd.append('submission_tujuan', submission_tujuan);
        fd.append('submission_no_hp', submission_no_hp);
        fd.append('submission_no_hp_2', submission_no_hp_2);

        $.ajax({
            url: '<?php echo base_url() ?>Submission/save_add',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#add_submission_mdl').modal('hide');
                    getData(tanggal);
                } else {
                    toastr.error(data, 'Failed');
                }
            }
        });

    }

    function edit_submission(id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>Submission/get_data_by_id/' + id,
            dataType: 'json',
            success: function(data) {
                $('#submission_id_edit').val(data.submission_id);
                $('#submission_ket_edit').val(data.submission_ket).change();
                $('#submission_pegawai_edit').val(data.submission_pegawai).change();
                $('#submission_tanggal_edit').val(data.submission_tanggal);
                $('#submission_tanggal_tukar_edit').val(data.submission_tanggal_tukar);
                $('#submission_jam_1_edit').val(data.submission_jam_1).change();
                $('#submission_jam_2_edit').val(data.submission_jam_2).change();
                $('#submission_tujuan_edit').val(data.submission_tujuan);
                $('#submission_no_hp_edit').val(data.submission_no_hp);
                $('#submission_no_hp_2_edit').val(data.submission_no_hp_2);
                $('#header_edit_submission').html('Edit Data<span class="text-info">' + data.submission_id + '</span>');
                $('#edit_submission_mdl').modal("show");
            }
        });
    }

    function save_edit_submission() {
        var tanggal = $('#tanggal').val();

        var submission_id = $('#submission_id_edit').val();
        var submission_ket = $('#submission_ket_edit').val();
        var submission_tanggal = $('#submission_tanggal_edit').val();
        var submission_tanggal_tukar = $('#submission_tanggal_tukar_edit').val();
        var submission_pegawai = $('#submission_pegawai_edit').val();
        var submission_jam_1 = $('#submission_jam_1_edit').val();
        var submission_jam_2 = $('#submission_jam_2_edit').val();
        var submission_tujuan = $('#submission_tujuan_edit').val();
        var submission_no_hp = $('#submission_no_hp_edit').val();
        var submission_no_hp_2 = $('#submission_no_hp_2_edit').val();

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Submission/save_edit',
            data: {
                submission_id: submission_id,
                submission_ket: submission_ket,
                submission_tanggal: submission_tanggal,
                submission_tanggal_tukar: submission_tanggal_tukar,
                submission_pegawai: submission_pegawai,
                submission_jam_1: submission_jam_1,
                submission_jam_2: submission_jam_2,
                submission_tujuan: submission_tujuan,
                submission_no_hp: submission_no_hp,
                submission_no_hp_2: submission_no_hp_2,
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#edit_submission_mdl').modal('hide');
                    getData(tanggal);
                } else {
                    toastr.error(data, 'Failed');
                }
            }
        });

    }

    function confirm_delete_submission(id) {

        $('#id_delete').val(id);
        $('#header_delete_submission').html('Confirm Delete Data Area');
        $('#confirm_delete_submission_mdl').modal('show');
    }

    function save_delete_submission() {
        var submission_id = $('#id_delete').val();
        var tanggal = $('#tanggal').val();


        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Submission/save_delete',
            data: {
                submission_id: submission_id,
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#confirm_delete_submission_mdl').modal('hide');
                    getData(tanggal);
                } else {
                    toastr.error("Data gagal diperbarui", 'Failed');
                }
            }
        });
    }
</script>