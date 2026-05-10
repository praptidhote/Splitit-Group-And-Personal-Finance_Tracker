<?php  
session_start();
error_reporting(0);

$conn = mysqli_connect("localhost", "root", "", "detsdb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get Group ID from URL
if(isset($_GET['id'])) {
    $group_id = $_GET['id'];
    $user_id = $_SESSION['detsuid']; // Ensure user session is set

    // Fetch Group Details
    $group_query = "SELECT * FROM user_group WHERE group_id = '$group_id'";
    $group_result = mysqli_query($conn, $group_query);
    $group = mysqli_fetch_assoc($group_result);

    // Fetch Group Members
    $member_query = "SELECT tbluser.ID, tbluser.FullName, tbluser.Email 
                    FROM group_members 
                    INNER JOIN tbluser ON group_members.user_id = tbluser.ID
                    WHERE group_members.group_id = '$group_id'";
    $member_result = mysqli_query($conn, $member_query);
    $members = [];
    while($row = mysqli_fetch_assoc($member_result)) {
        $members[] = $row;
    }

    // Handle Expense Submission
    if(isset($_POST['add_expense'])) {
        $expense_title = $_POST['expense_title'];
        $total_amount = $_POST['total_amount'];
        $contributions = $_POST['contributions'];

        mysqli_begin_transaction($conn);
        
        // Insert Expense Record
        $insert_expense = "INSERT INTO expenses (group_id, user_id, expense_title, total_amount) VALUES ('$group_id', '$user_id', '$expense_title', '$total_amount')";
        if (!mysqli_query($conn, $insert_expense)) {
            mysqli_rollback($conn);
            die("Error inserting expense: " . mysqli_error($conn));
        }
        $expense_id = mysqli_insert_id($conn);

        // Insert Contributions & Balances
        $total_contributed = 0;
        foreach($contributions as $uid => $amount) {
            $amount = (float)$amount;
            if($amount > 0) {
                $insert_contribution = "INSERT INTO
                 expense_contributions (expense_id, user_id, amount, group_id) VALUES ('$expense_id', '$uid', '$amount', '$group_id')";
                if (!mysqli_query($conn, $insert_contribution)) {
                    mysqli_rollback($conn);
                    die("Error inserting contribution: " . mysqli_error($conn));
                }
                $total_contributed += $amount;
            }
        }

        // Calculate Equal Share
        $member_count = count($members);
        $equal_share = $total_amount / $member_count;

        foreach($members as $member) {
            $uid = $member['ID'];
            $contributed = isset($contributions[$uid]) ? (float)$contributions[$uid] : 0;
            $balance = $contributed - $equal_share;
            
            $insert_balance = "INSERT INTO expense_balances (expense_id, user_id, balance, group_id) VALUES ('$expense_id', '$uid', '$balance', '$group_id')";
            if (!mysqli_query($conn, $insert_balance)) {
                mysqli_rollback($conn);
                die("Error inserting balance: " . mysqli_error($conn));
            }
        }

        mysqli_commit($conn);
    }

    // Fetch Expenses
    $expense_query = "SELECT * FROM expenses WHERE group_id = '$group_id' ORDER BY created_at DESC";
    $expense_result = mysqli_query($conn, $expense_query);

} else {
    echo "Invalid Group ID";
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Tracker - Group Details</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
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
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Expense Details</div>
                    <div class="panel-body">
                        <h2 style="text-align:center;">Group: <?php echo $group['group_name']; ?></h2>
                        <p style="text-align:center;"><strong>Description:</strong> <?php echo $group['group_description']; ?></p>

                        <h4>Group Members</h4>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Member Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($members as $member): ?>
                                    <tr>
                                        <td><?php echo $member['FullName']; ?></td>
                                        <td><?php echo $member['Email']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <h4>Add Expense</h4>
                        <form method="post">
                            <div class="form-group">
                                <label>Expense Title:</label>
                                <input type="text" name="expense_title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Total Expense Amount:</label>
                                <input type="number" name="total_amount" class="form-control" required>
                            </div>
                            
                            <h5>Enter Contributions:</h5>
                            <?php foreach($members as $member){
                                     if($member['ID']==$_SESSION['detsuid']){
                             ?>
                                <div class="form-group">
                                    <label><?php echo $member['FullName']; ?>'s Contribution:</label>
                                    <input type="number" name="contributions[<?php echo $member['ID']; ?>]" class="form-control" min="0">
                                </div>
                            <?php }} ?>

                            <button type="submit" name="add_expense" class="btn btn-success">Add Expense</button>
                        </form>

                       <h4>Expense History</h4>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Expense Title</th>
            <th>Total Amount</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $total_expenses = 0; // Initialize total expense variable
        while($expense = mysqli_fetch_assoc($expense_result)): 
            $total_expenses += $expense['total_amount']; // Add to total expenses
        ?>
            <tr>
                <td><?php echo $expense['expense_title']; ?></td>
                <td><?php echo $expense['total_amount']; ?></td>
                <td><?php echo $expense['created_at']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="1">Total Expense:</th>
            <th colspan="2">₹<?php echo number_format($total_expenses, 2); ?></th>
        </tr>
    </tfoot>
</table>

<h4>Settlement Details</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Member</th>
            <th>Balance</th>
            <th>Owes</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $total_balance_amount = 0; // Initialize total balance variable
        $balance_query = "SELECT b.user_id, u.FullName, SUM(b.balance) as total_balance 
                          FROM expense_balances b 
                          INNER JOIN tbluser u ON b.user_id = u.ID 
                          WHERE b.expense_id IN (SELECT expense_id FROM expenses WHERE group_id = '$group_id') 
                          GROUP BY b.user_id";
        $balance_result = mysqli_query($conn, $balance_query);

        while($row = mysqli_fetch_assoc($balance_result)): 
            $owes = $row['total_balance'] < 0 ? "Pay ₹".abs($row['total_balance']) : "Receives ₹".$row['total_balance'];
            $total_balance_amount += $row['total_balance']; // Add balance to total
        ?>
            <tr>
                <td><?php echo $row['FullName']; ?></td>
                <td><?php echo number_format($row['total_balance'], 2); ?></td>
                <td><?php echo $owes; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="1">Total Balance:</th>
            <th colspan="2">₹<?php echo number_format($total_balance_amount, 2); ?></th>
        </tr>
    </tfoot>
</table>


                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
