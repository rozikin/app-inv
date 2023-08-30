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
                        <div class="card-header">

                            <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i
                                    class="fas fa-plus"></i> Add</a>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>

                                        <th scope="col">#</th>
                                        <th scope="col">Size Code</th>
                                        <th scope="col">Size Description</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($size as $m) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $m['size_code']; ?></td>
                                        <td><?= $m['size_description']; ?></td>
                                        <td>
                                            <a href="#edit_<?= $m['id_size']; ?>" class="badge badge-success"
                                                data-toggle="modal"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="#delete_<?= $m['id_size']; ?>" class="badge badge-danger"
                                                data-toggle="modal"><i class="fas fa-trash"></i> Delete</a>
                                        </td>

                                    </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
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

    $("#example1").DataTable({
        "responsive": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

});
</script>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Controller_Size'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Size Code</label>
                        <input type="text" class="form-control" id="size_code" name="size_code" placeholder="Size Code">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Size Description</label>
                        <input type="text" class="form-control" id="size_description" name="size_description"
                            placeholder="Size Description">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i
                            class="fas fa-window-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php foreach ($size as $x) : ?>
<!-- Delete -->
<div class="modal fade" id="delete_<?= $x['id_size']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Delete</p>
                <h2 class="text-center"><?= $x['id_size'] . ' ' . $x['size_code']; ?></h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"><i
                        class="fas fa-window-close"></i> Cancel</button>

                <a href="<?= base_url(); ?>Controller_Size/delete_size/<?= $x['id_size']; ?>"
                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></span> Yes</a>
            </div>

        </div>
    </div>
</div>
<?php endforeach; ?>


<?php foreach ($size as $xr) : ?>
<div class="modal fade" id="edit_<?= $xr['id_size']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Controller_Size/edit_size/'); ?><?= $xr['id_size']; ?>" method="post">
                <div class="modal-body">

                    <div class="form-group">

                        <!-- <label for="id">id</label> -->

                        <input type='hidden' class="form-control" id="id_size" name="id_size"
                            value='<?= $xr['id_size']; ?>' readonly>
                        <?= form_error('id_size', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="menu">size Code</label>
                        <input type="text" class="form-control" id="size_code" name="size_code"
                            value="<?= $xr['size_code']; ?>">
                        <?= form_error('size_code', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="menu">size</label>
                        <input type="text" class="form-control" id="size_description" name="size_description"
                            value="<?= $xr['size_description']; ?>">
                        <?= form_error('size_description', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php endforeach; ?>