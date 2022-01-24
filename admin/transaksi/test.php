<?php
include("../includes/config.php");

?>



<div class="container">

    <form method="post" class="form-horizontal" name="theform" enctype="multipart/form-data" action="pro_test.php">
        <div class="form-group">
            <label class=" control-label">Penjasa<span style="color:red">*</span></label>
            <div class="">

                <?php
                $mySql = "SELECT * FROM tb_karyawan ORDER BY id_karyawan";
                $myQry = mysqli_query($koneksidb, $mySql);
                while ($array[] = $myQry->fetch_object());
                array_pop($array);

                ?>

                <select class="form-control" name="id_karyawan" required data-parsley-error-message="Field ini harus diisi">
                    <option value="">== Pilih Karyawan ==</option>
                    <?php foreach ($array as $option) : ?>

                        <option value="<?php echo "$option->id_karyawan"; ?>,<?php echo "$option->email"; ?>,<?php echo "$option->nama_karyawan"; ?>"><?php echo "$option->nama_karyawan"; ?></option>
                    <?php endforeach; ?>
                </select>
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







<?php
require '../includes/footer.php';
?>