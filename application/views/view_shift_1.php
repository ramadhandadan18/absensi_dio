<style>
    table.dataTable thead .weekend {
        background-color: #ed5565;
        color: #ffffff;
    }

    /* th.weekend {
        background-color: red;
    } */
</style>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title" style="background-color:#1494C6;color:white;">
                    <h5>Jadwal Shift Pegawai</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up text-white"></i>
                        </a>
                    </div>
                </div>
                <br><br>
                <div class="form-row col-lg-2">
                    <div class="form-group col">
                        <label>Tanggal</label>
                        <input type="text" class="form-control" id="fill_tanggal" name="fill_tanggal" value="<?php echo $periode ?>">
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover dataTables-example" width="100%" id="main-table">
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

<!-- <div class="modal inmodal" id="import_shift_mdl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close btn-submit-import" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Import Jadwal Shift</h4>
            </div>
            <div class="modal-body">
                <button class="btn btn-sm btn-success mb-4" role="button" onclick="downloadTemplate()"><i class="fa fa-download mr-2"></i>Download Template</button>
                <form method="post" action="" enctype="multipart/form-data" id="myform">
                    <div class="form-row">
                        <div class="form-group col">
                            <input type="file" class="file_template" id="file_template">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-submit-import btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-submit-import btn-primary" onclick="save_add_data(event)">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div> -->

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
<script src="<?php echo base_url() ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/repeaterjs/repeater.js"></script>


<!-- Page-Level Scripts -->
<script>
    $("#fill_tanggal").datepicker({
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months",
        autoclose: true
    });
    $(document).ready(function() {
        getMainTable($("#fill_tanggal").val());
    });

    $('#fill_tanggal').on('change', function() {
        getMainTable($("#fill_tanggal").val());
    });

    var columns, oTable;

    function getMainTable(periode) {
        // console.log(periode);
        // $('#main-table').DataTable().destroy();
        if (oTable) {
            oTable.destroy();
            $('#main-table').empty();
        }
        columns = [{
                title: 'No',
                data: 'no'
            },
            {
                title: 'Nama Pegawai',
                data: 'nama_pegawai'
            },
            {
                title: 'No. Telp',
                data: 'no_telp'
            },
            {
                title: 'NIK',
                data: 'nik'
            }
        ];

        var date_arr = [];

        $.ajax({
            type: 'GET',
            async: false,
            data: {
                periode: $('#fill_tanggal').val()
            },
            url: '<?php echo base_url() ?>Shift/getHeaderDate',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                $.each(data, function(key, value) {
                    if (value.day == 'Sat' || value.day == 'Sun') {
                        columns.push({
                            title: value.date + '<br>' + value.day,
                            data: value.date,
                            className: 'weekend'
                        });
                    } else {
                        columns.push({
                            title: value.date + '<br>' + value.day,
                            data: value.date
                        });
                    }
                    date_arr.push(value.date);
                });
            }
        });
        // console.log(columns);

        var fill_tanggal = $('#fill_tanggal').val() == '' ? 'ALL' : $('#fill_tanggal').val();
        oTable = $('#main-table').DataTable({
            scrolX: true,
            columns: columns,
            destroy: true,
            // dom: '<"html5buttons"B>lTfgitp',
            // buttons: {
            //     buttons: [{
            //         // text: '<i class="fa fa-plus-square"></i>&ensp;Import Data',
            //         // action: function(e, dt, node, config) {
            //         //     importShift();
            //         // }
            //     }, ],
            //     dom: {
            //         // button: {
            //         //     tag: "button",
            //         //     className: "btn btn-primary btn-sm"
            //         // },
            //         // buttonLiner: {
            //         //     tag: null
            //         // }
            //     }
            // },
            ajax: {
                url: "<?= base_url('Shift/get_data') ?>",
                type: 'GET',
                data: {
                    periode: fill_tanggal
                },
                dataSrc: function(json) {
                    // console.log(json);
                    var return_data = new Array()
                    $.each(json['response'], function(i, item) {
                        return_data.push({
                            'no': (i + 1),
                            'nama_pegawai': item['nama_pegawai'],
                            'no_telp': item['no_telp'],
                            'nik': item['no_pegawai'],
                        })
                        $.each(date_arr, function(ii, itemdate) {
                            // return_data.push({
                            //     [itemdate]: item[itemdate]
                            // })
                            Object.assign(return_data[i], {
                                [itemdate]: item[itemdate]
                            });
                        })
                    })
                    // console.log(return_data);
                    return return_data
                }
            },
            "rowCallback": function(row, data, index) {
                $("td:eq(0)", row).addClass("text-center");
                $.each(date_arr, function(i, itemdate) {
                    var cellValue = data[itemdate];
                    // console.log(cellValue);
                    if (cellValue == "x" || cellValue == "X")
                        $("td:eq(" + (i + 4) + ")", row).addClass("bg-danger");

                    $("td:eq(" + (i + 4) + ")", row).addClass("text-center");
                })
            },

            // retrieve: true,
        });

        // Wrap the colspan'ing header cells with a span so they can be positioned
        // absolutely - filling the available space, and no more.
        // $('#main-table thead th[colspan]').wrapInner( '<span/>' ).append( 'oioioioi' );
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

    function importShift() {
        $('#import_shift_mdl').modal('show');
    }

    function downloadTemplate() {
        $.ajax({
            type: "GET",
            url: '<?php echo base_url() ?>Shift/download_template_jadwal',
            data: {
                periode: $('#fill_tanggal').val(),
            },
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                var $a = $("<a>");
                $a.attr("href", data.file);
                $("body").append($a);
                $a.attr("download", "Template Jadwal Shift - " + $('#fill_tanggal').val() + ".xls");
                $a[0].click();
                $a.remove();
            }
        });
    }

    function save_add_data(event) {
        event.preventDefault();
        $('.btn-submit-import').prop('disabled', true);

        var myFile = $('#file_template').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', myFile);
        // console.log(myFile);

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Shift/save_add_data',
            contentType: false,
            processData: false,
            data: form_data,
            success: function(data) {
                if (data > 1) {
                    $('.btn-submit-import').prop('disabled', false);
                    toastr.success(data + ' data berhasil ditambahkan', 'Success');
                    $('#import_shift_mdl').modal('hide');
                    getMainTable();
                } else {
                    toastr.error("Data gagal diperbarui", 'Failed');
                }
            }
        });
    }

    function tableInit(data) {
        return data;
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
                // console.log(data);
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