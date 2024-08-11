<?php
session_start();
include "config.php";
include "doctype.php";
?>

<body>
  <div class="site-wrap">
    <?php include "header.php"; ?>
    <div class="site-blocks-cover" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
            <div class="site-block-cover-content text-center">
              <h2 class="sub-title animate__animated animate__flash animate__infinite	infinite animate__slow	10s">Your
                Trusted Health Partner, Anytime, Anywhere.</h2>
              <h1>Welcome To K-Medico</h1>
              <p>
                <a href="shop.php" class="btn btn-primary px-5 py-3">Shop Now</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase">Popular Category</h2>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row align-items-stretch ">
          <?php
          $fetchAllMedicine = mysqli_query($db, "SELECT * FROM category");
          foreach ($fetchAllMedicine as $data) {
            ?>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-0 p-5 shadow">
              <div class="banner-wrap h-100"
                style="background-image: url('AdminPanel/<?php echo $data['category_image'] ?>');background-repeat: no-repeat;background-size: cover;">
                <a href="categoryWiseProduct.php?category=<?php echo $data['category_name']; ?>" class="h-100">
                  <h5 class="text-danger fw-bold"><?php echo $data['category_name'] ?></h5>
                </a>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-12 animate__animated animate__pulse animate__infinite	infinite animate__slow	10s">
          <img src="images/banner.webp" class="img-fluid" alt="">
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase">Popular Products</h2>
          </div>
        </div>
        <div class="row">
          <?php
          $fetchAllMedicine = mysqli_query($db, "SELECT * FROM medicine  LIMIT 6");

          foreach ($fetchAllMedicine as $data) {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
              <div class="card shadow" style="width: 18rem;">
                <a href="shop-single.php?id=<?php echo $data['id'] ?>">
                  <img class="card-img-top " style='width:250px;height:200px' src="AdminPanel/<?php echo $data['img']; ?>"
                    alt="Card image cap"></a>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $data['brand_name'] ?></h5>
                  <p class="price">Rs <?php echo $data['price'] ?></p>
                  <a href="shop-single.php?id=<?php echo $data['id'] ?>" class="btn btn-primary">Detail</a>
                  <span class="text-danger ms-5">
                    <?php
                    if ($data['quatity'] > 0) {
                      echo "In Stock";
                    } else {
                      echo "Out Of Stock";
                    }
                    ?>
                  </span>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
        <div class="row mt-5">
          <div class="col-12 text-center">
            <a href="shop.php" class="btn btn-primary px-4 py-3">View All Products</a>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase">New Products</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 block-3 products-wrap">
            <div class="nonloop-block-3 owl-carousel">
              <?php
              $fetchAllMedicine = mysqli_query($db, "SELECT * FROM medicine ORDER BY id DESC LIMIT 6 ");
              foreach ($fetchAllMedicine as $data) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 justify-content-center">
                  <div class="card shadow" style="width: 18rem;">
                    <a href="shop-single.php?id=<?php echo $data['id'] ?>"><img class="card-img-top"
                        style='width:250px;height:200px' src="AdminPanel/<?php echo $data['img']; ?>"
                        alt="Card image cap"></a>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $data['brand_name'] ?></h5>
                      <p class="price">Rs <?php echo $data['price'] ?></p>
                      <a href="shop-single.php?id=<?php echo $data['id'] ?>" class="btn btn-primary">Detail</a>
                      <span class="text-danger ms-5">
                        <?php
                        if ($data['quatity'] > 0) {
                          echo "In Stock";
                        } else {
                          echo "Out Of Stock";
                        }
                        ?>
                      </span>
                    </div>
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
      <div class="container">
        <div class="row align-items-stretch">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
              <div class="banner-1-inner align-self-center">
                <h2 class="fs-5">Pharmacy Products</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.
                </p>
              </div>
            </a>
          </div>
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
              <div class="banner-1-inner ml-auto  align-self-center">
                <h2>Rated by Experts</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.
                </p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php include "footer.php"; ?>
  </div>
</body>

</html>