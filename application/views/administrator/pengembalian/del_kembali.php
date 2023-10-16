<style>
.box-login input {
    width: 100%;
    padding: 5px 0;
    background: none;
    border: none;
    returnline: none;
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
                        <h5 class="text-bold">PENGEMBALIAN</h5>

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
                                <th>No Kembali</th>
                                <th>Date</th>
                                <th>No out</th>
                                <th>NIK</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>POSISI</th>
                                <th>Item Code</th>
                                <th>Desc</th>
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


function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
}



function sukses() {

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });


    Toast.fire({
        icon: 'success',
        title: 'Data Berhasil Ditambahkan'
    })
}



function kd_otomatis_no_return() {
    $.ajax({
        url: "<?php echo site_url('Controller_Pengembalian/kode_otomatis_no_return') ?>/",
        type: "GET",
        dataType: "JSON",
        success: function(data) {

            $('[name="no_return"]').val(data);
        }
    });

}

function bersihkan_input() {

    $('#employee_id').val('');
    $('#employee_name').val('');
    $('#department').val('');
    $('#line').val('');
    $('#item_code').val('');
    $('#item_description').val('');
    $('#status').val('');
    $('#no_pinjam').val('');
}

$(document).on('click', '.pilih_data', function(e) {
    document.getElementById("no_pinjam").value = $(this).attr('data-id');
    document.getElementById("item_code").value = $(this).attr('data-code');
    document.getElementById("item_description").value = $(this).attr('data-desc');
    if ($(this).attr('data-status') == 1) {
        document.getElementById("status").value = 'OUT';
    }



    console.log('data-id');

    $('#simpan').prop('disabled', false);
    $('#simpan').click();

    $('#modal_form_pinjam').modal('hide');



});





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
            url: '<?php echo site_url('Controller_Pengembalian/get_data_return_del') ?>',
            data: {

                from_transaksi: from_trans,
                to_transaksi: to_trans
            },
            type: 'POST'
        }

    }).buttons().container().appendTo('#example6_wrapper .col-md-6:eq(0)');




};


















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
                url: "<?php echo site_url('Controller_Pengembalian/remove_material_return') ?>/" +
                    id,
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




function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 

}


function cari_pinjam() {

    var employee_id = $('#employee_id').val();
    $('#example_pinjam').DataTable({
        "responsive": true,
        destroy: true,

        "ajax": {
            url: '<?php echo site_url('Controller_Pengembalian/get_data_pinjam') ?>/' + employee_id,
            type: 'POST',

        }

    });

    $('#modal_form_pinjam').modal('show'); // show bootstrap modal
    $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title

}




$(document).ready(function() {
    var pc = document.getElementById('employee_id');
    var px = document.getElementById('no_pinjam');

    pc.focus();


    pc.onchange = function() {
        var employee_id = $(this).val();
        // $('[name="employee_name"]').val('');
        // $('[name="department"]').val('');
        // $('[name="line"]').val('');

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Controller_Pengembalian/get_data_nik') ?>/",
            dataType: "JSON",
            data: {
                employee_id: employee_id
            },
            cache: false,
            success: function(data) {
                console.log(data);
                $.each(data, function(employee_id, employee_name,
                    department, line, message) {
                    $('[name="employee_name"]').val(data.employee_name);
                    $('[name="department"]').val(data.department);
                    $('[name="line"]').val(data.line);

                });

                px.focus();
                cari_pinjam();
            },
            error: function() {
                toastr.error('data karyawan tidak pinjam barang!')
                pc.focus();

            }
        })
    }
    pc.focus();

    var px = document.getElementById('item_code');
    var pl = document.getElementById('remark');




    $("#simpan").on('click', function(e) {
        e.preventDefault()

        var pc = document.getElementById('employee_id');
        var employee_id = $('#employee_id').val();
        var item_code = $('#item_code').val();
        var no_pinjam = $('#no_pinjam').val();
        var no_return = $('#no_return').val();
        var status = $('#status').val();

        if (employee_id != "" && no_pinjam != "" && status == "OUT") {
            // $("#simpan").attr("disabled", "disabled");
            $.ajax({
                url: "<?php echo base_url("Controller_Pengembalian/create_return_ajax"); ?>",
                type: "POST",
                data: {
                    type: 1,
                    no_return: no_return,
                    employee_id: employee_id,
                    no_pinjam: no_pinjam,
                    item_code: item_code
                },
                cache: false,
                success: function(dataResult) {


                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {

                        kd_otomatis_no_return();

                        toastr.success(
                            'data berhasil disimpan!'
                        );
                        reload_table();
                        pc.focus();

                        bersihkan_input();

                        $('#simpan').prop('disabled', true);

                    } else if (dataResult.statusCode == 201) {
                        alert("Error occured !");
                    }
                }
            });

        } else if (status == "") {

            toastr.error('Barang tidak dipinjam / sudah kembali!');


        }
    });

})
</script>