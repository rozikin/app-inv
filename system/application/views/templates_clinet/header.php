<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kurios | Textile</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>client/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>client/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>client/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>client/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>client/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>client/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>client/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>client/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="<?= base_url('assets/'); ?>client/img/logo.svg" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <!-- <div class="header__top__right__language">
                <img src="<?= base_url('assets/'); ?>client/img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div> -->
            <div class="header__top__right__auth">
                <a href="<?= base_url('auth'); ?>"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> eduardus@kurios-utama.com</li>
                <li>(0298) 522 340</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> eduardus@kurios-utama.com</li>
                                <li>(0298) 522 340</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <!-- <div class="header__top__right__language">
                                <img src="<?= base_url('assets/'); ?>client/img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div> -->
                            <div class="header__top__right__auth">
                                <a href="<?= base_url('auth'); ?>"><i class="fa fa-user"></i> Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__nav">


            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="header__logo">
                            <a href=""><img src="<?= base_url('assets/'); ?>client/img/logo.svg" alt=""></a>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <nav class="header__menu">
                            <ul>
                                <li class="active"><a href="./index.html">Home</a></li>
                                <li><a href="./shop-grid.html">Shop</a></li>
                                <li><a href="#">Pages</a>
                                    <ul class="header__menu__dropdown">
                                        <li><a href="./shop-details.html">Shop Details</a></li>
                                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                        <li><a href="./checkout.html">Check Out</a></li>
                                        <li><a href="./blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="./blog.html">Blog</a></li>
                                <li><a href="./contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3">
                        <div class="header__cart">
                            <ul>
                                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                            </ul>
                            <div class="header__cart__price">item: <span>$150.00</span></div>
                        </div>
                    </div>
                </div>
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">

                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>(0298) 522 340</h5>
                                <span>contact number</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">

            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="<?= base_url('assets/'); ?>client/img/banner/bgr-1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?= base_url('assets/'); ?>client/img/banner/banner-2.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?= base_url('assets/'); ?>client/img/banner/banner-1.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="header-slide">

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 mt-2 mb-2 ml-2">
                            <h4 class="text-white">Supplier Kain Jaket, Parasut &amp; Kaos Terlengkap &amp; Termurah di Indonesia.</h4>
                        </div>
                        <div class="col-md-3 mt-2 mb-2 d-inline ml-2">
                            <div class="btn btn-danger"> Read More</div>
                        </div>
                    </div>
                </div>
            </div>




            <!-- <div class="hero__item set-bg mt-3" data-setbg="<?= base_url('assets/'); ?>client/img/hero/banner.jpg">
                <div class="hero__text">
                    <span>FRUIT FRESH</span>
                    <h2>Vegetable <br />100% Organic</h2>
                    <p>Free Pickup and Delivery Available</p>
                    <a href="#" class="primary-btn">SHOP NOW</a>
                </div>
            </div> -->
        </div>


    </section>
    <!-- Hero Section End -->