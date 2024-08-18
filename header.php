<div class="site-navbar py-2 position-fixed">
  <div class="search-wrap">
    <div class="container">
      <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
      <form action="#" method="post">
        <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
      </form>
    </div>
  </div>
  <div class="container">
    <div class="d-flex align-items-center justify-content-between">
      <div class="logo">
        <div class="site-logo">
          <img src="images/logo.png" style="width:80px;" alt="">
          <a href="index.php" class="js-logo-clone">K.Medico</a>
        </div>
      </div>
      <div class="main-nav d-none d-lg-block">
        <nav class="site-navigation text-right text-md-center" role="navigation">
          <ul class="site-menu js-clone-nav d-none d-lg-block">
            <li class="active" id="Home"><a href="index.php">Home</a></li>
            <li id="shop"><a href="shop.php">Store</a></li>
            <li id="about"><a href="about.php">About</a></li>
            <?php
            if (!isset($_SESSION['name'])) {
              ?>
              <li><a href="" data-toggle="modal" data-target="#loginModel">Login</a></li>
              <li><a href="" data-toggle="modal" data-target="#registerModel">Sign Up</a></li>
              <?php
            } else {
              ?>
              <li id="profile"><a href="profile.php">Profile</a></li>
              <li><a href="logout.php">Logout</a></li>
              <?php
            }
            ?>
          </ul>
        </nav>
      </div>
      <div class="icons">
        <a href="cart.php" class="icons-btn d-inline-block bag">
          <span class="icon-shopping-bag"></span>
          <span class="number bg-success text-light">
            <?php
            $count = 0;
            if (isset($_SESSION['cart'])) {
              foreach ($_SESSION['cart'] as $key => $value) {
                $count = count($_SESSION['cart']);
              }
            }
            echo $count;
            ?>
          </span>
        </a>
        <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
            class="icon-menu"></span></a>
      </div>
    </div>
  </div>
</div>

<!-- Login Form -->
<div class="modal fade" style="margin-top: 100px;"  id="loginModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="code.php" method='POST' enctype="multipart/form-data">
      <div class="modal-content ">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-light " id="exampleModalLabel">LOGIN FORM</h5>
          <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-sm-12">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control text-light bg-dark" name="email" id="exampleInputUsername2"
                placeholder="Email Address" required>
            </div>

            <div class="col-sm-12">
              <label for="exampleInputEmail1">Password</label>
              <input type="password" class="form-control text-light bg-dark" name="password" id="exampleInputUsername2"
                placeholder="Password" required>
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" name="login" class="btn btn-success">login</button>
        </div>
      </div>
    </form>
  </div>

</div>
<!-- Login Form -->
<!-- Register Form -->
<div class="modal fade" style="margin-top: 100px;" id="registerModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
              <input type="password" class="form-control text-light bg-dark" name="password" id="exampleInputUsername2"
                placeholder="Password" required>
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
<!-- Register Form -->