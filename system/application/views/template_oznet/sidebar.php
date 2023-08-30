<body class="hold-transition sidebar-mini layout-fixed text-sm">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url('assets/'); ?>AdminLTE/dist/img/AdminLTELogo.png"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <i class="fas fa-tshirt ml-4 mr-3"></i>
                <span class="brand-text font-weight-light">TIMW INONEISA</span>
            </a>


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('assets/'); ?>AdminLTE/dist/img/user2-160x160.jpg"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $user['email'] ?></a>
                    </div>
                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <?php

                        if (!$this->session->userdata('email')) {

                            redirect('auth');
                        }

                        $role_id = $this->session->userdata('role_id');
                        $queryMenu = "SELECT `user_menu`.`id`,`menu`, `icon`
                            FROM `user_menu` JOIN `user_access_menu`
                            ON `user_menu`.`id` = `user_access_menu`.`menu_id` 
                            WHERE  `user_access_menu`.`role_id` = $role_id
                            ORDER BY `user_access_menu`.`menu_id` ASC";

                        $menu = $this->db->query($queryMenu)->result_array();
                        ?>


                        <!-- LOOPING MENU -->

                        <?php foreach ($menu as $m) : ?>
                        <?php if($this->uri->segment(1) == 'controller_item'){

                            }?>

                        <li class="nav-item">
                            <a href=" #" class="nav-link"><i class="<?= $m['icon']; ?> nav-icon"></i>

                                <?= $m['menu']; ?>
                                <i class="fas fa-angle-left right "></i>

                            </a>

                            <?php
                                $menuid = $m['id'];
                                $querysubmenu = "SELECT * FROM `v_menu` WHERE  `v_menu`.`menu_id` = $menuid AND `is_active` = 1";

                                $submenu = $this->db->query($querysubmenu)->result_array();
                            ?>



                            <?php foreach ($submenu as $sm) : ?>

                            <?php if ($title == $sm['title']) : ?>

                            <!-- <li class="nav-item menu-open"> -->

                            <ul class="nav nav-treeview">

                                <a href="<?= base_url($sm['url']); ?>" class="nav-link active">
                                    <i class="<?= $sm['icon']; ?> nav-icon"></i>
                                    <p><?= $sm['title']; ?></p>
                                </a>


                            </ul>



                            <?php else : ?>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url($sm['url']); ?>" class="nav-link">
                                        <i class="<?= $sm['icon']; ?> nav-icon"></i>
                                        <p><?= $sm['title']; ?></p>
                                    </a>
                                </li>
                            </ul>



                            <?php endif; ?>
                            <?php endforeach; ?>

                        </li>
                        <hr class="sidebar-divider mt-1 mb-1">


                        <?php endforeach; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                                <i class="fas fa-fw fa-sign-out-alt"></i>
                                <span>logout</span></a>
                        </li>


                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>