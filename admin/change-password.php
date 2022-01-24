<?php
require 'includes/header.php';

// Code for change password	
if (isset($_POST['submit'])) {
	$password = md5($_POST['password']);
	$newpassword = md5($_POST['newpassword']);
	$username = $_SESSION['alogin'];
	$sql = "SELECT Password FROM admin WHERE UserName='$username' and Password='$password'";
	$query = mysqli_query($koneksidb, $sql);
	if (mysqli_num_rows($query) > 0) {
		$con = "update admin set Password='$newpassword' where UserName='$username'";
		$chngpwd = mysqli_query($koneksidb, $con);
		$msg = "Your Password succesfully changed";
	} else {
		$error = "Your current password is not valid.";
	}
}
?>


<div class="ts-main-content">
	<?php include('includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-md-12">

					<h2 class="page-title">Ubah Password</h2>

					<div class="row">
						<div class="col-md-10">
							<div class="panel panel-default">
								<div class="panel-heading">Form Ubah Password</div>
								<div class="panel-body">
									<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
										<div class="form-group">
											<label class="col-sm-4 control-label">Current Password</label>
											<div class="col-sm-8">
												<input type="password" class="form-control" name="password" id="password" required>
											</div>
										</div>
										<div class="hr-dashed"></div>

										<div class="form-group">
											<label class="col-sm-4 control-label">New Password</label>
											<div class="col-sm-8">
												<input type="password" class="form-control" name="newpassword" id="newpassword" required>
											</div>
										</div>
										<div class="hr-dashed"></div>

										<div class="form-group">
											<label class="col-sm-4 control-label">Confirm Password</label>
											<div class="col-sm-8">
												<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
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
<script src="<?php echo $base_url ?>/admin/js/jquery.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/bootstrap-select.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/Chart.min.js"></script>
<script src="<?php echo $base_url ?>/admin/js/fileinput.js"></script>
<script src="<?php echo $base_url ?>/admin/js/chartData.js"></script>
<script src="<?php echo $base_url ?>/admin/js/main.js"></script>

</body>

</html>
<?php
require 'includes/footer.php';
