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
  document.getElementById("profile").classList.add("active");
  document.getElementById("Home").classList.remove("active");
</script>

    <section style="background-color: #eee;">
      <div class="container py-2">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
              </ol>
            </nav>
          </div>
        </div>
        <?php
        include "config.php";
        $user_id = $_SESSION['id'];
        $query = "SELECT register.id,register.name,register.email,register.password,register.date AS register_date,register.address,register.phone_no,register.country,orders.id AS order_id,orders.u_name,orders.u_country,orders.u_address,orders.u_phone,orders.delivery_status,orders.p_id,orders.p_name,
orders.generic_name,orders.p_quantity,orders.p_price,orders.p_prescription,orders.order_status,tracking_no,orders.date AS order_date FROM
register LEFT JOIN orders ON register.id = orders.u_id WHERE register.id='$user_id';";
        $userData = mysqli_query($db, $query);
        $data = mysqli_fetch_assoc($userData)
          ?>
        <div class="row">
          <div class="col-lg-4">
            <div class="card mb-4">
              <div class="card-body text-center">
                <img src="images/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                <h5 class="my-3"><?php echo $data['name'] ?></h5>
                <p class="text-muted mb-4"><?php echo $data['country'] ?></p>
                <!-- <div class="d-flex justify-content-center mb-2">
                  <button type="button" class="btn btn-success" style="margin-right:10px;">Follow</button>
                  <button type="button" class="btn btn-outline-success ms-1">Message</button>
                </div> -->
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Email</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $data['email'] ?></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Phone</p>
                  </div>
                  <div class="col-sm-9 d-flex position-relative">
                    <p class="text-muted mb-0"><?php echo $data['phone_no'] ?></p>
                    <button type="button" class="btn btn-outline-success text-center"
                      style="position:absolute;right:10px;" data-toggle="modal"
                      data-target="#phonenumberupdate">Update</button>
                  </div>
                  <div class="modal fade mt-5" id="phonenumberupdate" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form action="profile.php" method='POST' enctype="multipart/form-data">
                        <div class="modal-content ">
                          <div class="modal-header bg-success">
                            <h5 class="modal-title text-light " id="exampleModalLabel">Update Phone Number</h5>
                            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="phonenumber">Phone Number</label>
                                <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                <input type="text" class="form-control text-light bg-dark" name="u_phoneno"
                                  id="phonenumber" value="<?php echo $data['phone_no'] ?>">
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="u_phoneno_btn" class="btn btn-success">Update</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Address</p>
                  </div>
                  <div class="col-sm-9 d-flex position-relative">
                    <p class="text-muted mb-0"><?php echo $data['address'] ?>,<?php echo $data['country'] ?></p>
                    <button class="btn btn-outline-success text-center" style="position:absolute;right:10px;"
                      data-toggle="modal" data-target="#updateaddress">Update</button>
                  </div>
                  <div class="modal fade mt-5" id="updateaddress" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form action="profile.php" method='POST' enctype="multipart/form-data">
                        <div class="modal-content ">
                          <div class="modal-header bg-success">
                            <h5 class="modal-title text-light " id="exampleModalLabel">Update Address and Country</h5>
                            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <label for="address_c">Address</label>
                                <input type="text" class="form-control text-light bg-dark" name="u_address"
                                  id="address_c" value="<?php echo $data['address'] ?>">
                              </div>
                              <div class="col-sm-12">
                                <label for="c_country">Country</label>
                                <select id="c_country" name="u_country" class="form-control">
                                  <option>Select a country</option>
                                  <?php
                                  $country = mysqli_query($db, "select * from country");
                                  foreach ($country as $coun) {
                                    ?>
                                    <option value="<?= $coun['iso'] ?>" <?php
                                      if ($data['country'] == $coun['iso'])
                                        echo "selected"; ?>>
                                      <?= $coun['name'] ?>
                                    </option>
                                    <?php
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="u_addressandcountry" class="btn btn-success">Update</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Sign Up Date</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $data['register_date'] ?></p>
                  </div>
                </div>
                <hr>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade mt-5" id="updatephoneno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form action="code.php" method='POST' enctype="multipart/form-data">
            <div class="modal-content ">
              <div class="modal-header bg-success">
                <h5 class="modal-title text-light " id="exampleModalLabel">SIGNUP FORM</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <div class="col-sm-12">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" class="form-control text-light bg-dark" name="name" id="exampleInputUsername2"
                      placeholder="Fullname" required>
                  </div>
                  <div class="col-sm-12">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control text-light bg-dark" name="email" id="exampleInputUsername2"
                      placeholder="Email Address" required>
                  </div>
                  <div class="col-sm-12">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" class="form-control text-light bg-dark" name="password"
                      id="exampleInputUsername2" placeholder="Password" required>
                  </div>
                  <div class="col-sm-12">
                    <label for="exampleInputEmail1">Retype Password</label>
                    <input type="password" class="form-control text-light bg-dark" name="retype_password"
                      id="exampleInputUsername2" placeholder="Retype Password" required>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" name="register" class="btn btn-success">SIGN UP</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col">
            <table class="table table-hover bg-light">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Medication Name</th>
                  <th scope="col">Qauntity</th>
                  <th scope="col">Address</th>
                  <th scope="col">Delivery Mode</th>
                  <th scope="col">Order Date/Time</th>
                  <th scope="col">Tracking No</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $user_id = $_SESSION['id'];
                $userData = mysqli_query($db, $query);
                $sno = 1;
                foreach ($userData as $data) {
                  if($data['p_name']!=null){
                    
                  
                  ?>
                  <tr>
                    <th scope="row"><?php echo $sno;
                    $sno++; ?></th>
                    <td><?php echo $data['p_name'] ?></td>
                    <td><?php echo $data['p_quantity'] ?></td>
                    <td><?php echo $data['u_address'] ?></td>
                    <td><?php echo $data['delivery_status'] ?></td>
                    <td><?php echo $data['order_date'] ?></td>
                    <td><?php echo $data['tracking_no'] ?></td>
                    <?php
                    $tracking_no=$data['tracking_no'];
                    $track=mysqli_query($db,"SELECT * FROM tracking WHERE tracking_no = '$tracking_no'");
                    $row = mysqli_fetch_array($track);
                    if($row['status']=='delivered'){
                      ?>
                      <td>
                        <p class="text-success">Delivered</p>
                      </td>
                      <?php
                    }else if($row['status']== 'shipped'){
                      ?>
                      <td>
                        <p class="text-warning">Shipped</p>
                      </td>
                      <?php
                    }else if($row['status']=='confirmed'){
                      ?>
                      <td>
                        <p class="text-primary">Confirmed</p>
                      </td>
                      <?php
                    }else{
                      ?>
                      <td>
                        <p class="text-danger">Pending</p>
                      </td>
                      <?php
                    }
                    ?>
                    <td>
                      <form action="print.php" method="post">
                      <input type="hidden" name="order" value="<?php echo $data['order_id'] ?>">
                      <input type="submit" name="print_order" class="btn btn-success" value="Print Order">
                      </form>
                    </td>
                  </tr>

                  <?php
                  }
                }
              
                if (isset($_POST['u_phoneno_btn'])) {
                  $user_id = $_SESSION['id'];
                  $phonenumber = $_POST['u_phoneno'];
                  $updatephonequery = "UPDATE register SET phone_no = '$phonenumber' WHERE id = '$user_id'";
                  mysqli_query($db, $updatephonequery);
                  ?>
                  <script>
                    alert('Phone Number Updated Successfully');
                    location.assign('profile.php');
                  </script>
                  <?php
                }
                if (isset($_POST['u_addressandcountry'])) {
                  $user_id = $_SESSION['id'];
                  $address = $_POST['u_address'];
                  $country = $_POST['u_country'];
                  $updateaddressquery = "UPDATE register SET address = '$address', country = '$country' WHERE id = '$user_id'";
                  mysqli_query($db, $updateaddressquery);
                  ?>
                  <script>
                    alert('Address and Country Updated Successfully');
                    location.assign('profile.php');
                  </script>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <?php
    include 'footer.php';
    ?>
  </div>

</body>

</html>
