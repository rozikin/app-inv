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

          </div>
          <!-- /.content-wrapper -->
  </div>