<?php
require '../includes/header.php';
?>

<div class="ts-main-content">
	<?php include('../includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-md-12">

					<h2 class="page-title">Jadwal Hari Ini</h2>

					<!-- Zero Configuration Table -->
					<div class="panel panel-default">
						<div class="panel-heading">Daftar Jadwal Pengambilan Foto Hari Ini</div>
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
											<th>Karyawan</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 0;

										$sqlsewa = "SELECT transaksi.*,paket.*,member.* FROM transaksi, paket, member
													WHERE transaksi.id_paket=paket.id_paket AND transaksi.email=member.email
													AND transaksi.stt_trx='Sudah Dibayar'
													ORDER BY transaksi.id_trx DESC";
										$querysewa = mysqli_query($koneksidb, $sqlsewa);

										$querykar = mysqli_query($koneksidb, $sqlkar);
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
												<td><a href="#myModal" data-toggle="modal" data-load-usr="<?php echo $result['email']; ?>" data-remote-target="#myModal .modal-body"><?php echo $result['nama_user']; ?></a></td>
												<td><?php echo htmlentities($result['stt_trx']); ?></td>
												<td><a href="#myModal" data-toggle="modal" data-load-kar="<?php echo $result['nama_karyawan']; ?>" data-remote-target="#myModal .modal-body"><?php echo $result['nama_karyawan']; ?></a></td>

												<td>
													<a href="jadwalview.php?id=<?php echo $result['id_trx']; ?>" class="btn btn-warning btn-xs">&nbsp;&nbsp;Cek&nbsp;&nbsp;</a>
												</td>
												<!--
												<td>
													<a href="#myModal" data-toggle="modal" data-load-code="<?php echo $result['id_trx']; ?>" data-remote-target="#myModal .modal-body"><span class="glyphicon glyphicon-eye-open"></span></a>
												</td>
										-->
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