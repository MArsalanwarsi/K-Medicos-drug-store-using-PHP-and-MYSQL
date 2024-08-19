<?php
include "config.php";
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];
    if ($password == $retype_password) {
        $Insert = mysqli_query($db, "INSERT INTO register (name,email,password,role)VALUES('$name','$email','$password','2')");
        echo "<script>
            alert('Account Created Successfully');
            location.assign('index.php');
        </script>";
    } else {
        echo "<script>
            alert('Password And Retype Password Not Match')
            location.assign('register.php');
        </script>";
    }
}
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $Fetch = mysqli_query($db, "SELECT * FROM register WHERE email ='$email' and password = '$password' ");
    if ($isDataExist = mysqli_num_rows($Fetch) > 0) {
        foreach ($Fetch as $data) {
            if ($data['role'] == 1) {
                session_start();
                $name = $data['name'];
                $_SESSION['name'] = $name;
                header('location:AdminPanel/index.php');
            } else {
                session_start();
                $name = $data['name'];
                $_SESSION['name'] = $name;
                $_SESSION['id'] = $data['id'];
                header('location:profile.php');
            }
        }
    } else {
        echo "<script>
        alert('Email Not Registered Yet!')
        location.assign('index.php');
    </script>";
    }
}
