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


                        <form>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="id_item">Item Code</label>
                                            <input type="hidden" class="form-control form-control-sm" name="id_item" id="id_item" value="<?= $items['id_item'] ?>">
                                            <input type="text" class="form-control form-control-sm" name="item_code" id="item_code" placeholder="item code" value="<?= $items['item_code'] ?>">
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="item_description">Description</label>
                                            <input type="text" class="form-control form-control-sm" name="item_description" id="item_description" placeholder="description" value="<?= $items['item_description'] ?>">

                                        </div>
                                        <!-- /.form-group -->

                                        <div class="form-group">
                                            <label for="item_price">price</label>
                                            <input type="text" class="form-control form-control-sm" name="item_price" id="item_price" placeholder="price" value="<?= $items['item_price'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Currency</label>
                                                <select class="form-control form-control-sm select2" style="width: 100%;" name="currency" id="currency">
                                                    <option <?php if ($items['currency'] == "idr") {
                                                                echo 'selected';
                                                            } ?> value="idr">IDR</option>
                                                    <option <?php if ($items['currency'] == "usd") {
                                                                echo 'selected';
                                                            } ?> value="usd">USD</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="unit">Unit</label>
                                            <input type="text" class="form-control form-control-sm" name="unit" id="unit" placeholder="unit" value="<?= $items['unit'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="col-md-8">

                                        <div class=" form-group">
                                            <label for="remark">Remark</label>
                                            <select class="form-control form-control-sm select2" style="width: 100%;" name="remark" id="remark">
                                                <option <?php if ($items['remark'] == "Local") {
                                                            echo 'selected';
                                                        } ?> value="Local">Local</option>
                                                <option <?php if ($items['remark'] == "Import") {
                                                            echo 'selected';
                                                        } ?> value="Import">Import</option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->

                                        <div class="form-group">

                                            <!-- /input-group -->
                                            <label for="id_supplier">Supplier</label>
                                            <div class="input-group mb-3">
                                                <input type="hidden" class="form-control form-control-sm rounded-0" name="id_supplier" id="id_supplier" readonly value="<?= $items['id_supplier'] ?>">
                                                <input type="text" class="form-control form-control-sm rounded-0" name="supplier_name" id="supplier_name" value="<?= $items['supplier_name'] ?>" readonly>
                                                <span class=" input-group-append">
                                                    <button class="btn btn-secondary btn-sm" type="button" onclick="cari_supplier()">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <!-- /input-group -->
                                            <label for="id_supplier">Size</label>
                                            <div class="input-group mb-3">
                                                <input type="hidden" class="form-control form-control-sm rounded-0" name="id_size" id="id_size" value="<?= $items['id_size'] ?>" readonly>
                                                <input type="text" class="form-control form-control-sm rounded-0" name="size_code" id="size_code" value="<?= $items['size_code'] ?>" onclick="cari_size()" readonly>
                                                <span class="input-group-append">
                                                    <button class="btn btn-secondary btn-sm" type="button" onclick="cari_size()">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!-- /input-group -->
                                            <label for="id_supplier">Color</label>
                                            <div class="input-group mb-3">
                                                <input type="hidden" class="form-control form-control-sm rounded-0" name="id_color" id="id_color" value="<?= $items['id_color'] ?>" readonly>
                                                <input type="text" class="form-control form-control-sm rounded-0" name="color_code" id="color_code" value="<?= $items['color'] ?>" readonly>
                                                <span class="input-group-append">
                                                    <button class="btn btn-secondary btn-sm" type="button" onclick="cari_color()">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->

                            </div>
                    </div>
                    <!-- /.row -->

                    <button type="submit" class="btn btn-primary btn-sm" id="edit">Save</button>

                    <a href="<?= base_url('Controller_Item'); ?>" class="btn btn-danger btn-sm">back</a>

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
            "autoWidth": false
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

    function cari_supplier() {
        $('#modal-lg').modal('show'); // show bootstrap modal
        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
    }

    function cari_size() {
        $('#modal_form_size').modal('show'); // show bootstrap modal
        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
    }

    function cari_color() {
        $('#modal_form_color').modal('show'); // show bootstrap modal
        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
    }

    $(document).on('click', '.pilih_suppliers', function(e) {
        document.getElementById("id_supplier").value = $(this).attr('data-kode');

        document.getElementById("supplier_name").value = $(this).attr('data-nama');

        $('#modal-lg').modal('hide');
    });

    $(document).on('click', '.pilih_color_c1', function(e) {
        document.getElementById("id_color").value = $(this).attr('data-id');
        document.getElementById("color_code").value = $(this).attr('data-kode');

        $('#modal_form_color').modal('hide');
    });

    $(document).on('click', '.pilih_size_c1', function(e) {
        document.getElementById("id_size").value = $(this).attr('data-id');
        document.getElementById("size_code").value = $(this).attr('data-kode');

        $('#modal_form_size').modal('hide');
    });


    $(document).on('click', '#edit', function(e) {
        e.preventDefault()
        var id_item = $('#id_item').val();
        var item_code = $('#item_code').val();
        var item_description = $('#item_description').val();
        var id_supplier = $('#id_supplier').val();
        var id_size = $('#id_size').val();
        var id_color = $('#id_color').val();
        var item_price = $('#item_price').val();
        var currency = $('#currency').val();
        var unit = $('#unit').val();
        var remark = $('#remark').val();
        var a = "<?php echo site_url('Controller_Item') ?>";
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>Controller_Item/update",

            data: {
                id_item: id_item,
                item_code: item_code,
                item_description: item_description,
                id_supplier: id_supplier,
                id_size: id_size,
                id_color: id_color,
                item_price: item_price,
                currency: currency,
                unit: unit,
                remark: remark
            },
            success: function(data) {
                sukses();

                window.location.assign(a);

            }
        });
    });



    function sukses() {

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });


        Toast.fire({
            icon: 'success',
            title: 'Data Berhasil Di update'
        })



    }
</script>



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
                            <tr class="pilih_suppliers" data-kode="<?= $m['id_supplier'] ?>" data-nama="<?= $m['supplier_name'] ?>">
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



<!-- Modal -->
<div class="modal fade" id="modal_form_size" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
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
                                    <th>Size</th>
                                </tr>
                            </thead>

                            <?php $i = 1; ?>
                            <?php foreach ($size as $sm) : ?>
                                <tr class="pilih_size_c1" data-id="<?= $sm['id_size'] ?>" data-kode="<?= $sm['size_code'] ?>">
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $sm['size_code']; ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_form_color" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
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
                                    <th>Color</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($color as $sm) : ?>
                                    <tr class="pilih_color_c1" data-id="<?= $sm['id_color'] ?>" data-kode="<?= $sm['color_code'] ?>">
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $sm['color_code']; ?></td>

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