<?php
if (isset($_POST['emailsubscibe'])) {
  $subscriberemail = $_POST['subscriberemail'];
  $sql = "SELECT * FROM subscribers WHERE email_sub='$subscriberemail'";
  $query = mysqli_query($koneksidb, $sql);
  if (mysqli_num_rows($query) > 0) {
    echo "<script>alert('Already Subscribed.');</script>";
  } else {
    $sql1 = "INSERT INTO subscribers(email_sub) VALUES('$subscriberemail')";
    $lastInsertId = mysqli_query($koneksidb, $sql1);
    if ($lastInsertId) {
      echo "<script>alert('Subscribed successfully.');</script>";
    } else {
      echo "<script>alert('Something went wrong. Please try again');</script>";
    }
  }
}
?>

<footer>
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-md-6">
          <h6>Tentang Kami</h6>
          <ul>


            <li><a href="page.php?type=aboutus">Tentang Kami</a></li>
            <li><a href="page.php?type=faqs">FAQs</a></li>
            <li><a href="page.php?type=privacy">Privacy</a></li>
            <li><a href="page.php?type=terms">Terms of use</a></li>
            <li><a href="admin/">Admin Login</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-push-6 text-right">
          <div class="footer_widget">
            <p>Connect with Us:</p>
            <ul>
              <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-md-pull-6">

        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Scripts -->
<script src="<?php echo $base_url ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo $base_url ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url ?>/assets/js/interface.js"></script>
<!--Switcher-->
<script src="<?php echo $base_url ?>/assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS-->
<script src="<?php echo $base_url ?>/assets/js/bootstrap-slider.min.js"></script>
<!--Slider-JS-->
<script src="<?php echo $base_url ?>/assets/js/slick.min.js"></script>
<script src="<?php echo $base_url ?>/assets/js/owl.carousel.min.js"></script>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->

</html>