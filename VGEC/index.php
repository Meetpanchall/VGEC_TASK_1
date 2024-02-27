<?php

include 'config.php';

session_start();

error_reporting(0);

//if (isset($_SESSION['username'])) {
//    header("Location: home.php");


if(isset($_COOKIE["reg_state"])){
	echo"<script>alert('Student Registration Successful')</script>";
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$sql = "SELECT * FROM reg WHERE email=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['user_id'] = $row['id'];
		header("Location: home.php");
	} else {
		echo "<script>alert('Email Or Password is invalid')</script>";
	}
}

?>




	<!--final-->

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
                         <h4>Login</h4>
                    </div>
                    <h3>Sign Into Your Account</h3>
                    <div class="login-inner-form">
                        <form action="#" method="POST">
                            <div class="form-group clearfix">
                                <label for="first_field" class="form-label">Email address</label>
                                <div class="form-box">
                                    <input name="email" type="email" class="form-control" id="first_field" placeholder="Email Address" aria-label="Email Address" value="<?php echo $email; ?>" required>
                                    <i class="fa-sharp fa-solid fa-envelope"></i>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label for="second_field" class="form-label">Password</label>
                                <div class="form-box">
                                    <input name="password" type="password" class="form-control" autocomplete="off" id="second_field" placeholder="Password" aria-label="Password" value="<?php echo $_POST['password']; ?>" required>
                                    <i class="fa-solid fa-lock"></i>
                                </div>
                            </div>
                            

                            <div class="checkbox form-group clearfix">
                                <div class="form-check float-start">
                                    <input class="form-check-input" type="checkbox" id="rememberme">
                                    <label class="form-check-label" for="rememberme">
                                        Remember me
                                    </label>
                                </div>
                                <a href="forgotpass.php" class="link-light float-end forgot-password">Forgot your password?</a>
                            </div>
                            <div class="form-group clearfix mb-0">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-theme">Login</button>
                            </div>
                             </form>
                        
                        
                    </div>
                    <p class="text-center">Don't have an account? <a href="registration.php"> Register here</a></p>
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



	<!----------Anti select query start---------->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script>$('body').disableSelection();</script>
<!----------Anti select query end---------->
   







</body>
</html>