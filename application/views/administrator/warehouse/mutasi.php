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

                            <table id="example8" class="table table-hover table-bordered table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">item code</th>
                                        <th scope="col">desc</th>
                                        <th scope="col">color</th>
                                        <th scope="col">size</th>
                                        <th scope="col">request</th>
                                        <th scope="col">purchase</th>
                                        <th scope="col">in</th>
                                        <th scope="col">out</th>
                                        <th scope="col">return</th>
                                        <th scope="col">Stok</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
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
    $(function() {


        $("#example8").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,

            "dom": 'Bfrtip',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "ajax": {
                url: '<?php echo site_url('Controller_Warehouse/get_mutasi') ?>',
                type: 'POST'
            }

        }).buttons().container().appendTo('#example8_wrapper .col-md-6:eq(0)');




    });
</script>