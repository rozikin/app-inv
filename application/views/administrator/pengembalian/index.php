<style>
    .box-login input {
        width: 100%;
        padding: 5px 0;
        background: none;
        border: none;
        outline: none;
        font-size: 18px;
        color: white;
    }
</style>
<section class="conten">
    <div class="container-fluid">


        <div class="row  bg-dark">
            <div class="col-12">

                <div class="row text-center">
                    <div class="col-md-12 text-center">
                        <h5>PENGEMBALIAN</h5>
                        <h5 id="jam"></h5>
                    </div>
                </div>


                <div class="card bg-dark">
                    <div class="card-body">

                        <form id="form-user">
                            <div class="row invoice-info">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">

                                                <div class="from-group col-md-6">


                                                    <label for="employee_id">NIK</label>

                                                    <input type="number" class="form-control form-control-sm" id="employee_id" name="employee_id" required autofocus>
                                                    <div class="box-login">
                                                        <input type="text" class="form-control form-control-sm" id="employee_name" name="employee_name">
                                                    </div>

                                                </div>


                                                <div class="form-group col-md-6">


                                                    <label for="item_code">ITEM</label>

                                                    <input type="text" class="form-control form-control-sm" id="item_code" name="item_code" required>
                                                    <div class="box-login">
                                                        <input type="text" class="form-control form-control-sm " id="item_description" name="item_description">
                                                    </div>
                                                    <div class="box-login">
                                                        <input type="text" class="form-control form-control-sm " id="status" name="status">
                                                    </div>

                                                    <div class="box-login">
                                                        <input type="text" class="form-control form-control-sm" id="no_pinjam" name="no_pinjam" required>

                                                    </div>


                                                </div>




                                            </div>

                                            <a class="btn btn-success btn-sm float-left mr-2" data-widget="fullscreen" href="#" role="button">
                                                full-screen
                                            </a>
                                            <button type="submit" id="simpan" class="btn btn-primary btn-sm float-left" style="margin-right: 5px;">
                                                <i class="fas fa-download"></i> Save
                                            </button>
                                            <a href="<?= base_url('admin'); ?>" class="btn btn-danger btn-sm">back</a>



                                        </div>
                                    </div>

                                </div>

                                <div class="row no-print">
                                    <div class="col-12">



                                    </div>
                                </div>
                        </form>
                    </div>
                </div>



                <div class="container">

                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>No Kembali</th>
                                <th>Date</th>
                                <th>No out</th>
                                <th>NIK</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>POSISI</th>
                                <th>Item Code</th>
                                <th>Desc</th>
                                <!-- <th scope="col">Action</th> -->
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
            <!-- /.card-header -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</section>




<!-- Modal -->
<div class="modal fade" id="modal_form_pinjam" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">

                    <div class="table-responsive">
                        <div class="container">


                            <table id="example_pinjam" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No out</th>
                                        <th>Date</th>
                                        <th>Item Code</th>
                                        <th>Desc</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>






<script type="text/javascript">
    var save_method; //for save method string
    var table;
    var base_url = '<?php echo base_url(); ?>';

    window.onload = function() {
        jam();
    }

    function jam() {
        var e = document.getElementById('jam'),
            d = new Date(),
            h, m, s;
        h = d.getHours();
        m = set(d.getMinutes());
        s = set(d.getSeconds());

        e.innerHTML = h + ':' + m + ':' + s;

        setTimeout('jam()', 1000);
    }

    function set(e) {
        e = e < 10 ? '0' + e : e;
        return e;
    }

    // kd_otomatis_no_return();

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }



    function sukses() {

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });


        Toast.fire({
            icon: 'success',
            title: 'Data Berhasil Ditambahkan'
        })
    }



    function bersihkan_input() {

        $('#employee_id').val('');
        $('#employee_name').val('');
        $('#department').val('');
        $('#line').val('');
        $('#item_code').val('');
        $('#item_description').val('');
        $('#status').val('');
        $('#no_pinjam').val('');
    }

    $(document).on('click', '.pilih_data', function(e) {
        document.getElementById("no_pinjam").value = $(this).attr('data-id');
        document.getElementById("item_code").value = $(this).attr('data-code');
        document.getElementById("item_description").value = $(this).attr('data-desc');
        if ($(this).attr('data-status') == 1) {
            document.getElementById("status").value = 'OUT';
        }



        console.log('data-id');

        $('#simpan').prop('disabled', false);
        $('#simpan').click();

        $('#modal_form_pinjam').modal('hide');



    });





    function delete_data(id) {
        var pc = document.getElementById('employee_id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "<?php echo site_url('Controller_Pengembalian/remove_material_return') ?>/" +
                        id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {

                    }
                });

                reload_table();
                // kd_otomatis_no_return();
                pc.focus();

            }
        })
    }


    $(document).ready(function() {
        table = $('#example1').DataTable({
            "responsive": true,

            "ajax": {
                url: '<?php echo site_url('Controller_Pengembalian/get_data_return') ?>',
                type: 'POST'
            }

        });


        $('#simpan').prop('disabled', true);
    });

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 

    }


    function cari_pinjam() {

        var employee_id = $('#employee_id').val();
        $('#example_pinjam').DataTable({
            "responsive": true,
            destroy: true,

            "ajax": {
                url: '<?php echo site_url('Controller_Pengembalian/get_data_pinjam') ?>/' + employee_id,
                type: 'POST',

            }

        });

        $('#modal_form_pinjam').modal('show'); // show bootstrap modal
        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title

    }




    $(document).ready(function() {
        var pc = document.getElementById('employee_id');
        var px = document.getElementById('item_code');

        pc.focus();


        pc.onchange = function() {
            var employee_id = $(this).val();
            // $('[name="employee_name"]').val('');
            // $('[name="department"]').val('');
            // $('[name="line"]').val('');

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Controller_Pengembalian/get_data_nik') ?>/",
                dataType: "JSON",
                data: {
                    employee_id: employee_id
                },
                cache: false,
                success: function(data) {
                    console.log(data);
                    $.each(data, function(employee_id, employee_name,
                        department, line, message) {
                        $('[name="employee_name"]').val(data.employee_name);
                        $('[name="department"]').val(data.department);
                        $('[name="line"]').val(data.line);

                    });

                    px.focus();
                    // cari_pinjam();
                },
                error: function() {
                    toastr.error('data karyawan tidak pinjam barang!')
                    pc.focus();

                }
            })
        }
        pc.focus();

        var px = document.getElementById('item_code');
        var pl = document.getElementById('remark');

        px.onchange = function() {
            var item_code = $(this).val();

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Controller_Pengembalian/get_data_kode') ?>/",
                dataType: "JSON",
                data: {
                    item_code: item_code
                },
                cache: false,
                success: function(data) {
                    $.each(data, function(item_code, item_description) {
                        $('[name="item_description"]').val(data.item_description);
                        $('[name="no_pinjam"]').val(data.no_out);

                        if (data.status == 1) {
                            $('[name="status"]').val('PINJAM');
                        } else {
                            $('[name="status"]').val('KEMBALI');
                        }
                    });

                    $('#simpan').prop('disabled', false);
                    $('#simpan').click();

                },
                error: function() {
                    toastr.error('data tidak dipinjam / sudah kembali!')
                    px.focus();

                }
            });
        }



        $("#simpan").on('click', function(e) {
            e.preventDefault()

            var pc = document.getElementById('employee_id');
            var employee_id = $('#employee_id').val();
            var item_code = $('#item_code').val();
            var no_pinjam = $('#no_pinjam').val();
            var no_return = $('#no_return').val();
            var status = $('#status').val();

            if (employee_id != "" && no_pinjam != "" && item_code != "" && status == "PINJAM") {
                // $("#simpan").attr("disabled", "disabled");
                $.ajax({
                    url: "<?php echo base_url("Controller_Pengembalian/create_return_ajax"); ?>",
                    type: "POST",
                    data: {
                        type: 1,
                        // no_return: no_return,
                        employee_id: employee_id,
                        no_pinjam: no_pinjam,
                        item_code: item_code,
                        remark: status
                    },
                    cache: false,
                    success: function(dataResult) {


                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {


                            toastr.success(
                                'data berhasil disimpan!'
                            );
                            reload_table();
                            pc.focus();

                            bersihkan_input();

                            $('#simpan').prop('disabled', true);

                        } else if (dataResult.statusCode == 201) {
                            toastr.error('Tidak ditemukan transaksi ini');
                            bersihkan_input();

                        }
                    }
                });

            } else if (employee_id != "" && no_pinjam != "" && item_code != "" && status == "KEMBALI") {

                toastr.error('Barang tidak dipinjam / sudah kembali!');
                bersihkan_input();



            }
        });

    })
</script>