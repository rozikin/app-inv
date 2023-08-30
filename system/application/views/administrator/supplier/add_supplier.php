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
                        <?= form_open_multipart('Controller_Supplier/add_data'); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Supplier Name</label>
                                    <input type="text" class="form-control" name="supplier_name" placeholder="name"
                                        onfocus="" required>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Supplier Address</label>
                                    <textarea class="form-control" rows="3" name="supplier_address"
                                        placeholder="Enter Address ..."></textarea>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">

                                    <!-- /input-group -->
                                    <label for="exampleInputEmail1">Supplier Phone</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control rounded-0" name="supplier_phone"
                                            id="supplier_phone" placeholder="phone" required>

                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Supplier Fax</label>
                                    <input type="text" class="form-control" name="supplier_fax" placeholder="fax">
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">

                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">supplier_email</label>
                                    <input type="text" class="form-control" name="supplier_email" placeholder="email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">supplier_attention</label>
                                    <input type="text" class="form-control" name="supplier_attention"
                                        placeholder="supplier_attention">
                                </div>
                                <div class=" form-group">
                                    <label for="exampleInputEmail1">VAT</label>
                                    <input type="text" class="form-control" name="remark" placeholder="VAT">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->

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

















<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">




                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Supplier Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1; ?>
                        <?php foreach ($supplier as $m) : ?>
                        <tr class="pilih_suppliers" data-kode="<?= $m['id_supplier'] ?>"
                            data-nama="<?= $m['supplier_name'] ?>">
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['supplier_name']; ?></td>
                            <td><?= $m['supplier_address']; ?></td>
                            <td><?= $m['supplier_phone']; ?></td>
                            <td><?= $m['supplier_email']; ?></td>


                        </tr>

                        <?php $i++; ?>
                        <?php endforeach; ?>



                    </tbody>

                </table>






            </div>
            <!-- <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->