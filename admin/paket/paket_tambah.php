<?php
require '../includes/header.php';
?>
<div class="ts-main-content">
	<?php include('../includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h2 class="page-title">Tambah Data Paket</h2>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Form Tambah Data Paket</div>
								<div class="panel-body">
									<form method="post" name="theform" action="paket_add.php" class="form-horizontal" onsubmit="return valid(this);" enctype="multipart/form-data">
										<div class="form-group">
											<label class="col-sm-2 control-label">Nama Paket<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="nama" class="form-control" required>
											</div>
										</div>

										<div class="hr-dashed"></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Keterangan<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<textarea class="form-control" name="keterangan" rows="3" required></textarea>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Harga /Packs<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="number" min="0" name="harga" class="form-control" required>
											</div>
										</div>

										<div class="hr-dashed"></div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Foto<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input class="form-control" type="file" name="img1" accept="image/*" required>
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
												<button class="btn btn-primary" type="submit">Simpan</button>
												<a href="paket.php" class="btn btn-default">Batal</a>
											</div>
										</div>
									</div>
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
<?php
require '../includes/footer.php';
?>