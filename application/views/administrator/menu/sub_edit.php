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
                <div class="card-header">
                    <h3 class="card-title"><?= $title; ?></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <?= $this->session->flashdata('message'); ?>
                            <form action="<?= base_url('menu/sub_edit/'); ?> <?= $subsmenu['id']; ?>" method="post">

                                <div class="form-group">

                                    <label for="title">title</label>
                                    <input type="hidden" class="form-control" id="id" name="id" value='<?= $subsmenu['id']; ?>'>
                                    <input type="text" class="form-control" id="title" name="title" value='<?= $subsmenu['title']; ?>'>
                                    <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="menu_id">menu_id</label>
                                    <input type="text" class="form-control" id="menu_id" name="menu_id" value="<?= $subsmenu['menu_id']; ?>">
                                    <?= form_error('menu_id', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="url">url</label>
                                    <input type="text" class="form-control" id="url" name="url" value="<?= $subsmenu['url']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="icon">icon</label>
                                    <input type="text" class="form-control" id="icon" name="icon" value="<?= $subsmenu['icon']; ?>">
                                </div>


                                <div class="form-group">
                                    <label for="icon"> Status Active</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" placeholder="Icon Name" value="1" checked>
                                        <label class="form-check-label" for="is_active">Active</label>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary btn-sm">edit</button>
                                </div>

                            </form>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
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