<?php 

include 'config.php';
$id = $_GET['id'];
$sql = "SELECT * FROM detail WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$title = $row['title'];
$description = $row['description'];



if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $sql = "UPDATE detail SET title='$title', description='$description' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: home.php");
    } else {
        echo "<script>alert('Failed to Update To Do')</script>";
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
<div class="page_loader"></div>
<div class="login-23">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-12 bg-color-23">
                <div class="form-section">
                    <div class="logo">
                         <h4>Update To Do</h4>
                    </div>
                    
                    <div class="login-inner-form">
                        <form action="#" method="POST">
                            <div class="form-group clearfix">

                                <label for="first_field" class="form-label">Title</label>
                                <div class="form-box">
                                    <input name="title" type="text" class="form-control" id="first_field" placeholder="Title" aria-label="title" value="<?php echo $title; ?>" required/>
                                    <i class="fa-solid fa-heading"></i>
                                </div>
                            </div>
                            
                             <div class="form-group clearfix">

                                <label for="first_field" class="form-label">Description</label>
                                <div class="form-box">
                                    <input name="description" type="text" class="form-control" id="first_field" placeholder="Description" aria-label="description" value="<?php echo $description; ?>" required />
                                   <i class="fa-solid fa-pen-nib"></i>
                                </div>
                            </div>

                            
                            <div class="form-group clearfix mb-0">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-theme">Update</button>
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



