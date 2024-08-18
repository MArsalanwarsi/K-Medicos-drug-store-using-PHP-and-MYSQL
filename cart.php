<?php
session_start();
include "doctype.php";
?>

<body>
  <div class="site-wrap">
    <?php include "header.php"; ?>
    <script>
      document.getElementById("Home").classList.remove("active");
    </script>
    <div class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
            <strong class="text-dark">Cart</strong>
          </div>
        </div>
      </div>
    </div>
    <?php
    if (isset($_POST['addCart'])) {
      if (isset($_SESSION['cart'])) {
        $myitem = array_column($_SESSION['cart'], 'p_id');
        if (in_array($_POST['p_id'], $myitem)) {
          echo "<script>
					alert('Product Already Added');
					location.assign('index.php');
				</script>";
        } else {
          $count = count($_SESSION['cart']);
          $p_id = $_POST['p_id'];
          $p_name = $_POST['p_name'];
          $p_price = $_POST['p_price'];
          $p_quantity = $_POST['p_quantity'];
          $p_img = $_POST['p_img'];
          $p_adr = $_POST['p_adr'];
          $p_generic = $_POST['p_generic'];
          $p_priscription = $_POST['p_priscription'];
          $_SESSION['cart'][$count] = array(
            'p_id' => $p_id,
            'p_name' => $p_name,
            'p_price' => $p_price,
            'p_quantity' => $p_quantity,
            'p_img' => $p_img,
            'p_adr' => $p_adr,
            'p_generic' => $p_generic,
            'p_priscription' => $p_priscription
          );

          echo "<script>
					alert('Product Added');
					location.assign('index.php');
				</script>";

        }
      } else {
        $p_id = $_POST['p_id'];
        $p_name = $_POST['p_name'];
        $p_price = $_POST['p_price'];
        $p_quantity = $_POST['p_quantity'];
        $p_img = $_POST['p_img'];
        $p_adr = $_POST['p_adr'];
        $p_generic = $_POST['p_generic'];
        $p_priscription = $_POST['p_priscription'];
        $_SESSION['cart'][0] = array(
          'p_id' => $p_id,
          'p_name' => $p_name,
          'p_price' => $p_price,
          'p_quantity' => $p_quantity,
          'p_img' => $p_img,
          'p_adr' => $p_adr,
          'p_generic' => $p_generic,
          'p_priscription' => $p_priscription
        );

        echo "<script>
					alert('Product Added'); 
					location.assign('index.php');
				</script>";

      }

    }
    // Remove Cart
    if (isset($_GET['remove'])) {
      $id = $_GET['remove'];
      foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['p_id'] == $id) {
          unset($_SESSION['cart'][$key]);
          $_SESSION['cart'] = array_values($_SESSION['cart']);
          echo "<script>
				alert('Product Removed Successfully');
				location.assign('cart.php');
			</script>";
        }
      }
    }
    if (isset($_POST['mod_quantity'])) {
      foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['p_name'] == $_POST['p_name']) {
          $_SESSION['cart'][$key]['p_quantity'] = $_POST['mod_quantity'];
        }
      }
    }
    ?>
    <div class="site-section">

      <div class="container p-5">
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="alert_doctor">
            </div>
          </div>
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $grandTotal = 0;
                  if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $key => $value) {
                      $qty = $value['p_quantity'];
                      $price = $value['p_price'];
                      $totalPrice = $qty * $price;
                      $grandTotal += $totalPrice;
                      ?>
                      <tr>
                        <td class="product-thumbnail">
                          <img src="AdminPanel/<?php echo $value['p_img'] ?>" alt="Image" class="img-fluid">
                        </td>
                        <td class="product-name">
                          <h2 class="h5 text-black"><?php echo $value['p_name'] ?></h2>
                        </td>
                        <td>Rs <?php echo $value['p_price'] ?></td>
                        <td>
                          <?php echo $value['p_quantity'] ?>
                </div>
                </td>
                <td>Rs <?php echo $totalPrice; ?></td>
                <td><a href="?remove=<?php echo $value['p_id'] ?>" class="btn btn-danger height-auto btn-sm">X</a></td>
                </tr>
                <?php
                    }
                  }
                  ?>
            </tbody>
            </table>
        </div>
        </form>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="row mb-5">
            <div class="col-md-6">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
            </div>
            <div class="col-md-8 mb-3 mb-md-0">
            </div>
            <div class="col-md-4">
            </div>
          </div>
        </div>
        <div class="col-md-6 pl-5">
          <div class="row justify-content-end">
            <div class="col-md-7">
              <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                  <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <span class="text-black">Grand Total</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black"><?php echo $grandTotal; ?></strong>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <?php
                  if (isset($_SESSION['name'])) {
                    ?>
                    <a href="checkout.php" class="btn btn-success btn-lg btn-block">
                      Proceed To Checkout
                    </a>
                    <?php
                  } else {
                    ?>
                    <a href="" data-toggle="modal" data-target="#loginModel" class="btn btn-success btn-lg btn-block">
                      Login
                    </a>
                    <?php
                  }
                  ?>
                </div>
              </div>
            </div>
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
              <h2>K-Medicos</h2>
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
<?php
function adr()
{
  $ses = $_SESSION['cart'];
  foreach ($ses as $data) {
    $p_generic = $data['p_generic'];
    foreach ($ses as $data2) {
      $p_adr = $data2['p_adr'];
      $adr_exploded = explode(",", $p_adr);
      foreach ($adr_exploded as $adr) {
        if ($adr == $p_generic) {
          ?>
          <script>
            $(document).ready(function () {
              $(".alert_doctor").html("<marquee class='bg-danger text-light'>These medicines show side-Effects when taken together Please consult doctor</marquee>")
            })
          </script>
          <?php
        }

      }

    }

  }
}
if (isset($_SESSION['cart'])) {
  $count = count($_SESSION['cart']);
  if ($count > 1) {
    adr();
  }
}

?>

</html>