<?php
session_start();
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
                  <button type="button" class="btn btn-success btn-icon-text " data-toggle="modal"
                    data-target="#companyModdel">
                    <i class="mdi mdi-upload btn-icon-prepend"></i> Add Company </button>



                  <!-- Add Company -->
                  <div class="modal fade" id="companyModdel" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form action="adminCoding.php" method='POST' enctype="multipart/form-data">
                        <div class="modal-content ">
                          <div class="modal-header bg-success">
                            <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
                            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="Add_company">Comapny Name</label>
                                <input type="text" class="form-control text-light" name="company_name" id="Add_company"
                                  placeholder="Company Name">
                              </div>
                            </div>


                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="add_company" class="btn btn-success">Save changes</button>
                          </div>
                        </div>
                      </form>
                    </div>

                  </div>
                  <!-- Add Company -->

                  <div class="table-responsive  mt-3">
                    <table class="table border">
                      <thead>
                        <tr>

                          <th> # </th>
                          <th> Company Name</th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        include "../config.php";
                        $fetchAllCompany = mysqli_query($db, "SELECT * FROM company");
                        $sno = 1;
                        foreach ($fetchAllCompany as $data) {
                          ?>
                          <tr>
                            <td>
                              <?php echo $sno;
                              $sno++; ?>
                            </td>

                            <td> <?php echo $data['company_name'] ?> </td>


                            <td>
                              <button class="btn btn-outline-success" style="margin-right:10px;" data-toggle="modal"
                                data-target="#update_<?php echo $data['id'] ?>">Update</button>
                              <button class="btn btn-outline-danger" data-toggle="modal"
                                data-target="#delete_<?php echo $data['id'] ?>">Delete
                              </button>
                            </td>
                          </tr>


                          <!-- Update Company  -->


                          <div class="modal fade" id="update_<?php echo $data['id'] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="update_<?php echo $data['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form action="company.php" method='POST' enctype="multipart/form-data">
                                <div class="modal-content ">
                                  <div class="modal-header bg-success">
                                    <h5 class="modal-title" id="update_<?php echo $data['id'] ?>">Update Company</h5>
                                    <button type="button" class="close text-danger" data-dismiss="modal"
                                      aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group row">
                                      <div class="col-sm-12">
                                        <label for="company_name">Comapny Name</label>
                                        <input type="hidden" name='update_id' value="<?php echo $data['id'] ?>">
                                        <input type="text" class="form-control text-light" name="company_name"
                                          value="<?php echo $data['company_name'] ?>" id="company_name"
                                          placeholder="Company Name">
                                      </div>
                                    </div>


                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" name="update_company" class="btn btn-success">Update</button>
                                  </div>
                                </div>
                              </form>
                            </div>

                          </div>
                          <!-- Update Company  -->

                          <!-- Delete Company -->
                          <div class="modal fade" id="delete_<?php echo $data['id'] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="delete_<?php echo $data['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form action="company.php" method='POST' enctype="multipart/form-data">
                                <div class="modal-content ">
                                  <div class="modal-header bg-danger">
                                    <h5 class="modal-title" id="delete_<?php echo $data['id'] ?>">Delete Company</h5>
                                    <button type="button" class="close text-light" data-dismiss="modal"
                                      aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <input type="hidden" name='delete_id' value="<?php echo $data['id'] ?>">
                                    <p>Are you sure you want to delete this Company ?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                    <button type="submit" name="delete_company" class="btn btn-danger">Delete</button>
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

                        if (isset($_POST['update_company'])) {
                          include "../config.php";
                          $id = $_POST['update_id'];
                          $company_name = $_POST['company_name'];

                          $update = mysqli_query($db, "UPDATE company SET company_name = '$company_name' WHERE id ='$id'");
                          if ($update) {
                            ?>
                            <script>
                              alert('Company Updated Successfully');
                              location.assign('company.php');
                            </script>
                            <?php
                          }
                        }
                        if (isset($_POST['delete_company'])) {
                          include "../config.php";
                          $id = $_POST['delete_id'];

                          $delete = mysqli_query($db, "DELETE FROM company WHERE id ='$id'");
                          if ($delete) {
                            ?>
                            <script>
                              alert('Company Deleted Successfully');
                              location.assign('company.php');
                            </script>
                            <?php
                          }
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
        ?>
</body>

</html>