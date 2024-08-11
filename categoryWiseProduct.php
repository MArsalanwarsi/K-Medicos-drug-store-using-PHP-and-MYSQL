<?php
session_start();
include "doctype.php";
?>

<body>
  <div class="site-wrap">
    <?php
    include "header.php";
    ?>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong
              class="text-black">Category</strong></div>
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
          include "config.php";
          if (isset($_GET['category'])) {
            $category_id = $_GET['category'];
            $fetchAllMedicine = mysqli_query($db, "SELECT * FROM medicine WHERE category = '$category_id'");
            if ($isDataExists = mysqli_num_rows($fetchAllMedicine) > 0) {
              foreach ($fetchAllMedicine as $data) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center ">
                  <div class="card" style="width: 18rem;">
                    <a href="shop-single.php?id=<?php echo $data['id'] ?>"><img class="card-img-top"
                        style='width:250px;height:200px' src="AdminPanel/<?php echo $data['img']; ?>"
                        alt="Card image cap"></a>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $data['brand_name'] ?></h5>
                      <p class="price">Rs <?php echo $data['price'] ?></p>
                      <a href="shop-single.php?id=<?php echo $data['id'] ?>" class="btn btn-primary">Detail</a>
                    </div>
                  </div>
                </div>
                <?php
              }
            } else {
              echo "
                    <div class='container'>
                        <div class='row'>
                            <div class='col-12'>
                                <div class='alert alert-danger' role='alert'>
                                    No Product Available Yet !
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
          }
          ?>
        </div>
      </div>
    </div>
    <?php include "footer.php"; ?>
  </div>
</body>

</html>