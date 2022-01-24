<?php
require 'header.php';

?>

<!-- Banners -->
<section id="banner" class="banner-section">
  <div class="container">
    <div class="div_zindex">
      <div class="row">
        <div class="col-md-5 col-md-push-7">
          <div class="banner_content">
            <h1>Abadikan semua momen indah anda.</h1>
            <p>Kami membantu anda dalam mengabadikan setiap momen yang tak terlupakan. </p>
            <a href="paket.php" class="btn">Selengkapnya <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Banners -->


<!-- Resent Cat-->
<section class="section-padding gray-bg">
  <div class="container">
    <div class="row">

      <!-- Nav tabs -->
      <div class="recent-tab">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">Gallery</a></li>
        </ul>
      </div>
      <!-- Recently Listed New Cars -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="resentnewcar">

          <?php
          $sql = "SELECT * FROM galery";
          $query = mysqli_query($koneksidb, $sql);
          if (mysqli_num_rows($query) > 0) {
            while ($results = mysqli_fetch_array($query)) {

          ?>

              <div class="col-list-3">
                <div class="recent-car-list">
                  <div class="car-info-box"><img src="<?php echo $base_url ?>/image/gallery/<?php echo htmlentities($results['foto_galery']); ?>" class="img-responsive" alt="image"></div>
                </div>
              </div>
          <?php }
          } ?>

        </div>
      </div>
    </div>
</section>
<!-- /Resent Cat -->


<!--Footer -->
<?php include('includes/footer.php'); ?>
<!-- /Footer-->

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top-->

<!--Login-Form -->
<?php include('includes/login.php'); ?>
<!--/Login-Form -->

<!--Register-Form -->
<?php include('includes/registration.php'); ?>

<!--/Register-Form -->

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php'); ?>
<!--/Forgot-password-Form -->