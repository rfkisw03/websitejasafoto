<?php
session_start();
error_reporting(0);
include('config.php');
include('format_rupiah.php');
include('library.php');
include('base_url.php');
if (strlen($_SESSION['alogin']) == 0) {
	header("location:" . $base_url . "/admin/login");
}
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">

	<title><?php echo $pagedesc; ?></title>

	<link rel="shortcut icon" href="<?php echo $base_url ?>/admin/img/fav.png">

	<!-- Font awesome -->
	<link rel="stylesheet" href="<?php echo $base_url ?>/admin/css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo $base_url ?>/admin/css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="<?php echo $base_url ?>/admin/css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="<?php echo $base_url ?>/admin/css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="<?php echo $base_url ?>/admin/css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="<?php echo $base_url ?>/admin/css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="<?php echo $base_url ?>/admin/css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="<?php echo $base_url ?>/admin/css/style.css">
	<script type="text/javascript">
		function valid(theform) {
			pola_nama = /^[a-zA-Z]*$/;
			if (!pola_nama.test(theform.vehicletitle.value)) {
				alert('Hanya huruf yang diperbolehkan untuk Nama ');
				theform.vehicletitle.focus();
				return false;
			}
			return (true);
		}
	</script>
	<script type="text/javascript">
		function valid() {
			if (document.laporan.akhir.value < document.laporan.awal.value) {
				alert("Tanggal akhir harus lebih besar dari tanggal awal!");
				return false;
			}
			return true;
		}
	</script>
	<style>
		.errorWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #dd3d36;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		}

		.succWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #5cb85c;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		}
	</style>

</head>

<body>
	<?php include('navbar.php'); ?>