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
                    data-target="#exampleModal">
                    <i class="mdi mdi-upload btn-icon-prepend"></i> Add Category </button>



                  <!-- Add Category -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form action="adminCoding.php" method='POST' enctype="multipart/form-data">
                        <div class="modal-content ">
                          <div class="modal-header bg-success">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group row">
                              <div class="col-sm-12 p-2">
                                <label for="new_name">Category Name</label>
                                <input type="text" class="form-control text-light" name="category_name"
                                  id="new_name" placeholder="Category Name">
                              </div>

                              <div class="col-sm-4 p-2">
                                <label for="new_file">Upload Image</label>
                                <input type="text" name="img" class="form-control text-light"
                                  placeholder="Upload Image" id="new_file" onclick="type='file'">
                              </div>
                            </div>


                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="add_category" class="btn btn-success">Save changes</button>
                          </div>
                        </div>
                      </form>
                    </div>

                  </div>
                  <!-- Add Category -->

                  <div class="table-responsive  mt-3">
                    <table class="table border">
                      <thead>
                        <tr>

                          <th> # </th>
                          <th> Category Name</th>
                          <th> Image</th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        include "../config.php";
                        $fetchAllCategory = mysqli_query($db, "SELECT * FROM category");
                        $sno = 1;
                        foreach ($fetchAllCategory as $data) {
                          ?>
                          <tr>
                            <td>
                              <?php echo $sno;
                              $sno++; ?>
                            </td>

                            <td> <?php echo $data['category_name'] ?> </td>
                            <td> <img src="<?php echo $data['category_image'] ?> " width="300px" alt=""></td>


                            <td>
                              <button class="btn btn-outline-success" data-toggle="modal"
                                data-target="#update_<?php echo $data['id'] ?>" style="margin-right:10px;">Update</button>
                              <button class="btn btn-outline-danger" data-toggle="modal"
                                data-target="#delete_<?php echo $data['id'] ?>">Delete</button>
                            </td>
                          </tr>


                          <!-- Update Company  -->


                          <div class="modal fade" id="update_<?php echo $data['id'] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form action="category.php" method='post' enctype="multipart/form-data">
                                <div class="modal-content ">
                                  <div class="modal-header bg-success">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                                    <button type="button" class="close text-danger" data-dismiss="modal"
                                      aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group row">
                                      <div class="col-12 p-2">
                                        <label for="category_name">Category Name</label>
                                        <input type="hidden" name='id' value="<?php echo $data['id'] ?>">
                                        <input type="text" class="form-control text-light" name="category_name"
                                          value="<?php echo $data['category_name'] ?>" id="category_name"
                                          placeholder="Category Name">
                                      </div>

                                      <div class="col-4 p-2">
                                        <label for="file_update">Upload Image</label>
                                        <input type="text" name="img" class="form-control text-light" placeholder="Upload New Image"  onclick="type='file'" id="file_update">
                                      </div>
                                    </div>


                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
                                    <button type="submit" name="update_category" class="btn btn-success">Update</button>
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
                                <form action="category.php" method='POST' enctype="multipart/form-data">
                                  <div class="modal-content ">
                                    <div class="modal-header bg-danger">
                                      <h5 class="modal-title" id="delete_<?php echo $data['id'] ?>">Delete Company</h5>
                                      <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
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

                        if (isset($_POST['update_category'])) {
                          include "../config.php";
                          $id = $_POST['id'];
                          $category_name = $_POST['category_name'];
                          if($category_name==""){
                            ?>
                            <script>
                              alert('Please Enter Category Name');
                              location.assign('category.php');
                            </script>
                            <?php
                          } else if (empty($_FILES['img'])) {
                            $update = mysqli_query($db, "UPDATE category SET category_name = '$category_name' WHERE id ='$id'");
                            ?>
                              <script>
                                alert('Category Updated Successfully');
                                location.assign('category.php');
                              </script>
                            <?php
                          }
                          else{
                            $img = $_FILES['img']['name'];
                            $tmp_name = $_FILES['img']['tmp_name'];
                            $destination = "../Category/" . $img;
                            $extension = pathinfo($img, PATHINFO_EXTENSION);
                            if ($extension == "png" or $extension == "jpg" or $extension == "jpeg" or $extension == "jfif" or $extension == "webp") {
                              if (move_uploaded_file($tmp_name, $destination)) {
                                $update = mysqli_query($db, "UPDATE category SET category_name = '$category_name',category_image='$destination' WHERE id ='$id'");
                                ?>
                                  <script>
                                    alert('Category Updated Successfully');
                                    location.assign('category.php');
                                  </script>
                                <?php
                              } else {
                                ?>
                                  <script>
                                    alert('Failed to Upload File try again');
                                    location.assign('category.php');
                                  </script>
                                <?php
                              }
                            } else {
                              ?>
                              <script>
                                alert('File Format Not Supported');
                                location.assign('category.php');
                              </script>
                            <?php
                            }
                          }

                         
                        }
                        if (isset($_POST['delete_company'])) {
                          include "../config.php";
                          $id = $_POST['delete_id'];
                          $delete = mysqli_query($db, "DELETE FROM category WHERE id ='$id'");
                          ?>
                          <script>
                            alert('Category Deleted Successfully');
                            location.assign('category.php');
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
      <?php
      include "footer.php";
      ?>
</body>

</html>