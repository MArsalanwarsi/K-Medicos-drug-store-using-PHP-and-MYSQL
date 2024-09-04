<?php
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$mail = new PHPMailer(true);
$mail->SMTPDebug = 3;
$mail->Debugoutput = 'error_log';
if (isset($_POST['Forgot_password'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM `register` WHERE email = '$email'";
    $result = mysqli_query($db, $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $row = mysqli_fetch_assoc($result);
        // random 4 digit number
        $OTP = rand(1000, 9999);
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
            $mail->addAddress($email);     //Add a recipient
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Forget Password';
            $mail->Body    = "Your OTP is <b>$OTP</b>";
            $mail->AltBody = "Your OTP is $OTP";

            $mail->send();
            echo "<script>alert('OTP has been sent to your email.')</script>";
        } catch (Exception $e) {
            echo "<script>alert('OTP could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
            echo "<script>location.assign('forgetPass.php')</script>";
        }
?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Forget Password</title>
            <meta name="description" content="Form UI design - learningrobo">
            <meta name="author" content="learningrobo.com">
            <meta name="keywords" content="form,responsive,learningrobo.com,html & css projects">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type=image/x-icon href="#">
            <meta charset="UTF-8">
            <style>
                body {
                    font-family: 'Poppins', sans-serif;
                    background-color: #28a745;
                }

                .box {
                    background-color: white;
                    height: 400px;
                    width: 600px;
                    margin: 130px auto;
                    text-align: center;
                    border-radius: 5px;
                    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
                }

                .tit {
                    color: #28a745;
                    font-size: 40px;
                    padding-top: 50px;
                }

                .para {
                    font-size: 17px;
                    padding: 0px 8px;
                    color: black;
                }

                input {
                    padding: 10px;
                    width: 460px;
                    margin-top: 30px;
                    text-align: center;
                    font-size: 18px;
                    border: 2px solid #28a745;
                    border-radius: 10px;
                    background-color: rgb(18, 18, 18);
                    color: white;
                }

                button {
                    padding: 10px;
                    width: 250px;
                    margin-top: 25px;
                    background-color: #28a745;
                    border: none;
                    color: white;
                    font-size: 15px;
                    border-radius: 5px;
                }

                button:hover {
                    background-color: white;
                    color: #28a745;
                    border: 2px solid #28a745;
                    cursor: pointer;
                }

                @media screen and (max-width:630px) {
                    .box {
                        width: 98%;
                    }

                    input {
                        width: 70%;
                    }
                }
            </style>
        </head>

        <body>
            <div class="box">
                <h1 class="tit">OTP</h1>
                <p class="para">Please Check your Email!</p>
                <form action="resetPass.php" method="post">
                    <input type="hidden" name="send_otp" value="<?php echo $OTP; ?>">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <input type="number" name="otp" id="otp" required placeholder="Enter OTP" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4"><br>
                    <button name="verify_otp">Verify</button>
                </form>
            </div>
        </body>

        </html>
<?php
    } else {
        echo "<script>alert('Email does not exist.')</script>";
        echo "<script>location.assign('forgetPass.php')</script>";
    }
}
?>