<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
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
            <div class="row">
                <div class="col-12">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?></div>
                    <?php endif; ?>
                    <?= $this->session->flashdata('message'); ?>




                    <div class="card">


                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-hover table-bordered table-sm" style="width:100%">
                                <thead>
                                    <tr>

                                        <th scope="col">#</th>
                                        <th scope="col">Trim Code</th>
                                        <th scope="col">MO</th>
                                        <th scope="col">Style</th>
                                        <th scope="col">Destination</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">User</th>
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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->






<script type="text/javascript">
    var save_method; //for save method string
    var table;
    var base_url = '<?php echo base_url(); ?>';

    $(document).ready(function() {
        //call function show all product

        table = $('#example1').DataTable({
            "responsive": true,
            "autoWidth": false,


            "ajax": {
                url: '<?php echo site_url('Controller_Purchase/get_data') ?>',
                type: 'POST'
            }

        });
    });




    function add_data() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Data'); // Set Title to Bootstrap modal title
        kd_otomatis();
    }

    function detail_data(id) {

        table = $('#example2').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,

            stateSave: true,
            "bDestroy": true,

            "ajax": {
                url: "<?php echo site_url('Controller_Purchase/detail_trim') ?>/" + id,
                type: 'POST'
            }
        });

        $('#modal-lg').modal('show'); // show bootstrap modal


    }


    function edit_data(id) {
        var a = "<?php echo site_url('Controller_Purchase/edit_trim') ?>/" + id;
        window.location.assign(a);
    }


    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 

    }

    function deleted(id) {
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
                    url: "<?php echo site_url('Controller_Purchase/remove') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        //if success reload ajax table
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        reload_table();
                    }
                });

            }
        })
    }
</script>



<div class="modal fade" id="modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Order Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>item code</th>
                            <th>item description</th>
                            <th>Supplier</th>
                            <th>size</th>
                            <th>color</th>
                            <th>qty</th>
                            <th>remark</th>

                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->