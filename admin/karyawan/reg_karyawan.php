<?php
require '../includes/header.php';
?>
<div class="ts-main-content">
    <?php include('../includes/leftbar.php'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <h2 class="page-title">Karyawan</h2>

                    <!-- Zero Configuration Table -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="add_karyawan.php" class="btn btn-success">Tambah</a>
                        </div>

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
                                        $sql = "SELECT * from  tb_karyawan ";
                                        $query = mysqli_query($koneksidb, $sql);
                                        while ($result = mysqli_fetch_array($query)) {
                                            $no++;
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo htmlentities($result['nama_karyawan']); ?></td>
                                                <td><?php echo htmlentities($result['email']); ?></td>
                                                <td><?php echo htmlentities($result['telp']); ?></td>
                                                <td><?php echo htmlentities($result['alamat']); ?></td>
                                                <td align='center'>
                                                    <a href="#myModal" data-toggle="modal" data-load-kar="<?php echo $result['nama_karyawan']; ?>" data-remote-target="#myModal .modal-body" class="btn btn-primary btn-xs">Detail</a>
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
<?php
require '../includes/footer.php';
?>