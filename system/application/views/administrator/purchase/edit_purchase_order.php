<style>
.form-control-xs {
    height: calc(1em + .375rem + 5px) !important;
    padding: .125rem .25rem !important;
    font-size: .75rem !important;
    line-height: 1.5;
    border-radius: .2rem;
}

.btn-xs {
    height: calc(1em + .375rem + 3px) !important;
    padding: .125rem .25rem !important;
    font-size: .75rem !important;
    line-height: 1.5;
    border-radius: .2rem;
}
</style>


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





    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">



                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">

                        <div class="text-center">
                            <h5> TIMW MATERIAL ORDER</h5>
                        </div>
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>

                                    <small class="float-right">Date: <?= date('d/m/Y');?></small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <?= form_open_multipart('controller_trimsorder/create'); ?>
                        <div class="row invoice-info">
                            <div class="col-sm-8 invoice-col">

                                <div class="form-group row mb-1">
                                    <label for="trim_code" class="col-sm-4 col-form-label">Trim Code</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control form-control-sm" id="trim_code"
                                            name="trim_code" placeholder="trim_code" value="<?= $trimx['trim_code']?>"
                                            required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label for="trim_style" class="col-sm-4 col-form-label">Style</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control form-control-sm" id="trim_style"
                                            name="trim_style" placeholder="style" value="<?= $trimx['trim_style']?>"
                                            required>
                                    </div>
                                </div>
                                <div class=" form-group row mb-1">
                                    <label for="destination" class="col-sm-4 col-form-label">destination</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control form-control-sm" id="trim_destination"
                                            name="trim_destination" placeholder="destination"
                                            value="<?= $trimx['trim_destination']?>" required>
                                    </div>
                                </div>

                                <div class=" form-group row mb-1">
                                    <label for="style" class="col-sm-4 col-form-label">Trim Status</label>
                                    <div class="col-sm-5">
                                        <select class="form-control form-control-sm select2" name="trim_status"
                                            id="trim_status">
                                            <option selected="selected" value="Request">Request</option>
                                            <option value="Aprove">Aprove</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row mb-1">
                                    <label for="req_date" class="col-sm-4 col-form-label">Req Date</label>
                                    <div class="col-sm-5">
                                        <!-- Date -->
                                        <div class="form-group">

                                            <div class="input-group date input-group-sm" id="reservationdate"
                                                data-target-input="nearest">
                                                <input type="text"
                                                    class="form-control form-control-sm datetimepicker-input"
                                                    data-target="#reservationdate" name="trim_date" id="trim_date"
                                                    value="<?= $trimx['trim_date']?>" />
                                                <div class="input-group-append" data-target="#reservationdate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->


                                <div class="form-group row">
                                    <label for="style" class="col-sm-4 col-form-label">Remark</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="3" name="trim_remark"
                                            id="trim_remark"><?= $trimx['remark']?></textarea>
                                    </div>
                                </div>


                            </div>

                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row mb-5">


                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
                                <button class="btn btn-danger delete btn-sm" id="removeRows" type="button">-
                                    Delete</button>
                                <button class="btn btn-success btn-sm" id="addRows" type="button">+ Add
                                    More</button>
                            </div>

                            <br />


                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <table class="table table-bordered table-hover table-sm" id="invoiceItem">
                                            <tr>
                                                <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox">
                                                </th>

                                                <th width="10%">Code Item</th>
                                                <th width="10%">Source</th>
                                                <th width="20%">Description</th>
                                                <th width="20%">Supplier</th>
                                                <th width="10%">Size</th>
                                                <th width="10%">Color</th>
                                                <th width="15%">Qty</th>
                                                <th>Remark</th>

                                            </tr>


                                            <?php $bb = 2; $i = $bb; ?>

                                            <?php foreach ($trimdetil as $ft2) : ?>

                                            <?php

                                                $id_itm = 'a' . $i;
                                                $code_itm = 'b' . $i;
                                                $src = 'c' . $i;
                                                $desc = 'd' . $i;
                                                $sup = 'e' . $i;
                                                $id_siz = 'f' . $i;
                                                $siz = 'g' . $i;
                                                $id_color = 'h' . $i;
                                                $color = 'i' . $i;
                                                $qty = 'j' . $i;
                                                ?>




                                            <tr>
                                                <td><input class="itemRow" type="checkbox"></td>

                                                <td>
                                                    <div class="input-group">
                                                        <input type="hidden" name="id_item[]" id="id_item_1">
                                                        <input type="text" name="item_code[]"
                                                            id="<?php echo  $code_itm; ?>"
                                                            class="form-control  form-control-xs" autocomplete="off"
                                                            value="<?= $ft2['item_code']?>" required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary btn-xs" type="button"
                                                                onclick="cari_item()">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="item_source[]" id="<?php echo  $src; ?>"
                                                        class="form-control  form-control-xs" autocomplete="off"
                                                        value="<?= $ft2['item_remark']?>" readonly>

                                                </td>
                                                <td>

                                                    <input type="text" name="item_description[]"
                                                        id="<?php echo  $desc; ?>" class="form-control  form-control-xs"
                                                        autocomplete="off" value="<?= $ft2['item_description']?>"
                                                        readonly>

                                                </td>
                                                <td>

                                                    <input type="text" name="supplier_name[]" id="<?php echo  $sup; ?>"
                                                        class="form-control  form-control-xs"
                                                        value="<?= $ft2['supplier_name']?>" autocomplete=" off"
                                                        readonly>

                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="hidden" name="id_size[]" id="id_size_1">
                                                        <input type="text" name="size_code[]" id="<?php echo  $sup; ?>"
                                                            class="form-control  form-control-xs"
                                                            value="<?= $ft2['size_code']?>" autocomplete=" off"
                                                            required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary btn-xs" type="button"
                                                                onclick="cari_size()">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="hidden" name="id_color[]" id="id_color_1">
                                                        <input type="text" name="color_code[]"
                                                            id="<?php echo  $color; ?>"
                                                            class="form-control  form-control-xs"
                                                            value="<?= $ft2['color_code']?>" autocomplete="off"
                                                            required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary btn-xs" type="button"
                                                                onclick="cari_color()">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>

                                                    <input type="text" name="qty[]" id="<?php echo  $qty; ?>"
                                                        class="form-control  form-control-xs" autocomplete="off"
                                                        value="<?= $ft2['qty']?>" required>

                                                </td>
                                                <td>

                                                    <input type="text" name="remark[]" id="remark_1"
                                                        class="form-control  form-control-xs" autocomplete="off"
                                                        value="<?= $ft2['remark']?>">

                                                </td>
                                            </tr>


                                            <?php endforeach; ?>

                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- /.row -->



                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">

                                <a href="<?= base_url('controller_trimsorder')?>"
                                    class="btn btn-success float-right">Back</a>
                                <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->

                    </form>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->


<script text="text/javascript">
$(document).ready(function() {
    $(document).on('click', '#checkAll', function() {
        $(".itemRow").prop("checked", this.checked);
    });
    $(document).on('click', '.itemRow', function() {
        if ($('.itemRow:checked').length == $('.itemRow').length) {
            $('#checkAll').prop('checked', true);
        } else {
            $('#checkAll').prop('checked', false);
        }
    });
    var count = $(".itemRow").length;
    $(document).on('click', '#addRows', function() {
        count++;
        var htmlRows = '';
        htmlRows += '<tr>';
        htmlRows += '<td> <input class="itemRow" type="checkbox"></td>';


        htmlRows +=
            '<td> <input type="text" name="id_item[]" id="id_item1_ok' + count +
            '" class="form-control form-control-xs" autocomplete="off" readonly> <div class="input-group"> <input type="text" name="item_code1[]" id="item_code1_ok' +
            count +
            '" class="form-control form-control-xs" autocomplete="off" required> <div class="input-group-append"> <button class="btn btn-secondary btn-xs" type="button" onclick="cari_item_c2()"><i class="fa fa-search"></i></button></div></div></td>';

        htmlRows += '<td>  <input type="text" name="item_source[]" id="item_source1_ok' + count +
            '" class="form-control form-control-xs" autocomplete="off" readonly> </td>';
        htmlRows += '<td>  <input type="text" name="item_description1[]" id="item_description1_ok' +
            count +
            '" class="form-control form-control-xs" autocomplete="off" readonly> </td>';

        htmlRows += '<td>  <input type="text" name="supplier_name[]" id="supplier_name1_ok' + count +
            '" class="form-control form-control-xs" autocomplete="off" readonly> </td>';

        htmlRows +=
            '<td><input type="text" name="id_size[]" id="id_size1_ok' + count +
            '" class="form-control form-control-xs" autocomplete="off" readonly> <div class="input-group"> <input type="text" name="size_code1[]" id="size_code1_ok' +
            count +
            '" class="form-control form-control-xs" autocomplete="off" required> <div class="input-group-append"> <button class="btn btn-secondary btn-xs" type="button" onclick="cari_size_c2()"><i class="fa fa-search"></i></button></div></div></td>';

        htmlRows +=
            '<td><input type="text" name="id_color[]" id="id_color1_ok' + count +
            '" class="form-control form-control-xs" autocomplete="off" readonly> <div class="input-group"> <input type="text" name="color_code1[]" id="color_code1_ok' +
            count +
            '" class="form-control form-control-xs" autocomplete="off" required> <div class="input-group-append"> <button class="btn btn-secondary btn-xs" type="button" onclick="cari_color_c2()"><i class="fa fa-search"></i></button></div></div></td>';

        htmlRows += '<td>  <input type="text" name="qty[]" id="qty1_ok' + count +
            '" class="form-control form-control-xs" autocomplete="off"> </td>';
        htmlRows += '<td>  <input type="text" name="remark[]" id="remark1_ok' + count +
            '" class="form-control form-control-xs" autocomplete="off"> </td>';

        htmlRows += '</tr>';
        $('#invoiceItem').append(htmlRows);
    });
    $(document).on('click', '#removeRows', function() {
        $(".itemRow:checked").each(function() {
            $(this).closest('tr').remove();
        });
        $('#checkAll').prop('checked', false);
        // calculateTotal();
    });


    $(document).on('click', '.pilih_code_c2', function(e) {

        document.getElementById("id_item1_ok" + count).value = $(this).attr('data-id');
        document.getElementById("item_code1_ok" + count).value = $(this).attr('data-kode');
        document.getElementById("item_description1_ok" + count).value = $(this).attr('data-nama');
        document.getElementById("supplier_name1_ok" + count).value = $(this).attr('data-supplier');
        document.getElementById("item_source1_ok" + count).value = $(this).attr('data-source');

        $('#modal_form_item_c2').modal('hide');
    });

    $(document).on('click', '.pilih_size_c2', function(e) {
        document.getElementById("id_size1_ok" + count).value = $(this).attr('data-id');
        document.getElementById("size_code1_ok" + count).value = $(this).attr('data-kode');

        $('#modal_form_size_c2').modal('hide');
    });

    $(document).on('click', '.pilih_color_c2', function(e) {
        document.getElementById("id_color1_ok" + count).value = $(this).attr('data-id');
        document.getElementById("color_code1_ok" + count).value = $(this).attr('data-kode');

        $('#modal_form_color_c2').modal('hide');
    });



    $(document).on('click', '.pilih_color_c1', function(e) {
        document.getElementById("id_color_1").value = $(this).attr('data-id');
        document.getElementById("color_code_1").value = $(this).attr('data-kode');

        $('#modal_form_color').modal('hide');
    });


    $(document).on('click', '.pilih_code_c1', function(e) {

        document.getElementById("id_item_1").value = $(this).attr('data-id');
        document.getElementById("item_code_1").value = $(this).attr('data-kode');
        document.getElementById("item_description_1").value = $(this).attr('data-nama');
        document.getElementById("supplier_name_1").value = $(this).attr('data-supplier');
        document.getElementById("item_source_1").value = $(this).attr('data-source');

        $('#modal_form_item').modal('hide');
    });


    $(document).on('click', '.pilih_size_c1', function(e) {
        document.getElementById("id_size_1").value = $(this).attr('data-id');
        document.getElementById("size_code_1").value = $(this).attr('data-kode');

        $('#modal_form_size').modal('hide');
    });






    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


    $(document).on('click', '.deleteInvoice', function() {
        var id = $(this).attr("id");
        if (confirm("Are you sure you want to remove this?")) {
            $.ajax({
                url: "action.php",
                method: "POST",
                dataType: "json",
                data: {
                    id: id,
                    action: 'delete_invoice'
                },
                success: function(response) {
                    if (response.status == 1) {
                        $('#' + id).closest("tr").remove();
                    }
                }
            });
        } else {
            return false;
        }
    });
});




function cari_item() {
    $('#modal_form_item').modal('show'); // show bootstrap modal
    $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
}


function cari_item_c2() {
    $('#modal_form_item_c2').modal('show'); // show bootstrap modal
    $('.modal-title').text('Search dataxx'); // Set Title to Bootstrap modal title
}

function cari_size() {
    $('#modal_form_size').modal('show'); // show bootstrap modal
    $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
}



function cari_size_c2() {
    $('#modal_form_size_c2').modal('show'); // show bootstrap modal
    $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
}



function cari_color() {
    $('#modal_form_color').modal('show'); // show bootstrap modal
    $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
}



function cari_color_c2() {
    $('#modal_form_color_c2').modal('show'); // show bootstrap modal
    $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
}
</script>



<!-- Modal -->
<div class="modal fade" id="modal_form_item" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <th>Item Code</th>
                                    <th>Description</th>
                                    <th>Section</th>
                                    <th>Supplier</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($item as $sm) : ?>
                                <tr class="pilih_code_c1" data-id="<?= $sm['id_item'] ?>"
                                    data-kode="<?= $sm['item_code'] ?>" data-nama="<?= $sm['item_description'] ?>"
                                    data-source="<?= $sm['remark'] ?>" data-supplier="<?= $sm['supplier_name'] ?>">
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $sm['item_code']; ?></td>
                                    <td><?= $sm['item_description']; ?></td>
                                    <td><?= $sm['remark']; ?></td>
                                    <td><?= $sm['supplier_name']; ?></td>
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
                            <tr class="pilih_size_c1" data-id="<?= $sm['id_size'] ?>"
                                data-kode="<?= $sm['size_code'] ?>">
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
                                <tr class="pilih_color_c1" data-id="<?= $sm['id_color'] ?>"
                                    data-kode="<?= $sm['color_code'] ?>">
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






<!-- Modal -->
<div class="modal fade" id="modal_form_item_c2" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <th>Item Code</th>
                                    <th>Description</th>
                                    <th>Section</th>
                                    <th>Supplier</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($item as $sm) : ?>
                                <tr class="pilih_code_c2" data-id="<?= $sm['id_item'] ?>"
                                    data-kode="<?= $sm['item_code'] ?>" data-nama="<?= $sm['item_description'] ?>"
                                    data-source="<?= $sm['remark'] ?>" data-supplier="<?= $sm['supplier_name'] ?>">
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $sm['item_code']; ?></td>
                                    <td><?= $sm['item_description']; ?></td>
                                    <td><?= $sm['remark']; ?></td>
                                    <td><?= $sm['supplier_name']; ?></td>
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

<!-- Modal -->
<div class="modal fade" id="modal_form_size_c2" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <tr class="pilih_size_c2" data-id="<?= $sm['id_size'] ?>"
                                data-kode="<?= $sm['size_code'] ?>">
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
<div class="modal fade" id="modal_form_color_c2" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <tr class="pilih_color_c2" data-id="<?= $sm['id_color'] ?>"
                                    data-kode="<?= $sm['color_code'] ?>">
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