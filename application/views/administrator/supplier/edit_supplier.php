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
                        <?= form_open_multipart('Controller_Supplier/edit_supplier/' . $supplier['id_supplier']); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Supplier Name</label>
                                    <input type="hidden" class="form-control" name="id_supplier" value="<?= $supplier['id_supplier'] ?>" onfocus="">
                                    <input type="text" class="form-control" name="supplier_name" placeholder="Supplier Name" value="<?= $supplier['supplier_name'] ?>" onfocus="" required>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Supplier Address</label>
                                    <textarea class="form-control" rows="3" name="supplier_address" placeholder="Enter Address ..." value=""><?= $supplier['supplier_address'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Supplier Phone</label>
                                    <input type="text" class="form-control" name="supplier_phone" placeholder="Supplier Phone" value="<?= $supplier['supplier_phone'] ?>" required>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fax</label>
                                    <input type="text" class="form-control" name="supplier_fax" placeholder="Supplier Fax" value="<?= $supplier['supplier_fax'] ?>">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" name="supplier_email" placeholder="Supplier Email" value="<?= $supplier['supplier_email'] ?>">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">supplier_attention</label>
                                    <input type="text" class="form-control" name="supplier_attention" value="<?= $supplier['supplier_attention'] ?>">
                                </div>
                                <div class=" form-group">
                                    <label for="remark">Remark</label>
                                    <select class="form-control form-control-sm select2" style="width: 100%;" name="remark" id="remark">
                                        <option <?php if ($supplier['remark'] == "Local") {
                                                    echo 'selected';
                                                } ?> value="Local">Local</option>
                                        <option <?php if ($supplier['remark'] == "Import") {
                                                    echo 'selected';
                                                } ?> value="Import">Import</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->

                        <button type="submit" class="btn btn-primary btn-sm">Save</button>

                        <a href="<?= base_url('Controller_Supplier'); ?>" class="btn btn-danger btn-sm">back</a>

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