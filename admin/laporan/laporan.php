<?php
require '../includes/header.php';
?>



<div class="ts-main-content">
	<?php include('../includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<h2 class="page-title">Laporan</h2>
			<div class="panel panel-default">
				<div class="panel-body">
					<form method="get" name="laporan" onSubmit="return valid();">
						<div class="form-group">
							<div class="col-sm-4">
								<label>Tanggal Awal</label>
								<input type="date" class="form-control" name="awal" placeholder="From Date(dd/mm/yyyy)" required>
							</div>
							<div class="col-sm-4">
								<label>Tanggal Akhir</label>
								<input type="date" class="form-control" name="akhir" placeholder="To Date(dd/mm/yyyy)" required>
							</div>
							<div class="col-sm-4">
								<label>&nbsp;</label><br />
								<input type="submit" name="submit" value="Lihat Laporan" class="btn btn-primary">
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php
			if (isset($_GET['submit'])) {
				$no = 0;
				$mulai 	 = $_GET['awal'];
				$selesai = $_GET['akhir'];
				$stt	 = "Sudah Dibayar";
				$stt1	 = "Selesai";
				$sqlsewa = "SELECT * FROM transaksi WHERE stt_trx='$stt' OR stt_trx='$stt1' AND tgl_bayar BETWEEN '$mulai' AND '$selesai'";
				$querysewa = mysqli_query($koneksidb, $sqlsewa);
			?>
				<!-- Zero Configuration Table -->
				<div class="panel panel-default">
					<div class="panel-heading">Laporan Booking Tanggal <?php echo IndonesiaTgl($mulai); ?> sampai <?php echo IndonesiaTgl($selesai); ?></div>
					<div class="panel-body">
						<div class="table-responsive">
							<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Booking</th>
										<th>Tanggal Transaksi</th>
										<th>Tanggal Bayar</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while ($result = mysqli_fetch_array($querysewa)) {
										$paket = $result['id_paket'];
										$sqlpaket = "SELECT * FROM paket WHERE id_paket='$paket'";
										$querypaket = mysqli_query($koneksidb, $sqlpaket);
										$res = mysqli_fetch_array($querypaket);

										$no++;
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td>
												<a href="#myModal" data-toggle="modal" data-load-code="<?php echo $result['id_trx']; ?>" data-remote-target="#myModal .modal-body"><?php echo $result['id_trx']; ?></a>
											</td>
											<td><?php echo IndonesiaTgl(htmlentities($result['tgl_trx'])); ?></td>
											<td><?php echo IndonesiaTgl(htmlentities($result['tgl_bayar'])); ?></td>
											<td><?php echo format_rupiah($res['harga']); ?></td>
										</tr>
									<?php }
									?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="form-group">
					<a href="laporan_cetak.php?awal=<?php echo $mulai; ?>&akhir=<?php echo $selesai; ?>" target="_blank" class="btn btn-primary">Cetak</a>
				</div>
			<?php } ?>

			<!-- Large modal -->
			<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-body">
							<p>One fine body…</p>
						</div>
					</div>
				</div>
			</div>
			<!-- Large modal -->


		</div>
	</div>

</div>
</div>
</div>

<?php
require '../includes/footer.php';
?>