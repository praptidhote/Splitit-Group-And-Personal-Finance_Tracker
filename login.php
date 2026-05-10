<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login']))
  {
    $email=$_POST['email'];
    $password=($_POST['password']);
    $query=mysqli_query($con,"select ID from tbluser where  Email='$email' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['detsuid']=$ret['ID'];
     header('location:dashboard.php');
    }
    else{
    $msg="Invalid Details.";
    }
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Split It</title>

	
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .hero-section {
              background: linear-gradient(90deg, rgb(255 255 255) 0%, rgba(160, 210, 218, 1) 35%, rgb(207 207 207) 100%);
            text-align: center;
            padding: 80px 20px;
        }
        .how-it-works {
            padding: 60px 20px;
        }
        .testimonials, .expense-slider {
            background: #e9ecef;
            padding: 60px 20px;
        }
        .carousel-item img {
            border-radius: 10px;
            max-width: 100%;
            height: auto;
        }  .login-form {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #fff;
        }
    </style>
</head>
<body>

    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">SplitIt: Group and Personal Finance Tracker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ms-auto">
                     <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

  


<!-- Login Form -->
    <div class="container">
        <div class="login-form">
            <h2 class="text-center">Login</h2>
           <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
					<form role="form" action="" method="post" id="" name="login">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                </div>
               <button type="submit" value="login" name="login" class="btn btn-primary">login</button><span style="padding-left:250px"><br><br>
				<a href="register.php" class="">Register Here</a></span>
            </form>
        </div>
    </div>


<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
