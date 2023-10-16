<style>
.box-login input {
    width: 100%;
    padding: 5px 0;
    background: none;
    border: none;
    outline: none;
    font-size: 18px;
    color: red;
}
</style>
<section class="conten">
    <div class="container-fluid">


        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-1 text-center">
                        <h5 id="jam"></h5>

                    </div>
                    <div class="col-11 text-center">
                        <h5>PEMINJAMAN</h5>

                    </div>


                </div>





                <div class="card">
                    <div class="container mt-5">

                        <div class="row">


                            <div class="col-md-5">

                                <div class="form-group row mb-1">
                                    <label for="reservationdatetime" class="col-sm-4 col-form-label">From </label>
                                    <div class="col-sm-5">
                                        <!-- Date -->
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
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
                                        <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#reservationdate1" id="to_transaksi" name="to_transaksi" />
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



                    </div>

                </div>



                <div class="container">

                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>No Pinjam</th>
                                <th>Date</th>
                                <th>NIK</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>POSISI</th>
                                <th>Item Code</th>
                                <th>Desc</th>
                                <th>Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
            <!-- /.card-header -->
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


<script type="text/javascript">
var save_method; //for save method string
var table;
var base_url = '<?php echo base_url(); ?>';

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





function delete_data(id) {
    var pc = document.getElementById('employee_id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "<?php echo site_url('Controller_Peminjaman/remove_material_out') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {

                }
            });

            cari_transaksi();
            pc.focus();

        }
    })
}




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

    table = $('#example1').DataTable({
        "responsive": true,
        destroy: true,

        "autoWidth": false,
        destroy: true,

        "dom": 'Bfrtip',
        "buttons": ["csv", "excel", "pdf", "print", "colvis"],


        "ajax": {
            url: '<?php echo site_url('Controller_Peminjaman/get_data_material_out_dell') ?>',
            data: {

                from_transaksi: from_trans,
                to_transaksi: to_trans
            },
            type: 'POST'
        }

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');




};
</script>