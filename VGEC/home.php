<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['submit'])) {
    if (isset($_POST['title']) && isset($_POST['description'])){
        $title = $_POST['title'];
        $description = $_POST['description'];

        $stmt = $conn->prepare("INSERT INTO detail (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $description);

        if ($stmt->execute()) {
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                echo json_encode(['status' => 'success', 'message' => 'To Do Added Successfully']);
                exit;
            } else {
                echo "<script>alert('To Do Added Successfully')</script>";
            }
        } else {
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                echo json_encode(['status' => 'error', 'message' => 'Failed to Add To Do']);
                exit;
            } else {
                echo "<script>alert('Failed to Add To Do')</script>";
            }
        }
        $stmt->close();
    }
}
?>


    
        


        <!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ADD TO DO | VGEC</title>
    <link rel="stylesheet" href="./Styles/Style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $(".form").on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url: '', // current page
                type: 'POST',
                data: $(this).serialize(),
                success: function(response){
                var data = JSON.parse(response);
                alert(data.message);
                if(data.status === 'success') {
                    location.reload(); // reload the page to get the updated list
                }
}
                }
            });
        });
    
    </script>

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="Login/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="Login/css/login.css">
</head>
<body id="top">
    <div class="main-container">
<div class="page_loader"></div>
<div class="login-23">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-12 bg-color-23">
                <div class="form-section">
                    <div class="logo">
                         
                    </div>
                    
                    <div class="login-inner-form">
                        <form action="#" method="POST">
                            <h5 style="font-size: 2rem; font-weight: 400">Hello <?php echo $_SESSION["username"]?> Add A To Do</h5>
                            <div class="form-group clearfix">

                                <label for="first_field" class="form-label">Title</label>
                                <div class="form-box">
                                    <input name="title" type="text" class="form-control" id="first_field" placeholder="Title" aria-label="title"  required/>
                                    <i class="fa-solid fa-heading"></i>
                                </div>
                            </div>
                            
                             <div class="form-group clearfix">

                                <label for="first_field" class="form-label">Description</label>
                                <div class="form-box">
                                    <input name="description" type="text" class="form-control" id="first_field" placeholder="Description" aria-label="description"  required />
                                   <i class="fa-solid fa-pen-nib"></i>
                                </div>
                            </div>

                            
                            <div class="form-group clearfix mb-0">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-theme">Add</button>
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






      <div class="display-todo">
        <table>
         
          <?php
            $sql = "SELECT * FROM detail";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<tr><th>ID</th><th>Title</th><th>Description</th><th>Time Added</th><th>Action</th></tr>";
                
                while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['title'] ?></td>
            <td><?php echo $row['description'] ?></td>
            <td><?php echo $row['time'] ?></td>
            <td><a class="edit" href="edit.php?id=<?php echo $row['id'] ?>">Edit</a><a class="delete" style="background: red;" href="delete.php?id=<?php echo $row['id'] ?>">Delete</a></td>

          </tr>
          <?php ; } }else{ echo"<span>No todo for now</span>";}?>
        </table>
      </div>
    </div>
  </body>
</html>