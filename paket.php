<!--Header-->
<?php include('header.php'); ?>
<!-- /Header -->

<!--Page Header-->
<section class="page-header listing_page">
	<div class="container">
		<div class="page-header_wrap">
			<div class="page-heading">
				<h1>Daftar Paket Fotografi</h1>
			</div>
			<ul class="coustom-breadcrumb">
				<li><a href="#">Home</a></li>
				<li>Daftar Paket Fotografi</li>
			</ul>
		</div>
	</div>
	<div class="dark-overlay"></div>
</section>
<!-- /Page Header-->

<!--Listing-->
<section class="section-padding gray-bg">
	<div class="container">
		<?php
		$sql1 = "SELECT * FROM paket ORDER BY nama_paket";
		$query1 = mysqli_query($koneksidb, $sql1);
		if (mysqli_num_rows($query1) > 0) {
			while ($results = mysqli_fetch_array($query1)) {
		?>
				<div class="col-list-3">
					<div class="recent-car-list">
						<div class="car-info-box"> <a href="paket_detail.php?pkt=<?php echo htmlentities($results['id_paket']); ?>"><img src="image/paket/<?php echo htmlentities($results['foto_paket']); ?>" class="img-responsive" alt="image"></a></div>
						<div class="car-title-m">
							<h6><a href="paket_detail.php?pkt=<?php echo htmlentities($results['id_paket']); ?>" align='center'><?php echo htmlentities($results['nama_paket']); ?></a></h6>
							<span class="price"><?php echo htmlentities(format_rupiah($results['harga'])); ?> /Pack</span>
						</div>
						<div class="inventory_info_m">
							<p><?php echo substr($results['ket_paket'], 0, 70); ?></p>
						</div>
					</div>
				</div>
		<?php }
		} ?>
	</div>
</section>
<!-- /Resent Cat -->

<!--Footer -->
<?php include('includes/footer.php'); ?>
<!-- /Footer-->

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top-->

<!--Login-Form -->
<?php include('includes/login.php'); ?>
<!--/Login-Form -->

<!--Register-Form -->
<?php include('includes/registration.php'); ?>

<!--/Register-Form -->

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php'); ?>

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