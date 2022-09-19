<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title" style="background-color:#1494C6;color:white;">
                    <h5>Verifikasi Permohonan Perubahan Jadwal</h5>
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
<div class="modal inmodal" id="confirm_approval_submission_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="header_approval_submission"></h4>
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
                        <textarea class="form-control" id="submission_note" name="submission_note" rows="4" cols="50" placeholder="Tambahkan komentar..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="save_approval_submission('2')">Reject</button>
                <button type="button" class="btn btn-primary" onclick="save_approval_submission('1')">Approve</button>
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
        var columns = new Array;
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>Shift/getHeaderDate',
            dataType: 'json',
            success: function(data) {
                // console.log(data.date);
                var date = data.date;
                for (const i in date) {
                    columns.push(date[i].date);
                }
            }
        });
        // console.log(columns);

        var fill_tanggal = $('#fill_tanggal').val() == '' ? 'ALL' : $('#fill_tanggal').val();

        // var oTable = $('#main-table').DataTable({
        //     processing: true,
        //     select: true,
        //     destroy: true,
        //     searching: true,
        //     lengthChange: true,
        //     pageLength: 10,
        //     responsive: true,
        //     ajax: {
        //         url: "<?= base_url('Shift/get_data/') ?>" + fill_tanggal,
        //         type: 'GET',
        //         dataSrc: function(json) {
        //             console.log(json);
        //             var return_data = new Array()
        //             // $.each(json['response'], function(i, item) {
        //             //     var button = '' +
        //             //         '<div class="btn-group">' +
        //             //         '<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="approval Data" onclick="confirm_approval_submission(\'' + item["submission_id"] + '\')"><i class="fa fa-pencil"></i>&ensp;approval</button>' +
        //             //         '</div>';
        //             //     return_data.push({
        //             //         'no': (i + 1),
        //             //         'submission_ket': item['submission_ket'],
        //             //         'submission_tanggal': item['submission_tanggal'],
        //             //         'submission_tanggal_tukar': item['submission_tanggal_tukar'],
        //             //         'pemohon': item['pemohon'],
        //             //         'pengganti': item['pengganti'],
        //             //         'jam_pengganti': item['jam_pengganti'],
        //             //         'telp_pemohon': item['telp_pemohon'],
        //             //         'telp_pengganti': item['telp_pengganti'],
        //             //         'tujuan': item['tujuan'],
        //             //         'status': item['submission_status'],
        //             //         'action': item['submission_id'] != '' ? button : ''
        //             //     })
        //             // })
        //             // return return_data
        //         }
        //     },
        //     columns: [{
        //             data: 'no'
        //         },
        //         {
        //             data: 'submission_ket'
        //         },
        //         {
        //             data: 'status'
        //         },
        //         {
        //             data: 'submission_tanggal'
        //         },
        //         {
        //             data: 'submission_tanggal_tukar'
        //         },
        //         {
        //             data: 'pemohon'
        //         },
        //         {
        //             data: 'pengganti'
        //         },
        //         {
        //             data: 'jam_pengganti'
        //         },
        //         {
        //             data: 'telp_pemohon'
        //         },
        //         {
        //             data: 'telp_pengganti'
        //         },
        //         {
        //             data: 'tujuan'
        //         },
        //         {
        //             data: 'action'
        //         }
        //     ]
        // });
    }

    function confirm_approval_submission(id) {

        $('#id_approval').val(id);
        $('#submission_note').val('');
        $('#header_approval_submission').html('Confirm approval');
        $('#confirm_approval_submission_mdl').modal('show');
    }

    function save_approval_submission(status) {
        var submission_id = $('#id_approval').val();
        var submission_note = $('#submission_note').val();
        var submission_status = status;

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Jadwal/save_edit',
            data: {
                submission_id: submission_id,
                submission_note: submission_note,
                submission_status: submission_status,
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {
                    toastr.success('Data berhasil diperbarui', 'Success');
                    $('#confirm_approval_submission_mdl').modal('hide');
                    getMainTable();
                } else {
                    toastr.error("Data gagal diperbarui", 'Failed');
                }
            }
        });
    }
</script>