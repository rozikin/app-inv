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

                                    <div class="form-group">
                                        <label for="id_item">Item Code</label>
                                        <input type="hidden" class="form-control form-control-sm" name="id_item"
                                            id="id_item" value="<?= $items['id_item'] ?>">
                                        <input type="hidden" class="form-control form-control-sm" name="remark"
                                            id="remark" value="<?= $items['remark'] ?>">
                                        <input type="text" class="form-control form-control-sm" name="item_code"
                                            id="item_code" placeholder="item code" value="<?= $items['item_code'] ?>"
                                            readonly>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="item_description">Description</label>
                                        <input type="text" class="form-control form-control-sm" name="item_description"
                                            id="item_description" placeholder="description"
                                            value="<?= $items['item_description'] ?>">

                                    </div>
                                    <!-- /.form-group -->

                                    <div class="form-group">
                                        <label for="linex">Line</label>
                                        <input type="text" class="form-control form-control-sm" name="linex" id="linex"
                                            placeholder="line" value="<?= $items['linex'] ?>">

                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" class="form-control form-control-sm" name="status"
                                            id="status" placeholder="status" value="<?= $items['status'] ?>">

                                    </div>



                                    <div class="form-group">
                                        <!-- /input-group -->
                                        <label for="category">Category</label>
                                        <div class="input-group mb-3">
                                            <input type="hidden" class="form-control form-control-sm rounded-0"
                                                name="id_category" id="id_category" value="<?= $items['id_category'] ?>"
                                                readonly>
                                            <input type="text" class="form-control form-control-sm rounded-0"
                                                name="name_category" id="name_category"
                                                value="<?= $items['name_category'] ?>" readonly required>
                                            <span class="input-group-append">
                                                <button class="btn btn-secondary btn-sm" type="button"
                                                    onclick="cari_category()">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <!-- /input-group -->
                                        <label for="unit">Unit</label>
                                        <div class="input-group mb-3">
                                            <input type="hidden" class="form-control form-control-sm rounded-0"
                                                name="id_unit" id="id_unit" value="<?= $items['id_unit'] ?>" readonly>
                                            <input type="text" class="form-control form-control-sm rounded-0"
                                                name="code_unit" id="code_unit" value="<?= $items['unit'] ?>" readonly required>
                                            <span class="input-group-append">
                                                <button class="btn btn-secondary btn-sm" type="button"
                                                    onclick="cari_unit()">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>





                                    <!-- <div class="form-group">

                                     
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

                                    </div> -->



                                </div>
                                <!-- /.col -->


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

function cari_category() {
    $('#modal_form_category').modal('show'); // show bootstrap modal
    $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
}

function cari_unit() {
    $('#modal_form_unit').modal('show'); // show bootstrap modal
    $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
}



$(document).on('click', '.pilih_suppliers', function(e) {
    document.getElementById("id_supplier").value = $(this).attr('data-kode');

    document.getElementById("supplier_name").value = $(this).attr('data-nama');

    $('#modal-lg').modal('hide');
});

$(document).on('click', '.pilih_category', function(e) {
    document.getElementById("id_category").value = $(this).attr('data-id');
    document.getElementById("name_category").value = $(this).attr('data-kode');

    $('#modal_form_category').modal('hide');


});

$(document).on('click', '.pilih_unit', function(e) {
    document.getElementById("id_unit").value = $(this).attr('data-id');
    document.getElementById("code_unit").value = $(this).attr('data-kode');
    $('#modal_form_unit').modal('hide');


});



$(document).on('click', '#edit', function(e) {
    e.preventDefault()
    var id_item = $('#id_item').val();
    var item_code = $('#item_code').val();
    var item_description = $('#item_description').val();
    var id_supplier = $('#id_supplier').val();
    var id_unit = $('#id_unit').val();
    var id_category = $('#id_category').val();
    var linex = $('#linex').val();
    var status = $('#status').val();

    var remark = $('#remark').val();
    var a = "<?php echo site_url('Controller_Item') ?>";
    $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>Controller_Item/update",

        data: {
            id_item: id_item,
            item_code: item_code,
            item_description: item_description,
            id_category: id_category,
            id_supplier: id_supplier,
            id_unit: id_unit,
            remark: remark,
            status: status,
            linex: linex
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




<!-- Modal -->
<div class="modal fade" id="modal_form_unit" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <th>code_unit</th>
                                    <th>description</th>
                                </tr>
                            </thead>

                            <?php $i = 1; ?>
                            <?php foreach ($unit as $sm) : ?>
                            <tr class="pilih_unit" data-id="<?= $sm['id_unit'] ?>" data-kode="<?= $sm['code_unit'] ?>">
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $sm['code_unit']; ?></td>
                                <td><?= $sm['description']; ?></td>

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
<div class="modal fade" id="modal_form_category" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <th>code_category</th>
                                    <th>name_category</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($category as $sm) : ?>
                                <tr class="pilih_category" data-id="<?= $sm['id_category'] ?>"
                                    data-kode="<?= $sm['name_category'] ?>">
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $sm['code_category']; ?></td>
                                    <td><?= $sm['name_category']; ?></td>

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