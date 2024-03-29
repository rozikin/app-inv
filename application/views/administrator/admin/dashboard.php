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
        padding: 1px 2px;
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
                <h3 class="text-center mb-0" id="jam"></h3>
                <h4 class="text-center">
                    <?php
                    date_default_timezone_set('Asia/Jakarta');
                    echo date('d F Y')
                    ?>
                </h4>

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
                            <i class="fa fa-list-alt"></i>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="put_employee"></h3>
                            <p>Employee (Borrow)</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                <div id="put_peminjaman"></div>
                            </h3>

                            <p>All OUT Transc.</p>

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

                            <p>Item OUT</p>
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
                            <div style="overflow-x:auto;">
                                <table class="table table1">
                                    <tr>
                                        <th>SEW</th>
                                        <th>QC</th>
                                        <th>PACK</th>
                                        <th>CUTT</th>
                                        <th>MKN</th>
                                        <th>SPL</th>
                                        <th>WH</th>
                                        <th>FOLD</th>
                                        <th>PRNT</th>
                                        <th>IRON</th>
                                        <th>OTHER</th>
                                        <th>OUT_NOW</th>
                                        <th>RETURN_NOW</th>
                                        <th>NOT_RETURN</th>

                                    </tr>
                                    <tr>
                                        <td id="put_sewing"></td>
                                        <td id="put_qc"></td>
                                        <td id="put_packing"></td>
                                        <td id="put_cutting"></td>
                                        <td id="put_mekanik"></td>
                                        <td id="put_sample"></td>
                                        <td id="put_wh"></td>
                                        <td id="put_folding"></td>
                                        <td id="put_print"></td>
                                        <td id="put_iron"></td>
                                        <td id="put_other"></td>
                                        <td id="put_pinjam_hari_ini"></td>
                                        <td id="put_kembali_hari_ini"></td>
                                        <td id="put_kemarin"></td>

                                    </tr>


                                </table>
                            </div>



                        </div>





                    </div>



                    <h6>Data not return</h6>
                    <table id="example6" class="table table-hover table-bordered table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>NO PINJAM</th>
                                <th>DATE</th>
                                <th>NO RT</th>
                                <th>DATE RT</th>
                                <th>EMP ID</th>
                                <th>NAME</th>
                                <!-- <th>DEPT.</th> -->
                                <!-- <th>LINE.</th> -->
                                <th>ITEM CODE.</th>
                                <th>DESC</th>
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
        // tanggal();
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

    function tanggal() {
        document.getElementById("tgl").innerHTML = Date('YYYY-mm-dd');
    }


    $(document).ready(function() {



        get_data_trans()

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
        get_ct_folding();
        get_ct_print();
        get_ct_iron();
        get_ct_other();

        get_ct_qc();
        get_pinjam_hari_ini();
        get_kembali_hari_ini();
        // pinjam_kemarin();
        get_ct_pinjam();
        get_belum_kembali();


        get_telegram();






    });

    function get_ct_pinjam() {

        var a = $("#put_peminjaman").text;
      

    }

    function get_telegram() {

        var cek_data = $('#put_employee').text();
        var cek_int = Number(cek_data);
       

        var cek_jam = '18:32:10';
        var cek_jam2 = '5:50:10';
        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        var dateTime = time; 

        // console.log(dateTime)

      

        if (dateTime == cek_jam) {
            $.ajax({
                url: '<?php echo site_url('Admin/get_update') ?>',
                type: 'POST'
            })

        }

        if (dateTime == cek_jam2) {
            $.ajax({
                url: '<?php echo site_url('Admin/get_update2') ?>',
                type: 'POST'
            })

        }
    


        setTimeout('get_telegram()', 1000);


    }


    function get_data_trans() {
        table = $('#example6').DataTable({
            "responsive": true,
            "autoWidth": false,
            "dom": 'Bfrtip',
            "buttons": ["excel", "colvis"],
            destroy: true,

            "ajax": {
                url: '<?php echo site_url('Admin/get_data_transaksi') ?>',
                type: 'POST'
            }
        }).buttons().container().appendTo('#example6_wrapper .col-md-6:eq(0)');

        setTimeout('get_data_trans()', 300000);


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
        setTimeout('get_employee()', 1000000);
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
        setTimeout('get_item()', 1000000);
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
        setTimeout('get_peminjaman()', 1000000);
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
        setTimeout('get_item_pinjam()', 1000000);
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
        setTimeout('get_belum_kembali()', 1000000);
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

        setTimeout('get_ct_sweing()', 1000000);
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

        setTimeout('get_ct_qc()', 1000000);
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
        setTimeout('get_ct_packing()', 1000000);
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
        setTimeout('get_ct_cutting()', 1000000);
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

        setTimeout('get_ct_mekanik()', 1000000);
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

        setTimeout('get_ct_sample()', 1000000);
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

        setTimeout('get_ct_wh()', 1000000);
    }

    function get_ct_folding() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_ct_folding') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_folding");
                hii.innerHTML = data.message;
            }
        });
        setTimeout('get_ct_folding()', 1000000);
    }


    function get_ct_print() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_ct_print') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_print");
                hii.innerHTML = data.message;
            }
        });
        setTimeout('get_ct_print()', 1000000);
    }

    function get_ct_iron() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_ct_iron') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_iron");
                hii.innerHTML = data.message;
            }
        });
        setTimeout('get_ct_iron()', 1000000);
    }

    function get_ct_other() {

        $.ajax({
            url: "<?php echo site_url('Admin/get_ct_other') ?>/",
            type: "POST",
            success: function(result) {
                var data = $.parseJSON(result);

                var hii = document.getElementById("put_other");
                hii.innerHTML = data.message;
            }
        });
        setTimeout('get_ct_other()', 1000000);
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
        setTimeout('get_pinjam_hari_ini()', 1000000);
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
        setTimeout('get_kembali_hari_ini()', 1000000);
    }





    function pinjam_kemarin() {
        var kemarin = $('#put_peminjaman').val();
        var hari_ini = $('#put_pinjam_hari_ini').val();

        console.log(kemarin);


    }
</script>