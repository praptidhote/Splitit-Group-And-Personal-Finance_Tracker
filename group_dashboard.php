<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
} else {

$userid = $_SESSION['detsuid'];

// Count the number of groups the user is in
$query_groups = mysqli_query($con, "SELECT COUNT(*) AS total_groups FROM group_members WHERE user_id='$userid'");
$result_groups = mysqli_fetch_array($query_groups);
$total_groups = $result_groups['total_groups'];
include 'config.php'; // Database connection file
// Fetch pending amount (amount user still owes)
$user_id = $_SESSION['detsuid']; // Assuming logged-in user ID is 3
$sql_pending = "SELECT SUM(balance) AS pending_amount FROM expense_contributionss WHERE payee_id = ?";
$stmt = $conn->prepare($sql_pending);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_pending = $stmt->get_result();
$row_pending = $result_pending->fetch_assoc();
$pending_amount = $row_pending['pending_amount'] ?? 0;
$user_id = $_SESSION['detsuid']; // Assuming logged-in user ID is 3
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
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Group Expense Dashboard</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>
	<?php include_once('includes/header.php'); ?>
	<?php include_once('includes/sidebar.php'); ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Group Expense Dashboard</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Group Expense Dashboard</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Groups Joined</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $total_groups; ?>">
							<span class="percent"> <?php echo ($total_groups == "" ? "0" : $total_groups); ?> </span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Pending Amount
</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $total_group_expense; ?>">
							<span class="percent"> <?php echo $pending_amount; ?> </span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Submitted Amount</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $total_pending; ?>">
							<span class="percent"> <?php echo $submitted_amount; ?> </span>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>
