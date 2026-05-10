<?php  
session_start();
error_reporting(0);

$conn = mysqli_connect("localhost", "root", "", "detsdb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get logged-in user ID (Ensure you have this in session)
echo $user_id = $_SESSION['detsuid']; 

// Fetch only groups where the user is a member
$query = "SELECT ug.*, 
            (SELECT COUNT(*) FROM group_members gm WHERE gm.group_id = ug.group_id) AS total_members 
          FROM user_group ug
          WHERE ug.group_id IN (SELECT group_id FROM group_members WHERE user_id = '$user_id')";

$result = mysqli_query($conn, $query);
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
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><em class="fa fa-home"></em></a></li>
				<li class="active">Expense</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Expense</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center">
                            <?php if($msg){ echo $msg; } ?> 
                        </p>

						<div class="col-md-12">
							<div class="table-responsive">
								<h2 style="text-align:center;">Your Groups</h2>

                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Group Name</th>
                                                <th>Group Description</th>
                                                <th>Total Members</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['group_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['group_description']); ?></td>
                                                    <td><?php echo $row['total_members']; ?></td>
                                                    <td>
            <a href="split_expense.php?group_id=<?php echo $row['group_id']; ?>" class="btn btn-info">
            Manage Expenses </a>
             <a href="pay_expense.php?group_id=<?php echo $row['group_id']; ?>" class="btn btn-info">
            Pay Expenses </a>
              <a href="edit_group.php?group_id=<?php echo $row['group_id']; ?>" class="btn btn-info">
            Edit Group Details </a>

                                                      <!--  <a href="view_members.php?id=<?php echo $row['group_id']; ?>" class="btn btn-info">View Members</a>
-->                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p style="text-align:center; font-size:18px; color:red;">
                                        You are not part of any groups.
                                    </p>
                                <?php endif; ?>

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
