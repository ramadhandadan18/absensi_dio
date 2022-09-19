<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title" style="background-color:#1494C6;color:white;">
                    <h5>Master Admin</h5>
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
                                    <th width="10%">Username</th>
                                    <th width="10%">Role</th>
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
<div class="modal inmodal" id="add_admin_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <form method="post" action="" enctype="multipart/form-data" id="myform">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Username</strong>
                            <input type="text" class="form-control" id="username" name="username" placeholder="username" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Password</strong>
                            <input type="text" class="form-control" id="password" name="password" placeholder="password" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Role</strong>
                            <select class="form-control" id="role" name="role" required>
                                <option value="1">Admin</option>
                                <option value="3">SIG</option>
                            </select>
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
</div>

<!-- MODAL EDIT -->
<div class="modal inmodal" id="edit_admin_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_edit_admin"></h4>
            </div>
            <form method="post" action="" enctype="multipart/form-data" id="myform_edit">
                <div class="modal-body">
                    <div class="form-row" style="display: none;">
                        <div class="form-group col">
                            <strong>ID</strong>
                            <input type="text" class="form-control" id="id_edit" name="id_edit" readonly="true">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Username</strong>
                            <input type="text" class="form-control" id="username_edit" name="username_edit" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Password</strong>
                            <input type="text" class="form-control" id="password_edit" name="password_edit" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <strong>Role</strong>
                            <select class="form-control" id="role_edit" name="role_edit" required>
                                <option value="1">Admin</option>
                                <option value="3">SIG</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save_edit_admin()">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL DELETE -->
<div class="modal inmodal" id="confirm_delete_admin_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_delete_admin"></h4>
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
                <button type="button" class="btn btn-danger" onclick="save_delete_admin()">Yes</button>
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
    });

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
                    text: '<i class="fa fa-plus-square"></i>&ensp;Tambah Admin',
                    action: function(e, dt, node, config) {
                        add_admin();
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
                url: "<?= base_url('Admin/get_data') ?>",
                type: 'GET',
                dataSrc: function(json) {
                    var return_data = new Array()
                    $.each(json['response'], function(i, item) {
                        var button = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data" onclick="edit_admin(\'' + item["id"] + '\')"><i class="fa fa-edit"></i>&ensp;Edit</button>' +
                            '<button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete Data" onclick="confirm_delete_admin(\'' + item["id"] + '\')"><i class="fa fa-trash"></i>&ensp;Delete</button>' +
                            '</div>';
                        return_data.push({
                            'no': (i + 1),
                            'username': item['username'],
                            'role': item['role'],
                            'action': item['id'] != '' ? button : ''
                        })
                    })
                    return return_data
                }
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'username'
                },
                {
                    data: 'role'
                },
                {
                    data: 'action'
                }
            ]
        });
    }


    function add_admin() {
        $('#username').val('');
        $('#password').val('');
        $('#role').val('');
        $('#add_admin_mdl').modal('show');
    }
    $('#myform').on('submit', function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: '<?php echo base_url() ?>Admin/save_add',
            method: "POST",
            data: form_data,
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#add_admin_mdl').modal('hide');
                    getMainTable();
                } else {
                    toastr.error(data, 'Failed');
                }
            }
        });
    });

    function edit_admin(id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>Admin/get_data_by_id/' + id,
            dataType: 'json',
            success: function(data) {
                $('#id_edit').val(data.id);
                $('#username_edit').val(data.username);
                $('#password_edit').val(data.password);
                $('#role_edit').val(data.role);
                $('#header_edit_admin').html('Edit Data <span class="text-info">' + data.id + '</span>');
                $('#edit_admin_mdl').modal("show");
            }
        });
    }

    function save_edit_admin() {
        var id_edit = $('#id_edit').val();
        var username = $('#username_edit').val();
        var password = $('#password_edit').val();
        var role = $('#role_edit').val();

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Admin/save_edit',
            data: {
                id_edit: id_edit,
                username: username,
                password: password,
                role: role,
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#edit_admin_mdl').modal('hide');
                    getMainTable();
                } else {
                    toastr.error(data, 'Failed');
                }
            }
        });

    }


    function confirm_delete_admin(id) {

        $('#id_delete').val(id);

        $('#header_delete_admin').html('Confirm Delete Data');

        $('#confirm_delete_admin_mdl').modal('show');

    }

    function save_delete_admin() {
        var id = $('#id_delete').val();

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Admin/save_delete',
            data: {
                id: id,
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#confirm_delete_admin_mdl').modal('hide');
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