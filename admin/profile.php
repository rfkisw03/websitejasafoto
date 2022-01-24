<?php
require 'includes/header.php';

// Code for change password	
if (isset($_POST['submit'])) {
	$oldimg = $_POST['oldimage'];
	$nama = $_POST['nama'];
	$file = $_FILES["image"]["name"];
	$str = substr($file, -5);
	$newimage = date('dmYHis') . $str;
	$username = $_SESSION['alogin'];
	if ($file == "") {
		$con = "update admin set name='$nama' where UserName='$username'";
		$done = mysqli_query($koneksidb, $con);
		if ($done) {
			$msg = "Your Profile succesfully changed";
		} else {
			$error = "Your Profile unsuccesfully changed";
		}
	} else {
		move_uploaded_file($_FILES["image"]["tmp_name"], "img/" . $newimage);
		$con = "update admin set name='$nama', Image='$newimage' where UserName='$username'";
		$done = mysqli_query($koneksidb, $con);
		if ($done) {
			$msg = "Your Profile succesfully changed";
		} else {
			$error = "Your Profile unsuccesfully changed";
		}
	}
}
?>
<div class="ts-main-content">
	<?php include('includes/leftbar.php'); ?>
	<?php
	$user = $_SESSION['alogin'];
	$sql = "SELECT * FROM admin WHERE UserName='$user'";
	$query = mysqli_query($koneksidb, $sql);
	$data = mysqli_fetch_array($query);

	?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h2 class="page-title">Profile</h2>
					<div class="row">
						<div class="col-md-10">
							<div class="panel panel-default">
								<div class="panel-heading">Update Profile</div>
								<div class="panel-body">
									<form method="post" name="chngprfl" class="form-horizontal" onSubmit="return valid();" enctype="multipart/form-data">
										<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
										<div class="form-group">
											<label class="col-sm-4 control-label">Nama</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="nama" id="nama" value=<?php echo $data['name']; ?> required>
												<input type="hidden" class="form-control" name="oldimage" id="oldimage" value=<?php echo $data['Image']; ?> required>
											</div>
										</div>
										<div class="hr-dashed"></div>

										<div class="form-group">
											<label class="col-sm-4 control-label">Foto</label>
											<div class="col-sm-8">
												<img src="img/<?php echo $data['Image'] ?>" width="100px">
											</div>
										</div>
										<div class="hr-dashed"></div>

										<div class="form-group">
											<label class="col-sm-4 control-label">Ganti Foto</label>
											<div class="col-sm-8">
												<input class="form-control" type="file" name="image" accept="image/*">
											</div>
										</div>
										<div class="hr-dashed"></div>
										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-4">
												<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
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
<?php require 'includes/footer.php';
?>