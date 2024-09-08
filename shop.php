<?php
session_start();
include "doctype.php";
?>

<body>
  <div class="site-wrap">
    <?php
    include "header.php";
    ?>
    <script>
      document.getElementById("shop").classList.add("active");
      document.getElementById("Home").classList.remove("active");
    </script>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong
              class="text-black">Store</strong></div>
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2 class="text-uppercase">All Products</h2>
          </div>
        </div>
        <div class="row">
          <?php
          include "config.php";
          $fetchAllMedicine = mysqli_query($db, "SELECT * FROM medicine ");
          foreach ($fetchAllMedicine as $data) {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center ">
              <div class="card" style="width: 18rem;">
                <a href="shop-single.php?id=<?php echo $data['id'] ?>"><img class="card-img-top"
                    style='width:250px;height:200px' src="AdminPanel/<?php echo $data['img']; ?>"
                    alt="Card image cap"></a>
                <div class="card-body">
                  <div class="d-flex">
                  <h5 class="card-title"><?php echo $data['brand_name'] ?></h5>
                  <p class="price" style="margin-left:auto;">Rs <?php echo $data['price'] ?></p>
                  </div>
                  <a href="shop-single.php?id=<?php echo $data['id'] ?>" class="btn btn-outline-success">Detail</a>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
    <?php include "footer.php"; ?>
  </div>
</body>

</html>