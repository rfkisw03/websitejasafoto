<?php
require '../includes/header.php';
$date = date('Y-m-d');
$reskus         = $koneksidb->query("SELECT count(created) FROM tb_karyawan");
$rowcountkus     = mysqli_fetch_array($reskus);
//$tanggal_data	= date('dmy'); 
$jumlahkus         = $rowcountkus['count(created)'] + 1;
$nomer        = sprintf("%002s", $jumlahkus);
?>

<div class="ts-main-content">
    <?php include('../includes/leftbar.php'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Tambah Karyawan</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Form Tambah Data karyawan</div>
                                <div class="panel-body">
                                    <form method="post" name="theform" action="add_proses.php" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nama<span style="color:red">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="kd_karyawan" class="form-control" value="KAR<?php echo $nomer ?>" required>
                                                <input type="text" name="nama_karyawan" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">E-mail<span style="color:red">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="email" name="email" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Username<span style="color:red">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="username" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="hr-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">password<span style="color:red">*</span></label>
                                            <div class="col-sm-4">
                                                <input type="password" name="password" class="form-control" required>
                                            </div>
                                        </div>



                                        <div class="hr-dashed"></div>



                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <div class="checkbox checkbox-inline">
                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                                <a href="<?php echo $base_url ?>/admin/karyawan/reg_karyawan.php" class="btn btn-default">Batal</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</form>
<?php
require '../includes/footer.php';
?>