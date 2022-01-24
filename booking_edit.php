<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
include('includes/base_url.php');
if (strlen($_SESSION['ulogin']) == 0) {
	header('location:index.php');
} else {




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

		<?php
		$kode = $_GET['kode'];
		$sql1 	= "SELECT transaksi.*,member.*,paket.* FROM transaksi, member, paket WHERE transaksi.email=member.email
		   AND transaksi.id_paket=paket.id_paket AND transaksi.id_trx='$kode'";
		$query1 = mysqli_query($koneksidb, $sql1);
		$result = mysqli_fetch_array($query1);
		$harga	= $result['harga'];
		$durasi = $result['durasi'];
		$totalsewa = $durasi * $harga;
		$tglmulai = strtotime($result['tgl_take']);
		$jmlhari  = 86400 * 1;
		$tgl	  = $tglmulai - $jmlhari;
		$tglhasil = date("Y-m-d", $tgl);

		$dp = $harga * 50 / 100;
		?>
		<section class="user_profile inner_pages">
			<center>
				<h3>Pembayaran</h3>
			</center>
			<div class="container">
				<div class="user_profile_info">
					<div class="col-md-12 col-sm-10">
						<form method="post" action="update_sewa.php" name="sewa" onSubmit="return valid();" enctype="multipart/form-data">
							<input type="hidden" class="form-control" name="id" value="<?php echo $kode; ?>" required>
							<div class="form-group">
								<label>Kode Booking</label>
								<input type="text" class="form-control" name="kode" value="<?php echo $result['id_trx']; ?>" readonly>
							</div>
							<input type="hidden" class="form-control" name="vid" value="<?php echo $vid; ?>" required>
							<div class="form-group">
								<label>Paket</label>
								<input type="text" class="form-control" name="mobil" value="<?php echo $result['nama_paket']; ?>" readonly>
							</div>
							<div class="form-group">
								<label>Tanggal Take</label>
								<input type="text" class="form-control" name="fromdate" placeholder="" value="<?php echo IndonesiaTgl($result['tgl_take']); ?>" readonly>
							</div>
							<div class="form-group">
								<label>Jam</label>
								<input type="text" class="form-control" name="todate" placeholder="" value="<?php echo $result['jam_take']; ?>" readonly>
							</div>
							<div class="form-group">
								<label>Biaya</label><br />
								<input type="text" class="form-control" name="total" value="<?php echo format_rupiah($result['harga']); ?>" readonly>
							</div>
							<div class="form-group">
								<label>Catatan</label><br />
								<textarea class="form-control" name="catatan"><?php echo $result['catatan']; ?></textarea>
							</div>



							<?php if ($result['stt_trx'] == "Menunggu Pembayaran") { ?>
								<div class="input-group">
									<label>Silahkan masukan nominal uang dp</label><br />
									<b>*dp maksimal 50% dari total biaya <br>

										<input type="text" id="masking1" class="form-control" onkeyup="get();" placeholder="<?php echo format_rupiah($dp); ?>" aria-describedby="basic-addon1" required>

										<input type="hidden" id="dp" name="dp" onkeyup="get();" class="form-control" placeholder="" style="height:auto;text-align:center;width: 100%;">

								</div>
								<div class="form-group">
									<label>Upload Bukti Pembayaran</label><br />

									<input type="file" class="form-control" name="img1">
								</div>
								<div class="form-group">
									<button class="btn btn-primary" id="dis" type="submit" name="update">Submit</button>
								</div>
							<?php
							} else {
							?>
								<div class="input-group">
									<label>Silahkan masukan nominal uang dp</label><br />
									<b>*dp maksimal 50% dari total biaya <br>

										<input type="text" id="masking1" class="form-control" onkeyup="get();" placeholder="<?php echo format_rupiah($dp); ?>" aria-describedby="basic-addon1" readonly>

										<input type="hidden" id="dp" name="dp" onkeyup="get();" class="form-control" placeholder="" style="height:auto;text-align:center;width: 100%;">

								</div><br>
								<div class="form-group">
									<label>Bukti Pembayaran</label><br />
									<img src="<?php echo base_url(); ?>/image/bukti/<?php echo $result['bukti_bayar']; ?>" width="300" height="200" style="border:solid 1px #000"><br />

								</div>
							<?php
							}
							?>
							<script>
								function get() {
									var str = document.getElementById("masking1").value;
									var res1 = str.toLowerCase().split(/[^\w\s]/g).join('');
									var res = res1.toLowerCase().split(/[^\w\S]/g).join('-');



									var max = <?php echo $dp; ?>;
									var hrg = document.getElementById("dp").value = res;
									if (hrg >= max) {
										document.getElementById("dis").disabled = true;
										document.getElementById("danger").innerHTML = '<small style="color:#aaa">Min dp <?php echo $dp; ?> !</small>';
									} else {
										document.getElementById("dis").disabled = false;
										document.getElementById("danger").innerHTML = '';
									}



								}
							</script>
						</form>
					</div>
				</div>
			</div>
		</section>
		<!--/my-vehicles-->
		<?php include('includes/footer.php'); ?>

		<!-- Scripts -->

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/interface.js"></script>
		<!--Switcher-->
		<script src="assets/switcher/js/switcher.js"></script>
		<!--bootstrap-slider-JS-->
		<script src="assets/js/bootstrap-slider.min.js"></script>
		<!--Slider-JS-->
		<script src="assets/js/slick.min.js"></script>
		<script src="assets/js/owl.carousel.min.js"></script>
		<script>
			// $(document).ready(function(){
			// $(".owl-carousel").owlCarousel();
			// });
			$(document).ready(function() {
				$('#masking1').mask('#.##0', {
					reverse: true
				});

			})
		</script>
	</body>

	</html>
<?php } ?>