
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
.box{
    background-color: white;
    height: 400px;
    width: 600px;
    margin: 130px auto;
    text-align: center;
    border-radius:5px;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}
.tit{
    color: #28a745;
    font-size: 40px;
    padding-top: 50px;
}
.para{
    font-size: 17px;
    padding: 0px 8px;
    color: black;
}
input{
    padding: 10px;
    width: 460px;
    margin-top: 30px;
    text-align: center;
    font-size: 18px;
    border:2px solid #28a745;
    border-radius:10px;
    background-color:rgb(18, 18, 18);
    color: white;
}
button{
    padding: 10px;
    width: 250px;
    margin-top: 25px;
    background-color: #28a745;
    border: none;
    color: white;
    font-size: 15px;
    border-radius: 5px;
}
button:hover{
    background-color: white;
    color: #28a745;
    border: 2px solid #28a745;
    cursor: pointer;
}
@media screen and (max-width:630px) {
    .box{
        width:98%;
    }  
    input{
        width:70%;
    }    
}


    </style>
</head>
<body>
    <div class="box">
    <h1 class="tit">Forgot Password</h1>
    <p class="para">Forgot your password ? Don't worry we are just here to solve your problem ! Just enter your e-mail address to proceed.</p>
    <form action="otp.php" method="post">
        <input type="email" name="email" id="email" placeholder="Your e-mail address" required><br>
        <button name="Forgot_password">Reset my Password</button>
    </form>
</div>
</body>
</html>