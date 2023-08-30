<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-tshirt"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Kurios </span> </div>
	</a>




	<!-- Divider -->


	<hr class="sidebar-divider mb-1">

	<?php

	if (!$this->session->userdata('email')) {

		redirect('auth');
	}

	$role_id = $this->session->userdata('role_id');
	$queryMenu = "SELECT `user_menu`.`id`,`menu`
    FROM `user_menu` JOIN `user_access_menu`
    ON `user_menu`.`id` = `user_access_menu`.`menu_id` 
    WHERE  `user_access_menu`.`role_id` = $role_id
    ORDER BY `user_access_menu`.`menu_id` ASC";

	$menu = $this->db->query($queryMenu)->result_array();
	?>

	<!-- LOOPING MENU -->
	<?php foreach ($menu as $m) : ?>
		<div class="sidebar-heading">

			<?= $m['menu']; ?>
		</div>



		<?php



		$menuid = $m['id'];
		$querysubmenu = "SELECT *
        FROM `v_menu`
        WHERE  `v_menu`.`menu_id` = $menuid AND `is_active` = 1";

		$submenu = $this->db->query($querysubmenu)->result_array();
		?>

		<?php foreach ($submenu as $sm) : ?>

			<?php if ($title == $sm['title']) : ?>
				<li class="nav-item active">

				<?php else : ?>
				<li class="nav-item">
				<?php endif; ?>
				<a class="nav-link pb-0 pt-2" href="<?= base_url($sm['url']); ?>">
					<i class="<?= $sm['icon']; ?>"></i>
					<span><?= $sm['title']; ?></span></a>
				</li>

			<?php endforeach; ?>

			<!-- Divider -->
			<hr class="sidebar-divider mt-1 mb-1">

		<?php endforeach; ?>





		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('auth/logout'); ?>">
				<i class="fas fa-fw fa-sign-out-alt"></i>
				<span>logout</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">




		<!-- Sidebar Toggler (Sidebar) -->
		<div class="text-center d-none d-md-inline">
			<button class="rounded-circle border-0" id="sidebarToggle"></button>
		</div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

	<!-- Main Content -->
	<div id="content">






		<!-- Custom scripts for all pages-->
		<script src="<?= base_url('assets/'); ?>/admin/js/sb-admin-2.min.js"></script>