<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title" style="background-color:#1494C6;color:white;">
                    <h5>Master Divisi</h5>
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
                                    <th width="20%">Nama Divisi</th>
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
<div class="modal inmodal" id="add_divisi_mdl" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <strong>Nama Divisi</strong>
                                <input type="text" class="form-control" id="nama_div" name="nama_div" required>
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
<div class="modal inmodal" id="edit_divisi_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_edit_divisi"></h4>
            </div>
            <form method="post" action="" enctype="multipart/form-data" id="myform_edit">
                <div class="panel-body">
                    <span id="success_result"></span>
                    <div class="form-row" style="display: none;">
                        <div class="form-group col">
                            <strong>ID</strong>
                            <input type="text" class="form-control" id="id_div_edit" name="id_div_edit" readonly="true">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Nama Divisi</strong>
                            <input type="text" class="form-control" id="nama_div_edit" name="nama_div_edit" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="save_edit_divisi()">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div class="modal inmodal" id="confirm_delete_divisi_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_delete_divisi"></h4>
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
                <button type="button" class="btn btn-danger" onclick="save_delete_divisi()">Yes</button>
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
                        add_divisi();
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
                url: '<?= base_url("Divisi/get_data/") ?>',
                type: 'GET',
                dataSrc: function(json) {
                    var return_data = new Array()
                    $.each(json['response'], function(i, item) {
                        var button = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data" onclick="edit_divisi(\'' + item["id_div"] + '\')"><i class="fa fa-edit"></i>&ensp;Edit</button>' +
                            '<button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Data" onclick="confirm_delete_divisi(\'' + item["id_div"] + '\')"><i class="fa fa-trash"></i>&ensp;Delete</button>' +
                            '</div>'
                        return_data.push({
                            'no': (i + 1),
                            'nama_div': item['nama_div'],
                            'action': item['id_div'] != '' ? button : ''
                        })
                    })
                    return return_data
                }
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'nama_div'
                },
                {
                    data: 'action'
                }
            ]
        });
    }

    function add_divisi() {
        $('#nama_div').val('');
        $('#add_divisi_mdl').modal('show');
    }

    $('#insert_form').on('submit', function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: '<?php echo base_url() ?>Divisi/save_add',
            method: "POST",
            data: form_data,
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#add_divisi_mdl').modal('hide');
                    getMainTable();
                } else {
                    toastr.error(data, 'Failed');
                }
            }
        });
    });

    function edit_divisi(id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>Divisi/get_data_by_id/' + id,
            dataType: 'json',
            success: function(data) {
                $('#id_div_edit').val(data.id_div);
                $('#nama_div_edit').val(data.nama_div).change();
                $('#header_edit_divisi').html('Edit Data Divisi <span class="text-info">' + data.nama_div + '</span>');
                $('#edit_divisi_mdl').modal("show");
            }
        });
    }

    function save_edit_divisi() {
        var id_div = $('#id_div_edit').val();
        var nama_div = $('#nama_div_edit').val();


        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Divisi/save_edit',
            data: {
                id_div: id_div,
                nama_div: nama_div,
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#edit_divisi_mdl').modal('hide');
                    getMainTable();
                } else {
                    toastr.error(data, 'Failed');
                }
            }
        });

    }

    function confirm_delete_divisi(id) {

        $('#id_delete').val(id);
        $('#header_delete_divisi').html('Confirm Delete Data Divisi');
        $('#confirm_delete_divisi_mdl').modal('show');
    }

    function save_delete_divisi() {
        var id_div = $('#id_delete').val();

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Divisi/save_delete',
            data: {
                id_div: id_div,
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#confirm_delete_divisi_mdl').modal('hide');
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