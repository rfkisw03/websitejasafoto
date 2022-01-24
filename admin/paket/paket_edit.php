<?php
require '../includes/header.php';
?>
<div class="ts-main-content">
	<?php include('../includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-md-12">

					<h2 class="page-title">Edit Data Baju</h2>

					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Form Edit Data Baju</div>
								<div class="panel-body">
									<?php
									$id = intval($_GET['id']);
									$sql = "SELECT * FROM paket WHERE id_paket='$id'";
									$query = mysqli_query($koneksidb, $sql);
									$result = mysqli_fetch_array($query);
									?>

									<form method="post" class="form-horizontal" name="theform" action="paket_upd.php" onsubmit="return valid(this);" enctype="multipart/form-data">
										<div class="form-group">
											<label class="col-sm-2 control-label">Nama Paket<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>" required>
												<input type="text" name="nama" class="form-control" value="<?php echo htmlentities($result['nama_paket']); ?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Deskripsi<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<textarea class="form-control" name="deskripsi" rows="3" required><?php echo htmlentities($result['ket_paket']); ?></textarea>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Harga /Packs<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="harga" class="form-control" value="<?php echo htmlentities($result['harga']); ?>" required>
											</div>
										</div>

										<div class="hr-dashed"></div>

										<div class="form-group">
											<div class="col-sm-4">
												<center>Gambar Paket<img src="<?php echo $base_url ?>/image/paket/<?php echo htmlentities($result['foto_paket']); ?>" width="300" height="200" style="border:solid 1px #000">
													<br />
													<br />
													<a href="gambar_paket.php?imgid=<?php echo htmlentities($result['id_paket']) ?>" class="btn btn-warning">&nbsp;&nbsp;Ganti Gambar&nbsp;&nbsp;</a>
												</center>
											</div>
										</div>
										<div class="hr-dashed"></div>

								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="form-group">
										<div class="col-sm-3">
											<div class="checkbox checkbox-inline">
												<button class="btn btn-primary" type="submit">Update</button>
												<a href="baju.php" class="btn btn-default">Batal</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			</form>

		</div>
	</div>
</div>

<?php
require '../includes/footer.php';
?>