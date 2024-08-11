<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 
include "../config.php";

if(isset($_POST['add_company'])){
    $company_name = $_POST['company_name'];
    $insert = mysqli_query($db,"INSERT INTO company(company_name)VALUES('$company_name')");

    if($insert){
        echo "<script>
            alert('Company Added Successfully');
            location.assign('company.php');
        </script>";
        $_SESSION['status'] = "Company Added Successfully";
        $_SESSION['status_code'] = "success";
    }else{
        echo "<script>
            alert('Company Not Added');
            location.assign('company.php');
        </script>";
        $_SESSION['status'] = "Company Not Added";
        $_SESSION['status_code'] = "error";
    }
}

if(isset($_POST['add_category'])){
    $category_name = $_POST['category_name'];
    $img = $_FILES['img']['name'];
    $tmp_name = $_FILES['img']['tmp_name'];
    $destination = "Category/".$img;
    $extension = pathinfo($img,PATHINFO_EXTENSION);

    if($extension == "png" OR $extension == "jpg" OR $extension == "jpeg" OR $extension == "jfif" OR $extension == "webp"){
        if(move_uploaded_file($tmp_name,$destination)){
            $insert = mysqli_query($db,"INSERT INTO category(category_name,category_image)VALUES('$category_name','$destination')");
            ?>
            <script>
                alert('Category Added Successfully');
                location.assign('category.php');
            </script>
            <?php
        }else{
            ?>
            <script>
                alert('Fail to upload File');
                location.assign('medicine.php');
            </script>
            <?php
        }
    }else{
        ?>
        <script>
            alert('Please Upload valid image');
            location.assign('medicine.php');
        </script>
        <?php
    }
    
}


if(isset($_POST['add_medicine'])){
    include "../config.php";
    $img = $_FILES['img']['name'];
    $tmp_name = $_FILES['img']['tmp_name'];
    $destination = "images/".$img;
    $extension = pathinfo($img,PATHINFO_EXTENSION);

    if($extension == "png" OR $extension == "jpg" OR $extension == "jpeg" OR $extension == "jfif" OR $extension == "webp"){
        if(move_uploaded_file($tmp_name,$destination)){
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
            
            $insert = mysqli_query($db,"INSERT INTO medicine (dosage,brand_name,generic_name,strength,indication,adverce_drug_reaction,side_effect,category,company,counseling,pack_size,quatity,price,prescription,img)VALUES('$dosage','$brand_name','$generic_name','$strength','$indication','$adverce_drug_reaction','$side_effect','$category_name','$company_name','$counceling','$pack_size','$quantity','$price','$prescription','$destination')");

            echo "<script>
            alert('Medicine Uploaded Successfully');
            location.assign('medicine.php');
        </script>";  


        }else{
            echo "<script>
            alert('File Not Uploaded');
            location.assign('medicine.php');
        </script>";    
        }
    }else{
        echo "<script>
            alert('Please Upload Only Image File');
            location.assign('medicine.php');
        </script>";
    }
}

// if(isset($_GET['mail'])){
//     include "../config.php";
//     $u_id = $_GET['mail'];

//     $fetchEmail = mysqli_query($db,"SELECT * FROM register WHERE id = '$u_id'");
//     $data = mysqli_fetch_assoc($fetchEmail);
//     $name = $data['name'];
//     $to = $data['email'];
//     $subject = "Order Is Going To Shipment";
//     $from = "talibmari123@gmail.com";
//     $msg = "Dear".$name."Your Order Is In Process Stay Connected With Us";
//     mail($to,$subject,$msg);

//     // echo "<script>
//     //         alert('Mail Sent Successfully');
//     //         location.assign('index.php');
//     //     </script>";
// }

?>
