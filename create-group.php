<?php  
session_start();
error_reporting(0);
include 'config.php';  // Database connection

$user_id = $_SESSION['detsuid']; // Assuming user 1 is logged in

// Fetch all users for member selection
$userQuery = "SELECT ID, FullName FROM tbluser";
$userResult = $conn->query($userQuery);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Create Group</title>
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
				<li class="active">Create Group</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Create Group</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center">
						 <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
						<a href="view_members.php">View Members</a>
    <h2>Create a New Group</h2>
    <form method="POST" action="create-group.php">
        <label>Group Title:</label><br>
        <input type="text" class="from-control" style="height: 40px; width: 60%;"  name="group_title"  required><br>

        <label>Group Description:</label><br>
        <textarea name="group_desc" class="from-control" style="height: 140px; width: 60%;" required ></textarea><br>

        <label>Select Members:</label><br>
        <?php while ($user = $userResult->fetch_assoc()) { ?>
            <input type="checkbox" name="members[]" class="from-control" value="<?= $user['ID'] ?>">
            <?= htmlspecialchars($user['FullName']) ?><br>
        <?php } ?>

        <button type="submit">Create Group</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $group_title = trim($_POST['group_title']);
        $group_desc = trim($_POST['group_desc']);
        $selected_members = $_POST['members'] ?? [];

        if (!empty($group_title) && !empty($group_desc) && !empty($selected_members)) {
            // Insert into groups table
            $sql = "INSERT INTO user_group (group_name, group_description, created_by) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            
            if (!$stmt) {
                die("SQL Error: " . $conn->error); // Debugging error
            }

            $stmt->bind_param("ssi", $group_title, $group_desc, $user_id);
            
            if ($stmt->execute()) {
                $group_id = $stmt->insert_id;

                // Insert selected members into group_members
                $stmt = $conn->prepare("INSERT INTO group_members (group_id, user_id, memer_no) VALUES (?, ?, ?)");
                
                if (!$stmt) {
                    die("SQL Error in group_members: " . $conn->error); // Debugging error
                }

                foreach ($selected_members as $index => $member_id) {
                    $member_no = "M" . ($index + 1); // Generating a simple member number
                    $stmt->bind_param("iis", $group_id, $member_id, $member_no);
                    $stmt->execute();
                }
// Also add the creator to the group, only if not already added
if (!in_array($user_id, $selected_members)) {
    $creator_no = "M" . (count($selected_members) + 1);
    $stmt->bind_param("iis", $group_id, $user_id, $creator_no);
    $stmt->execute();
}


                echo "<p style='color:green;'><script>alert('Group created successfully!');</script></p>";
            } else {
                echo "<p style='color:red;'>Error creating group.</p>";
            }
        } else {
            echo "<p style='color:red;'>All fields are required.</p>";
        }
    }
    ?>


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
