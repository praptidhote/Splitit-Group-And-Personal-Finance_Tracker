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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Split Expenses with Friends Easily</h1>
            <p>Manage group expenses and settle up effortlessly.</p>
            <a href="#" class="btn btn-primary">Get Started</a>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="container text-center">
            <h2>How It Works</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <h4>1. Create a Group</h4>
                    <p>Invite your friends and add shared expenses.</p>
                </div>
                <div class="col-md-4">
                    <h4>2. Add Expenses</h4>
                    <p>Log expenses, track who owes whom.</p>
                </div>
                <div class="col-md-4">
                    <h4>3. Settle Up</h4>
                    <p>Pay friends and keep balances clear.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Friends Expense Slider -->
    <section class="expense-slider">
        <div class="container text-center">
            <h2>Friends Sharing Expenses</h2>
            <div id="expenseCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                      <br><br>  <img src="images/11.png" class="d-block w-100" alt="Friends on a trip">
                       <br><br> <p>"John, Sarah, and Mike are splitting expenses for a weekend trip!"</p>
                    </div>
                   
                </div>
                
            </div>
        </div>
    </section>

    <!-- Testimonials Slider -->
    <section class="testimonials">
        <div class="container text-center">
            <h2>What Our Users Say</h2>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <p>"This app makes splitting expenses so easy!" - John Doe</p>
                    </div>
                    <div class="carousel-item">
                        <p>"No more awkward money talks with friends!" - Sarah Lee</p>
                    </div>
                    <div class="carousel-item">
                        <p>"I love the simplicity and efficiency of this app!" - Mike Ross</p>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>
  <!-- Footer -->
    <footer class="footer">
        <div class="container"><br>
          <center>  <p>&copy; 2025 Expense Split It. All rights reserved.</p>
            <p>
                <a href="#">About Us</a> | 
                <a href="#">Contact</a> | 
                <a href="#">Privacy Policy</a>
            </p></center>
        </div>
    </footer>
</body>
</html>
