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
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a
              href="shop.html">Store</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Ibuprofen Tablets,
              200mg</strong></div>
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
        <?php
        if (isset($_GET['id'])) {
          include "config.php";
          $id = $_GET['id'];

          $selectDataById = mysqli_query($db, "SELECT * FROM medicine WHERE id = '$id'");

          $data = mysqli_fetch_assoc($selectDataById);
          ?>
          <div class="row">
            <div class="col-md-5 mr-auto">
              <div class="border text-center">
                <img src="AdminPanel/<?php echo $data['img'] ?>" alt="Image" class="img-fluid p-0">
              </div>
            </div>
            <div class="col-md-6">
              <h2 class="text-black"><?php echo $data['brand_name'] ?>, <?php echo $data['strength'] ?></h2>
              <p> <strong class="text-primary h4">Rs <?php echo $data['price'] ?></strong></p>
              <form action="cart.php" method="POST">
                <input type="hidden" name="p_id" value="<?php echo $data['id'] ?>">
                <input type="hidden" name="p_name" value="<?php echo $data['brand_name'] ?>">
                <input type="hidden" name="p_price" value="<?php echo $data['price'] ?>">
                <input type="hidden" name="p_img" value="<?php echo $data['img'] ?>">
                <input type="hidden" name="p_adr" value="<?php echo $data['adverce_drug_reaction'] ?>">
                <input type="hidden" name="p_generic" value="<?php echo $data['generic_name'] ?>">   
                <input type="hidden" name="p_priscription" value="<?php echo $data['prescription'] ?>">
                <div class="mb-5">
                  <div class="input-group mb-3" style="max-width: 220px;">
                    <div class="input-group-prepend">
                      <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                    </div>
                    <input type="text" name="p_quantity" class="form-control text-center" value="1" placeholder=""
                      aria-label="Example text with button addon" aria-describedby="button-addon1">
                    <div class="input-group-append">
                      <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                    </div>
                  </div>
                </div>
                <p><button type="submit" name="addCart" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary">Add
                    To Cart</button></p>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="mt-5">
              <ul class="nav nav-pills mb-3 custom-pill" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                    aria-controls="pills-home" aria-selected="true">Ordering Information</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                    aria-controls="pills-profile" aria-selected="false">Specifications</a>
                </li>
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                  <table class="table custom-table">
                    <thead>
                      <th>Generic Name</th>
                      <th>Indication</th>
                      <th>Adverce Drug Reaction</th>
                      <th>Side Effect</th>
                      <th>Counseling</th>
                      <th>Pack Size</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $data['generic_name'] ?></td>
                        <td><?php echo $data['indication'] ?></td>
                        <td><?php echo $data['adverce_drug_reaction'] ?></td>
                        <td><?php echo $data['side_effect'] ?></td>
                        <td><?php echo $data['counseling'] ?></td>
                        <td><?php echo $data['pack_size'] ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  <table class="table custom-table">
                    <tbody>
                      <tr>
                        <td>HPIS CODE</td>
                        <td class="bg-light">999_200_40_0</td>
                      </tr>
                      <tr>
                        <td>HEALTHCARE PROVIDERS ONLY</td>
                        <td class="bg-light">No</td>
                      </tr>
                      <tr>
                        <td>LATEX FREE</td>
                        <td class="bg-light">Yes, No</td>
                      </tr>
                      <tr>
                        <td>MEDICATION ROUTE</td>
                        <td class="bg-light">Topical</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
    <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
      <div class="container">
        <div class="row align-items-stretch">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
              <div class="banner-1-inner align-self-center">
                <h2>Pharma Products</h2>
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