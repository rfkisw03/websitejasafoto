<?php
require 'includes/header.php';

?>
<div class="ts-main-content">
	<?php include('includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-md-12">


					<div class="row">
						<div class="col-md-12">
							<div class="row">

								<div class="col-md-4">
									<div class="panel panel-default">
										<div class="panel-body bk-info text-light">
											<div class="stat-panel text-center">
												<?php
												$sqlbayar = "SELECT id_trx FROM transaksi WHERE stt_trx='Menunggu Pembayaran'";
												$querybayar = mysqli_query($koneksidb, $sqlbayar);
												$bayar = mysqli_num_rows($querybayar);
												?>
												<div class="stat-panel-number h1 "><?php echo htmlentities($bayar); ?></div>
												<div class="stat-panel-title text-uppercase">Menunggu Pembayaran</div>
											</div>
										</div>
										<a href="trx_bayar.php" class="block-anchor panel-footer text-center">Rincian &nbsp; <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>

								<div class="col-md-4">
									<div class="panel panel-default">
										<div class="panel-body bk-success text-light">
											<div class="stat-panel text-center">
												<?php
												$sqlkonfir = "SELECT id_trx FROM transaksi WHERE stt_trx='Menunggu Konfirmasi'";
												$querykonfir = mysqli_query($koneksidb, $sqlkonfir);
												$konfir = mysqli_num_rows($querykonfir);
												?>
												<div class="stat-panel-number h1 "><?php echo htmlentities($konfir); ?></div>
												<div class="stat-panel-title text-uppercase">Menunggu Konfirmasi</div>
											</div>
										</div>
										<a href="trx_konfirmasi.php" class="block-anchor panel-footer text-center">Rincian &nbsp; <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>

								<div class="col-md-4">
									<div class="panel panel-default">
										<div class="panel-body bk-warning text-light">
											<div class="stat-panel text-center">
												<?php

												$st = "Sudah Dibayar";
												$jadwal = "SELECT id_trx FROM transaksi WHERE stt_trx='Sudah Dibayar'";
												$querypaket = mysqli_query($koneksidb, $jadwal);
												$paket = mysqli_num_rows($querypaket);
												?>
												<div class="stat-panel-number h1 "><?php echo htmlentities($paket); ?></div>
												<div class="stat-panel-title text-uppercase">Jadwal Hari Ini</div>
											</div>
										</div>
										<a href="jadwal.php" class="block-anchor panel-footer text-center">Rincian &nbsp; <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-7">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">
										Akun yang sedang login
									</h3>
								</div><!-- /.card-header -->
								<div class="card-body">
									<div class="row">
										<div class="col-md-9">
											<?php
											$load = mysqli_query($koneksidb, "select * from admin where id ='$_SESSION[id]'");
											$tampil = mysqli_fetch_array($load);
											?>
											<table class="table table-borderless">
												<tr>
													<td>Nama</td>
													<td>:</td>
													<td><b><?php echo $tampil['name'] ?></b></td>
												</tr>
												<tr>
													<td>Username</td>
													<td>:</td>
													<td><b><?php echo $tampil['UserName'] ?></b></td>
												</tr>

												<tr>
													<td>Server</td>
													<td>:</td>
													<td><b><?php echo $_SERVER['SERVER_NAME'] ?></b></td>
												</tr>
											</table>
										</div>
									</div>
								</div><!-- /.card-body -->
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="container-fluid">

	</div>
</section>
<!-- Loading Scripts -->
<script src="<?php echo $base_url ?>/admin/js/jquery.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/bootstrap-select.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/Chart.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/fileinput.js"></script>
<script src="<?php echo $base_url ?>/admin/js/chartData.js"></script>
<script src="<?php echo $base_url ?>/admin/js/main.js"></script>

<script>
	window.onload = function() {

		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero: true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		});

		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {
			responsive: true
		});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {
			responsive: true
		});

	}
</script>
</body>

</html>