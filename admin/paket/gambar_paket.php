<?php

require '../includes/header.php';
if (isset($_POST['update'])) {
	$img = $_FILES["img1"]["name"];
	$str = substr($img, -5);
	$image1 = date('dmYHis') . $str;
	$id = $_POST['id'];
	move_uploaded_file($_FILES["img1"]["tmp_name"], "../../image/paket/" . $image1);
	$sql = "update paket set foto_paket='$image1' where id_paket='$id'";
	$query	= mysqli_query($koneksidb, $sql);
	echo "<script type='text/javascript'>
			alert('Berhasil ganti gambar.');
			document.location = 'paket_edit.php?id=$id'; 
		</script>";
}
?>


<div class="ts-main-content">
	<?php include('../includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-md-12">

					<h2 class="page-title">Ganti Gambar Paket</h2>

					<div class="row">
						<div class="col-md-10">
							<div class="panel panel-default">
								<div class="panel-heading"></div>
								<div class="panel-body">
									<form method="post" class="form-horizontal" enctype="multipart/form-data">

										<div class="form-group">
											<label class="col-sm-4 control-label">Gambar Paket Sekarang</label>
											<?php
											$id = intval($_GET['imgid']);
											$sql = "SELECT foto_paket from paket where id_paket='$id'";
											$query	= mysqli_query($koneksidb, $sql);
											$cnt = 1;
											while ($result = mysqli_fetch_array($query)) {
											?>
												<div class="col-sm-8">
													<img src="<?php echo $base_url ?>/image/paket/<?php echo htmlentities($result['foto_paket']); ?>" width="300" height="200" style="border:solid 1px #000">
												</div>
											<?php } ?>
										</div>

										<div class="form-group">
											<input type="hidden" name="id" value="<?php echo $id; ?>" required>
											<label class="col-sm-4 control-label">Upload Gambar Paket Baru<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="file" name="img1" class="form-control" accept="image/*" required>
											</div>
										</div>
										<div class="hr-dashed"></div>

										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-4">
												<button class="btn btn-primary" name="update" type="submit">Update</button>
											</div>
										</div>
									</form>
								</div>
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