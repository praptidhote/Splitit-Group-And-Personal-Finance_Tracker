<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['name'])) {
    $fname = $_POST['name'];
    $mobno = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $password = ($_POST['password']);
    $address = $_POST['address'];
    $profession = $_POST['profession'];
    $age = $_POST['age'];

    // File upload handling
    $qr_target_dir = "images/qr/";
    $profile_target_dir = "images/profile/";

    if(!is_dir($qr_target_dir)) { mkdir($qr_target_dir, 0777, true); }
    if(!is_dir($profile_target_dir)) { mkdir($profile_target_dir, 0777, true); }

    $qr_file = time() . "_" . basename($_FILES["qr"]["name"]);
    $qr_temp = $_FILES["qr"]["tmp_name"];
    $qr_path = $qr_target_dir . $qr_file;

    $profile_file = time() . "_" . basename($_FILES["profile_photo"]["name"]);
    $profile_temp = $_FILES["profile_photo"]["tmp_name"];
    $profile_path = $profile_target_dir . $profile_file;

    // Check if email already exists
    $ret = mysqli_query($con, "SELECT Email FROM tbluser WHERE Email='$email'");
    $result = mysqli_fetch_array($ret);
    
    if($result > 0) {
        $msg = "This email is already associated with another account.";
        $isError = true;
    } else {
        if(move_uploaded_file($qr_temp, $qr_path) && move_uploaded_file($profile_temp, $profile_path)) {
            $query = mysqli_query($con, "INSERT INTO tbluser (FullName, MobileNumber, Email, Password, Address, Profession, qr_code, profile_photo, age) 
                                         VALUES ('$fname', '$mobno', '$email', '$password', '$address', '$profession', '$qr_path', '$profile_path', '$age')");
            if ($query) {
                $msg = "You have successfully registered! You can now log in.";
                $isError = false;
            } else {
                $msg = "Database error. Please try again.";
                $isError = true;
            }
        } else {
            $msg = "Failed to upload files. Please make sure valid image files are selected.";
            $isError = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - SplitIt</title>

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

        .reg-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 15px;
            position: relative;
        }

        .ambient-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.35;
            z-index: 0;
            animation: pulseShape 10s ease-in-out infinite alternate;
        }
        .shape-1 {
            width: 380px;
            height: 380px;
            background: #4cc9f0;
            top: 5%;
            left: 10%;
        }
        .shape-2 {
            width: 400px;
            height: 400px;
            background: #f72585;
            bottom: 5%;
            right: 10%;
        }

        @keyframes pulseShape {
            0% { transform: scale(1) translateY(0); }
            100% { transform: scale(1.15) translateY(-30px); }
        }

        .reg-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 24px;
            padding: 40px 35px;
            width: 100%;
            max-width: 680px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 10;
        }

        .form-control {
            border-radius: 12px;
            padding: 11px 15px;
            border: 1.5px solid #e2e8f0;
            transition: all 0.25s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.15);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            padding: 14px;
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
                    <li class="nav-item"><a class="nav-link text-white" href="login.php"><i class="fa-solid fa-right-to-bracket me-1"></i> Login</a></li>
                    <li class="nav-item"><a class="nav-link text-white active" href="register.php"><i class="fa-solid fa-user-plus me-1"></i> Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Registration Area -->
    <div class="reg-wrapper">
        <div class="ambient-shape shape-1"></div>
        <div class="ambient-shape shape-2"></div>

        <div class="reg-card" data-aos="zoom-in" data-aos-duration="800">
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle mb-3" style="width: 65px; height: 65px; font-size: 1.8rem;">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <h3 class="fw-bold mb-1">Create Your Account</h3>
                <p class="text-muted small">Join friends and start tracking split expenses seamlessly</p>
            </div>

            <?php if(isset($msg)){ ?>
                <div class="alert <?php echo $isError ? 'alert-danger' : 'alert-success'; ?> d-flex align-items-center py-2 px-3 small rounded-3 mb-4" role="alert">
                    <i class="fa-solid <?php echo $isError ? 'fa-circle-exclamation' : 'fa-circle-check'; ?> me-2"></i>
                    <div>
                        <?php echo htmlspecialchars($msg); ?>
                        <?php if(!$isError){ ?>
                            <a href="login.php" class="fw-bold text-success ms-2">Click to Login</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <form role="form" action="" method="post" name="signup" onsubmit="return checkpass();" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Full Name</label>
                        <input class="form-control" placeholder="e.g. Rahul Sharma" name="name" type="text" pattern="^[A-Za-z\s]{3,50}$" title="Only letters and spaces are allowed, 3-50 characters" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Email Address</label>
                        <input class="form-control" placeholder="e.g. rahul@example.com" name="email" type="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Mobile Number (10 digits)</label>
                        <input type="text" class="form-control" name="mobilenumber" placeholder="e.g. 9876543210" maxlength="10" pattern="[0-9]{10}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Age</label>
                        <input type="number" class="form-control" name="age" max="100" min="10" placeholder="e.g. 21" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Password (Min 8 characters)</label>
                        <input class="form-control" placeholder="••••••••" name="password" type="password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Must contain at least 1 letter, 1 number, and 1 special char" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Confirm Password</label>
                        <input type="password" class="form-control" name="repeatpassword" placeholder="••••••••" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Address / City</label>
                        <input type="text" class="form-control" name="address" placeholder="e.g. Pune, Maharashtra" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Profession</label>
                        <input type="text" class="form-control" name="profession" placeholder="e.g. Software Engineer / Student" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Upload QR Code (Payment QR)</label>
                        <input type="file" class="form-control" name="qr" accept=".png,.jpg,.jpeg" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary">Upload Profile Photo</label>
                        <input type="file" class="form-control" name="profile_photo" accept=".png,.jpg,.jpeg" required>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" value="submit" class="btn-submit">
                        <i class="fa-solid fa-user-check me-2"></i> Register Account
                    </button>
                </div>

                <div class="text-center mt-3">
                    <span class="text-muted small">Already have an account? </span>
                    <a href="login.php" class="fw-semibold text-primary text-decoration-none small">Login Here</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS & AOS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true });

        function checkpass() {
            if (document.signup.password.value != document.signup.repeatpassword.value) {
                alert('Password and Confirm Password do not match');
                document.signup.repeatpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
