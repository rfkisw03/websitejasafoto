<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('../includes/config.php');
include('../includes/base_url.php');
error_reporting(0);



$kd_karyawan        = $_POST['kd_karyawan'];
$nama            = $_POST['nama_karyawan'];
$username        = $_POST['username'];
$email            = $_POST['email'];
$password        = md5($_POST["password"]);
$created        = date('Y-m-d H:i:s');
// cek nama ada tidak 
$cnama = "SELECT * FROM tb_karyawan where username='$_POST[username]' ";
$ceknama = mysqli_query($koneksidb, $cnama);

if (mysqli_num_rows($ceknama) > 0) { //proses mengingatkan data sudah ada
    echo "<script>alert('Username Sudah Ada.');history.go(-2) </script>";
} else {

    $sql = "INSERT INTO tb_karyawan (kd_karyawan, nama_karyawan, username, password, created, email)
                        values('$kd_karyawan', '$nama', '$username', '$password', '$created', '$email' )";

    if ($koneksidb->query($sql) === TRUE) {
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
						<h1>Halo, <b>" . $nama . "</b></h1>
						<h2>Selamat anda sudah terdaftar sebagai KARYAWAN</h2>
						<h4>Silakan login menggunakan username dan password dengan nama yakni  <strong>" . $nama . "</strong> </h4><br>
						<h4><b>Klik Link Dibawah Untuk Login</b></h4><br>
						<a style='padding:10px 20px;border: solid 1px #125a63;background-color: #125a63;border-radius: 100px;color: #fff;text-decoration: none;margin-bottom:15px;' href='" . $base_url . "/karyawan' >Login</a>
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

        echo "<script>alert('Sukses !');document.location='reg_karyawan.php'; </script>";
    } else {
        echo "<script>alert('Gagal !');document.location='reg_karyawan.php'; </script>";
    }
    // echo"<script>alert('Password Harus Sama');location.href='".$base_url."/page/data-admin/'</script>";
}
