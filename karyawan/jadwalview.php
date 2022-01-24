<?php
session_start();
error_reporting(0);


include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



if (isset($_POST['submit'])) {
    $catatan = $_POST['catatan_karyawan'];
    $proses = $_POST['proses_karyawan'];
    $kode = $_POST['id'];
    $email = $_POST['email'];

    $mySql    = "UPDATE transaksi SET catatan_karyawan = '$catatan',
                                          proses_karyawan='$proses'
                                          WHERE id_trx='$kode'";
    $myQry    = mysqli_query($koneksidb, $mySql);


    if ($myQry == TRUE) {
        echo "<script type='text/javascript'>
            alert('Status berhasil diupdate.'); 
            document.location = 'jadwal.php'; 
        </script>";
        include('../admin/libary/Exception.php');
        include('../admin/libary/class.phpmailer.php');
        include('../admin/libary/class.smtp.php');


        //email pelanggan
        $email_pengirim = 'kikitheboom@gmail.com';
        $nama_pengirim = 'E-Moment';
        $email_penerima = $email;
        $subjek = "Status Moment Anda";
        $pesan = " 

			<body style='margin: 10px;'>
				<div style='padding: 15px;'>
					<center> 
						<h1>Halo, <b>" . $email . "</b></h1>
						<h2>Status Moment anda Sedang " . $proses . "</h2>
						<h4>Pesan dari Karyawan</h4><br>
                        <h4>" . $catatan . "</h4><br>
                        <h4>SEMOGA LANCAR</h4><br>
                        
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
    } else {
        echo "<script type='text/javascript'>
            alert('Status gagal diupdate.'); 
            document.location = 'jadwal.php'; 
        </script>";
    }
}


?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title><?php echo $pagedesc; ?></title>
    <link rel="shortcut icon" href="img/fav.png">

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">Cek Jadwal</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Info Member</div>
                                    <div class="panel-body">
                                        <?php
                                        $id = $_GET['id'];
                                        $sqlsewa = "SELECT transaksi.*,paket.*,member.* FROM transaksi,paket,member WHERE transaksi.id_paket=paket.id_paket
                                        AND transaksi.email=member.email AND transaksi.id_trx ='$id'";
                                        $querysewa = mysqli_query($koneksidb, $sqlsewa);
                                        $result = mysqli_fetch_array($querysewa);
                                        $email = $result['email'];
                                        ?>
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
                                                    </select> <input type="text" name="status" class="form-control" value="<?php echo $result['stt_trx'];; ?>" required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Mamber</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="penyewa" class="form-control" value="<?php echo $result['nama_user']; ?>" required readonly>
                                                    <input type="hidden" name="email" class="form-control" value="<?php echo $result['email']; ?>" required readonly>

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
                                                    <a href="../image/bukti/<?php echo $result['bukti_bayar']; ?>" target="_blank"><img src="../image/bukti/<?php echo $result['bukti_bayar']; ?>" width="150" height="150"></a>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Proses Karyawan<span style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="form-control" name="proses_karyawan" required>
                                                        <?php
                                                        $proses = $result['proses_karyawan'];
                                                        echo "<option value='$proses' selected>" . $proses . "</option>";
                                                        echo "<option value='Terkonfirmasi'>" . "Terkonfirmasi" . "</option>";
                                                        echo "<option value='Terkendali'>" . "Terkendali" . "</option>";
                                                        echo "<option value='Bermasalah'>" . "Bermasalah" . "</option>";
                                                        echo "<option value='Berjalan'>" . "Berjalan" . "</option>";
                                                        echo "<option value='Selesai'>" . "Selesai" . "</option>";
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Catatan Karyawan<span style="color:red">*</span></label>
                                                    <div class="col-sm-4">
                                                        <textarea class="form-control" name="catatan_karyawan" required><?php echo $result['catatan_karyawan']; ?></textarea>
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