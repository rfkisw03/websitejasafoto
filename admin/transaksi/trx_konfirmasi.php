<?php
require '../includes/header.php';

if (isset($_REQUEST['belum'])) {
	$belum = intval($_GET['belum']);
	$status1 = 1;
	$sql = "UPDATE transaksi SET stt_dp='$status1' WHERE  id_trx='$belum'";
	$query = mysqli_query($koneksidb, $sql);
	if ($query) {
		echo "<script>
						alert('Data berhasil diubah!');
						document.location='trx_konfirmasi.php';
				</script>";
	}
}

if (isset($_REQUEST['lunas'])) {
	$lunas = intval($_GET['lunas']);
	$status2 = 2;
	$sql2 = "UPDATE transaksi SET stt_dp='$status2' WHERE  id_trx='$lunas'";
	$query2 = mysqli_query($koneksidb, $sql2);
	if ($query2) {
		echo "<script>
					alert('Data berhasil diubah!');
					document.location='trx_konfirmasi.php'; 
			</script>";
	}
}

?>


<div class="ts-main-content">
	<?php include('../includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-md-12">

					<h2 class="page-title">Booking Menunggu Konfirmasi</h2>

					<!-- Zero Configuration Table -->
					<div class="panel panel-default">
						<div class="panel-heading">Daftar Booking Menunggu Konfirmasi</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr align="center">
											<th>No</th>
											<th>Kode Booking</th>
											<th>Paket </th>
											<th>Tgl. Take</th>
											<th>Jam</th>
											<th>Biaya</th>
											<th>Member</th>
											<th>Status</th>

											<th>Status DP</th>
											<th>Biaya Dp</th>
											<th class="justify-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 0;
										$sqlsewa = "SELECT transaksi.*,paket.*,member.* FROM transaksi, paket, member 
													WHERE transaksi.id_paket=paket.id_paket AND transaksi.email=member.email 
													AND transaksi.stt_trx='Menunggu Konfirmasi'
													ORDER BY transaksi.id_trx DESC";
										$querysewa = mysqli_query($koneksidb, $sqlsewa);
										while ($result = mysqli_fetch_array($querysewa)) {
											$i++;
										?>
											<tr align="center">
												<td><?php echo $i; ?></td>
												<td><?php echo htmlentities($result['id_trx']); ?></td>
												<td><?php echo htmlentities($result['nama_paket']); ?></td>
												<td><?php echo IndonesiaTgl(htmlentities($result['tgl_take'])); ?></td>
												<td><?php echo htmlentities($result['jam_take']); ?></td>
												<td><?php echo format_rupiah(htmlentities($result['harga'])); ?></td>
												<td><a href="#myModal" data-toggle="modal" data-load-id="<?php echo $result['email']; ?>" data-remote-target="#myModal .modal-body"><?php echo $result['nama_user']; ?></a></td>
												<td><?php echo htmlentities($result['stt_trx']); ?></td>
												<td><?php echo htmlentities($result['stt_dp']); ?></td>
												<td><?php echo format_rupiah(htmlentities($result['dp'])); ?></td>
												<?php if ($result['stt_dp'] == 0) { ?>

													<td>

														<a href="trx_konfirmasi.php?belum=<?php echo $result['id_trx']; ?>" onclick="return confirm('Yakin Ingin Mengubah Data?')"><button class="btn btn-danger">Belum Lunas</button></a>
														<a href="trx_konfirmasi.php?lunas=<?php echo $result['id_trx']; ?>" onclick="return confirm('Yakin Ingin Mengubah Data?')"><button class="btn btn-success btn-2x">Lunas</button></a>

													</td>
												<?php } else if ($result['stt_dp'] == 1) { ?>
													<td>


														<!--<a href="sewa_konfirmasi?belum=<?php echo $result['id_booking']; ?>" onclick="return confirm('Yakin Ingin Mengubah Data?')"  ><button class="btn btn-danger">Belum Lunas</button></a>-->
														BELUM LUNAS
														<!--<a href="sewa_konfirmasi?lunas=<?php echo $result['id_booking']; ?>" onclick="return confirm('Yakin Ingin Mengubah Data?')"  ><button class="btn btn-success btn-2x">Lunas</button></a>-->

													</td>
												<?php } else if ($result['stt_dp'] == 2) { ?>

													<td>

														<!--<a href="sewa_konfirmasi?belum=<?php echo $result['id_booking']; ?>" onclick="return confirm('Yakin Ingin Mengubah Data?')"  ><button class="btn btn-danger">Belum Lunas</button></a>-->
														LUNAS
														<!--<a href="sewa_konfirmasi?lunas=<?php echo $result['id_booking']; ?>" onclick="return confirm('Yakin Ingin Mengubah Data?')"  ><button class="btn btn-success btn-2x">Lunas</button></a>-->

													</td>
												<?php } ?>

												<td>
													<a href="trx_konfirmasi_cek.php?id=<?php echo $result['id_trx']; ?>" class="btn btn-warning btn-xs">&nbsp;&nbsp;Cek Pembayaran&nbsp;&nbsp;</a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
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
	</div>
</div>

<?php
require '../includes/footer.php';
?>