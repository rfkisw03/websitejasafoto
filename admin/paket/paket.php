<?php
require '../includes/header.php';
?>

<div class="ts-main-content">
	<?php include('../includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h2 class="page-title">Data Paket</h2>
					<!-- Zero Configuration Table -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<a href="paket_tambah.php" class="btn btn-success">Tambah</a>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Paket</th>
											<th>Harga/Packs</th>
											<th>Foto</th>
											<th>Opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$nomor = 0;
										$sqlmobil = "SELECT * FROM paket ORDER BY nama_paket ASC";
										$querymobil = mysqli_query($koneksidb, $sqlmobil);
										while ($result = mysqli_fetch_array($querymobil)) {
											$nomor++;
										?>
											<tr>
												<td><?php echo htmlentities($nomor); ?></td>
												<td><?php echo htmlentities($result['nama_paket']); ?></td>
												<td><?php echo format_rupiah($result['harga']); ?></td>
												<td><img src="<?php echo $base_url ?>/image/paket/<?php echo $result['foto_paket']; ?>" width="100px"></td>
												<td align="center">
													<a href="paket_edit.php?id=<?php echo $result['id_paket']; ?>" class="btn btn-warning btn-xs">&nbsp;&nbsp;Ubah&nbsp;&nbsp;</a>&nbsp;&nbsp;
													<a href="paket_hapus.php?id=<?php echo $result['id_paket']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus <?php echo $result['nama_paket']; ?>?');" class="btn btn-danger btn-xs">&nbsp;&nbsp;Hapus&nbsp;&nbsp;</a>
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
<?php
require '../includes/footer.php';
?>