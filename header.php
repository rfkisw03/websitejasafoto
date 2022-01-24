<?php
session_start();

include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
include('includes/base_url.php');

error_reporting(0);


$web = mysqli_query($koneksidb, "select * from contactusinfo where id= '1' ");
$tampilweb = mysqli_fetch_array($web);


?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title><?php echo $pagedesc; ?></title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="<?php echo $base_url ?>/assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $base_url ?>/assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $base_url ?>/assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $base_url ?>/assets/css/owl.transitions.css" type="text/css">
    <link href="<?php echo $base_url ?>/assets/css/slick.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>/assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" id="switcher-css" type="text/css" href="<?php echo $base_url ?>/assets/switcher/css/switcher.css" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $base_url ?>/assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $base_url ?>/assets/switcher/css/orange.css" title="orange" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $base_url ?>/assets/switcher/css/blue.css" title="blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $base_url ?>/assets/switcher/css/pink.css" title="pink" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $base_url ?>/assets/switcher/css/green.css" title="green" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo $base_url ?>/assets/switcher/css/purple.css" title="purple" media="all" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $base_url ?>/assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $base_url ?>/assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $base_url ?>/assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $base_url ?>/assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?php echo $base_url ?>/admin/img/fav.png">
    <link rel="shortcut icon" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/fontawesome-webfont.woff">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>

<body>
    <!-- Start Switcher -->
    <?php include('includes/colorswitcher.php'); ?>
    <!-- /Switcher -->

    <header>
        <div class="default-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-md-3">
                        <div class="logo"><a href="index.php"><img src="<?php echo $base_url ?>/admin/img/icon.png" width="100px" height="60px" alt="image" /></a> </div>
                    </div>
                    <div class="col-sm-8 col-md-8">
                        <div class="header_info">
                            <div class="header_widgets">
                                <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
                                <p class="uppercase_text">E-mail : </p>
                                <a href="mailto:<?php echo $tampilweb['email_kami']; ?>"><?php echo $tampilweb['email_kami']; ?></a>
                            </div>
                            <div class="header_widgets">
                                <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                                <p class="uppercase_text">Telp : </p>
                                <a href="tel:<?php echo $tampilweb['telp_kami']; ?>"><?php echo $tampilweb['telp_kami']; ?></a>
                            </div>
                            <?php if (strlen($_SESSION['ulogin']) == 0) {
                            ?>
                                <div class="login_btn">
                                    <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Register</a>
                                </div>
                            <?php } else {
                                echo "Selamat Datang!";
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require "navbar.php";

        ?>

    </header>