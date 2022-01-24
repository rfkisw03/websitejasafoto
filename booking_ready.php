<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
include('includes/base_url.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (strlen($_SESSION['ulogin']) == 0) {
	header('location:index.php');
} else {

	$sqlrek = mysqli_query($koneksidb, "select * from tblpages where PageName = 'Rekening' ");
	$resrek = mysqli_fetch_array($sqlrek);
	$rek = $resrek['detail'];

	$web = mysqli_query($koneksidb, "select * from contactusinfo where id= '1' ");
	$tampilweb = mysqli_fetch_array($web);
	$telp_web = $tampilweb['telp_kami'];
	if (isset($_POST['submit'])) {



		$fromdate	= $_POST['fromdate'];
		$tglnow		= date('Y-m-d');
		$pkt			= $_POST['pkt'];
		$jam		= $_POST['jam'];
		$cat		= $_POST['catatan'];
		$email		= $_SESSION['ulogin'];
		$stt		= "Menunggu Pembayaran";
		$bukti		= "";
		$durasi		= 1;
		$cek		= 0;

		$trx		= date('dmYHis');
		//insert
		$sql 	= "INSERT INTO transaksi (id_trx,email,id_paket,tgl_trx,stt_trx,tgl_take,jam_take,catatan)
			   VALUES('$trx','$email','$pkt','$tglnow','$stt','$fromdate','$jam','$cat')";
		$query 	= mysqli_query($koneksidb, $sql);
		if ($query == TRUE) {
			for ($cek; $cek < $durasi; $cek++) {
				$tglmulai = strtotime($fromdate);
				$jmlhari  = 86400 * $cek;
				$tgl	  = $tglmulai + $jmlhari;
				$tglhasil = date("Y-m-d", $tgl);
				$sql1	= "INSERT INTO cek_transaksi (id_trx,id_paket,tgl_trx,stt_trx)VALUES('$trx','$pkt','$tglhasil','$stt')";
				$query1 = mysqli_query($koneksidb, $sql1);
			}
			include('libary/Exception.php');
			include('libary/class.phpmailer.php');
			include('libary/class.smtp.php');

			$email_pengirim = 'kikitheboom@gmail.com';
			$nama_pengirim = 'E-Moment';
			$email_penerima = $email;
			$subjek = "Transaksi Anda Sedang Diproses";
			$pesan = " 

			<body style='margin: 10px;'>
				<div style='padding: 15px;'>
					<center> 
						
						<h1>Halo, <b>" . $email . "</b></h1>
						<h2>Terima Kasih Sudah Bertransaksi di <b>" . $nama_pengirim . "</b></h2>
						<h2>Silahkan melakukan pembayaran dengan nomer rekening <b>" . $rek . "</b></h2>
						<h2>Jika terjadi kendala pada saat melakukan pembayaran silahkan hubungi <b> " . $telp_web . "</b></h2>
						<h4><b>Klik Link Dibawah Untuk melanjutkan transaksi anda</h4><br>
						<a style='padding:10px 20px;border: solid 1px #125a63;background-color: #125a63;border-radius: 100px;color: #fff;text-decoration: none;margin-bottom:15px;' href='" . $base_url . "/riwayatsewa.php' >Cek Riwayat</a>
					</center>
				</div> 
			</body>";
			$mail = new PHPMailer();
			$mail->isSMTP();

			$mail->Host = "smtp.gmail.com";

			$mail->Username = $email_pengirim; // Gmail address which you want to use as SMTP server
			$mail->Password = 'jzfdfydkujztfley'; // Gmail address Password
			$mail->Port = 465;

			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "ssl";
			$mail->SMTPDebug = 2;
			$mail->SetFrom($email_pengirim, $nama_pengirim); //set email pengirim
			$mail->addAddress($email_penerima); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)
			$mail->isHTML(true);
			$mail->Subject = $subjek;
			$mail->Body = $pesan;
			$send = $mail->send();

			echo " <script> alert ('Transaksi Berhasil.'); </script> ";
			echo "<script type='text/javascript'> document.location = 'riwayatsewa.php'; </script>";
		} else {
			echo " <script> alert ('Ooops, terjadi kesalahan. Silahkan coba lagi.'); </script> ";
			echo "<script type='text/javascript'> document.location = 'booking.php?pkt=$pkt'; </script>";
		}
	}
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
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="assets/css/style.css" type="text/css">
		<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
		<link href="assets/css/slick.css" rel="stylesheet">
		<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
		<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="admin/img/fav.png">
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
	</head>

	<body>

		<!-- Start Switcher -->
		<?php include('includes/colorswitcher.php'); ?>
		<!-- /Switcher -->

		<!--Header-->
		<?php include('includes/header.php'); ?>
		<!--Page Header-->
		<!-- /Header -->

		<!--Page Header
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>My Booking</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>My Booking</li>
      </ul>
    </div>
  </div>
  <div class="dark-overlay"></div>
</section>
<!- /Page Header-->
		<div>
			<br />
			<center>
				<?php

				$sql1	= "SELECT id_trx FROM cek_transaksi WHERE tgl_trx between '$fromdate' AND id_paket='$pkt' AND stt_trx !='Selesai'";
				$query1 	= mysqli_query($koneksidb, $sq1);
				$jumlah = mysqli_num_rows($query1);

				?>
				<h3><?php echo $jumlah; ?>Paket Tersedia untuk disewa.</h3>
			</center>
			<hr>
		</div>
		<?php
		$email = $_SESSION['ulogin'];
		$pkt = $_GET['pkt'];
		$mulai = $_GET['mulai'];
		$jam	= $_GET['jam'];
		$catatan = $_GET['catatan'];
		$start = new DateTime($mulai);

		$sql1 = "SELECT * FROM paket WHERE id_paket='$pkt'";
		$query1 = mysqli_query($koneksidb, $sql1);
		$result = mysqli_fetch_array($query1);

		?>
		<section class="user_profile inner_pages">
			<div class="container">
				<div class="col-md-6 col-sm-8">
					<div class="product-listing-img"><img src="image/paket/<?php echo htmlentities($result['foto_paket']); ?>" class="img-responsive" alt="Image" /> </a> </div>
					<div class="product-listing-content">
						<h5><?php echo htmlentities($result['nama_paket']); ?></a></h5>
						<p class="list-price"><?php echo htmlentities(format_rupiah($result['harga'])); ?> / Packs</p>
						<p class="list-price"><?php echo htmlentities($result['ket_paket']); ?></p>
					</div>
				</div>

				<div class="user_profile_info">
					<div class="col-md-8 col-sm-10">
						<form method="post" name="sewa" onSubmit="return valid();">

							<input type="hidden" class="form-control" name="pkt" value="<?php echo $pkt; ?>" required>
							<input type="hidden" class="form-control" name="email" value="<?php echo $email; ?>" required>
							<div class="form-group">

								<label>Tanggal Take</label>
								<input type="date" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" value="<?php echo $mulai; ?>" readonly>


								<label>Jam Take</label>
								<input type="text" class="form-control" name="jam" placeholder="To Date(dd/mm/yyyy)" value="<?php echo $jam; ?>" readonly>

							</div>
							<div class="form-group">

								<label>catatan</label>
								<textarea class="form-control" name="catatan" placeholder="" readonly><?php echo $catatan; ?></textarea>



							</div>



							<div class="form-group">

								<input type="submit" name="submit" value="Sewa" class="btn btn-block">


							</div>
					</div>
				</div>

			</div>
			</form>
			</div>
			</div>
			</div>
		</section>
		<!--/my-vehicles-->
		<?php include('includes/footer.php'); ?>

		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/interface.js"></script>
		<!--Switcher-->
		<script src="assets/switcher/js/switcher.js"></script>
		<!--bootstrap-slider-JS-->
		<script src="assets/js/bootstrap-slider.min.js"></script>
		<!--Slider-JS-->
		<script src="assets/js/slick.min.js"></script>
		<script src="assets/js/owl.carousel.min.js"></script>
	</body>

	</html>
<?php } ?>