<?php
session_start();
error_reporting(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('includes/config.php');
include('includes/base_url.php');
$fname = $_POST['fullname'];
$email = $_POST['emailid'];
$mobile = $_POST['mobileno'];
$alamat = $_POST['alamat'];
$pass = $_POST['pass'];
$conf = $_POST['conf'];
if ($conf != $pass) {
	echo "<script>alert('Password tidak sama!');</script>";
	echo "<script type='text/javascript'> document.location = 'regist.php'; </script>";
} else {
	$sqlcek = "SELECT email FROM member WHERE email='$email'";
	$querycek = mysqli_query($koneksidb, $sqlcek);
	if (mysqli_num_rows($querycek) > 0) {
		echo "<script>alert('Email sudah terdaftar, silahkan gunakan email lain!');</script>";
		echo "<script type='text/javascript'> document.location = 'regist.php'; </script>";
	} else {
		$password = md5($_POST['pass']);
		$sql1 = "INSERT INTO member(nama_user,email,telp,password,alamat) VALUES('$fname','$email','$mobile','$password','$alamat')";
		$lastInsertId = mysqli_query($koneksidb, $sql1);
		if ($lastInsertId) {
			include('libary/Exception.php');
			include('libary/class.phpmailer.php');
			include('libary/class.smtp.php');

			$email_pengirim = 'kikitheboom@gmail.com';
			$nama_pengirim = 'E-Moment';
			$email_penerima = $email;
			$subjek = "Registrasi";
			$pesan = " 

					<body style='margin: 10px;'>
						<div style='padding: 15px;'>
							<center> 
								
								<h1>Halo, <b>" . $email . "</b></h1>
								<h2>Selamat anda sudah terdaftar di website E-moment</b></h2>
								<h4><b>Klik Link Dibawah Untuk Login</b></h4><br>
								<a style='padding:10px 20px;border: solid 1px #125a63;background-color: #125a63;border-radius: 100px;color: #fff;text-decoration: none;margin-bottom:15px;' href='" . $base_url . "' >Website</a>
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
			$send = $mail->send();

			echo "<script>alert('Silahkan Cek E-mail anda.');</script>";
			echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
		} else {
			echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
			echo "<script type='text/javascript'> document.location = 'regist.php'; </script>";
		}
	}
}
