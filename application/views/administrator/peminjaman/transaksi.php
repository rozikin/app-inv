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

                    <div class="card">

                        <div class="container mt-5">

                            <div class="row">


                                <div class="col-md-5">

                                    <div class="form-group row mb-1">
                                        <label for="reservationdatetime" class="col-sm-4 col-form-label">From </label>
                                        <div class="col-sm-5">
                                            <!-- Date -->
                                            <div class="input-group date" id="reservationdate"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#reservationdate" id="from_transaksi"
                                                    name="from_transaksi" />
                                                <div class="input-group-append" data-target="#reservationdate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-5">
                                    <div class="form-group row mb-1">
                                        <label for="reservationdatetime" class="col-sm-4 col-form-label"> To</label>
                                        <div class="col-sm-5">
                                            <!-- Date -->
                                            <div class="input-group date" id="reservationdate1"
                                                data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#reservationdate1" id="to_transaksi"
                                                    name="to_transaksi" />
                                                <div class="input-group-append" data-target="#reservationdate1"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-1">
                                    <button class="btn btn-primary text-left" id="cari_transaksi">pilih</button>


                                </div>
                            </div>
                        </div>
                        <div class="card-body">


                            <table id="example6" class="table table-hover table-bordered table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th>NO PINJAM</th>
                                        <th>DATE</th>
                                        <th>NO KEMBALI</th>
                                        <th>DATE KEMBALI</th>
                                        <th>EMP ID</th>
                                        <th>NAME</th>
                                        <th>DEPT.</th>
                                        <th>POSISI</th>
                                        <th>ITEM CODE.</th>
                                        <th>Desc.</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>

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
$(document).ready(function() {

    $("#cari_transaksi").click(function() {

        cari_transaksi();

    })

});



function cari_transaksi() {


    var from_trans = $('#from_transaksi').val();
    var to_trans = $('#to_transaksi').val();

    console.log(from_trans);
    console.log(to_trans);

    table = $('#example6').DataTable({
        "responsive": true,
        destroy: true,

        "autoWidth": false,
        destroy: true,

        "dom": 'Bfrtip',
        "buttons": ["csv", "excel", "pdf", "print", "colvis"],


        "ajax": {
            url: '<?php echo site_url('Controller_Peminjaman/get_data_transaksi') ?>',
            data: {

                from_transaksi: from_trans,
                to_transaksi: to_trans
            },
            type: 'POST'
        }

    }).buttons().container().appendTo('#example6_wrapper .col-md-6:eq(0)');




};
</script>