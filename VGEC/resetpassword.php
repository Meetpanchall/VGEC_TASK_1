<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["token"])) {
        $token = $_POST["token"];
        
        $sql = "SELECT email, expiry_time FROM reset WHERE token = '$token'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row["email"];
            $expiry_time = strtotime($row["expiry_time"]);

            if (time() < $expiry_time) {
                $password = $_POST["password"];
                $confirm_password = $_POST["confirm_password"];

                if ($password !== $confirm_password) {
                    echo "Passwords do not match.";
                    exit;
                }

                // Hash the new password
                $hashed_password = md5($password);

                $update_sql = "UPDATE reg SET password = '$hashed_password' WHERE email = '$email'";
                $delete_token = "DELETE FROM reset WHERE token = '$token'";
                if ($conn->query($update_sql) === TRUE && $conn->query($delete_token) === TRUE){
                    echo "Password updated successfully.";
                } else {
                    echo "Error updating password: " . $conn->error;
                }
            } else {
               // echo "Token has expired.";
            }
        } else {
            echo "Invalid token.";
        }
    } else {
        echo "Token not provided.";
    }
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
    <?php if (!isset($_POST["token"])): ?>
<div class="page_loader"></div>
<div class="login-23">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-12 bg-color-23">
                <div class="form-section">
                    <div class="logo">
                         <h4>Reset Password</h4>
                    </div>
                    
                    <div class="login-inner-form">
                        <form action="#" method="POST">
                             
                                
                                <div class="form-box">
                                    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                                </div>
                     

                            
                            <div class="form-group clearfix">
                                <label for="first_field" class="form-label">New Password</label>
                                <div class="form-box">
                                    <input name="password" type="password" class="form-control" id="first_field" placeholder="New Password" aria-label="password" required>
                                     <i class="fa-solid fa-lock"></i>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label for="first_field" class="form-label">Confirm Password</label>
                                <div class="form-box">
                                    <input name="confirm_password" type="password" class="form-control" id="first_field" placeholder="Confirm Password" aria-label="confirm_password" required>
                                   <i class="fa-solid fa-key"></i>
                                </div>
                            </div>
                            

                            
                            <div class="form-group clearfix mb-0">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-theme">Reset Password</button>
                            </div>
                             </form>
                        
                        
                    </div>
                    
                </div>
            </div><?php endif; ?>
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




