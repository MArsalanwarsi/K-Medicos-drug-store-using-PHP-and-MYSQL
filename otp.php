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
        <form action="code.php" method="post">
            <input type="number" name="otp" id="otp" required placeholder="Enter OTP" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4"><br>
            <button type="submit" name="verify_otp">Verify</button>
        </form>
    </div>
</body>

</html>