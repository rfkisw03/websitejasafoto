<?php
include('includes/config.php');
error_reporting(0);

$id = $_POST['id_karyawan'];
$nama = $_POST["nama"];

$img1 = $_FILES["img1"]["name"];
$str1 = substr($img1, -5);
$vimage1 = date('dmYHis') . $str1;



$sql 	= "INSERT INTO galery (nama_galery,foto_galery,id_karyawan)VALUES ('$nama','$vimage1','$id')";
$query 	= mysqli_query($koneksidb, $sql);
if ($query) {
	move_uploaded_file($_FILES["img1"]["tmp_name"], "../image/gallery/" . $vimage1);
	echo "<script type='text/javascript'>
			alert('Berhasil tambah data.'); 
			document.location = 'gallery.php'; 
		</script>";
} else {
	echo "No Error : " . mysqli_errno($koneksidb);
	echo "<br/>";
	echo "Pesan Error : " . mysqli_error($koneksidb);

	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'gal_tambah.php'; 
		</script>";
}
