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


                            <table id="example6" class="table table-hover table-bordered table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th>NO Return</th>
                                        <th>Date out</th>
                                        <th>Person</th>
                                        <th>Department</th>
                                        <th>Remark</th>
                                        <th>Code Item</th>
                                        <th>Item</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Qty</th>

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




<script>
    $(document).ready(function() {
        //call function show all product
        table = $('#example6').DataTable({
            "responsive": true,
            "autoWidth": false,
            "dom": 'Bfrtip',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

            "ajax": {
                url: '<?php echo site_url('Controller_Warehouse/get_data_material_return_all') ?>',
                type: 'POST'
            }
        }).buttons().container().appendTo('#example6_wrapper .col-md-6:eq(0)');
    });
</script>