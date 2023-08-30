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
                            <h5> TIMW PURCHASE ORDER</h5>
                        </div>
                        <!-- title row -->

                        <!-- info row -->
                        <?= form_open_multipart('Controller_Trimsorder/create'); ?>
                        <div class="row invoice-info mt-5">


                            <div class="container">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row mb-1">
                                            <label for="trim_code" class="col-sm-4 col-form-label">PO Number</label>
                                            <div class="col-sm-5">
                                                <input type="hidden" class="form-control form-control-sm" id="id_trim" name="id_trim" required autofocus>

                                                <input type="text" class="form-control form-control-sm" id="trim_code" name="po_numer" placeholder="PO Number" required autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="trim_style" class="col-sm-4 col-form-label">Supplier</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="trim_mo" name="trim_mo" placeholder="Supplier Detail" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="trim_style" class="col-sm-4 col-form-label">Request in House</label>
                                            <div class="col-sm-5">
                                                <div class="form-group">

                                                    <div class="input-group date input-group-sm" id="reservationdate" data-target-input="nearest">
                                                        <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#reservationdate" name="trim_date" id="trim_date" />
                                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="destination" class="col-sm-4 col-form-label">Delivery Point at</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-sm" id="trim_destination" name="trim_destination" placeholder="Delivery Point at" required>
                                            </div>
                                        </div>

                                        <div class=" form-group row mb-1">
                                            <label for="style" class="col-sm-4 col-form-label">Supplier Source</label>
                                            <div class="col-sm-5">
                                                <select class="form-control form-control-sm select2" name="trim_status" id="trim_status">
                                                    <option selected="selected" value="Request">Local</option>
                                                    <option value="Aprove">Import</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row mb-1">
                                            <label for="req_date" class="col-sm-4 col-form-label">Req Date</label>
                                            <div class="col-sm-5">
                                                <!-- Date -->
                                                <div class="form-group">

                                                    <div class="input-group date input-group-sm" id="reservationdate" data-target-input="nearest">
                                                        <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#reservationdate" name="trim_date" id="trim_date" />
                                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.col -->

                                        <div class="form-group row">
                                            <label for="style" class="col-sm-4 col-form-label">Notes</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" rows="3" name="trim_remark" id="trim_remark" placeholder="Enter notes here.."></textarea>
                                            </div>
                                        </div>

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

                                        <br />
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-sm-12">
                                                    <table class="table table-bordered table-hover table-sm" style="width:100%" id="invoiceItem">
                                                        <tr>
                                                            <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                                            <th width="15%">Code Item</th>
                                                            <th width="40%">Description</th>
                                                            <th width="10%">Price</th>
                                                            <th width="10%">Qty</th>
                                                            <th width="100%">Total Price</th>

                                                        </tr>
                                                        <tr>
                                                            <td><input class="itemRow" type="checkbox"></td>

                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="hidden" name="id_item[]" id="id_item_1">
                                                                    <input type="text" name="item_code[]" id="item_code_1" class="form-control  form-control-xs" autocomplete="off" onclick="cari_item()" required>

                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control  form-control-xs" id="item_detail" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control  form-control-xs" id="item_price_1" readonly>
                                                            </td>
                                                            <td>

                                                                <input type="text" name="qty[]" id="qty_1" class="form-control  form-control-xs" autocomplete="off" required>

                                                            </td>
                                                            <td>

                                                                <input type="text" name="total_price[]" id="total_price_1" class="form-control  form-control-xs" autocomplete="off">

                                                            </td>
                                                        </tr>
                                                    </table>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->



                                </div>
                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-7">
                                        <p class="lead">Payment Methods:</p>
                                        <img src="../../dist/img/credit/visa.png" alt="Visa">
                                        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                                        <img src="../../dist/img/credit/american-express.png" alt="American Express">
                                        <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                                            plugg
                                            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                        </p>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-5">
                                        <p class="lead">Amount Due 2/22/2014</p>

                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <tr>
                                                    <th style="width:50%">Subtotal :</th>
                                                    <td>$250.30</td>
                                                </tr>
                                                <tr>
                                                    <th>Rounding :</th>
                                                    <td>$10.34</td>
                                                </tr>
                                                <tr>
                                                    <th>Tax 11% :</th>
                                                    <td>$10.34</td>
                                                </tr>
                                                <tr>
                                                    <th>Grand Total:</th>
                                                    <td>$5.80</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>$265.24</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <div class="row no-print">
                                    <div class="col-12">

                                        <a href="<?= base_url('Controller_Trimsorder') ?>" class="btn btn-success float-right">Back</a>
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
    $(document).ready(function() {
        kd_otomatis();
        jumlah();
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
                '<td> <input type="hidden" name="id_item[]" id="id_item1_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off" readonly> <div class="input-group"> <input type="text" name="item_code1[]" id="item_code1_ok' +
                count +
                '" class="form-control form-control-xs" autocomplete="off" onclick="cari_item_c2()" required> </div></td>';

            htmlRows += '<td>  <input type="text" name="item_source[]" id="item_detail_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off" readonly> </td>';

            htmlRows += '<td>  <input type="text" name="item_price[]" id="item_price1_ok' + count +
                '" class="form-control form-control-xs" autocomplete="off" required readonly> </td>';

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

        function jumlah() {

            var satu = document.getElementById('item_price_1').value;
            var dua = document.getElementById('qty_1').value;
            var total = parseInt(satu) + parseInt(dua);
            document.getElementById('total_price_1').innerHTML = " Hasilnya adalah " + total;
        }


        function kd_otomatis() {
            $.ajax({
                url: "<?php echo site_url('Controller_Trimsorder/kode_otomatis') ?>/",
                type: "GET",
                dataType: "JSON",
                success: function(data) {

                    $('[name="id_trim"]').val(data);
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
            document.getElementById("item_detail_ok" + count).value = a + " / " + b + " / " + c + " / " + d + " / " + e;

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
            document.getElementById("item_detail").value = a + " / " + b + " / " + c + " / " + d + " / " + e;
            document.getElementById("item_price_1").value = $(this).attr('data-price');
            // document.getElementById("supplier_name_1").value = $(this).attr('data-supplier');
            // document.getElementById("item_source_1").value = $(this).attr('data-source');

            $('#modal_form_item').modal('hide');
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
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Section</th>
                                    <th>Supplier</th>
                                    <th>Currency</th>
                                    <th>Price</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($item as $sm) : ?>
                                    <tr class="pilih_code_c1" data-id="<?= $sm['id_item'] ?>" data-kode="<?= $sm['item_code'] ?>" data-nama="<?= $sm['item_description'] ?>" data-source="<?= $sm['remark'] ?>" data-supplier="<?= $sm['supplier_name'] ?>" data-size="<?= $sm['size_code'] ?>" data-color="<?= $sm['color'] ?>" data-price="<?= $sm['item_price'] ?>">
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $sm['item_code']; ?></td>
                                        <td><?= $sm['item_description']; ?></td>
                                        <td><?= $sm['size_code']; ?></td>
                                        <td><?= $sm['color']; ?></td>
                                        <td><?= $sm['remark']; ?></td>
                                        <td><?= $sm['supplier_name']; ?></td>
                                        <td><?= $sm['currency']; ?></td>
                                        <td><?= $sm['item_price']; ?></td>
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
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Section</th>
                                    <th>Supplier</th>
                                    <th>Currency</th>
                                    <th>Price</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($item as $sm) : ?>
                                    <tr class="pilih_code_c2" data-id="<?= $sm['id_item'] ?>" data-kode="<?= $sm['item_code'] ?>" data-nama="<?= $sm['item_description'] ?>" data-source="<?= $sm['remark'] ?>" data-supplier="<?= $sm['supplier_name'] ?>" data-size="<?= $sm['size_code'] ?>" data-color="<?= $sm['color'] ?>">
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $sm['item_code']; ?></td>
                                        <td><?= $sm['item_description']; ?></td>
                                        <td><?= $sm['size_code']; ?></td>
                                        <td><?= $sm['color']; ?></td>
                                        <td><?= $sm['remark']; ?></td>
                                        <td><?= $sm['supplier_name']; ?></td>
                                        <td><?= $sm['currency']; ?></td>
                                        <td><?= $sm['item_price']; ?></td>
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