  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Dashboard</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Dashboard</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">

          <div class="row">
              <div class="container">
                  <h3 class="text-center" id="jam"></h3>

              </div>
          </div>
          <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                          <div class="inner">
                              <h3><?= $item; ?></h3>

                              <p>Item</p>
                          </div>
                          <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                          </div>
                          <!-- <a href=<?= base_url('Controller_Trimsorder'); ?> class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                          <div class="inner">
                              <h3><?= $employee; ?></h3>
                              <p>Employee</p>
                          </div>
                          <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                          </div>
                          <!-- <a href=<?= base_url('Controller_Purchase'); ?> class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                          <div class="inner">
                              <h3><?= $pinjam; ?></h3>

                              <p>Peminjaman</p>


                          </div>
                          <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                          </div>

                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-danger">
                          <div class="inner">
                              <h3><?= $retur; ?></h3>

                              <p>Pengembalian</p>
                          </div>
                          <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                          </div>

                      </div>
                  </div>
                  <!-- ./col -->
              </div>
              <!-- /.row -->

              <div class="card">
                  <!-- /.card-header -->

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
                                  <th>LINE.</th>
                                  <th>ITEM CODE.</th>
                                  <th>Desc.</th>
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
    //call function show all product
    table = $('#example6').DataTable({
        "responsive": true,
        "autoWidth": false,
        "dom": 'Bfrtip',
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

        "ajax": {
            url: '<?php echo site_url('Admin/get_data_transaksi') ?>',
            type: 'POST'
        }
    }).buttons().container().appendTo('#example6_wrapper .col-md-6:eq(0)');
});
  </script>