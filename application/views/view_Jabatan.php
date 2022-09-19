<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title" style="background-color:#1494C6;color:white;">
                    <h5>Master Jabatan</h5>
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
                                    <th width="20%">Kode Jabatan</th>
                                    <th width="20%">Nama Jabatan</th>
                                    <th width="20%">Status</th>
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

<!-- MODAL ADD AREA -->
<div class="modal inmodal" id="add_jabatan_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="container">
                <form method="post" id="insert_form">
                    <div class="panel-body">
                        <span id="success_result"></span>
                        <div class="form-row">
                            <div class="form-group col">
                                <strong>Kode Jabatan</strong>
                                <input type="text" class="form-control" id="kode_jabatan" name="kode_jabatan" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <strong>Nama Jabatan</strong>
                                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal inmodal" id="edit_jabatan_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_edit_jabatan"></h4>
            </div>
            <form method="post" action="" enctype="multipart/form-data" id="myform_edit">
                <div class="panel-body">
                    <span id="success_result"></span>
                    <div class="form-row" style="display: none;">
                        <div class="form-group col">
                            <strong>ID</strong>
                            <input type="text" class="form-control" id="id_jabatan_edit" name="id_jabatan_edit" readonly="true">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Kode Jabatan</strong>
                            <input type="text" class="form-control" id="kode_jabatan_edit" name="kode_jabatan_edit" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Nama Jabatan</strong>
                            <input type="text" class="form-control" id="nama_jabatan_edit" name="nama_jabatan_edit" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="save_edit_jabatan()">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div class="modal inmodal" id="confirm_delete_jabatan_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_delete_jabatan"></h4>
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
                <button type="button" class="btn btn-danger" onclick="save_delete_jabatan()">Yes</button>
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
<script src="<?php echo base_url() ?>assets/js/plugins/repeaterjs/repeater.js"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {

        getMainTable();
    });


    function getMainTable() {
        var role_id = 1;
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
                        add_jabatan();
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
                url: '<?= base_url("Jabatan/get_data/") ?>',
                type: 'GET',
                dataSrc: function(json) {
                    var return_data = new Array()
                    $.each(json['response'], function(i, item) {
                        var button = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data" onclick="edit_jabatan(\'' + item["id_jabatan"] + '\')"><i class="fa fa-edit"></i>&ensp;Edit</button>' +
                            '<button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Data" onclick="confirm_delete_jabatan(\'' + item["id_jabatan"] + '\')"><i class="fa fa-trash"></i>&ensp;Delete</button>' +
                            '</div>'
                        return_data.push({
                            'no': (i + 1),
                            'kode_jabatan': item['kode_jabatan'],
                            'nama_jabatan': item['nama_jabatan'],
                            'action': item['id_jabatan'] != '' ? button : ''
                        })
                    })
                    return return_data
                }
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'kode_jabatan'
                },
                {
                    data: 'nama_jabatan'
                },
                {
                    data: 'action'
                }
            ]
        });
    }

    function add_jabatan() {
        $('#kode_jabatan').val('');
        $('#nama_jabatan').val('');
        $('#add_jabatan_mdl').modal('show');
    }

    $('#insert_form').on('submit', function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: '<?php echo base_url() ?>Jabatan/save_add',
            method: "POST",
            data: form_data,
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#add_jabatan_mdl').modal('hide');
                    getMainTable();
                } else {
                    toastr.error(data, 'Failed');
                }
            }
        });
    });

    function edit_jabatan(id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>Jabatan/get_data_by_id/' + id,
            dataType: 'json',
            success: function(data) {
                $('#id_jabatan_edit').val(data.id_jabatan);
                $('#kode_jabatan_edit').val(data.kode_jabatan).change();
                $('#nama_jabatan_edit').val(data.nama_jabatan).change();
                $('#header_edit_jabatan').html('Edit Data Jabatan <span class="text-info">' + data.kode_jabatan + '</span>');
                $('#edit_jabatan_mdl').modal("show");
            }
        });
    }

    function save_edit_jabatan() {
        var id_jabatan = $('#id_jabatan_edit').val();
        var kode_jabatan = $('#kode_jabatan_edit').val();
        var nama_jabatan = $('#nama_jabatan_edit').val();


        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Jabatan/save_edit',
            data: {
                id_jabatan: id_jabatan,
                kode_jabatan: kode_jabatan,
                nama_jabatan: nama_jabatan,
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#edit_jabatan_mdl').modal('hide');
                    getMainTable();
                } else {
                    toastr.error(data, 'Failed');
                }
            }
        });

    }

    function confirm_delete_jabatan(id) {

        $('#id_delete').val(id);
        $('#header_delete_jabatan').html('Confirm Delete Data Jabatan');
        $('#confirm_delete_jabatan_mdl').modal('show');
    }

    function save_delete_jabatan() {
        var id_jabatan = $('#id_delete').val();

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Jabatan/save_delete',
            data: {
                id_jabatan: id_jabatan,
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#confirm_delete_jabatan_mdl').modal('hide');
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