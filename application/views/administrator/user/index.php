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

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body pb-0">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
              <div class="card-header text-muted border-bottom-0">
                <?= $this->session->flashdata('message'); ?>

              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h2 class="lead"><b><?= $user['name']; ?></b></h2>
                    <p class="text-muted text-sm"><b>Email: </b><?= $user['email']; ?> </p>
                    <p class="text-muted text-sm"><b>Create: </b><?= date('d F Y', $user['date_created']); ?> </p>

                  </div>
                  <div class="col-5 text-center">
                    <img src="<?= base_url('assets/admin/img/profile/') . $user['image']; ?>" class="img-circle img-fluid">

                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->