<?php
session_start();
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

<?php
include "../config.php";
?>
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




          <div class="row ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <button type="button" class="btn btn-success btn-icon-text" data-toggle="modal"
                    data-target="#add_medicine">
                    <i class="mdi mdi-upload btn-icon-prepend"></i> Add Medicine </button>



                  <!-- Add Medicine -->
                  <div class="modal fade" id="add_medicine" tabindex="-1" role="dialog"
                    aria-labelledby="add_medicineLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <form action="adminCoding.php" method='POST' enctype="multipart/form-data">
                        <div class="modal-content ">
                          <div class="modal-header bg-success">
                            <h5 class="modal-title" id="add_medicineLabel">Add Medicine</h5>
                            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group row">
                              <div class="col-sm-3">
                                <label for="exampleInputEmail1">Dosage</label>
                                <input type="text" name="dosage" class="form-control text-light"
                                  id="exampleInputUsername2" placeholder="Dosage">
                              </div>


                              <div class="col-sm-3">
                                <label for="exampleInputEmail1">Brand Name</label>
                                <input type="text" name="brand_name" class="form-control text-light"
                                  id="exampleInputUsername2" placeholder="Brand Name">
                              </div>

                              <div class="col-sm-3">
                                <label for="exampleInputEmail1">Generic Name</label>
                                <input type="text" name="generic_name" class="form-control text-light"
                                  id="exampleInputUsername2" placeholder="Generic Name">
                              </div>

                              <div class="col-sm-3">
                                <label for="exampleInputEmail1">Strength</label>
                                <input type="text" name="strength" class="form-control text-light"
                                  id="exampleInputUsername2" placeholder="Strength">
                              </div>
                            </div>

                            <div class="form-group row">
                              <div class="col-sm-3">
                                <label for="exampleInputEmail1">Indication</label>
                                <input type="text" name="indication" class="form-control text-light"
                                  id="exampleInputUsername2" placeholder="Indication">
                              </div>


                              <div class="col-sm-3">
                                <label for="exampleInputEmail1">Adverce Drug Reaction</label>
                                <input type="text" name="adverce_drug_reaction" class="form-control text-light"
                                  id="exampleInputUsername2" placeholder="Adverce Drug Reaction">
                              </div>

                              <div class="col-sm-3">
                                <label for="exampleInputEmail1">Side Effect</label>
                                <input type="text" name="side_effect" class="form-control text-light"
                                  id="exampleInputUsername2" placeholder="Side Effect">
                              </div>

                              <div class="col-sm-3">
                                <label for="exampleInputEmail1">Category</label>
                                <select class="form-control text-light" name="category_name">
                                  <option value="">Select Category</option>
                                  <?php

                                  $allCompany = mysqli_query($db, "SELECT * FROM category");
                                  foreach ($allCompany as $data) {
                                    ?>
                                    <option value="<?php echo $data['category_name'] ?>">
                                      <?php echo $data['category_name'] ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>


                            <div class="form-group row">
                              <div class="col-sm-3">
                                <label for="exampleInputEmail1">Company</label>
                                <select class="form-control text-light" name="company_name">
                                  <option value="">Select Company</option>
                                  <?php

                                  $allCompany = mysqli_query($db, "SELECT * FROM company");
                                  foreach ($allCompany as $data) {
                                    ?>
                                    <option value="<?php echo $data['company_name'] ?>">
                                      <?php echo $data['company_name'] ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>


                              <div class="col-sm-3">
                                <label for="exampleInputEmail1">Counseling</label>
                                <input type="text" name="counceling" class="form-control text-light"
                                  id="exampleInputUsername2" placeholder="Counseling">
                              </div>

                              <div class="col-sm-3">
                                <label for="exampleInputEmail1">Pack Size</label>
                                <input type="text" name="pack_size" class="form-control text-light"
                                  id="exampleInputUsername2" placeholder="Pack Size">
                              </div>

                              <div class="col-sm-3">
                                <label for="exampleInputEmail1">Quantity</label>
                                <input type="number" name="quantity" class="form-control text-light"
                                  id="exampleInputUsername2" placeholder="Quantity">
                              </div>
                            </div>

                            <div class="form-group row">
                              <div class="col-sm-3">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="number" name="price" class="form-control text-light"
                                  id="exampleInputUsername2" placeholder="Price">
                              </div>


                              <div class="col-sm-6">
                                <label for="exampleInputEmail1">Prescription</label>
                                <input type="text" name="prescription" class="form-control text-light"
                                  id="exampleInputUsername2" placeholder="Prescription">
                              </div>

                              <div class="col-sm-3">
                                <label for="newimg">Upload Image</label>
                                <input type="text" name="img" class="form-control text-light" id="newimg"
                                  placeholder="Upload Image" onclick="type='file'">
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="sumbit" name="add_medicine" class="btn btn-success">Save changes</button>
                          </div>
                        </div>
                      </form>
                    </div>

                  </div>
                  <!-- Add Medicine -->

                  <div class="table-responsive mt-3">
                    <table class="table border">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th>Image</th>
                          <th>Dosage </th>
                          <th>Brand Name </th>
                          <th>Generic Name </th>
                          <th>Strength </th>
                          <th>Indication </th>
                          <th>Adverce Drung Reaction </th>
                          <th>Side Effect</th>
                          <th>Category</th>
                          <th>Company</th>
                          <th>Counceling</th>
                          <th>Pack Size</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Prescription</th>
                          <th> Payment Status </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $fetchAllMedincine = mysqli_query($db, "SELECT * FROM medicine");
                        $sno = 1;
                        foreach ($fetchAllMedincine as $data) {
                          ?>
                          <tr>
                            <td>
                              <?php echo $sno;
                              $sno++; ?>
                            </td>
                            <td>
                              <img src="<?php echo $data['img'] ?>" alt="image" />
                            </td>
                            <td> <?php echo $data['dosage'] ?> </td>
                            <td> <?php echo $data['brand_name'] ?> </td>
                            <td> <?php echo $data['generic_name'] ?> </td>
                            <td> <?php echo $data['strength'] ?> </td>
                            <td> <?php echo $data['indication'] ?> </td>
                            <td> <?php echo $data['adverce_drug_reaction'] ?> </td>
                            <td> <?php echo $data['side_effect'] ?> </td>
                            <td> <?php echo $data['category'] ?> </td>
                            <td> <?php echo $data['company'] ?> </td>
                            <td> <?php echo $data['counseling'] ?> </td>
                            <td> <?php echo $data['pack_size'] ?> </td>
                            <td> <?php echo $data['quatity'] ?> </td>
                            <td> <?php echo $data['price'] ?> </td>
                            <td> <?php echo $data['prescription'] ?> </td>

                            <td>
                              <button class="btn btn-outline-success" data-toggle="modal"
                                data-target="#update_<?php echo $data['id'] ?>" style="margin-right:10px;">Update</button>
                              <button class="btn btn-outline-danger" data-toggle="modal"
                                data-target="#delete_<?php echo $data['id'] ?>">Delete</button>
                            </td>
                          </tr>


                          <!-- Update Medicine -->
                          <div class="modal fade" id="update_<?php echo $data['id'] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="update_<?php echo $data['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <form action="" method='POST' enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                                <div class="modal-content">
                                  <div class="modal-header bg-success">
                                    <h5 class="modal-title" id="update_<?php echo $data['id'] ?>">Update Medicine</h5>
                                    <button type="button" class="close text-danger" data-dismiss="modal"
                                      aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group row">
                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Dosage</label>
                                        <input type="text" name="dosage" value=<?php echo $data['dosage'] ?>
                                          class="form-control text-light" id="exampleInputUsername2" placeholder="Dosage">
                                      </div>


                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Brand Name</label>
                                        <input type="text" name="brand_name" value=<?php echo $data['brand_name'] ?>
                                          class="form-control text-light" id="exampleInputUsername2"
                                          placeholder="Brand Name">
                                      </div>

                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Generic Name</label>
                                        <input type="text" name="generic_name" value=<?php echo $data['generic_name'] ?>
                                          class="form-control text-light" id="exampleInputUsername2"
                                          placeholder="Generic Name">
                                      </div>

                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Strength</label>
                                        <input type="text" name="strength" value=<?php echo $data['strength'] ?>
                                          class="form-control text-light" id="exampleInputUsername2"
                                          placeholder="Strength">
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Indication</label>
                                        <input type="text" name="indication" value=<?php echo $data['indication'] ?>
                                          class="form-control text-light" id="exampleInputUsername2"
                                          placeholder="Indication">
                                      </div>


                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Adverce Drug Reaction</label>
                                        <input type="text" name="adverce_drug_reaction"
                                          value="<?php echo $data['adverce_drug_reaction'] ?>"
                                          class="form-control text-light" id="exampleInputUsername2"
                                          placeholder="Adverce Drug Reaction">
                                      </div>

                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Side Effect</label>
                                        <input type="text" name="side_effect" value="<?php echo $data['side_effect'] ?>"
                                          class="form-control text-light" id="exampleInputUsername2"
                                          placeholder="Side Effect">
                                      </div>

                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select class="form-control text-light" name="category_name">
                                          <option value="">Select Category</option>
                                          <?php

                                          $allCompany = mysqli_query($db, "SELECT * FROM category");
                                          foreach ($allCompany as $old) {
                                            ?>
                                            <option value="<?php echo $old['category_name'] ?>" <?php if ($data['category'] == $old['category_name']) {
                                                 echo "selected";
                                               } ?>>
                                              <?php echo $old['category_name'] ?></option>
                                          <?php
                                          }
                                          ?>
                                        </select>
                                      </div>
                                    </div>


                                    <div class="form-group row">
                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Company</label>
                                        <select class="form-control text-light" name="company_name">
                                          <option value="">Select Company</option>
                                          <?php

                                          $allCompany = mysqli_query($db, "SELECT * FROM company");
                                          foreach ($allCompany as $old) {
                                            ?>
                                            <option value="<?php echo $old['company_name'] ?>" <?php if ($data['company'] == $old['company_name']) {
                                                 echo "selected";
                                               } ?>>
                                              <?php echo $old['company_name'] ?></option>
                                          <?php
                                          }
                                          ?>
                                        </select>
                                      </div>


                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Counseling</label>
                                        <input type="text" name="counceling" value="<?php echo $data['counseling'] ?>"
                                          class="form-control text-light" id="exampleInputUsername2"
                                          placeholder="Counseling">
                                      </div>

                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Pack Size</label>
                                        <input type="text" name="pack_size" value="<?php echo $data['pack_size'] ?>"
                                          class="form-control text-light" id="exampleInputUsername2"
                                          placeholder="Pack Size">
                                      </div>

                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Quantity</label>
                                        <input type="number" name="quantity" value="<?php echo $data['quatity'] ?>"
                                          class="form-control text-light" id="exampleInputUsername2"
                                          placeholder="Quantity">
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="number" name="price" value="<?php echo $data['price'] ?>"
                                          class="form-control text-light" id="exampleInputUsername2" placeholder="Price">
                                      </div>


                                      <div class="col-sm-6">
                                        <label for="exampleInputEmail1">Prescription</label>
                                        <input type="text" name="prescription" value="<?php echo $data['prescription'] ?>"
                                          class="form-control text-light" id="exampleInputUsername2"
                                          placeholder="Prescription">
                                      </div>

                                      <div class="col-sm-3">
                                        <label for="exampleInputEmail1">Upload Image</label>
                                        <input type="text" name="img" class="form-control text-light" placeholder="Upload Image" onclick="type='file'">
                                      </div>


                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="sumbit" name="update_medicine" class="btn btn-success">Update</button>
                                  </div>
                                </div>
                              </form>
                            </div>

                          </div>
                          <!-- Add Medicine -->
                              <!-- Delete Company -->
                          <div class="modal fade" id="delete_<?php echo $data['id'] ?>" tabindex="-1" role="dialog"
                                aria-labelledby="delete_<?php echo $data['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <form action="medicine.php" method='POST' enctype="multipart/form-data">
                                    <div class="modal-content ">
                                      <div class="modal-header bg-danger">
                                        <h5 class="modal-title" id="delete_<?php echo $data['id'] ?>">Delete Medicine</h5>
                                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <input type="hidden" name='delete_id' value="<?php echo $data['id'] ?>">
                                        <p>Are you sure you want to delete this medicine ?</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                        <button type="submit" name="delete_medicine" class="btn btn-danger">Delete</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              
                              </div>
                              <!-- Delete Company -->
                        <?php
                        }
                        ?>

                        <?php
                        if (isset($_POST['update_medicine'])) {

                          $id = $_POST['id'];
                          $img = $_FILES['img']['name'];
                          $tmp_name = $_FILES['img']['tmp_name'];
                          $destination = "images/" . $img;
                          $extension = pathinfo($img, PATHINFO_EXTENSION);

                          if ($extension == "png" or $extension == "jpg" or $extension == "jpeg" or $extension == "jfif" or $extension == "webp") {
                            if (move_uploaded_file($tmp_name, $destination)) {
                              $dosage = $_POST['dosage'];
                              $brand_name = $_POST['brand_name'];
                              $generic_name = $_POST['generic_name'];
                              $strength = $_POST['strength'];
                              $indication = $_POST['indication'];
                              $adverce_drug_reaction = $_POST['adverce_drug_reaction'];
                              $side_effect = $_POST['side_effect'];
                              $category_name = $_POST['category_name'];
                              $company_name = $_POST['company_name'];
                              $counceling = $_POST['counceling'];
                              $pack_size = $_POST['pack_size'];
                              $quantity = $_POST['quantity'];
                              $price = $_POST['price'];
                              $prescription = $_POST['prescription'];

                              $update = mysqli_query($db, "UPDATE medicine SET dosage = '$dosage',brand_name='$brand_name',generic_name='$generic_name',strength='$strength',indication='$indication',adverce_drug_reaction='$adverce_drug_reaction',side_effect='$side_effect',category='$category_name',company='$company_name',counseling='$counceling',pack_size='$pack_size',quatity='$quantity',price='$price',prescription='$prescription',img='$destination' WHERE id ='$id'");

                              echo "<script>
                                          alert('Medicine Updated Successfully');
                                          location.assign('medicine.php');
                                      </script>";


                            } else {
                              echo "<script>
                                          alert('File Not Uploaded');
                                          location.assign('medicine.php');
                                      </script>";
                            }
                          } else {
                            echo "<script>
                                          alert('Please Upload Only Image File');
                                          location.assign('medicine.php');
                                      </script>";
                          }
                        }


                        if (isset($_POST['delete_medicine'])) {

                          $id = $_POST['delete_id'];

                          $delete = mysqli_query($db, "DELETE FROM medicine WHERE id ='$id'");
                          ?>
                          <script>
                            alert('Medicine Deleted Successfully');
                            location.assign('medicine.php');
                          </script>
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
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © MAS
              2024</span>
            <!-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                templates</a> from Bootstrapdash.com</span> -->
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="assets/js/dashboard.js"></script>
  <!-- End custom js for this page -->
</body>

</html>