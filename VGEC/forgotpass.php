<?php
include "config.php";
require 'vendor/autoload.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function generateToken($length = 20) {
    return bin2hex(random_bytes($length));
}


function sendPasswordResetEmail($email, $token) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                           
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                 
        $mail->Username   = 'tsupperb@gmail.com';                   
        $mail->Password   = 'umcyfonirkspdbjg';                         
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 587;                                    

        
        $mail->setFrom('tsupperb@gmail.com', 'VGEC');
        $mail->addAddress($email);                                  

        $mail->isHTML(true);                                        
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = '<h1>Click the following link to reset your password: <a href="http://localhost:8012/vgec/resetpassword.php?token=' . $token . '">Reset Password</a></h1>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}




if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $user = "SELECT * FROM reg WHERE email = '$email'";
    $result = $conn->query($user);

    if ($result->num_rows <= 0) {
        echo "<script>alert('User not found');window.location.href = 'forgotpass.php';</script>";
        
              
    }

    else {
    
    $token = generateToken();

    
    $expiry_time = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $sql = "INSERT INTO reset (email, token, expiry_time) VALUES ('$email', '$token', '$expiry_time')";
    $conn->query($sql);

   


    if (sendPasswordResetEmail($email, $token)) {
        echo "<script>alert('password reset link has been sent')</script>";
    } else {
        echo "Failed to send password reset email.";
        
    }}
}
?>




<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="Login/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="Login/css/login.css">
</head>
<body id="top">
<div class="page_loader"></div>
<div class="login-23">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-12 bg-color-23">
                <div class="form-section">
                    <div class="logo">
                         <h4>Forgot Password</h4>
                    </div>
                    <h3>Sign Into Your Account</h3>
                    <div class="login-inner-form">
                        <form action="#" method="POST">
                            <div class="form-group clearfix">

                                <label for="first_field" class="form-label">Email address</label>
                                <div class="form-box">
                                    <input name="email" type="email" class="form-control" id="first_field" placeholder="Email Address" aria-label="Email Address">
                                    <i class="fa-sharp fa-solid fa-envelope"></i>
                                </div>
                            </div>
                            

                            
                            <div class="form-group clearfix mb-0">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-theme">Submit</button>
                            </div>
                             </form>
                        
                        
                    </div>
                    
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 col-md-12 bg-img">
                <div class="info">
                    <div class="waviy">
                        <span style="--i:1">W</span>
                        <span style="--i:2">e</span>
                        <span style="--i:3">l</span>
                        <span style="--i:4">c</span>
                        <span style="--i:5">o</span>
                        <span style="--i:6">m</span>
                        <span style="--i:7">e</span>
                        <span class="color-yellow" style="--i:8">t</span>
                        <span class="color-yellow" style="--i:9">o</span>
                        <span style="--i:10">V</span>
                         <span style="--i:11">G</span>
                        <span style="--i:12">E</span>
                        <span style="--i:13">C</span>
                       
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>



