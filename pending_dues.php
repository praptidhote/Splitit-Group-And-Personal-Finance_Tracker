<?php session_start(); error_reporting(0);
$conn = mysqli_connect("localhost", "root", "", "detsdb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo $user_id = $_SESSION['detsuid']; // Get logged-in user ID
$joined_groups_query = "SELECT g.group_id, g.group_name, g.group_description, 
                               COALESCE(SUM(b.balance), 0) AS total_group_balance, 
                               (SELECT COALESCE(SUM(b2.balance), 0) 
                                FROM expense_balances b2 
                                INNER JOIN expenses e2 ON b2.expense_id = e2.expense_id
                                WHERE b2.user_id = '$user_id' AND e2.group_id = g.group_id) 
                               AS user_pending_amount
                        FROM user_group g
                        INNER JOIN group_members gm ON g.group_id = gm.group_id
                        LEFT JOIN expense_balances b ON g.group_id = 
                            (SELECT e.group_id FROM expenses e WHERE e.expense_id = b.expense_id)
                        WHERE gm.user_id = '$user_id'
                        GROUP BY g.group_id, g.group_name, g.group_description";
$joined_groups_result = mysqli_query($conn, $joined_groups_query);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Manage Expense</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Expense</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Expense</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							
							<div class="table-responsive">
         <table class="table table-bordered">
    <thead>
        <tr>
            <th>Group Name</th>
            <th>Description</th>
            <th>Total Group Balance (₹)</th>
            <th>Your Pending Amount (₹)</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($joined_groups_result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['group_name']); ?></td>
                <td><?php echo htmlspecialchars($row['group_description']); ?></td>
                <td>₹<?php echo number_format(abs($row['total_group_balance']), 2); ?></td>
                <td>₹<?php echo number_format(abs($row['user_pending_amount']), 2); ?></td>
     <td><a href="Pending-Dues-Settle.php?id=<?php echo htmlspecialchars($row['group_id']); ?>" class="btn btn-primary">Pending Dues Settle</a></td>        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
          </div>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('includes/footer.php');?>
		</div><!-- /.row -->
	</div><!--/.main-->
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
