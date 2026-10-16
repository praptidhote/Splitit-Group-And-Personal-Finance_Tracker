<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SplitIt - Group and Personal Finance Tracker</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS (Animate on Scroll) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary: #4cc9f0;
            --accent: #f72585;
            --success: #10b981;
            --bg-light: #f8fafc;
            --text-main: #1e293b;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-main);
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Glassmorphism Navbar */
        .custom-navbar {
            background: rgba(15, 23, 42, 0.88) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            background: linear-gradient(135deg, #4cc9f0, #4361ee, #f72585);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link {
            font-weight: 500;
            padding: 8px 16px !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 4px;
            left: 50%;
            background: var(--secondary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 70%;
        }

        /* Hero Section with Animated Mesh & Floating Badges */
        .hero-section {
            position: relative;
            background: radial-gradient(circle at 10% 20%, rgba(67, 97, 238, 0.15) 0%, rgba(247, 37, 133, 0.08) 45%, rgba(76, 201, 240, 0.12) 90%), #ffffff;
            padding: 110px 20px 90px;
            overflow: hidden;
        }

        /* Ambient floating animated spheres */
        .ambient-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.45;
            z-index: 0;
            animation: pulseShape 10s ease-in-out infinite alternate;
        }
        .shape-1 {
            width: 380px;
            height: 380px;
            background: #4cc9f0;
            top: -100px;
            left: -100px;
        }
        .shape-2 {
            width: 420px;
            height: 420px;
            background: #f72585;
            bottom: -150px;
            right: -100px;
            animation-duration: 14s;
        }

        @keyframes pulseShape {
            0% { transform: scale(1) translate(0, 0); }
            50% { transform: scale(1.15) translate(40px, -20px); }
            100% { transform: scale(0.95) translate(-30px, 30px); }
        }

        /* Floating badges in Hero */
        .floating-badge {
            position: absolute;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 10px 18px;
            border-radius: 50px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            animation: floatUpDown 4s ease-in-out infinite;
            z-index: 2;
        }
        .badge-1 {
            top: 15%;
            left: 8%;
            animation-delay: 0s;
        }
        .badge-2 {
            bottom: 22%;
            right: 8%;
            animation-delay: 2s;
        }

        @keyframes floatUpDown {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-16px) rotate(2deg); }
        }

        .hero-title {
            font-size: 3.2rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.5px;
            margin-bottom: 20px;
        }

        .gradient-text {
            background: linear-gradient(135deg, #4361ee 0%, #7209b7 50%, #f72585 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: #64748b;
            max-width: 650px;
            margin: 0 auto 35px;
        }

        /* Buttons with ripple and glow */
        .btn-glow-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            padding: 14px 34px;
            font-weight: 600;
            font-size: 1.05rem;
            border-radius: 50px;
            border: none;
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-glow-primary:hover {
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 14px 30px rgba(67, 97, 238, 0.55);
        }

        .btn-outline-custom {
            padding: 14px 32px;
            font-weight: 600;
            font-size: 1.05rem;
            border-radius: 50px;
            border: 2px solid #cbd5e1;
            color: #334155;
            background: #fff;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-outline-custom:hover {
            color: var(--primary);
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        /* Interactive Simulator Card */
        .interactive-simulator {
            background: #ffffff;
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(226, 232, 240, 0.8);
            position: relative;
            z-index: 10;
            max-width: 700px;
            margin: 40px auto 0;
            transition: transform 0.3s ease;
        }

        .interactive-simulator:hover {
            transform: translateY(-4px);
        }

        .calc-display {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border-radius: 18px;
            padding: 24px;
            color: #fff;
            text-align: center;
            margin-top: 20px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.25);
        }

        .calc-amount {
            font-size: 2.4rem;
            font-weight: 800;
            color: #4cc9f0;
            transition: all 0.2s ease;
        }

        /* Feature Cards */
        .feature-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 36px 28px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            border: 1px solid #f1f5f9;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(67, 97, 238, 0.12);
            border-color: rgba(67, 97, 238, 0.3);
        }

        .feature-icon-wrapper {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 24px;
            transition: transform 0.4s ease;
        }

        .feature-card:hover .feature-icon-wrapper {
            transform: scale(1.15) rotate(6deg);
        }

        .icon-blue { background: #e0e7ff; color: #4361ee; }
        .icon-pink { background: #ffe4e6; color: #f43f5e; }
        .icon-cyan { background: #cffafe; color: #06b6d4; }
        .icon-green { background: #dcfce7; color: #10b981; }

        /* Stats Counter Strip */
        .stats-section {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #fff;
            padding: 60px 20px;
            position: relative;
        }

        .stat-item h3 {
            font-size: 2.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #4cc9f0, #a5b4fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 5px;
        }

        .stat-item p {
            color: #94a3b8;
            font-weight: 500;
            margin-bottom: 0;
        }

        /* Testimonials Section */
        .testimonials-section {
            background: #f1f5f9;
            padding: 90px 20px;
        }

        .testimonial-card {
            background: #fff;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin: 15px auto;
            max-width: 750px;
            text-align: left;
            border-left: 5px solid var(--primary);
        }

        .quote-icon {
            font-size: 2.2rem;
            color: #cbd5e1;
            margin-bottom: 15px;
        }

        .star-rating {
            color: #f59e0b;
            font-size: 1.1rem;
            margin-bottom: 12px;
        }

        /* Slider Image Rounding */
        .slider-image-card {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12);
            transition: transform 0.3s ease;
        }

        .slider-image-card:hover {
            transform: scale(1.02);
        }

        /* Footer */
        .footer-custom {
            background: #0f172a;
            color: #94a3b8;
            padding: 50px 20px 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-custom a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-custom a:hover {
            color: #4cc9f0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-receipt"></i> SplitIt
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fa-solid fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link text-white active" href="index.php"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#how-it-works"><i class="fa-solid fa-circle-question me-1"></i> How It Works</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#calculator"><i class="fa-solid fa-calculator me-1"></i> Calculator</a></li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="nav-link text-white btn btn-sm btn-outline-light px-3 py-1 rounded-pill" href="login.php">
                            <i class="fa-solid fa-right-to-bracket me-1"></i> Login
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="btn btn-sm btn-primary px-3 py-1 rounded-pill fw-semibold shadow-sm" href="register.php">
                            <i class="fa-solid fa-user-plus me-1"></i> Register Free
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <!-- Ambient shapes for depth -->
        <div class="ambient-shape shape-1"></div>
        <div class="ambient-shape shape-2"></div>

        <!-- Floating decorative badges -->
        <div class="floating-badge badge-1 d-none d-md-flex">
            <span class="fs-4">🍕</span>
            <div>
                <span class="d-block text-muted" style="font-size: 0.75rem;">Dinner Split</span>
                <span class="text-success fw-bold">Settled: ₹350</span>
            </div>
        </div>
        <div class="floating-badge badge-2 d-none d-md-flex">
            <span class="fs-4">✈️</span>
            <div>
                <span class="d-block text-muted" style="font-size: 0.75rem;">Goa Trip Group</span>
                <span class="text-primary fw-bold">4 Friends Active</span>
            </div>
        </div>

        <div class="container position-relative" style="z-index: 5;">
            <div data-aos="fade-down" data-aos-duration="800">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-3">
                    <i class="fa-solid fa-wand-magic-sparkles me-1"></i> Zero Math, Zero Stress
                </span>
            </div>

            <h1 class="hero-title" data-aos="zoom-in" data-aos-duration="1000">
                Split Expenses with Friends <br>
                <span class="gradient-text">Effortlessly & Instantly</span>
            </h1>

            <p class="hero-subtitle" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                Keep track of your shared expenses, track group vacations, dinners, and flatmate bills. Never have an awkward money talk again!
            </p>

            <div class="d-flex justify-content-center gap-3 flex-wrap" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <a href="register.php" class="btn-glow-primary">
                    <i class="fa-solid fa-rocket"></i> Get Started Free
                </a>
                <a href="login.php" class="btn-outline-custom">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Sign In to Account
                </a>
            </div>

            <!-- Interactive Live Split Simulator -->
            <div id="calculator" class="interactive-simulator" data-aos="fade-up" data-aos-duration="1100" data-aos-delay="400">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="fa-solid fa-bolt text-warning me-2"></i> Try Live Split Simulator
                    </h5>
                    <span class="badge bg-success-subtle text-success border border-success px-2 py-1">Instant Demo</span>
                </div>

                <div class="row g-3 text-start">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small">Total Bill Amount (₹)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold">₹</span>
                            <input type="number" id="simAmount" class="form-control form-control-lg fw-bold" value="2400" min="10" step="50">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small">Number of Friends: <span id="friendsCount" class="text-primary fw-bold">4</span></label>
                        <input type="range" id="simFriends" class="form-range mt-2" min="2" max="20" value="4">
                    </div>
                </div>

                <div class="calc-display">
                    <small class="text-uppercase tracking-wider text-light opacity-75">Each Friend Owes Exactly</small>
                    <div class="calc-amount my-1" id="eachOwes">₹600.00</div>
                    <span class="badge bg-info bg-opacity-25 text-info px-3 py-1 rounded-pill small">
                        <i class="fa-solid fa-check-circle me-1"></i> Clean Equal Share
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Counter Strip -->
    <section class="stats-section text-center">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-md-3 stat-item" data-aos="zoom-in" data-aos-delay="100">
                    <h3>₹5,00,000+</h3>
                    <p>Expenses Tracked</p>
                </div>
                <div class="col-6 col-md-3 stat-item" data-aos="zoom-in" data-aos-delay="200">
                    <h3>1,200+</h3>
                    <p>Groups Created</p>
                </div>
                <div class="col-6 col-md-3 stat-item" data-aos="zoom-in" data-aos-delay="300">
                    <h3>10,000+</h3>
                    <p>Bills Split</p>
                </div>
                <div class="col-6 col-md-3 stat-item" data-aos="zoom-in" data-aos-delay="400">
                    <h3>100%</h3>
                    <p>Dispute Free</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-5">
        <div class="container text-center py-4">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-2" data-aos="fade-up">
                Simple 3-Step Process
            </span>
            <h2 class="fw-bold mb-3" data-aos="fade-up">How SplitIt Works</h2>
            <p class="text-muted max-w-500 mx-auto mb-5" data-aos="fade-up">Designed for friend groups, flatmates, trips, and team lunches.</p>

            <div class="row g-4 mt-2">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper icon-blue mx-auto">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h4 class="fw-bold mb-3">1. Create a Group</h4>
                        <p class="text-muted">Invite roommates or travel buddies into a dedicated shared group in seconds.</p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="250">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper icon-pink mx-auto">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <h4 class="fw-bold mb-3">2. Add Expenses</h4>
                        <p class="text-muted">Enter any bill amount, select who paid, and let SplitIt calculate the math.</p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper icon-green mx-auto">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <h4 class="fw-bold mb-3">3. Settle Balances</h4>
                        <p class="text-muted">Track pending dues in real-time, pay via UPI/QR code, and clear balances smoothly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Friends Expense Showcase / Slider -->
    <section class="py-5 bg-white">
        <div class="container text-center py-3">
            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill fw-semibold mb-2" data-aos="fade-up">
                Real Memories, Clear Bills
            </span>
            <h2 class="fw-bold mb-4" data-aos="fade-up">Friends Sharing Good Times</h2>

            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="zoom-in" data-aos-duration="900">
                    <div id="expenseCarousel" class="carousel slide slider-image-card" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images/11.png" class="d-block w-100" alt="Friends having a meal and sharing costs" style="max-height: 440px; object-fit: cover;">
                                <div class="p-4 bg-white text-center">
                                    <h5 class="fw-bold text-dark mb-1">Weekend Getaway & Dining Out</h5>
                                    <p class="text-muted mb-0">"John, Sarah, and Mike split stay, travel and food without any spreadsheet headache!"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Slider -->
    <section class="testimonials-section text-center">
        <div class="container">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold mb-2" data-aos="fade-up">
                Loved By Thousands
            </span>
            <h2 class="fw-bold mb-4" data-aos="fade-up">What Our Users Say</h2>

            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-aos="fade-up" data-aos-delay="200">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="testimonial-card">
                            <div class="star-rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="fs-5 text-dark fw-medium mb-3">
                                "This app completely eliminated money confusion among my flatmates. We just enter grocery and electricity bills and it's done!"
                            </p>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px;">
                                    JD
                                </div>
                                <div class="text-start">
                                    <h6 class="mb-0 fw-bold">John Doe</h6>
                                    <small class="text-muted">Bangalore, Flatmate Group</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="testimonial-card" style="border-left-color: #f72585;">
                            <div class="star-rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="fs-5 text-dark fw-medium mb-3">
                                "No more awkward money talks with friends after weekend parties or road trips! Settle up is super fast."
                            </p>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px;">
                                    SL
                                </div>
                                <div class="text-start">
                                    <h6 class="mb-0 fw-bold">Sarah Lee</h6>
                                    <small class="text-muted">Mumbai, Road Trip Organizer</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="testimonial-card" style="border-left-color: #10b981;">
                            <div class="star-rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="fs-5 text-dark fw-medium mb-3">
                                "I love the simplicity and clean design of this project. Very intuitive, responsive, and easy to use on phone too."
                            </p>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px;">
                                    MR
                                </div>
                                <div class="text-start">
                                    <h6 class="mb-0 fw-bold">Mike Ross</h6>
                                    <small class="text-muted">Pune, College Student</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-2 mt-4">
                    <button class="btn btn-outline-dark rounded-circle" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev" style="width: 44px; height: 44px;">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="btn btn-outline-dark rounded-circle" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next" style="width: 44px; height: 44px;">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to action card banner -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="p-5 rounded-4 text-center text-white" style="background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%); box-shadow: 0 20px 40px rgba(67, 97, 238, 0.3);" data-aos="zoom-in">
                <h2 class="fw-bold mb-3">Ready to Start Splitting Bills?</h2>
                <p class="fs-5 opacity-90 max-w-500 mx-auto mb-4">Join now, create your first group, and invite your friends in under 2 minutes.</p>
                <a href="register.php" class="btn btn-light text-primary fw-bold px-4 py-3 rounded-pill shadow-lg fs-6">
                    <i class="fa-solid fa-user-plus me-2"></i> Create Free Account
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container text-center">
            <h5 class="text-white fw-bold mb-3">
                <i class="fa-solid fa-receipt text-primary me-2"></i> SplitIt Finance
            </h5>
            <p class="text-muted small mb-4">Making group expenses transparent, friendly, and hassle-free.</p>
            <p class="mb-2">
                <a href="index.php" class="mx-2">Home</a> | 
                <a href="login.php" class="mx-2">Login</a> | 
                <a href="register.php" class="mx-2">Register</a> | 
                <a href="#how-it-works" class="mx-2">How It Works</a>
            </p>
            <p class="text-secondary small mt-3">&copy; 2026 SplitIt. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animate On Scroll JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS animations
        AOS.init({
            duration: 800,
            once: true,
            offset: 80
        });

        // Interactive Live Split Calculator
        const simAmount = document.getElementById('simAmount');
        const simFriends = document.getElementById('simFriends');
        const friendsCount = document.getElementById('friendsCount');
        const eachOwes = document.getElementById('eachOwes');

        function updateCalculator() {
            const amount = parseFloat(simAmount.value) || 0;
            const friends = parseInt(simFriends.value) || 1;
            
            friendsCount.textContent = friends;
            
            const perPerson = (amount / friends).toFixed(2);
            eachOwes.textContent = '₹' + Number(perPerson).toLocaleString('en-IN', { minimumFractionDigits: 2 });
            
            // Subtle bounce animation on update
            eachOwes.style.transform = 'scale(1.08)';
            setTimeout(() => {
                eachOwes.style.transform = 'scale(1)';
            }, 180);
        }

        simAmount.addEventListener('input', updateCalculator);
        simFriends.addEventListener('input', updateCalculator);
        updateCalculator();
    </script>
</body>
</html>
