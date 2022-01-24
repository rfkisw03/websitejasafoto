<?php include('../includes/header.php'); ?>

<div class="ts-main-content">
	<?php include('../includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-md-12">

					<h2 class="page-title">Member</h2>

					<!-- Zero Configuration Table -->
					<div class="panel panel-default">
						<div class="panel-heading">Daftar Member</div>
						<div class="panel-body">
							<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
							<div class="table-responsive">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Email</th>
											<th>Telp</th>
											<th>Alamat</th>
											<th>Opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										$sql = "SELECT * from  member ";
										$query = mysqli_query($koneksidb, $sql);
										while ($result = mysqli_fetch_array($query)) {
											$no++;
										?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo htmlentities($result['nama_member']); ?></td>
												<td><?php echo htmlentities($result['email']); ?></td>
												<td><?php echo htmlentities($result['telp']); ?></td>
												<td><?php echo htmlentities($result['alamat']); ?></td>
												<td align='center'>
													<a href="#myModal" data-toggle="modal" data-load-code="<?php echo $result['email']; ?>" data-remote-target="#myModal .modal-body" class="btn btn-primary btn-xs">Detail</a>
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
<script>
	var app = {
		code: '0'
	};
	$('[data-load-code]').on('click', function(e) {
		e.preventDefault();
		var $this = $(this);
		var code = $this.data('load-code');
		if (code) {
			$($this.data('remote-target')).load('userview.php?code=' + code);
			app.code = code;

		}
	});
</script>

</body>

</html>