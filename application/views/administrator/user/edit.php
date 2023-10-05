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



								<?= form_open_multipart('user/edit'); ?>
								<div class="form-group row">
									<label for="email" class="col-sm-2 col-form-label">email</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email" value=<?= $user['email']; ?> readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label">name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" value=<?= $user['name'] ?>>
										<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-2">Picture</div>
									<div class="col-sm-10">
										<div class="row">
											<div class="col-sm-3">

												<img src="<?= base_url('assets/admin/img/profile/') . $user['image']; ?>" class="img-thumbnail">
											</div>

											<div class="col-sm-9">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="image" name="image">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>

											</div>

										</div>
									</div>
								</div>
							</div>

						</div>



						<div class="form-group row justify-content-end">


							<div class="col-sm-11">
								<button type="submit" class="btn btn-primary"> Edit</button>
							</div>

						</div>


						</form>
					</div>
					<!-- /.container-fluid -->



				</div>
			</div>
		</div>
</div>
</div>
</div>
</div>
<!-- End of Main Content -->

<script>
	$('.custom-file-input').on('change', function() {

		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(fileName);

	});
</script>