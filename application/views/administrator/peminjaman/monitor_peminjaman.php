<style>
.box-login input {
    width: 100%;
    padding: 5px 0;
    background: none;
    border: none;
    outline: none;
    font-size: 18px;
    color: white;
}
</style>
<section class="conten">
    <div class="container-fluid">


        <div class="row bg-dark">
            <div class="col-12">
            <div class="col-1 text-center">
                        <h5 id="jam"></h5>

                    </div>
                <div class="row">
                  
                    <div class="col-12 text-center">
                        <h5>PEMINJAMAN</h5>

                    </div>


                </div>


                <div id="flash_data">
                    <div id="isi_pesan"><?= $this->session->flashdata('message'); ?></div>
                </div>


                <div class="card bg-dark">
                    <div class="card-body">

                    <a href="<?= base_url('admin'); ?>" class="btn btn-danger btn-sm">back</a>

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
                                <!-- <th scope="col">Action</th> -->
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




window.setTimeout(function() {
    $("#flash_data").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 800);



$(document).ready(function() {
    table = $('#example1').DataTable({
        "responsive": true,

        "ajax": {
            url: '<?php echo site_url('Controller_Peminjaman/get_data_monitor_peminjaman') ?>',
            type: 'POST'
        }

    });


    $('#simpan').prop('disabled', true);
});

function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 

}

$("#item_code").keydown(function(){

  let ams = $("#item_code").val();
  if(ams.match(/'#/g)){
    toastr.error('tidak boleh menggunakan tanda #!')
  }

 
});



$(document).ready(function() {



    $("#simpan").on('click', function(e) {
        e.preventDefault()

       



            var pc = document.getElementById('employee_id');
        var employee_id = $('#employee_id').val();
        var item_code = $('#item_code').val();
        var no_out = $('#no_out').val();
        var status = $('#status').val();

        if (employee_id != "" && item_code != "" && status != "OUT") {
            // $("#simpan").attr("disabled", "disabled");
            $.ajax({
                url: "<?php echo base_url("Controller_Peminjaman/create_out_ajax"); ?>",
                type: "POST",
                data: {
                    type: 1,
                    // no_out: no_out,
                    employee_id: employee_id,
                    item_code: item_code
                },
                cache: false,
                success: function(dataResult) {


                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {

                        // kd_otomatis_no_out();

                        toastr.success(
                            'data berhasil disimpan!'
                        );
                        reload_table();
                        pc.focus();


                        $('#employee_id').val('');
                        $('#employee_name').val('');
                        $('#department').val('');
                        $('#line').val('');
                        $('#item_code').val('');
                        $('#item_description').val('');
                        $('#status').val('');





                        $('#simpan').prop('disabled', true);

                    } else if (dataResult.statusCode == 201) {
                        alert("Error occured !");
                    }
                }
            });

        } else if (status === "OUT") {

            toastr.error('Barang sudah dipinjam!');
            $('#simpan').prop('disabled', true);


            $('#employee_id').val('');
            $('#employee_name').val('');
            $('#department').val('');
            $('#line').val('');
            $('#item_code').val('');
            $('#item_description').val('');
            $('#status').val('');

            pc.focus();


        }



        




          });



    var pc = document.getElementById('employee_id');
    var px = document.getElementById('item_code');

    pc.focus();


    pc.onchange = function() {
        var employee_id = $(this).val();
        if(employee_id.match(/'#/g)){
            toastr.error('tidak boleh menggunakan tanda #!')
        } else{






        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Controller_Peminjaman/get_data_nik') ?>/",
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
            },
            error: function() {
                toastr.error('data karyawan tidak ditemukan!')
                pc.focus();

            }
        })
    }
    }
    pc.focus();

    var px = document.getElementById('item_code');
    var pl = document.getElementById('remark');



    px.onchange = function() {
        var item_code = $(this).val();
        // $('[name="item_description"]').val('');

        let ams = $("#item_code").val();
        if(ams.match(/'#/g)){
            toastr.error('tidak boleh menggunakan tanda #!')
        } else{





        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Controller_Peminjaman/get_data_kode') ?>/",
            dataType: "JSON",
            data: {
                item_code: item_code
            },
            cache: false,
            success: function(data) {
                $.each(data, function(item_code, item_description, status) {
                    $('[name="item_description"]').val(data.item_description);

                    if (data.status == 1) {
                        $('[name="status"]').val('OUT');
                    } else {
                        $('[name="status"]').val('');
                    }

                    // $('[name="status"]').val(data.status);
                });

                $('#simpan').prop('disabled', false);
                $('#simpan').click();

            },
            error: function() {
                toastr.error('data item tidak ditemukan!')
                px.focus();

            }
        });
    }}
})
</script>