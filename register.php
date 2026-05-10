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
    $qr_target_dir = "images/qr/"; // Folder to store QR codes
    $profile_target_dir = "images/profile/"; // Folder to store profile photos

    $qr_file = $_FILES["qr"]["name"];
    $qr_temp = $_FILES["qr"]["tmp_name"];
    $qr_path = $qr_target_dir . basename($qr_file);

    $profile_file = $_FILES["profile_photo"]["name"];
    $profile_temp = $_FILES["profile_photo"]["tmp_name"];
    $profile_path = $profile_target_dir . basename($profile_file);

    // Check if email already exists
    $ret = mysqli_query($con, "SELECT Email FROM tbluser WHERE Email='$email'");
    $result = mysqli_fetch_array($ret);
    
    if($result > 0) {
        $msg = "This email is already associated with another account";
    } else {
        // Move uploaded files to respective folders
        if(move_uploaded_file($qr_temp, $qr_path) && move_uploaded_file($profile_temp, $profile_path)) {
            // Insert into database
            $query = mysqli_query($con, "INSERT INTO tbluser (FullName, MobileNumber, Email, Password, Address, Profession, qr_code, profile_photo, age) 
                                         VALUES ('$fname', '$mobno', '$email', '$password', '$address', '$profession', '$qr_path', '$profile_path', '$age')");
            if ($query) {
                $msg = "You have successfully registered";
            } else {
                $msg = "Something went wrong. Please try again";
            }
        } else {
            $msg = "Failed to upload files. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
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

    <script type="text/javascript">
        function checkpass() {
            if (document.signup.password.value != document.signup.repeatpassword.value) {
                alert('Password and Repeat Password field do not match');
                document.signup.repeatpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Split It</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .form-container {
            padding: 40px;
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>

    <section class="form-container">
        <h2 class="text-center">Register</h2>
        <form role="form" action="" method="post" name="signup" onsubmit="return checkpass();" enctype="multipart/form-data">
            <p style="font-size:16px; color:green" align="center">
                <?php if(isset($msg)){ echo htmlspecialchars($msg); } ?>
            </p>
            <fieldset>
                <div class="form-group mb-3">
                    <input class="form-control" placeholder="Full Name" name="name" type="text" 
                        pattern="^[A-Za-z\s]{3,50}$" 
                        title="Only letters and spaces are allowed, 3-50 characters" required>
                </div>

                <div class="form-group mb-3">
                    <input class="form-control" placeholder="E-mail" name="email" type="email" 
                        pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" 
                        title="Enter a valid email address (e.g., example@mail.com)" required>
                </div>

                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="mobilenumber" placeholder="Mobile Number" 
                        maxlength="10" pattern="[0-9]{10}" 
                        title="Enter a valid 10-digit mobile number" required>
                </div>

                <div class="form-group mb-3">
                    <input class="form-control" placeholder="Password" name="password" type="password" 
                        pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" 
                        title="Password must be at least 8 characters, contain one uppercase, one lowercase, one number, and one special character" required>
                </div>

                <div class="form-group mb-3">
                    <input type="password" class="form-control" name="repeatpassword" placeholder="Repeat Password" required>
                </div>

                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                </div>

                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="profession" placeholder="Profession" required>
                </div>
                 <div class="form-group mb-3">
                    <input type="number" class="form-control" name="age" max="100" min="10" placeholder="Age" required>
                </div>

                <div class="form-group mb-3">
                    <label>Upload QR Code</label>
                    <input type="file" class="form-control" name="qr" accept=".png,.jpg,.jpeg" 
                        title="Upload only PNG, JPG, or JPEG files" required>
                </div>

                <div class="form-group mb-3">
                    <label>Upload Profile Photo</label>
                    <input type="file" class="form-control" name="profile_photo" accept=".png,.jpg,.jpeg" 
                        title="Upload only PNG, JPG, or JPEG files" required>
                </div>

                <button type="submit" value="submit" class="btn btn-primary w-100">Register</button>
            </fieldset>
        </form>
    </section>

</body>
</html>
