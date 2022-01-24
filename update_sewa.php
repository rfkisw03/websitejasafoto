<?php
session_start();
error_reporting(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('includes/config.php');
include('includes/library.php');
include('includes/base_url.php');
$image1 = $_FILES["img1"]["name"];
$newimg1 = date('dmYHis') . $image1;
$kode = $_POST['kode'];
$stt = "Menunggu Konfirmasi";
$tgl = date('Y-m-d');
$dp = $_POST['dp'];
$catatan = $_POST['catatan'];

$email = $_SESSION['ulogin'];

move_uploaded_file($_FILES["img1"]["tmp_name"], "image/bukti/" . $newimg1);

$sql = "UPDATE transaksi SET	bukti_bayar='$newimg1', 
									stt_trx		='$stt',  
									tgl_bayar	='$tgl', 
									dp			='$dp',
									catatan		= '$catatan'
									WHERE id_trx='$kode'";
$lastInsertId = mysqli_query($koneksidb, $sql);
if ($lastInsertId) {
	include('libary/Exception.php');
	include('libary/class.phpmailer.php');
	include('libary/class.smtp.php');

	$email_pengirim = 'kikitheboom@gmail.com';
	$nama_pengirim = 'E-Moment';
	$email_penerima = $email;
	$subjek = "Transaksi Anda Sedang Diproses";
	$pesan = " 

			<body style='margin: 10px;'>
				<div style='padding: 15px;'>
					<center> 
						<h1>Halo, <b>" . $email . "</b></h1>
						<h2>Anda telah mengupload bukti bayar anda</h2>
						<h4>Silakan Tunggu Notifikasi selanjutnya dari E-Moment :)</h4><br>
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


	echo "<script>alert('Upload Bukti Pembayaran Berhasil!');</script>";
	echo "<script type='text/javascript'> document.location = 'riwayatsewa.php'; </script>";
} else {
	echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
	echo "<script type='text/javascript'> document.location = 'bookingedit.php?kode'" . $kode . "'; </script>";
}
