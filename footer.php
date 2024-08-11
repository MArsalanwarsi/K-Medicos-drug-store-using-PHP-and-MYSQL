<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class=" col-lg-4 col-md-4 mb-4 mb-lg-0">
        <div class="block-7">
          <h3 class="footer-heading mb-4">About Us</h3>
          <p class="text-justify">K-Medico's mission is to improve access to healthcare in Pakistan by making it easy
            and convenient for people to purchase the medicines and health products they need, at competitive prices and
            with exceptional customer service.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 mx-auto mb-5 mb-lg-0">
        <h3 class="footer-heading mb-4">Quick Links</h3>
        <ul class="list-unstyled">
          <?php
          include "config.php";
          $fetchAllMedicine = mysqli_query($db, "SELECT * FROM category");
          foreach ($fetchAllMedicine as $data) {
            ?>
            <li><a
                href="categoryWiseProduct.php?category=<?php echo $data['category_name']; ?>"><?php echo $data['category_name'] ?></a>
            </li>
            <?php
          }
          ?>
        </ul>
      </div>
      <div class="col-lg-4 col-md-4 ">
        <div class="block-5 mb-5">
          <h3 class="footer-heading mb-4">Contact Info</h3>
          <ul class="list-unstyled">
            <li class="address">Aptech Karachi,Pakistan</li>
            <li class="phone"><a href="tel://+9200000000">+9200000000</a></li>
            <li class="email">K_medico@gmail.com</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row pt-5 mt-5 text-center">
      <div class="col-md-12">
        <p>
          Copyright &copy;
          <script>document.write(new Date().getFullYear());</script> All rights reserved
        </p>
      </div>
    </div>
  </div>
</footer>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/main.js"></script>