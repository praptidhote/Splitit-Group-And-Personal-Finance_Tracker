<?php
session_start();
include 'config.php'; // Database connection file

$user_id = 1; // Assuming logged-in user ID is 3

// Fetch number of groups the user has joined
$sql_groups = "SELECT COUNT(DISTINCT group_id) AS total_groups FROM expense WHERE 
               expense_member1 = ? OR expense_member2 = ? OR expense_member3 = ? OR 
               expense_member4 = ? OR expense_member5 = ? OR expense_member6 = ?";
$stmt = $conn->prepare($sql_groups);
$stmt->bind_param("iiiiii", $user_id, $user_id, $user_id, $user_id, $user_id, $user_id);
$stmt->execute();
$result_groups = $stmt->get_result();
$row_groups = $result_groups->fetch_assoc();
$total_groups = $row_groups['total_groups'];

// Fetch pending amount (amount user still owes)
$sql_pending = "SELECT SUM(balance) AS pending_amount FROM expense_contributionss WHERE payee_id = ?";
$stmt = $conn->prepare($sql_pending);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_pending = $stmt->get_result();
$row_pending = $result_pending->fetch_assoc();
$pending_amount = $row_pending['pending_amount'] ?? 0;

// Fetch submitted amount (amount user has paid)
$sql_submitted = "SELECT SUM(balance) AS submitted_amount FROM expense_contributionss WHERE payer_id = ?";
$stmt = $conn->prepare($sql_submitted);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_submitted = $stmt->get_result();
$row_submitted = $result_submitted->fetch_assoc();
$submitted_amount = $row_submitted['submitted_amount'] ?? 0;

// Close connections
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center">Expense Dashboard</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Groups Joined</h5>
                    <p class="card-text fs-3"><?= $total_groups; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pending Amount</h5>
                    <p class="card-text fs-3">₹<?= number_format($pending_amount, 2); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Submitted Amount</h5>
                    <p class="card-text fs-3">₹<?= number_format($submitted_amount, 2); ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
