<?php
session_start();
include "config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];
    if ($password == $retype_password) {
        $check_email = mysqli_query($db, "SELECT * FROM register WHERE email = '$email'");
        if (mysqli_num_rows($check_email) > 0) {
            echo "<script>
                alert('Email Already Exist')
                location.assign('index.php');
            </script>";
        } else {
            $password = sha1($password);
            $Insert = mysqli_query($db, "INSERT INTO register (name,email,password,role)VALUES('$name','$email','$password','2')");
            echo "<script>
            alert('Account Created Successfully');
            location.assign('index.php');
        </script>";
        }
    } else {
        echo "<script>
            alert('Password And Retype Password Not Match')
            location.assign('index.php');
        </script>";
    }
}
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $Fetch = mysqli_query($db, "SELECT * FROM register WHERE email ='$email' AND password = '$password' ");
    if (mysqli_num_rows($Fetch) > 0) {
        foreach ($Fetch as $data) {
            if ($data['role'] == 1) {
                $name = $data['name'];
                $_SESSION['name'] = $name;
                echo "<script> alert('Login Successful WELCOME $name')
                location.assign('AdminPanel/index.php');</script>";
            } else {
                $name = $data['name'];
                $_SESSION['name'] = $name;
                $_SESSION['id'] = $data['id'];
                echo "<script> alert('Login Successful WELCOME $name')
                location.assign('profile.php');</script>";
            }
        }
    } else {
        echo "<script>
        alert('Email Or Password Incorrect!')
        location.assign('index.php');
    </script>";
    }
}

// forgot password
if (isset($_POST['Forgot_password'])) {
    $email = $_POST['email'];
    $fetch = mysqli_query($db, "SELECT * FROM register WHERE email ='$email' ");
    if (mysqli_num_rows($fetch) > 0) {
        $row = mysqli_fetch_array($fetch);
        $OTP = rand(1000, 9999);
        $_SESSION['otp_email'] = $email;
        $check = mysqli_query($db, "select * from otp where email='$email'");
        if (mysqli_num_rows($check) > 0) {
            mysqli_query($db, "update otp set code='$OTP' where email='$email'");
        } else {
            mysqli_query($db, "insert into otp(email,code) values('$email','$OTP')");
        }
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
            $mail->Subject = 'Forget Password';
            $mail->Body    = "Your OTP is <b>$OTP</b>";
            $mail->AltBody = "Your OTP is $OTP";

            $mail->send();
            echo "<script>alert('OTP has been sent to your email.')
            location.assign('otp.php')</script>";
        } catch (Exception $e) {
            echo "<script>alert('OTP could not be sent. Mailer Error: {$mail->ErrorInfo}')
            location.assign('forgetPass.php')
            </script>";
        }
    } else {
        echo "<script>alert('Email Not Registered Yet!')
        location.assign('forgetPass.php')</script>";
    }
}

// otp 

if (isset($_POST['verify_otp'])) {
    $otp = $_POST['otp'];
    $email = $_SESSION['otp_email'];
    $fetch = mysqli_query($db, "SELECT * FROM otp WHERE email='$email' AND code='$otp' ");
    if (mysqli_num_rows($fetch) > 0) {
        echo "<script>alert('OTP Matched.')
            location.assign('resetPass.php')</script>";
    } else {
        echo "<script>alert('Wrong OTP.')
            location.assign('otp.php')</script>";
    }
}

if (isset($_POST['change_password'])) {
    $email = $_SESSION['otp_email'];
    $password = $_POST['new_password'];
    $retype_password = $_POST['retype_password'];
    if ($password == $retype_password) {
        $password = sha1($password);  // Hashing password using md5 algorithm for security.
        $update = mysqli_query($db, "UPDATE register SET password='$password' WHERE email='$email'");
        $delete = mysqli_query($db, "DELETE FROM otp WHERE email='$email'");
        unset($_SESSION['otp_email']);
        echo "<script>alert('Password Changed Successfully.')
            location.assign('index.php')</script>";
    } else {
        echo "<script>alert('Password And Retype Password Not Match')
            location.assign('resetPass.php')</script>";
    }
}

if (isset($_GET["tracking_id"])) {
    $tracking_id = $_GET["tracking_id"];
    $query =mysqli_query($db,"UPDATE tracking SET status = 'confirmed' WHERE tracking_no = '$tracking_id'");
    if ($query) {
       header("Location: order_confirmed.html");
    }
}