<style>
    .table1 {
        font-family: sans-serif;
        color: #444;
        border-collapse: collapse;
        width: 25%;
        border: 1px solid #f2f5f7;
    }

    .table1 tr th {
        background: #35A9DB;
        color: #fff;
        font-weight: normal;
    }

    .table1,
    th,
    td {
        padding: 1px 5px;
        text-align: center;
    }

    .table1 tr:hover {
        background-color: #f5f5f5;
    }

    .table1 tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>


<div class="content-wrapper">
    <section class="content">

        <div class="row">
            <div class="container">
                <h3 class="text-center" id="jam"></h3>

            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="put_item"></h3>

                            <p>Item</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="put_employee"></h3>
                            <p>Employee</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                <div id="put_peminjaman"></div>
                            </h3>

                            <p>All Peminjaman</p>

                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">

                            <h3 id="put_item_pinjam"></h3>

                            <p>Item Pinjam</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>

                    </div>
                </div>

            </div>

            <div class="card">
                <div class="card-body">



                    <div class="row mb-3">
                        <div class="col-12">
                            <h6>Peminjaman Hari ini</h6>
                            <table class="table1 table">
                                <tr>
                                    <th>SEWING</th>
                                    <th>QC</th>
                                    <th>PACKING</th>
                                    <th>CUTTING</th>
                                    <th>MEKANIK</th>
                                    <th>SAMPLE</th>
                                    <th>WAREHOUSE</th>
                                    <th>PINJAM_NOW</th>
                                    <th>REUTRN_NOW</th>
                                    <th>KMRN_BLM_KBLI</th>

                                </tr>
                                <tr>
                                    <td id="put_sewing"></td>
                                    <td id="put_qc"></td>
                                    <td id="put_packing"></td>
                                    <td id="put_cutting"></td>
                                    <td id="put_mekanik"></td>
                                    <td id="put_sample"></td>
                                    <td id="put_wh"></td>
                                    <td id="put_pinjam_hari_ini"></td>
                                    <td id="put_kembali_hari_ini"></td>
                                    <td id="put_kemarin"></td>

                                </tr>


                            </table>



                        </div>

                        



                    </div>




                    <table id="example6" class="table table-hover table-bordered table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>NO PINJAM</th>
                                <th>DATE</th>
                                <th>NO RT</th>
                                <th>DATE RT</th>
                                <th>EMP ID</th>
                                <!-- <th>NAME</th>
                                <th>DEPT.</th>
                                <th>LINE.</th> -->
                                <th>ITEM CODE.</th>
                                <!-- <th>Desc.</th> -->
                                <th>STATUS</th>
                            </tr>
                        </thead>

                    </table>

                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
</div>

<script>
    window.onload = function() {
        jam();
    }

    function jam() {
        var e = document.getElementById('jam'),
            d = new Date(),
            h, m, s;
        h = d.getHours();
        m = set(d.getMinutes());
        s = set(d.getSeconds());

        e.innerHTML = h + ':' + m + ':' + s;

        setTimeout('jam()', 1000);
    }

    function set(e) {
        e = e < 10 ? '0' + e : e;
        return e;
    }


    $(document).ready(function() {
        table = $('#example6').DataTable({
            "responsive": true,
            "autoWidth": false,
            "dom": 'Bfrtip',
            "buttons": ["excel", "colvis"],

            "ajax": {
                url: '<?php echo site_url('Admin/get_data_transaksi') ?>',
                type: 'POST'
            }
        }).buttons().container().appendTo('#example6_wrapper .col-md-6:eq(0)');





        get_item();
        get_employee();

        get_peminjaman();
        get_item_pinjam();



        get_ct_sweing();
        get_ct_packing();
        get_ct_cutting();
        get_ct_mekanik();
        get_ct_sample();
        get_ct_wh();
        get_ct_qc();
        get_pinjam_hari_ini();
        get_kembali_hari_ini();
        // pinjam_kemarin();
        get_ct_pinjam();
        get_belum_kembali();





    });

    function get_ct_pinjam() {

        var a = $("#put_peminjaman").text;
        console.log(a);

    }


    function get_employee() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_data_employee') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_employee");
                hii.innerHTML = data.message;
            }
        });
    }

    function get_item() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_data_item') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_item");
                hii.innerHTML = data.message;
            }
        });
    }


    function get_peminjaman() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_data_peminjaman') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_peminjaman");
                hii.innerHTML = data.message;
            }
        });
    }

    function get_item_pinjam() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_data_item_peminjaman') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_item_pinjam");
                hii.innerHTML = data.message;
            }
        });
    }

    function get_belum_kembali() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_data_belum_kembali') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_kemarin");
                hii.innerHTML = data.message;
            }
        });
    }










    function get_ct_sweing() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_ct_sweing') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_sewing");
                hii.innerHTML = data.message;
            }
        });
    }


    function get_ct_qc() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_ct_qc') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_qc");
                hii.innerHTML = data.message;
            }
        });
    }

    function get_ct_packing() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_ct_packing') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_packing");
                hii.innerHTML = data.message;
            }
        });
    }


    function get_ct_cutting() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_ct_cutting') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_cutting");
                hii.innerHTML = data.message;
            }
        });
    }

    function get_ct_mekanik() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_ct_mekanik') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_mekanik");
                hii.innerHTML = data.message;
            }
        });
    }

    function get_ct_sample() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_ct_sample') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_sample");
                hii.innerHTML = data.message;
            }
        });
    }

    function get_ct_wh() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_ct_wh') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_wh");
                hii.innerHTML = data.message;
            }
        });
    }


    function get_pinjam_hari_ini() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_data_pinjam_hari_ini') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_pinjam_hari_ini");
                hii.innerHTML = data.message;
            }
        });
    }



    function get_kembali_hari_ini() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_data_kembali_hari_ini') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_kembali_hari_ini");
                hii.innerHTML = data.message;
            }
        });
    }





    function pinjam_kemarin() {
        var kemarin = $('#put_peminjaman').val();
        var hari_ini = $('#put_pinjam_hari_ini').val();

        console.log(kemarin);

        // var hasil = parseInt(kemarin) - parseInt(hari_ini);

        // var hii = document.getElementById("put_kemarin");
        // hii.innerHTML = hasil;
        // $('#put_kemarin').val(hasil);
    }
</script>