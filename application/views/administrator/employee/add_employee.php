<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <?= form_open_multipart('Controller_Employee/create'); ?>
                        <form>


                            <div class="row">
                                <div class="col-md-5">

                                    <div class="form-group">
                                        <label for="employee_id">Employee ID</label>
                                        <input type="text" class="form-control form-control-sm" name="employee_id" id="employee_id" placeholder="item code" required autofocus>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="employee_name">Employee Name</label>
                                        <input type="text" class="form-control form-control-sm" name="employee_name" id="employee_name" placeholder="description" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <input type="text" class="form-control form-control-sm" name="department" id="department" placeholder="description" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="line">POSISI</label>
                                        <input type="text" class="form-control form-control-sm" name="line" id="line" placeholder="description" required>
                                    </div>




                                    <div class=" form-group">
                                        <!-- <label for="remark">Remark</label> -->
                                        <input type="hidden" class="form-control form-control-sm rounded-0" name="remark" id="remark" value='0'>
                                    </div>
                                    <!-- /.form-group -->


                                </div>

                            </div>

                            <!-- /.row -->
                            <button type="submit" class="btn btn-primary btn-sm" id="save">Save</button>
                            <a href="<?= base_url('Controller_Employee'); ?>" class="btn btn-danger btn-sm">back</a>
                            <div class="form-group">
                            </div>
                        </form>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>







<script>
    $(function() {

        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        })
    });


    function cari_supplier() {
        $('#modal-lg').modal('show'); // show bootstrap modal
        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
    }

    function cari_category() {
        $('#modal_form_category').modal('show'); // show bootstrap modal
        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
    }

    function cari_unit() {
        $('#modal_form_unit').modal('show'); // show bootstrap modal
        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
    }


    $(document).on('click', '.pilih_suppliers', function(e) {
        document.getElementById("id_supplier").value = $(this).attr('data-kode');

        document.getElementById("supplier_name").value = $(this).attr('data-nama');

        $('#modal-lg').modal('hide');
    });


    $(document).on('click', '.pilih_category', function(e) {
        document.getElementById("id_category").value = $(this).attr('data-id');
        document.getElementById("name_category").value = $(this).attr('data-kode');

        $('#modal_form_category').modal('hide');


    });

    $(document).on('click', '.pilih_unit', function(e) {
        document.getElementById("id_unit").value = $(this).attr('data-id');
        document.getElementById("code_unit").value = $(this).attr('data-kode');
        $('#modal_form_unit').modal('hide');


    });


    // $('#save').on('click', function(e) {
    //     e.preventDefault()
    //     var employee_id = $('#employee_id').val();
    //     var item_description = $('#item_description').val();
    //     var id_supplier = $('#id_supplier').val();
    //     var id_unit = $('#id_unit').val();
    //     var id_category = $('#id_category').val();

    //     var remark = $('#remark').val();


    //     if (employee_id !== "" !== "" && id_unit !== "" && id_category !== "") {
    //         $.ajax({
    //             type: "POST",
    //             url: "<?= base_url() ?>Controller_Employee/create",
    //             data: {
    //                 employee_id: employee_id,
    //                 item_description: item_description,
    //                 id_supplier: id_supplier,
    //                 id_unit: id_unit,
    //                 id_category: id_category,

    //                 remark: remark
    //             },
    //             success: function(data) {

    //                 $('#employee_id').val('');
    //                 $('#item_description').val('');
    //                 $('#id_unit').val('');
    //                 $('#id_category').val('');
    //                 $('#unit').val('');


    //                 sukses();

    //             },

    //             error: function(XMLHttpRequest, textStatus, errorThrown) {
    //                 duplikat();
    //             }
    //         });
    //     } else {
    //         $('#employee_id').focus();
    //     }

    // });

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


    function duplikat() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        Toast.fire({
            icon: 'error',
            title: 'Kode Duplikat!'
        })
    }



    function gagal() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        Toast.fire({
            icon: 'error',
            title: 'Data tidak boleh kosong!'
        })
    }
</script>