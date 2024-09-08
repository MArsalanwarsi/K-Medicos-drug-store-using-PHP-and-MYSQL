<?php
session_start();
include_once 'config.php';
include "doctype.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
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
      function generateTrackingID($length = 16)
      {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $charactersLength = strlen($characters);
        $numbersLength = strlen($numbers);
        $randomString = '';

        // Generate the first 4 characters
        for ($i = 0; $i < 4; $i++) {
          $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        // Generate the remaining characters as numbers
        for ($i = 0; $i < $length - 4; $i++) {
          $randomString .= $numbers[random_int(0, $numbersLength - 1)];
        }

        return $randomString;
      }
      foreach ($_SESSION['cart'] as $key => $value) {
        $p_id = $value['p_id'];
        $p_name = $value['p_name'];
        $p_price = $value['p_price'];
        $p_quantity = $value['p_quantity'];
        $p_generic = $value['p_generic'];
        $p_priscription = $value['p_priscription'];
        $p_img = $value['p_img'];
        $tracking_id = generateTrackingID();
        $checktrack = mysqli_query($db, "select * from tracking where tracking_no='$tracking_id'");

        if (mysqli_num_rows($checktrack) > 0) {
          $tracking_id = generateTrackingID();
        }

        $insert = mysqli_query($db, "INSERT INTO orders (u_id,u_name,u_country,u_address,u_phone,delivery_status,p_id,p_name,p_quantity,p_price,generic_name,p_prescription,p_image,tracking_no)VALUES('$u_id','$u_name','$country','$address','$phone','$cod','$p_id','$p_name','$p_quantity','$p_price','$p_generic','$p_prescription','$p_img','$tracking_id')");
        mysqli_query($db, "insert into tracking(tracking_no)values('$tracking_id')");

        $getOldQuantity = mysqli_query($db, "SELECT * FROM medicine WHERE id = '$p_id'");
        $dataQuantity = mysqli_fetch_assoc($getOldQuantity);
        $old_quantity = $dataQuantity['quatity'];
        $updated_quantity = $old_quantity - $p_quantity;


        $update = mysqli_query($db, "UPDATE medicine SET quatity = '$updated_quantity' WHERE id = '$p_id'");
        $email_query=mysqli_query($db,"select * from register where id='$u_id'");
        $email_data=mysqli_fetch_assoc($email_query);
        $email=$email_data['email'];
        $name=$email_data['name'];
        // send mail confirm order
        $confirmOrderUrl = 'http://localhost/Arsalan%20php/Medicine%20Website%20using%20php%20mysql/code.php?tracking_id=' . $tracking_id;
        $mail = new PHPMailer(true);
        try {
          //Server settings
          $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
          $mail->isSMTP();                                            //Send using SMTP
          $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
          $mail->Username   = 'mohammadarsalanwarsi@gmail.com';                     //SMTP username
          $mail->Password   = 'vqooylnpygwmrzgf';                               //SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
          $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

          //Recipients
          $mail->setFrom('mohammadarsalanwarsi@gmail.com', 'K-Medicos');
          $mail->addAddress("$email");     //Add a recipient
          //Content
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Order Confirmation';


          // HTML Body
          $mail->Body    = "
    <html>
    <head>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f0f8ff;
            }
            .container {
                width: 90%;
                max-width: 650px;
                margin: 20px auto;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border: 1px solid #ddd;
            }
            .header {
                text-align: center;
                padding: 20px;
                background-color: #4CAF50;  /* Premium Green */
                color: #ffffff;
                border-radius: 10px 10px 0 0;
            }
            .header h1 {
                margin: 0;
                font-size: 24px;
            }
            .content {
                padding: 20px;
                color: #333;
                line-height: 1.6;
            }
            .content p {
                margin: 10px 0;
            }
            .content b {
                color: #4CAF50;  /* Premium Green */
            }
            .cta-button {
                display: block;
                width: fit-content;
                margin: 20px auto;
                padding: 10px 20px;
                font-size: 16px;
                font-weight: bold;
                color: #4CAF50 !important;  /* Premium Green */
                background-color: #ffffff;
                border: 2px solid #4CAF50;  /* Premium Green */
                border-radius: 5px;
                text-decoration: none;
                text-align: center;
            }
            .cta-button:hover {
                background-color: #4CAF50;  /* Premium Green */
                color: #ffffff;
            }
            .footer {
                text-align: center;
                padding: 15px;
                font-size: 14px;
                color: #666;
                background-color: #f9f9f9;
                border-radius: 0 0 10px 10px;
                border-top: 1px solid #ddd;
            }
            .footer a {
                color: #4CAF50;  /* Premium Green */
                text-decoration: none;
            }
            .footer a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>Order Confirmation</h1>
            </div>
            <div class='content'>
                <p>Dear <b>$name</b>,</p>
                <p>Thank you for your order! We're excited to let you know that your order has been successfully placed.</p>
                <p>Your Tracking ID is: <b>$tracking_id</b></p>
                <p>The total amount is: <b>$p_price</b></p>
                <p>To confirm your order and finalize the process, please click the button below:</p>
                <a href='$confirmOrderUrl' class='cta-button'>Confirm Order</a>
            </div>
            <div class='footer'>
                <p>Thank you for shopping with us!</p>
                <p>Best regards, <br>K-Medicos</p>
                <p><a href='https://www.example.com'>Visit our website</a></p>
            </div>
        </div>
    </body>
    </html>
";

          // Plain text Body
          $mail->AltBody = "
    Order Confirmation

    Dear $name,

    Thank you for your order! We're excited to let you know that your order has been successfully placed.

    Your order number is: $tracking_id
    The total amount is: RS $p_price
    To confirm your order and finalize the process, please click the following link:
    $confirmOrderUrl

    If you have any questions or need assistance, please contact us at support@example.com.

    Thank you for shopping with us!

    Best regards,
    Your Company Name
    Visit our website: https://www.example.com
";

          $mail->send();
        } catch (Exception $e) {
        }
      }
      unset($_SESSION['cart']);

      echo "<script>
      location.assign('thankyou.php')
    </script>";
    }
    ?>
</body>

</html>