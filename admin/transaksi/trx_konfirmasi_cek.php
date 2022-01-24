<?php
require '../includes/header.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$id = $_GET['id'];
$sqlsewa = "SELECT transaksi.*,paket.*,member.* FROM transaksi,paket,member WHERE transaksi.id_paket=paket.id_paket
				AND transaksi.email=member.email AND transaksi.id_trx ='$id'";
$querysewa = mysqli_query($koneksidb, $sqlsewa);
$result = mysqli_fetch_array($querysewa);
$email = $result['email'];


if (isset($_POST['submit'])) {
	$myArray = explode(",", $_POST["id_karyawan"]);
	$myArray[0]; //id_karyawan
	$myArray[1]; //email
	$myArray[2]; // nama karyawan

	$status = $_POST['status'];
	$nama_karyawan = $myArray[2];
	$id_karyawan = $myArray[0];
	$email_kar = $myArray[1];
	$kode = $_POST['id'];
	$null = "";



	if ($status == "Menunggu Pembayaran") {
		$mySql	= "UPDATE transaksi SET stt_trx = '$status', tgl_bayar='$null', bukti_bayar='$null'  WHERE id_trx='$kode'";
		$myQry	= mysqli_query($koneksidb, $mySql);
		include('../libary/Exception.php');
		include('../libary/class.phpmailer.php');
		include('../libary/class.smtp.php');
		//email pelanggan
		$email_pengirim = 'kikitheboom@gmail.com';
		$nama_pengirim = 'E-Moment';
		$email_penerima = $email;
		$subjek = "Transaksi Anda Sedang Diproses";
		$pesan = " 

			<body style='margin: 10px;'>
				<div style='padding: 15px;'>
					<center> 
						<h1>Halo, <b>" . $email . "</b></h1>
						<h2>Maaf bukti yang anda upload tidak valid</h2>
						<h4>Silakan upload ulang bukti bayar anda</h4><br>
				
						<h4><b>Klik Link Dibawah Untuk melihat transaksi anda</b></h4><br>
						<a style='padding:10px 20px;border: solid 1px #125a63;background-color: #125a63;border-radius: 100px;color: #fff;text-decoration: none;margin-bottom:15px;' href='" . $base_url . "/riwayatsewa.php' >Cek Riwayat</a>
					</center>
				</div> 
			</body>";
		$mail = new PHPMailer();
		$mail->isSMTP();

		$mail->Host = "smtp.gmail.com";

		$mail->Username = $email_pengirim; // Gmail address which you want to use as SMTP server
		$mail->Password = 'jzfdfydkujztfley'; // Gmail address Password
		$mail->Port = 465;

		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->SMTPDebug = 2;
		$mail->SetFrom($email_pengirim, $nama_pengirim); //set email pengirim
		$mail->addAddress($email_penerima); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)
		$mail->isHTML(true);
		$mail->Subject = $subjek;
		$mail->Body = $pesan;
		$mail->send();

		// email karyawan
		$email_pengirim2 = 'kikitheboom@gmail.com';
		$nama_pengirim2 = 'E-Moment';
		$email_penerima2 = $email_kar;
		$subjek2 = "Job Baru Untuk Anda";
		$pesan2 = " 

			<body style='margin: 10px;'>
				<div style='padding: 15px;'>
					<center> 
						<h1>Halo, <b>" . $email_kar . "</b></h1>
						<h2>Ada job baru untuk anda</h2>
						<h4>Silakan cek website dan login dihalaman karyawan</h4><br>
						<h4><b>Klik Link Dibawah Untuk Melihat Jadwal Anda</b></h4><br>
						<a style='padding:10px 20px;border: solid 1px #125a63;background-color: #125a63;border-radius: 100px;color: #fff;text-decoration: none;margin-bottom:15px;' href='" . $base_url . "/karyawan' >LOGIN</a>
					</center>
				</div> 
			</body>";
		$mail2 = new PHPMailer();
		$mail2->isSMTP();

		$mail2->Host = "smtp.gmail.com";

		$mail2->Username = $email_pengirim2; // Gmail address which you want to use as SMTP server
		$mail2->Password = 'jzfdfydkujztfley'; // Gmail address Password
		$mail2->Port = 465;

		$mail2->SMTPAuth = true;
		$mail2->SMTPSecure = "ssl";
		$mail2->SMTPDebug = 2;
		$mail2->SetFrom($email_pengirim2, $nama_pengirim2); //set email pengirim
		$mail2->addAddress($email_penerima2); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)
		$mail2->isHTML(true);
		$mail2->Subject = $subjek2;
		$mail2->Body = $pesan2;
		$mail2->send();
	} else {
		$mySql	= "UPDATE transaksi SET stt_trx = '$status',
										id_karyawan = '$id_karyawan',
										nama_karyawan = '$nama_karyawan'
									 WHERE id_trx='$kode'";
		$myQry	= mysqli_query($koneksidb, $mySql);
		include('../libary/Exception.php');
		include('../libary/class.phpmailer.php');
		include('../libary/class.smtp.php');

		$email_pengirim = 'kikitheboom@gmail.com';
		$nama_pengirim = 'E-Moment';
		$email_penerima = $email;
		$subjek = "Transaksi Anda Sedang Diproses";
		$pesan = " 

			<body style='margin: 10px;'>
				<div style='padding: 15px;'>
					<center> 
						<h1>Halo, <b>" . $email . "</b></h1>
						<h2>Terima Kasih!</h2>
						<h4>Transaksi Anda Sukses</h4><br>
						<h4><b>Klik Link Dibawah Untuk melihat transaksi anda</b></h4><br>
						<a style='padding:10px 20px;border: solid 1px #125a63;background-color: #125a63;border-radius: 100px;color: #fff;text-decoration: none;margin-bottom:15px;' href='" . $base_url . "/riwayatsewa.php' >Cek Riwayat</a>
					</center>
				</div> 
			</body>";
		$mail = new PHPMailer();
		$mail->isSMTP();

		$mail->Host = "smtp.gmail.com";

		$mail->Username = $email_pengirim; // Gmail address which you want to use as SMTP server
		$mail->Password = 'jzfdfydkujztfley'; // Gmail address Password
		$mail->Port = 465;

		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->SMTPDebug = 2;
		$mail->SetFrom($email_pengirim, $nama_pengirim); //set email pengirim
		$mail->addAddress($email_penerima); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)
		$mail->isHTML(true);
		$mail->Subject = $subjek;
		$mail->Body = $pesan;
		$mail->send();

		// email karyawan
		$email_pengirim2 = 'kikitheboom@gmail.com';
		$nama_pengirim2 = 'E-Moment';
		$email_penerima2 = $email_kar;
		$subjek2 = "Job Baru Untuk Anda";
		$pesan2 = " 

			<body style='margin: 10px;'>
				<div style='padding: 15px;'>
					<center> 
						<h1>Halo, <b>" . $email_kar . "</b></h1>
						<h2>Ada job baru untuk anda</h2>
						<h4>Silakan cek website dan login dihalaman karyawan</h4><br>
						<h4><b>Klik Link Dibawah Untuk Melihat Jadwal Anda</b></h4><br>
						<a style='padding:10px 20px;border: solid 1px #125a63;background-color: #125a63;border-radius: 100px;color: #fff;text-decoration: none;margin-bottom:15px;' href='" . $base_url . "/karyawan' >LOGIN</a>
					</center>
				</div> 
			</body>";
		$mail2 = new PHPMailer();
		$mail2->isSMTP();

		$mail2->Host = "smtp.gmail.com";

		$mail2->Username = $email_pengirim2; // Gmail address which you want to use as SMTP server
		$mail2->Password = 'jzfdfydkujztfley'; // Gmail address Password
		$mail2->Port = 465;

		$mail2->SMTPAuth = true;
		$mail2->SMTPSecure = "ssl";
		$mail2->SMTPDebug = 2;
		$mail2->SetFrom($email_pengirim2, $nama_pengirim2); //set email pengirim
		$mail2->addAddress($email_penerima2); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)
		$mail2->isHTML(true);
		$mail2->Subject = $subjek2;
		$mail2->Body = $pesan2;
		$mail2->send();
	}
	echo "<script type='text/javascript'>
				alert('Status berhasil diupdate.'); 
				document.location = 'trx_konfirmasi.php'; 
			</script>";
}


?>

<div class="ts-main-content">
	<?php include('../includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="col-md-12">

					<h2 class="page-title">Cek Pembayaran</h2>

					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Info Member</div>
								<div class="panel-body">

									<form method="post" class="form-horizontal" name="theform" enctype="multipart/form-data">
										<div class="form-group">
											<label class="col-sm-2 control-label">Kode Booking</label>
											<div class="col-sm-4">
												<input type="text" name="id" class="form-control" value="<?php echo $id; ?>" required readonly>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Status<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<select class="form-control" name="status" required>
													<?php
													$stt = $result['stt_trx'];
													echo "<option value='$stt' selected>" . $stt . "</option>";
													echo "<option value='Menunggu Pembayaran'>" . "Menunggu Pembayaran" . "</option>";
													echo "<option value='Sudah Dibayar'>" . "Sudah Dibayar" . "</option>";
													?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Penjasa<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<?php
												$mySql = "SELECT * FROM tb_karyawan ORDER BY id_karyawan";
												$myQry = mysqli_query($koneksidb, $mySql);
												while ($array[] = $myQry->fetch_object());
												array_pop($array);

												?>

												<select class="form-control" name="id_karyawan" required data-parsley-error-message="Field ini harus diisi">
													<option value="">== Pilih Karyawan ==</option>
													<?php foreach ($array as $option) : ?>

														<option value="<?php echo "$option->id_karyawan"; ?>,<?php echo "$option->email"; ?>,<?php echo "$option->nama_karyawan"; ?>">
															<?php echo "$option->nama_karyawan"; ?></option>
													<?php endforeach; ?>
												</select>

											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Status Dp<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<?php if ($result['stt_dp'] == 1) { ?>

													<input type="text" name="stt_dp" class="form-control" value="BELUM LUNAS" required readonly>

												<?php } else if ($result['stt_dp'] == 2) { ?>
													<input type="text" name="stt_dp" class="form-control" value="LUNAS" required readonly>

												<?php } ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Mamber</label>
											<div class="col-sm-4">
												<input type="text" name="penyewa" class="form-control" value="<?php echo $result['nama_user']; ?>" required readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Telepon</label>
											<div class="col-sm-4">
												<input type="text" name="telp" class="form-control" value="<?php echo $result['telp']; ?>" required readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Alamat</label>
											<div class="col-sm-4">
												<textarea col="5" name="alamat" class="form-control" readonly><?php echo $result['alamat']; ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Bukti Bayar</label>
											<div class="col-sm-4">
												<a href="<?php echo $base_url ?>/image/bukti/<?php echo $result['bukti_bayar']; ?>" target="_blank"><img src="<?php echo $base_url ?>/image/bukti/<?php echo $result['bukti_bayar']; ?>" width="150" height="150"></a>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-3">
												<div class="checkbox checkbox-inline">
													<button class="btn btn-primary" type="submit" name="submit" style="margin-top:4%">Simpan</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Detail Booking</div>
								<div class="panel-body">
									<form class="form-horizontal">
										<div class="form-group">
											<label class="col-sm-2 control-label">Paket</label>
											<div class="col-sm-4">
												<input type="text" name="namamobil" class="form-control" value="<?php echo $result['nama_paket']; ?>" required readonly>
											</div>
										</div>
										<br />
										<div class="form-group">
											<label class="col-sm-2 control-label">Tanggal Take</label>
											<div class="col-sm-4">
												<input type="text" name="mulai" class="form-control" value="<?php echo IndonesiaTgl($result['tgl_take']); ?>" required readonly>
											</div>
										</div>
										<br />
										<div class="form-group">
											<label class="col-sm-2 control-label">Jam</label>
											<div class="col-sm-4">
												<input type="text" name="selesai" class="form-control" value="<?php echo $result['jam_take']; ?>" required readonly>
											</div>
										</div>
										<br />
										<div class="form-group">
											<label class="col-sm-2 control-label">Biaya</label>
											<div class="col-sm-4">
												<input type="text" name="total" class="form-control" value="<?php echo format_rupiah($result['harga']); ?>" required readonly>
											</div>
										</div>
										<br />
										<div class="form-group">
											<label class="col-sm-2 control-label">Catatan</label>
											<div class="col-sm-4">
												<textarea class="form-control" readonly><?php echo $result['catatan']; ?></textarea>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- COntainer Fluid-->
		</div>
	</div>
</div>
</div>

<?php
require '../includes/footer.php';
?>