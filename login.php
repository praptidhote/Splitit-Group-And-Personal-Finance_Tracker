<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=($_POST['password']);
    $query=mysqli_query($con,"select ID from tbluser where Email='$email' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
        $_SESSION['detsuid']=$ret['ID'];
        header('location:dashboard.php');
        exit;
    }
    else{
        $msg="Invalid Email or Password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SplitIt</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary: #4cc9f0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at 10% 20%, rgba(67, 97, 238, 0.12) 0%, rgba(247, 37, 133, 0.08) 50%, rgba(76, 201, 240, 0.12) 90%), #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .custom-navbar {
            background: rgba(15, 23, 42, 0.9) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            background: linear-gradient(135deg, #4cc9f0, #4361ee, #f72585);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
            position: relative;
        }

        /* Ambient glowing circles */
        .ambient-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(50px);
            opacity: 0.4;
            z-index: 0;
            animation: pulseShape 8s ease-in-out infinite alternate;
        }
        .shape-1 {
            width: 300px;
            height: 300px;
            background: #4cc9f0;
            top: 10%;
            left: 15%;
        }
        .shape-2 {
            width: 320px;
            height: 320px;
            background: #f72585;
            bottom: 10%;
            right: 15%;
        }

        @keyframes pulseShape {
            0% { transform: scale(1) translateY(0); }
            100% { transform: scale(1.15) translateY(-30px); }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 24px;
            padding: 40px 35px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 10;
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-4px);
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            transition: all 0.25s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.15);
        }

        .input-group-text {
            border-radius: 12px 0 0 12px;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            background: #f8fafc;
            color: #64748b;
        }

        .input-group .form-control {
            border-radius: 0 12px 12px 0;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            padding: 13px;
            font-weight: 600;
            border-radius: 12px;
            border: none;
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.35);
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-submit:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(67, 97, 238, 0.45);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-receipt me-1"></i> SplitIt
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fa-solid fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white active" href="login.php"><i class="fa-solid fa-right-to-bracket me-1"></i> Login</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="register.php"><i class="fa-solid fa-user-plus me-1"></i> Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Area -->
    <div class="login-wrapper">
        <div class="ambient-shape shape-1"></div>
        <div class="ambient-shape shape-2"></div>

        <div class="login-card" data-aos="zoom-in" data-aos-duration="800">
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle mb-3" style="width: 65px; height: 65px; font-size: 1.8rem;">
                    <i class="fa-solid fa-user-lock"></i>
                </div>
                <h3 class="fw-bold mb-1">Welcome Back!</h3>
                <p class="text-muted small">Sign in to manage and split your group expenses</p>
            </div>

            <?php if($msg){ ?>
                <div class="alert alert-danger d-flex align-items-center py-2 px-3 small rounded-3 mb-3" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    <div><?php echo $msg; ?></div>
                </div>
            <?php } ?>

            <form role="form" action="" method="post" name="login">
                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold text-secondary">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label small fw-semibold text-secondary mb-0">Password</label>
                        <a href="forgot-password.php" class="text-decoration-none small text-primary">Forgot?</a>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" value="login" name="login" class="btn-submit">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Sign In
                </button>

                <div class="text-center mt-4">
                    <span class="text-muted small">Don't have an account? </span>
                    <a href="register.php" class="fw-semibold text-primary text-decoration-none small">Create Account</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS & AOS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true });
    </script>
</body>
</html>
