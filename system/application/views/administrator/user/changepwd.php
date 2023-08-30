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

					<div class="card bg-light d-flex flex-fill">
						<div class="card-header text-muted border-bottom-0">
							<?= $this->session->flashdata('message'); ?>

						</div>
						<div class="card-body pt-0">
							<div class="row">


								<?= $this->session->flashdata('message'); ?>
								<form action="<?= base_url('user/changepwd'); ?>" method="post">

									<div class="form-group">
										<label for="current_password">Current Password</label>
										<input type="password" class="form-control" id="current_password" name="current_password" placeholder="current password">
										<?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>

									<div class="form-group">
										<label for="current_password">New Password</label>
										<input type="password" class="form-control" id="new_password1" name="new_password1" placeholder="New Password">
										<?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>

									<div class="form-group">
										<label for="new_password2">Repeat Password</label>
										<input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Repeat password">
									</div>

									<div class="form-group">
										<button type="submit" name="submit" class="btn btn-primary">Change Password</button>
									</div>

								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>