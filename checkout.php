<?php
session_start();
include_once 'config.php';
include "doctype.php";
?>

<body>
  <div class="site-wrap">
    <?php include "header.php"; ?>
    <script>
  document.getElementById("Home").classList.remove("active");
</script>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Checkout</strong>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
        </div>
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-md-6 col-lg-6 mb-5 mb-md-0">
            <?php
            $user_id = $_SESSION['id'];
            $query = mysqli_query($db, "select * from register where id = $user_id");
            $row = mysqli_fetch_array($query);
            ?>
            <form action="" method="post">
              <h2 class="h3 mb-3 text-black">Billing Details</h2>
              <div class="p-3 p-lg-5 border">
                <div class="form-group">
                  <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                  <select id="c_country" name="country" class="form-control">
                    <option>Select a country</option>
                    <?php
                    $query = mysqli_query($db, "select * from country");
                    foreach ($query as $coun) {
                      ?>
                      <option value="<?= $coun['iso'] ?>" <?php
                        if ($row['country'] == $coun['iso'])
                          echo "selected"; ?>>
                        <?= $coun['name'] ?>
                      </option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_address" name="address" placeholder="Street address"
                      value="<?= $row['address'] ?>">
                  </div>
                </div>
                <div class="form-group row mb-5">
                  <div class="col-md-12">
                    <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_phone" name="phone" placeholder="Phone Number"
                      value="<?= $row['phone_no'] ?>">
                  </div>
                </div>
              </div>
          </div>
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <h2 class="h3 mb-3 text-black">Place Order</h2>
                <div class="p-3 p-lg-5 border">
                  <div class="border mb-3 p-3">
                    <input class="" type="radio" name="cod" value="cash on delivery" checked> CASH ON DELIVERY
                    </h3>
                    <div class="form-group">
                      <button type="submit" name="checkout" class="btn btn-outline-success btn-lg btn-block">Place
                        Order</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
      <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
        <div class="container">
          <div class="row align-items-stretch">
            <div class="col-lg-6 mb-5 mb-lg-0">
              <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
                <div class="banner-1-inner align-self-center">
                  <h2>K-Medicos</h2>
                  <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio
                    voluptatem.
                  </p>
                </div>
              </a>
            </div>
            <div class="col-lg-6 mb-5 mb-lg-0">
              <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
                <div class="banner-1-inner ml-auto  align-self-center">
                  <h2>Rated by Experts</h2>
                  <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio
                    voluptatem.
                  </p>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php include "footer.php"; ?>
    </div>
    <?php
    if (isset($_POST['checkout'])) {
      include "config.php";
      $country = $_POST['country'];
      $address = $_POST['address'];
      $phone = $_POST['phone'];
      $cod = $_POST['cod'];
      $u_name = $_SESSION['name'];
      $fetchUserName = mysqli_query($db, "SELECT * FROM register WHERE name = '$u_name'");
      $data = mysqli_fetch_assoc($fetchUserName);
      $u_id = $data['id'];
      foreach ($_SESSION['cart'] as $key => $value) {
        $p_id = $value['p_id'];
        $p_name = $value['p_name'];
        $p_price = $value['p_price'];
        $p_quantity = $value['p_quantity'];
        $p_generic = $value['p_generic'];
        $p_priscription = $value['p_priscription'];
        $p_img = $value['p_img'];


        $insert = mysqli_query($db, "INSERT INTO orders (u_id,u_name,u_country,u_address,u_phone,delivery_status,p_id,p_name,p_quantity,p_price,generic_name,p_prescription,p_image)VALUES('$u_id','$u_name','$country','$address','$phone','$cod','$p_id','$p_name','$p_quantity','$p_price','$p_generic','$p_prescription','$p_img')");

        $getOldQuantity = mysqli_query($db, "SELECT * FROM medicine WHERE id = '$p_id'");
        $dataQuantity = mysqli_fetch_assoc($getOldQuantity);
        $old_quantity = $dataQuantity['quatity'];
        $updated_quantity = $old_quantity - $p_quantity;


        $update = mysqli_query($db, "UPDATE medicine SET quatity = '$updated_quantity' WHERE id = '$p_id'");

      }
      unset($_SESSION['cart']);

      echo "<script>
      location.assign('thankyou.php')
    </script>";
    }
    ?>
</body>

</html>