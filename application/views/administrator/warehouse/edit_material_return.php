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
                            <h5 class="font-weight-bold"> Edit Material Return</h5>
                        </div>
                        <!-- title row -->

                        <!-- info row -->
                        <?= form_open_multipart('Controller_Warehouse/updates_return'); ?>
                        <div class="row invoice-info mt-5">


                            <div class="container">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row mb-1">
                                            <label for="id_in" class="col-sm-4 col-form-label">NO Return</label>
                                            <div class="col-sm-5">
                                                <input type="hidden" class="form-control form-control-sm" id="id_return" name="id_return" value="<?= $po['id_return'] ?>" required autofocus>

                                                <input type="text" class="form-control form-control-sm" id="no_return" name="no_return" value="<?= $po['no_return'] ?>" required autofocus>
                                            </div>
                                        </div>


                                        <div class="form-group row mb-1">
                                            <label for="reservationdatetime" class="col-sm-4 col-form-label">Date</label>
                                            <div class="col-sm-5">
                                                <!-- Date -->
                                                <div class="form-group">

                                                    <div class="input-group date input-group-sm" id="reservationdatetime" data-target-input="nearest">
                                                        <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#reservationdatetime" name="date_return" value="<?= $po['date'] ?>" id="date_return" required />
                                                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row mb-1">
                                            <label for="person" class="col-sm-4 col-form-label">Person</label>
                                            <div class="col-sm-5">

                                                <input type="text" class="form-control form-control-sm" id="person" name="person" value="<?= $po['person'] ?>">
                                            </div>
                                        </div>






                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row mb-1">
                                            <label for="department" class="col-sm-4 col-form-label">department</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="department" name="department" value="<?= $po['department'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="mo" class="col-sm-4 col-form-label">mo</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="mo" name="mo" value="<?= $po['mo'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="style" class="col-sm-4 col-form-label">style</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="style" name="style" value="<?= $po['style'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="remark" class="col-sm-4 col-form-label">Remark</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="remark" name="remark1" value="<?= $po['remark'] ?>">
                                            </div>
                                        </div>


                                        <!-- /.col -->

                                    </div>
                                </div>
                            </div>


                            <!-- /.row -->

                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
                                            <button class="btn btn-danger delete btn-sm" id="removeRows" type="button">-
                                                Delete</button>
                                            <button class="btn btn-success btn-sm" id="addRows" type="button">+ Add
                                                More</button>
                                        </div>


                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-sm-12">
                                                    <table class="table table-bordered table-hover table-sm" style="width:100%" id="invoiceItem">
                                                        <tr>
                                                            <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                                            <th width="10%">Code</th>
                                                            <th width="15%">Description</th>
                                                            <th width="10%">Color</th>
                                                            <th width="5%">Size</th>
                                                            <th width="10%">Unit</th>
                                                            <th width="10%">Qty</th>
                                                            <th width="10%">Remark</th>


                                                        </tr>
                                                        <!-- <tbody> -->
                                                        <?php $bb = 2;
                                                        $i = $bb; ?>
                                                        <?php foreach ($podetil as $ft2) : ?>
                                                            <?php

                                                            $id_itm = 'a' . $i;
                                                            $code_itm = 'b' . $i;
                                                            $detil = 'c' . $i;
                                                            $qty = 'e' . $i;
                                                            $price = 'd' . $i;
                                                            $total_price = 'k' . $i;
                                                            $color = 'l' . $i;
                                                            $size = 'm' . $i;
                                                            $unit = 'n' . $i;
                                                            $remark = 'o' . $i;



                                                            $ax = $ft2['item_description'];
                                                            $bx = $ft2['size'];
                                                            $cx = $ft2['color'];
                                                            $dx = $ft2['remark'];
                                                            $ex = $ft2['supplier_name'];


                                                            $fx = $ax;

                                                            ?>

                                                            <tr class="po-item">
                                                                <td><input class="itemRow" type="checkbox"></td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <input type="hidden" name="id_item[]" id="<?php echo  $id_itm; ?>" value="<?= $ft2['id_item'] ?>">
                                                                        <input type="text" name="item_code[]" id="<?php echo  $code_itm; ?>" class="form-control   form-control-xs" onclick="cari_item()" autocomplete="off" value="<?= $ft2['item_code'] ?>" required>

                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  form-control-xs" id="<?php echo  $detil; ?>" value="<?= $fx; ?>" id="item_detail" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="color[]" id="<?php echo  $color; ?>" value="<?= $ft2['color'] ?>" class="form-control  form-control-xs" autocomplete="off">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="size[]" id="<?php echo  $size; ?>" value="<?= $ft2['size'] ?>" class="form-control  form-control-xs" autocomplete="off">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="unit[]" id="<?php echo  $unit; ?>" value="<?= $ft2['unit'] ?>" class="form-control  form-control-xs" autocomplete="off" required>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="qty[]" id="<?php echo  $qty; ?>" value="<?= $ft2['qty'] ?>" class="form-control  form-control-xs" autocomplete="off" required>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="remark[]" id="<?php echo  $remark; ?>" value="<?= $ft2['remark'] ?>" class="form-control  form-control-xs" autocomplete="off">
                                                                </td>


                                                            </tr>
                                                            <!-- </tbody> -->


                                                            <label class="text-white"><?php echo $i++; ?></label>
                                                        <?php endforeach; ?>
                                                    </table>

                                                    <div class="row mb-5 mt-5">

                                                        <input type="hidden" name="cek[]" id="cek" class="form-control  form-control-sm" autocomplete="off" readonly>

                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->




                                </div>

                                <!-- /.row -->
                                <div class="row no-print">
                                    <div class="col-12">

                                        <a href="<?= base_url('Controller_Warehouse/material_return') ?>" class="btn btn-success float-right">Back</a>
                                        <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                                            <i class="fas fa-download"></i> Save
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <!-- Table row -->


                        </form>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->


<script text="text/javascript">
    $('#invoiceItem').find('tr').click(function() {
        var aa = ($(this).index() + 1);
        // alert('You clicked row ' + aa);
        var ab = aa;
        document.getElementById("cek").value = aa;

    });


    $(document).ready(function() {

        // kd_otomatis();


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
            // htmlRows += '<tbody>';
            htmlRows += '<tr class="po-item">';
            htmlRows += '<td> <input class="itemRow" type="checkbox"></td>';


            htmlRows +=
                '<td> <input type="hidden" name="id_item[]" id="id_item1_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off" readonly> <div class="input-group"> <input type="text" name="item_code1[]" id="item_code1_ok' +
                count +
                '" class="form-control form-control-xs" autocomplete="off" onclick="cari_item_c2()" required> </div></td>';

            htmlRows += '<td>  <input type="text" name="item_source[]" id="item_detail_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off" readonly> </td>';


            htmlRows += '<td id="hehe">  <input type="text" name="color[]" id="color1_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off"> </td>';

            htmlRows += '<td id="hehe">  <input type="text" name="size[]" id="size1_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off"> </td>';

            htmlRows += '<td id="hehe">  <input type="text" name="unit[]" id="unit1_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off"> </td>';


            htmlRows += '<td id="hehe">  <input type="text" name="qty[]" id="qty1_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off" "> </td>';

            htmlRows += '<td id="hehe">  <input type="text" name="remark[]" id="remark1_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off" "> </td>';




            // htmlRows +=
            //     '<td class="total-price">0</td>';

            htmlRows += '</tr>';
            // htmlRows += '</tbody>';
            $('#invoiceItem').append(htmlRows);



        });
        $(document).on('click', '#removeRows', function() {
            $(".itemRow:checked").each(function() {
                $(this).closest('tr').remove();
                // calculate();
            });
            $('#checkAll').prop('checked', false);
            // calculateTotal();
        });

        $(document).on('click', '.pilih_code_c2', function(e) {

            var a = $(this).attr('data-nama');
            var b = $(this).attr('data-size');
            var c = $(this).attr('data-color');
            var d = $(this).attr('data-source');
            var e = $(this).attr('data-supplier');

            document.getElementById("id_item1_ok" + count).value = $(this).attr('data-id');
            document.getElementById("item_code1_ok" + count).value = $(this).attr('data-kode');
            document.getElementById("item_detail_ok" + count).value = a;
            document.getElementById("color1_ok" + count).value = $(this).attr('data-color');
            document.getElementById("size1_ok" + count).value = $(this).attr('data-size');
            document.getElementById("qty1_ok" + count).value = $(this).attr('data-qty');
            document.getElementById("unit1_ok" + count).value = $(this).attr('data-unit');

            // calculate();


            $('#modal_form_item_c2').modal('hide');
        });






        $("#qty1_ok" + count).keypress(function() {
            console.log('hahaha');
            // calculate();
        });

        $("#qty1_ok" + count).keyup(function() {
            console.log('hahaha');
            // calculate();
        });
        $("#qty1_ok").keypress(function() {
            console.log('hahaha');
            // calculate();
        });




        $("#qty").keyup(function() {
            // calculate();
        });

        $("[name='qty[]']").keyup(function() {
            // calculate();
        });

        $("#taxs, #tax_end").keyup(function() {
            // calculate();
        });






        $(document).on('click', '.pilih_code_c1', function(e) {
            var aax = $("#cek").val();
            var id_item = 'a';
            var item_code = 'b';
            var item_detil = 'c';
            var item_price = 'd';
            var item_qty = 'e';
            var item_total = 'k';

            var item_unit = 'n';
            var item_color = 'l';
            var item_size = 'm';
            var remark = 'o';

            var id_item_oks = id_item + aax;
            var item_code_oks = item_code + aax;
            var item_detil_oks = item_detil + aax;
            var item_price_oks = item_price + aax;
            var item_qty_oks = item_qty + aax;
            var item_total_oks = item_total + aax;

            var item_unit_oks = item_unit + aax;
            var item_color_oks = item_color + aax;
            var item_size_oks = item_size + aax;


            var ax = $(this).attr('data-nama');
            var bx = $(this).attr('data-size');
            var cx = $(this).attr('data-color');
            var dx = $(this).attr('data-source');
            var ex = $(this).attr('data-supplier');

            document.getElementById(id_item_oks).value = $(this).attr('data-id');
            document.getElementById(item_code_oks).value = $(this).attr('data-kode');
            document.getElementById(item_detil_oks).value = ax;
            // document.getElementById(item_price_oks).value = $(this).attr('data-price');
            document.getElementById(item_qty_oks).value = $(this).attr('data-qty');

            document.getElementById(item_unit_oks).value = $(this).attr('data-unit');
            document.getElementById(item_color_oks).value = $(this).attr('data-color');
            document.getElementById(item_size_oks).value = $(this).attr('data-size');

            // 
            $('#modal_form_item').modal('hide');
            // calculate();

        });



        function kd_otomatis() {
            $.ajax({
                url: "<?php echo site_url('Controller_Purchase/kode_otomatis') ?>/",
                type: "GET",
                dataType: "JSON",
                success: function(data) {

                    $('[name="id_po"]').val(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });

        }





        $(document).on('click', '.pilih_suppliers', function(e) {
            document.getElementById("id_supplier").value = $(this).attr('data-kode');

            document.getElementById("supplier_name").value = $(this).attr('data-nama');
            document.getElementById("supplier_source").value = $(this).attr('data-source');

            $('#modal-supplier').modal('hide');
        });


        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $("#example2").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

        $("#example3").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');


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



    $(document).ready(function() {
        $("#item_price_1, #qty_1").keyup(function() {
            var harga = $("#item_price_1").val();
            var jumlah = $("#qty_1").val();
            var total = parseInt(harga) * parseInt(jumlah);
            $("#total_price").val(total);
        });
    });







    function klik0() {

        $("#item_price_1, #qty_1").keyup(function() {
            console.log("ini aku");
            var harga = $("#item_price_1").val();
            var jumlah = $("#qty_1").val();

            var total = parseInt(harga) * parseInt(jumlah);
            $("#total_price").val(total);
        });
    }



    function klik1() {

        console.log('halo ini klik');

        // calculate();
    }


    function cari_item() {


        var a = $('#id_trim').val();
        var b = $('#id_supplier').val();

        $('#modal_form_item').modal('show'); // show bootstrap modal
        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
    }


    function cari_item_c2() {
        $('#modal_form_item_c2').modal('show'); // show bootstrap modal
        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
    }

    function cari_supplier() {



        $('#modal-supplier').modal('show'); // show bootstrap modal

        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title



    }



    function get_sup() {

        var idx = $('#id_trim').val();

        table = $('#example6').DataTable({
            "responsive": true,
            "autoWidth": false,

            "ajax": {
                url: '<?php echo site_url('Controller_Purchase/get_sup') ?>/' + idx,
                type: 'ajax',
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td>' + i + '</td>' +
                            '<td>' + data[i].supplier_name + '</td>' +
                            '<td>' + data[i].supplier_address + '</td>' +
                            '</tr>';
                    }
                    $('#show_data').html(html);
                }

            }

        });
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
                        <table id="example3" class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Size</th>
                                    <th>Color</th>



                                    <th>Qty</th>
                                    <th>Unit</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($itemtrim as $sm) : ?>
                                    <tr class="pilih_code_c1" data-id="<?= $sm['id_item'] ?>" data-kode="<?= $sm['item_code'] ?>" data-nama="<?= $sm['item_description'] ?>" data-size="<?= $sm['size'] ?>" data-color="<?= $sm['color'] ?>" data-qty="<?= $sm['qty'] ?>" data-unit="<?= $sm['unit'] ?>">
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $sm['item_code']; ?></td>
                                        <td><?= $sm['item_description']; ?></td>
                                        <td><?= $sm['size']; ?></td>
                                        <td><?= $sm['color']; ?></td>


                                        <td><?= $sm['qty']; ?></td>
                                        <td><?= $sm['unit']; ?></td>
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
                        <table id="example2" class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Size</th>
                                    <th>Color</th>



                                    <th>Qty</th>
                                    <th>Unit</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($itemtrim as $sm) : ?>
                                    <tr class="pilih_code_c2" data-id="<?= $sm['id_item'] ?>" data-kode="<?= $sm['item_code'] ?>" data-nama="<?= $sm['item_description'] ?>" data-size="<?= $sm['size'] ?>" data-color="<?= $sm['color'] ?>" data-qty="<?= $sm['qty'] ?>" data-unit="<?= $sm['unit'] ?>">
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $sm['item_code']; ?></td>
                                        <td><?= $sm['item_description']; ?></td>
                                        <td><?= $sm['size']; ?></td>
                                        <td><?= $sm['color']; ?></td>


                                        <td><?= $sm['qty']; ?></td>
                                        <td><?= $sm['unit']; ?></td>
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


<div class="modal fade" id="modal-supplier">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example6" class="table table-bordered table-sm table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Supplier Name</th>
                            <th>Source</th>
                            <th>Address</th>

                        </tr>
                    </thead>

                    <!-- <tbody id="show_data"> -->

                    </tbody>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($suppliers as $m) : ?>
                            <tr class="pilih_suppliers" data-kode="<?= $m['id_supplier'] ?>" data-nama="<?= $m['supplier_name'] ?>" data-alamat="<?= $m['supplier_address'] ?>" data-source="<?= $m['remark_supplier'] ?>">
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $m['supplier_name']; ?></td>
                                <td><?= $m['remark_supplier']; ?></td>
                                <td><?= $m['supplier_address']; ?></td>

                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-trim">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Trim Code</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-sm table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Trim Code</th>
                            <th>MO Number</th>
                            <th>Style</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($supplier as $m) : ?>
                            <tr class="pilih_trim" data-id="<?= $m['id_trim'] ?>" data-kode="<?= $m['trim_code'] ?>">
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $m['trim_code']; ?></td>
                                <td><?= $m['trim_mo']; ?></td>
                                <td><?= $m['trim_style']; ?></td>

                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>