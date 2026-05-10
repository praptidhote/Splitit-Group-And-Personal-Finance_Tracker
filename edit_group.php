<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (!isset($_GET['group_id']) || empty($_GET['group_id'])) {
    echo "Invalid group ID!";
    exit;
}

$group_id = intval($_GET['group_id']);

// Fetch group details
$query = mysqli_query($con, "SELECT group_name, group_description FROM user_group WHERE group_id = '$group_id'");
$group = mysqli_fetch_assoc($query);

if (!$group) {
    echo "Group not found!";
    exit;
}

// Handle form submission for updating group details
if (isset($_POST['update_group'])) {
    $group_name = mysqli_real_escape_string($con, $_POST['group_name']);
    $group_desc = mysqli_real_escape_string($con, $_POST['group_description']);

    $update_query = mysqli_query($con, "UPDATE user_group SET group_name='$group_name', group_description='$group_desc' WHERE group_id='$group_id'");

    if ($update_query) {
        $msg = "<span style='color:green;'>Group details updated successfully!</span>";
    } else {
        $msg = "Error updating group details. Try again!";
    }
}
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

                                <?php if (isset($msg)) { ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div>
        <?php } ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Group Name</label>
                <input type="text" name="group_name" class="form-control" value="<?php echo htmlspecialchars($group['group_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Group Description</label>
                <textarea name="group_description" class="form-control" required><?php echo htmlspecialchars($group['group_description']); ?></textarea>
            </div><br>
            <button type="submit" name="update_group" class="btn btn-primary">Update Group</button>
            <br><br>
            <a href="manage-group.php">Back</a>
        </form>

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
