<!-- <div class="container">


	<div class="row justify-content-center">

		<div class="col-lg-7">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
				
					<div class="row">

						<div class="col-lg">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Login Page</h1>
								</div>
								<?= $this->session->flashdata('message'); ?>
								<form class="user" method="post" action="<?= base_url('auth'); ?>">
									<div class="form-group">
										<input type="text" class="form-control form-control-user" id="email" placeholder="Enter Email Address..." name="email" value="<?= set_value('email'); ?>">
										<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									<div class="form-group">
										<input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
										<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>

									<button type="submit" class="btn btn-primary btn-user btn-block">
										Login
									</button>


								</form>
								<hr>
								<div class="text-center">
									<a class="small" href="forgot-password.html">Forgot Password?</a>
								</div>
								<div class="text-center">
									<a class="small" href="<?= base_url('auth/registration'); ?>">Create an Account!</a>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

</div> -->


<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h3"><b>TIMW</b>Indonesia</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?= $this->session->flashdata('message'); ?>
                <form class="user" method="post" action="<?= base_url('auth'); ?>">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-user" id="email"
                            placeholder="Enter Email Address..." name="email" value="<?= set_value('email'); ?>">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>

                            </div>
                        </div>
                    </div>
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>


                    <div class="input-group mb-3">
                        <input type="password" class="form-control form-control-user" id="password" name="password"
                            placeholder="Password">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <!-- /.social-auth-links -->


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->