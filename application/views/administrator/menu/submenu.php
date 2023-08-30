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
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Menu</th>
                                        <th>Url</th>
                                        <th>icon</th>
                                        <th>Active</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($submenu as $sm) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $sm['title']; ?></td>
                                        <td><?= $sm['menu']; ?></td>
                                        <td><?= $sm['url']; ?></td>
                                        <td><?= $sm['icon']; ?></td>
                                        <td><?= $sm['is_active']; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>menu/sub_edit/<?= $sm['id']; ?>"
                                                class="badge badge-success"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="#delete_<?= $sm['id']; ?>" class="badge badge-danger"
                                                data-toggle='modal'><i class="fas fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Menu</th>
                                        <th>Url</th>
                                        <th>icon</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
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
        "responsive": true,
        "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="title Name"
                            required>

                    </div>
                    <div class="form-group">
                        <label for="menu">Menu</label>
                        <select name="menu_id" id="menu_id" class="form-control" required>
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="url">url</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="url Name" required>

                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon Name" required>

                    </div>

                    <div class="form-group">
                        <label for="icon"> Status Active</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                placeholder="Icon Name" value="1" checked>
                            <label class="form-check-label" for="is_active">Active</label>

                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i
                            class="fas fa-window-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-sm"> <i class="fas fa-save"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php foreach ($submenu as $sm) : ?>
<!-- Modal edit -->
<div class="modal fade" id="edit_<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/edit_submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="title Name"
                            value=<?= $sm['title']; ?>>

                    </div>
                    <div class="form-group">
                        <label for="menu">Menu</label>
                        <select name="menu_id" id="menu_id" class="form-control" required>
                            <option value="<?= $sm['id']; ?>"><?= $sm['menu']; ?></option>

                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>

                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="url">url</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="url Name"
                            value=<?= $sm['url']; ?> required>

                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon Name"
                            value=<?= $sm['icon']; ?> required>

                    </div>

                    <div class="form-group">
                        <label for="icon"> Status Active</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                placeholder="Icon Name" value="1" checked>
                            <label class="form-check-label" for="is_active">Active</label>

                        </div>
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


<?php foreach ($submenu as $sm) : ?>
<!-- Delete -->
<div class="modal fade" id="delete_<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Delete</p>
                <h2 class="text-center"><?= $sm['title'] . ' ' . $sm['url']; ?></h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><span
                        class="glyphicon glyphicon-remove"></span> Cancel</button>

                <a href="<?= base_url(); ?>Menu/hapus_submenu/<?= $sm['id']; ?>" class="btn btn-danger"><span
                        class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>
<?php endforeach; ?>