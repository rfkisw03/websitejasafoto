<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
require 'base_url.php';
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else { ?>
	<? ?>

	<body>
		<?php include('includes/header.php'); ?>

		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<h2 class="page-title">Data Gallery</h2>
							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<a href="gal_tambah.php" class="btn btn-success">Tambah</a>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Foto</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$nomor = 0;
												$sqlmobil = "SELECT * FROM galery ORDER BY id_galery DESC";
												$querymobil = mysqli_query($koneksidb, $sqlmobil);
												while ($result = mysqli_fetch_array($querymobil)) {
													$nomor++;
												?>
													<tr>
														<td><?php echo htmlentities($nomor); ?></td>
														<td><img src="gallery/<?php echo $result['foto_galery']; ?>" width="200px"></td>
														<td align="center">
															<a href="gal_edit.php?id=<?php echo $result['id_galery']; ?>" class="btn btn-warning btn-xs">&nbsp;&nbsp;Ubah&nbsp;&nbsp;</a>&nbsp;&nbsp;
															<a href="gal_hapus.php?id=<?php echo $result['id_galery']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus galery?');" class="btn btn-danger btn-xs">&nbsp;&nbsp;Hapus&nbsp;&nbsp;</a>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Loading Scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>
	</body>

	</html>
<?php } ?>