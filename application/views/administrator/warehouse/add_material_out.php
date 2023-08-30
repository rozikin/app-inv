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
                            <h5 class="font-weight-bold"> Material OUT</h5>
                        </div>
                        <!-- title row -->

                        <!-- info row -->
                        <?= form_open_multipart('Controller_Warehouse/create_out'); ?>
                        <div class="row invoice-info mt-5">


                            <div class="container">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row mb-1">
                                            <label for="no_sj" class="col-sm-4 col-form-label">NO OUT</label>
                                            <div class="col-sm-5">

                                                <input type="hidden" class="form-control form-control-sm" id="id_out" name="id_out" required>
                                                <input type="text" class="form-control form-control-sm" id="no_out" name="no_out" required autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-1">
                                            <label for="reservationdatetime" class="col-sm-4 col-form-label">Date</label>
                                            <div class="col-sm-5">
                                                <!-- Date -->
                                                <div class="form-group">

                                                    <div class="input-group date input-group-sm" id="reservationdatetime" data-target-input="nearest">
                                                        <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#reservationdatetime" name="date_out" id="date_out" required />
                                                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class=" form-group row mb-1">
                                            <label for="allocation" class="col-sm-4 col-form-label">Allocation</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="allocation" name="allocation" required>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row mb-1">
                                            <label for="department" class="col-sm-4 col-form-label">Department</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="department" name="department" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="mo" class="col-sm-4 col-form-label">MO</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="mo" name="mo" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="style" class="col-sm-4 col-form-label">Style</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="style" name="style" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="remark" class="col-sm-4 col-form-label">Remark</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="remark1" name="remark1" required>
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
                                                        <tr class="po-item">
                                                            <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                                            <th width="10%">Code</th>
                                                            <th width="15%">Description</th>
                                                            <th width="10%">Color</th>
                                                            <th width="5%">Size</th>
                                                            <th width="10%">Unit</th>
                                                            <th width="10%">Qty</th>
                                                            <th width="15%">Remark</th>
                                                        </tr>

                                                    </table>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->



                                </div>

                                <!-- /.row -->
                                <div class="row no-print">
                                    <div class="col-12">

                                        <a href="<?= base_url('Controller_Warehouse/material_out') ?>" class="btn btn-success float-right">Back</a>
                                        <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                                            <i class="fas fa-download"></i> Save
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </div>

                        </form>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<script text="text/javascript">
    // function calculate() {
    //     var _total = 0
    //     $('.po-item').each(function() {
    //         var qty = $(this).find("[name='qty[]']").val()
    //         var unit_price = $(this).find("[name='item_price[]']").val()
    //         var row_total = 0;
    //         if (qty > 0 && unit_price > 0) {
    //             row_total = parseFloat(qty) * parseFloat(unit_price)
    //         }
    //         $(this).find("[name='total_price[]']").val(row_total)

    //     })

    //     $("[name='total_price[]']").each(function() {
    //         var _price = $(this).val()
    //         _price = _price.replace(/\,/gi, '')
    //         _total += parseFloat(_price)
    //     })

    //     $('#sub_total').val(parseFloat(_total))

    //     var tax_perc = 0
    //     if ($('[name="tax"]').val() > 0) {
    //         tax_perc = $('[name="tax"]').val()
    //     }
    //     var tax_amount = _total * (tax_perc / 100);
    //     var grand = parseInt(_total) + parseInt(tax_amount);

    //     $('[name="tax_end"]').val(parseFloat(tax_amount))
    //     $('#grand_total_end').val(parseFloat(grand))
    //     $('#purchase_amount_end').val(parseFloat(grand))
    // }




    // $('#invoiceItem tbody').on('keyup change', function() {

    //     calculate();
    // });


    // $("#item_price").keyup(function() {
    //     $("input").css("background-color", "pink");
    // });

    // $("#item_price1_ok").keyup(function() {
    //     calculate();
    // });
    // $("#item_price").keyup(function() {
    //     calculate();
    // });

    // $("[name='item_price[]']").keyup(function() {
    //     calculate();
    // });




    $(document).ready(function() {
        kd_otomatis_out();
        kd_otomatis_no_out();


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
            var c = 'INI IDxx KE';
            var d = c + count++;
            console.log(d);

            var htmlRows = '';
            htmlRows += '<tbody>';
            htmlRows += '<tr class="po-item">';
            htmlRows += '<td> <input class="itemRow" type="checkbox"></td>';


            htmlRows +=
                '<td> <input type="hidden" name="id_item[]" id="id_item1_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off" readonly> <div class="input-group"> <input type="text" name="item_code1[]" id="item_code1_ok' +
                count +
                '" class="form-control form-control-xs" autocomplete="off" onclick="cari_item_c2()" required> </div></td>';

            htmlRows += '<td>  <input type="text" name="item_source[]" id="item_detail_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off" readonly> </td>';

            htmlRows += '<td>  <input type="text" name="color[]" id="color1_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off" > </td>';

            htmlRows += '<td>  <input type="text" name="size[]" id="size1_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off" > </td>';

            htmlRows += '<td>  <input type="text" name="unit[]" id="unit1_ok' + count +
                '" class="form-control form-control-xs unit" autocomplete="off" required> </td>';

            htmlRows += '<td>  <input type="text" name="qty[]" id="qty1_ok' + count +
                '" class="form-control form-control-xs qty" autocomplete="off" required> </td>';


            htmlRows += '<td >  <input type="text" name="remark[]" id="remark1_ok' + count +
                '" class="form-control form-control-xs remark" autocomplete="off" onclick="klik1()"> </td>';

            htmlRows += '</tr>';
            htmlRows += '</tbody>';
            $('#invoiceItem').append(htmlRows);



        });

        $(document).on('click', '#removeRows', function() {
            $(".itemRow:checked").each(function() {
                $(this).closest('tr').remove();

            });
            $('#checkAll').prop('checked', false);

        });


        function kd_otomatis_out() {
            $.ajax({
                url: "<?php echo site_url('Controller_Warehouse/kode_otomatis_out') ?>/",
                type: "GET",
                dataType: "JSON",
                success: function(data) {

                    $('[name="id_out"]').val(data);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });

        }

        function kd_otomatis_no_out() {
            $.ajax({
                url: "<?php echo site_url('Controller_Warehouse/kode_otomatis_no_out') ?>/",
                type: "GET",
                dataType: "JSON",
                success: function(data) {

                    $('[name="no_out"]').val(data);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });

        }



        $(document).on('click', '.pilih_code_c2', function(e) {

            var a = $(this).attr('data-nama');
            var b = $(this).attr('data-size');
            var c = $(this).attr('data-color');
            var d = $(this).attr('data-source');
            var e = $(this).attr('data-supplier');

            document.getElementById("id_item1_ok" + count).value = $(this).attr('data-id');
            document.getElementById("item_code1_ok" + count).value = $(this).attr('data-kode');
            document.getElementById("item_detail_ok" + count).value = a;
            document.getElementById("size1_ok" + count).value = $(this).attr('data-size');
            document.getElementById("color1_ok" + count).value = $(this).attr('data-color');
            // document.getElementById("qty1_ok" + count).value = $(this).attr('data-qty');
            document.getElementById("unit1_ok" + count).value = $(this).attr('data-unit');




            $('#modal_form_item_c2').modal('hide');
        });





        $(document).on('click', '.pilih_code_c1', function(e) {
            var a = $(this).attr('data-nama');
            var b = $(this).attr('data-size');
            var c = $(this).attr('data-color');
            var d = $(this).attr('data-source');
            var e = $(this).attr('data-supplier');

            document.getElementById("id_item_1").value = $(this).attr('data-id');
            document.getElementById("item_code_1").value = $(this).attr('data-kode');
            document.getElementById("item_detail").value = a;

            document.getElementById("color").value = $(this).attr('data-color');
            document.getElementById("size").value = $(this).attr('data-size');
            // document.getElementById("qty").value = $(this).attr('data-qty');


            var harga = $("#item_price_1").val();
            var jumlah = $("#qty_1").val();

            var total = parseInt(harga) * parseInt(jumlah);
            $("#total_price").val(total);





            $('#modal_form_item').modal('hide');
        });


        $(document).on('click', '.pilih_suppliers', function(e) {
            document.getElementById("id_po").value = $(this).attr('data-kode');
            document.getElementById("no_po").value = $(this).attr('data-po');

            document.getElementById("supplier_name").value = $(this).attr('data-supplier');

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
                        // calculate();
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

        if ($("#qty_1").val() > 0) {
            var a = $("#qty_1").val();
            var b = $("#item_price_1").val();
            var c = parseInt(a) * parseInt(b);

            $("#total_price").val(c);
        }




    });
    $(document).ready(function() {
        $('#tax').val(0);
        $('#rounding').val(0);
        $("#tax, #tax_end").keyup(function() {
            // calculate();
        });
    });




    function klik11() {


        get_data_detil();
    }





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

    function cari_po() {
        $('#modal-supplier').modal('show'); // show bootstrap modal
        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
    }





    function get_data_detil() {

        var id_po = $("#id_po").val();

        $.ajax({
            url: '<?php echo site_url('Controller_Warehouse/get_data_detil'); ?>',
            method: 'POST',
            data: {
                id_po: id_po

            },
            async: true,
            dataType: 'json',
            success: function(data) {


                var html = '';
                var i;
                var x = 2;
                for (i = 0; i < data.length; i++) {

                    // $id_itm = 'a'.$i;
                    // $code_itm = 'b'.$i;
                    // $detil = 'c'.$i;
                    // $qty = 'e'.$i;
                    // $price = 'd'.$i;
                    // $remark = 'k'.$i;


                    html += '<tbody>';
                    html += '<tr class="po-item">';
                    html += '<td> <input class="itemRow" type="checkbox"></td>';
                    html += '<td><input type="hidden" name="id_item[]" class="form-control form-control-xs" value="' + data[i].id_item + '"><input type="text" name="item_source[]" class="form-control form-control-xs" onclick="cari_item()" value="' + data[i].item_code + '"></td>';
                    html += '<td><input type="text" name="item_desscription[]" class="form-control form-control-xs" value="' + data[i].item_description + '"></td>';
                    html += '<td><input type="text" name="color[]" class="form-control form-control-xs" value="' + data[i].color + '"></td>';
                    html += '<td><input type="text" name="size[]" class="form-control form-control-xs" value="' + data[i].size + '"></td>';
                    html += '<td><input type="text" name="unit[]" class="form-control form-control-xs unit" value="' + data[i].unit + '"></td>';
                    html += '<td><input type="text" name="qty[]" class="form-control form-control-xs qty" value="' + data[i].qty + '"></td>';

                    html += '<td><input type="text" name="remark[]" class="form-control form-control-xs total_price"></td>';

                    html += '</tr>';
                    html += '</tbody>';
                }
                $('#invoiceItem').append(html);
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
                                    <th>Unit</th>
                                    <th>stok</th>



                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($item as $sm) : ?>
                                    <tr class="pilih_code_c1" data-id="<?= $sm['id_item'] ?>" data-kode="<?= $sm['item_code'] ?>" data-nama="<?= $sm['item_description'] ?>" data-size="<?= $sm['size'] ?>" data-color="<?= $sm['color'] ?>" data-qty="<?= $sm['stok'] ?>">
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $sm['item_code']; ?></td>
                                        <td><?= $sm['item_description']; ?></td>
                                        <td><?= $sm['size']; ?></td>
                                        <td><?= $sm['color']; ?></td>
                                        <td><?= $sm['unit']; ?></td>
                                        <td><?= $sm['stok']; ?></td>



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
                                    <th>Unit</th>

                                    <th>stok</th>


                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($item as $sm) : ?>
                                    <tr class="pilih_code_c2" data-id="<?= $sm['id_item'] ?>" data-kode="<?= $sm['item_code'] ?>" data-nama="<?= $sm['item_description'] ?>" data-size="<?= $sm['size'] ?>" data-color="<?= $sm['color'] ?>" data-qty="<?= $sm['stok'] ?>" data-unit="<?= $sm['unit'] ?>">
                                        <th scope=" row"><?= $i; ?></th>
                                        <td><?= $sm['item_code']; ?></td>
                                        <td><?= $sm['item_description']; ?></td>
                                        <td><?= $sm['size']; ?></td>
                                        <td><?= $sm['color']; ?></td>
                                        <td><?= $sm['unit']; ?></td>

                                        <td><?= $sm['stok']; ?></td>


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