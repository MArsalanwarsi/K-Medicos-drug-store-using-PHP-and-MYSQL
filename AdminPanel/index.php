<?php

session_start();
if (!isset($_SESSION["name"])) {
  header("location:../index.php");
}
include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>K-Medico Admin Panel</title>
  <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <!-- <link rel="shortcut icon" href="assets/images/favicon.png" /> -->
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <?php
    include 'sidebar.php';

    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      <?php
      include 'header.php';
      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-4 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5>Users</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <h2 class="mb-0"><?php $usr=mysqli_query($db,"SELECT * FROM register");$count = mysqli_num_rows($usr);echo $count; ?></h2>
                        <!-- <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p> -->
                      </div>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                      <i class="icon-lg mdi mdi-account text-primary ml-auto"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5>Sales</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <h2 class="mb-0">$<?php $sal=mysqli_query($db,"SELECT * FROM orders");$sum = 0;foreach($sal as $row){$sum += $row['p_price']*$row['p_quantity'];}echo $sum; ?></h2>
                        <p class="text-success ml-2 mb-0 font-weight-medium">+8.3%</p>
                      </div>
                      <h6 class="text-muted font-weight-normal"> 9.61% Since last month</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                      <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5>Purchase</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <h2 class="mb-0">$2039</h2>
                        <p class="text-danger ml-2 mb-0 font-weight-medium">-2.1% </p>
                      </div>
                      <h6 class="text-muted font-weight-normal">2.27% Since last month</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                      <i class="icon-lg mdi mdi-monitor text-success ml-auto"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Order Status</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Client Name </th>
                          <th> Product Name </th>
                          <th> Product Quantity</th>
                          <th> Payment Mode </th>
                          <th> Tracking NO </th>
                          <th> Order Status </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody id="table_data">
                        <?php
                        $fetchAllOrders = mysqli_query($db, "SELECT * FROM orders ");
                        $sno = 1;
                        foreach ($fetchAllOrders as $data) {
                        ?>
                          <tr>
                            <td>
                              <?php echo $sno;
                              $sno++; ?>
                            </td>

                            <td> <?php echo $data['u_name'] ?> </td>
                            <td> <?php echo $data['p_name'] ?></td>
                            <td> <?php echo $data['p_quantity'] ?></td>
                            <td> <?php echo $data['delivery_status'] ?> </td>
                            <?php
                            $tracking_no = $data['tracking_no'];
                            $tracking = mysqli_query($db, "SELECT * FROM tracking WHERE tracking_no = '$tracking_no'");
                            $track_row = mysqli_fetch_array($tracking);
                            ?>
                            <td> <?php echo $track_row['tracking_no'] ?> </td>
                            <?php
                            if ($track_row['status'] == 'delivered') {
                            ?>
                              <td>
                                <p class="text-success" style="text-shadow: 0.5px 0.5px 1px black;">Delivered</p>
                              </td>
                            <?php
                            } else if ($track_row['status'] == 'shipped') {
                            ?>
                              <td>
                                <p class="text-warning" style="text-shadow: 0.5px 0.5px 1px black;">Shipped</p>
                              </td>
                            <?php
                            } else if ($track_row['status'] == 'confirmed') {
                            ?>
                              <td>
                                <p class="text-secondary" style="text-shadow: 0.5px 0.5px 1px black;">Confirmed</p>
                              </td>
                            <?php
                            } else if ($track_row['status'] == 'packed') {
                            ?>
                              <td>
                                <p style="color: lightblue;text-shadow: 0.5px 0.5px 1px black;" class="">Packed</p>
                              </td>
                            <?php
                            } else {
                            ?>
                              <td>
                                <p class="text-danger" style="text-shadow: 0.5px 0.5px 1px black;">Pending</p>
                              </td>
                            <?php
                            }
                            ?>
                            <td class="d-flex">
                              <?php
                              if ($track_row['status'] != 'pending') {
                              ?>
                                <button class="btn btn-outline-success" data-toggle="modal"
                                  data-target="#update_<?php echo $data['id'] ?>" style="margin-right:10px;">Update Status</button>
                              <?php
                              }
                              ?>

                              <form action="../print.php" method="post" class="mr-2">
                                <input type="hidden" name="order" value="<?php echo $data['id'] ?>">
                                <input type="submit" name="print_order" class="btn btn-outline-success " value="Print Order">
                              </form>
                              <form action="Label_print.php" method="post">
                                <input type="hidden" name="order" value="<?php echo $data['id'] ?>">
                                <input type="submit" name="print_label" class="btn btn-outline-success" value="Print Label">
                              </form>
                              <!-- update status -->
                              <div class="modal fade" id="update_<?php echo $data['id'] ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <form action="index.php" method='post'>
                                    <div class="modal-content ">
                                      <div class="modal-header bg-success">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                                        <button type="button" class="close text-danger" data-dismiss="modal"
                                          aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="form-group row">
                                          <div class="col-12 p-2">
                                            <label for="category_name">Order Status</label>
                                            <input type="hidden" name='tracking_no' value="<?php echo $track_row['tracking_no'] ?>">
                                            <select name="delivery_status" id="" class="form-control text-white">
                                              <option value="confirmed" <?php if ($track_row['status'] == 'confirmed') {
                                                                          echo "selected";
                                                                        } ?>>Confirmed</option>
                                              <option value="packed" <?php if ($track_row['status'] == 'packed') {
                                                                        echo "selected";
                                                                      } ?>>Packed</option>
                                              <option value="shipped" <?php if ($track_row['status'] == 'shipped') {
                                                                        echo "selected";
                                                                      } ?>>Shipped</option>
                                              <option value="delivered" <?php if ($track_row['status'] == 'delivered') {
                                                                          echo "selected";
                                                                        } ?>>Delivered</option>
                                            </select>

                                          </div>
                                        </div>


                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" name="update_status" class="btn btn-success">Update</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>

                              </div>
                              <!-- end update status -->
                            </td>
                          </tr>
                        <?php
                        }
                        ?>



                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php
        include "footer.php";
        if (isset($_POST['update_status'])) {
          $tracking_no = $_POST['tracking_no'];
          $delivery_status = $_POST['delivery_status'];

          mysqli_query($db, "UPDATE `tracking` SET `status` = '$delivery_status' WHERE `tracking`.`tracking_no` = '$tracking_no'");
          echo "<script> alert('Status Updated');
          location.assign('index.php'); </script>";
        }
       
        ?>
        <script>
          $(document).ready(function() {
            $("#searchbox").keyup(function() {
              var value = $(this).val();

              $.ajax({
                url: "search.php",
                method: "POST",
                data: {
                  "index": value
                },
                success: function(data) {
                  $("#table_data").html(data);
                }
              })
            })

          })
        </script>
</body>

</html>