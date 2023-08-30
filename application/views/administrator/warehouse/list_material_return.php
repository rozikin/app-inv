<!-- <div class="content-wrapper"> -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-5">
                <h1><?= $title; ?></h1>
            </div>
            <div class="col-sm-2">
                <h1>
                    <?php date_default_timezone_set("Asia/jakarta"); ?>
                    <p><b><span id="jam" style="font-size:50"></span></b></p>

                </h1>
            </div>
            <div class="col-sm-5">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?= $title; ?></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?></div>
                <?php endif; ?>
                <div id="flash_data">
                    <?= $this->session->flashdata('message'); ?>
                </div>

                <div class="card">


                    <!-- /.card-header -->
                    <div class="card-body">

                        <?= form_open_multipart('Controller_Warehouse/create_out'); ?>
                        <div class="row invoice-info mt-1">


                            <div class="container">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row mb-1">
                                            <label for="no_sj" class="col-sm-4 col-form-label">NO
                                                KEMBALI</label>
                                            <div class="col-6">

                                                <input type="hidden" class="form-control form-control-sm" id="id_return" name="id_return" required>
                                                <input type="text" class="form-control form-control-sm" id="no_out" name="no_out">
                                            </div>
                                        </div>



                                        <div class=" form-group row mb-1">
                                            <label for="employee_id" class="col-sm-4 col-form-label">NIK</label>
                                            <div class="col-6">
                                                <input type="text" class="form-control form-control-sm" id="employee_id" name="employee_id" required autofocus>
                                            </div>
                                        </div>

                                        <div class=" form-group row mb-1">
                                            <label for="employee_name" class="col-sm-4 col-form-label">Name</label>
                                            <div class="col-6">
                                                <input type="text" class="form-control form-control-sm" id="employee_name" name="employee_name" disabled required>
                                            </div>
                                        </div>
                                        <div class=" form-group row mb-1">
                                            <label for="department" class="col-sm-4 col-form-label">Dep / Line</label>
                                            <div class="col-3">
                                                <input type="text" class="form-control form-control-sm" id="department" name="department" disabled>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control form-control-sm" id="line" name="line" disabled>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="col-sm-6">
                                        <div class="form-group row mb-1">
                                            <label for="item_code" class="col-sm-4 col-form-label">ITEM</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="item_code" name="item_code" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="item_description" class="col-sm-4 col-form-label">NAME</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="item_description" name="item_description" required disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="remark" class="col-sm-4 col-form-label">REMARK</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="remark" name="remark" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <!-- /.row -->

                            <div class="container mt-1">


                                <hr />

                                <!-- /.row -->
                                <div class="row no-print mb-1">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-sm float-left" style="margin-right: 5px;">
                                            <i class="fas fa-download"></i> Save
                                        </button>


                                    </div>
                                </div>


                            </div>
                        </div>

                        </form>
                        <hr />



                        <table id="example1" class="table table-hover table-bordered table-sm mt-5" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th>No Pinjam</th>
                                    <th>Date</th>
                                    <th>NIK</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Line</th>
                                    <th>Item Code</th>
                                    <th>Desc</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                        </table>
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

    kd_otomatis_return();
    kd_otomatis_no_return();






    $(document).ready(function() {
        table = $('#example1').DataTable({
            "responsive": true,
            "autoWidth": false,
            "ajax": {
                url: '<?php echo site_url('Controller_Warehouse/get_data_material_return') ?>',
                type: 'POST'
            }
        });
    });



    function kd_otomatis_return() {
        $.ajax({
            url: "<?php echo site_url('Controller_Warehouse/kode_otomatis_return') ?>/",
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id_return"]').val(data);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    }

    function kd_otomatis_no_return() {
        $.ajax({
            url: "<?php echo site_url('Controller_Warehouse/kode_otomatis_no_return') ?>/",
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="no_out"]').val(data);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    }

    $(document).ready(function() {
        $('#item_code').on('input', function() {

            var item_code = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Controller_Warehouse/get_data_kode') ?>/",
                dataType: "JSON",
                data: {
                    item_code: item_code
                },
                cache: false,
                success: function(data) {
                    $.each(data, function(item_code, item_description) {
                        $('[name="item_description"]').val(data.item_description);

                    });

                }
            });
            return false;
        });

    });


    $(document).ready(function() {
        $('#employee_id').on('input', function() {

            var employee_id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Controller_Warehouse/get_data_nik') ?>/",
                dataType: "JSON",
                data: {
                    employee_id: employee_id
                },
                cache: false,
                success: function(data) {
                    $.each(data, function(employee_id, employee_name, department, line) {
                        $('[name="employee_name"]').val(data.employee_name);
                        $('[name="department"]').val(data.department);
                        $('[name="line"]').val(data.line);

                    });

                }
            });
            return false;
        });

    });

    window.setTimeout(function() {
        $("#flash_data").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);

    function delete_data(id) {
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
                    url: "<?php echo site_url('Controller_Warehouse/remove_material_out') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        //if success reload ajax table
                        // Swal.fire(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        // )

                    }
                });

                window.location.reload();

            }
        })
    }
</script>