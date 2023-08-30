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



                        <form method="POST" action="<?= base_url('Controller_Item/cari_line/') ?>" enctype="multipart/form-data">


                            <div class="row">
                                <div class="col-md-5">


                                    <div class="form-group">
                                        <!-- /input-group -->
                                        <label for="id_category">LINE</label>
                                        <div class="input-group mb-3">

                                            <input type="text" class="form-control form-control-sm rounded-0" name="linex" id="linex" required>
                                            <span class="input-group-append">
                                                <button class="btn btn-secondary btn-sm" type="button" onclick="cari_line()">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /.row -->

                            <input type="submit" class="btn btn-primary btn-sm" value="view_barcode">
                            <a href="javascript:window.history.go(-1);" class="btn btn-danger btn-sm">back</a>
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




<!-- Modal -->
<div class="modal fade" id="modal_form_line" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <table id="example1" class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Line</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($linex as $sm) : ?>
                                    <tr class="pilih_line" data-id="<?= $sm['linex'] ?>">
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $sm['linex']; ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
    $(function() {

        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        })
    });


    function cari_line() {
        $('#modal_form_line').modal('show'); // show bootstrap modal
        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
    }


    $(document).on('click', '.pilih_line', function(e) {
        document.getElementById("linex").value = $(this).attr('data-id');

        $('#modal_form_line').modal('hide');

    });


    $(document).on('click', '#view_barcode', function(e) {
        idx = $('#linex').val();
        console.log(idx);


    });
</script>