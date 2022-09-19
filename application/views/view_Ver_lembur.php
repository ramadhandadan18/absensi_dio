<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title" style="background-color:#1494C6;color:white;">
                    <h5>Verifikasi Permohonan Lembur</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up text-white"></i>
                        </a>
                    </div>
                </div>
                <br><br>
                <div class="form-row col-lg-4">
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
                                    <th width="20%">Tanggal</th>
                                    <th width="20%">Pemohon</th>
                                    <th width="20%">Jam mulai</th>
                                    <th width="20%">Jam selesai</th>
                                    <th width="20%">Jumlah Jam</th>
                                    <th width="20%">Status</th>
                                    <th width="20%">Action</th>
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

<!-- approval MODAL -->
<div class="modal inmodal" id="confirm_approval_lembur_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_approval_lembur"></h4>
            </div>
            <div class="modal-body">
                <div class="form-row" style="display: none;">
                    <div class="form-group col">
                        <label>ID</label>
                        <input type="text" class="form-control" id="id_approval" name="id_approval" placeholder="...">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label>Komentar</label>
                        <textarea class="form-control" id="lembur_note" name="lembur_note" rows="4" cols="50" placeholder="Tambahkan komentar..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="save_approval_lembur('2')">Reject</button>
                <button type="button" class="btn btn-primary" onclick="save_approval_lembur('1')">Approve</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="foto_mdl" tabindex="-1" role="dialog" aria-hidden="true">
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
<script src="<?php echo base_url() ?>assets/js/plugins/repeaterjs/repeater.js"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {

        getMainTable();
    });

    $('#fill_tanggal').on('change', function() {
        getMainTable();
    });


    function getMainTable() {
        var fill_tanggal = $('#fill_tanggal').val() == '' ? 'ALL' : $('#fill_tanggal').val();
        var oTable = $('#main-table').DataTable({
            processing: true,
            select: true,
            destroy: true,
            searching: true,
            lengthChange: true,
            pageLength: 10,
            responsive: true,
            ajax: {
                url: "<?= base_url('Ver_lembur/get_data/') ?>" + fill_tanggal,
                type: 'GET',
                dataSrc: function(json) {
                    var return_data = new Array()
                    $.each(json['response'], function(i, item) {
                        var button = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="approval Data" onclick="confirm_approval_lembur(\'' + item["id_lembur"] + '\')"><i class="fa fa-pencil"></i>&ensp;approval</button>' +
                            '</div>';
                        var btn_foto = '' +
                            '<div class="btn-group">' +
                            '<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit Data" onclick="foto(\'' + item["id_lembur"] + '\')"><i class="fa fa-edit"></i>&ensp;Detail</button>'
                        '</div>';
                        return_data.push({
                            'no': (i + 1),
                            'tgl_lembur': item['tgl_lembur'],
                            'pemohon': item['pemohon'],
                            'jam_fr': item['jam_fr'],
                            'jam_to': item['jam_to'],
                            'jumlah_jam': item['jumlah_jam'],
                            'status': item['lembur_status'],
                            'action': item['id_lembur'] != '' ? button : ''
                        })
                    })
                    return return_data
                }
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'tgl_lembur'
                },
                {
                    data: 'pemohon'
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

    function confirm_approval_lembur(id) {

        $('#id_approval').val(id);
        $('#lembur_note').val('');
        $('#header_approval_lembur').html('Confirm approval');
        $('#confirm_approval_lembur_mdl').modal('show');
    }

    function save_approval_lembur(status) {
        var id_lembur = $('#id_approval').val();
        var lembur_note = $('#lembur_note').val();
        var lembur_status = status;

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Ver_lembur/save_edit',
            data: {
                id_lembur: id_lembur,
                lembur_note: lembur_note,
                lembur_status: lembur_status,
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#confirm_approval_lembur_mdl').modal('hide');
                    getMainTable();
                } else {
                    toastr.error("Data gagal diperbarui", 'Failed');
                }
            }
        });
    }
</script>