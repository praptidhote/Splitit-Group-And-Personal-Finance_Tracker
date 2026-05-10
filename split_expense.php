<?php
session_start();
error_reporting(0);
include 'config.php'; // Database connection

$group_id = $_GET['group_id']; // Assume this is passed in URL
$user_id = $_SESSION['detsuid']; // Assuming user 1 is logged in

// Fetch group members dynamically
$membersQuery = "SELECT user_id FROM group_members WHERE group_id = ?";
$stmt = $conn->prepare($membersQuery);
$stmt->bind_param("i", $group_id);
$stmt->execute();
$membersResult = $stmt->get_result();
$members = [];
while ($row = $membersResult->fetch_assoc()) {
    $members[] = $row['user_id']; // Store user IDs
}
$total_members = count($members);

// Handle adding an expense
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $expense_title = trim($_POST['expense_title']);
    $expense_amount = floatval($_POST['expense_amount']);

    if (!empty($expense_title) && $expense_amount > 0) {
        // Prepare values for expense table
        $expense_data = array_fill(0, $total_members, 0); // Set all members' expense to 0
        $payer_index = array_search($user_id, $members); // Find payer index
        if ($payer_index !== false) {
            $expense_data[$payer_index] = $expense_amount; // Assign amount to payer
        }

        // Construct dynamic column names
        $columns = implode(",", array_map(function ($i) { 
            return "expense_member" . $i; 
        }, range(1, $total_members)));        $placeholders = implode(",", array_fill(0, $total_members, "?"));

        // Insert into expense table
        $sql = "INSERT INTO expense (expense_title, group_id, $columns) VALUES (?, ?, $placeholders)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param(
                "si" . str_repeat("i", $total_members), // Fix: "s" for title, "i" for group_id, rest are integers
                $expense_title, $group_id, 
                ...$expense_data
            );
            $stmt->execute();
            echo "<p style='color:green;'>Expense added successfully!</p>";
        } else {
            echo "<p style='color:red;'>Error in SQL query.</p>";
        }
    } else {
        echo "<p style='color:red;'>Invalid expense details.</p>";
    }
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
<?php
// Include database connection

// Check if group_id is set in GET request
if (isset($_GET['group_id'])) {
    $group_id = intval($_GET['group_id']); // Ensure it's an integer to prevent SQL injection

    // Fetch group details
    $sql = "SELECT group_name, group_description FROM user_group WHERE group_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $group_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $group = $result->fetch_assoc();
        $group_name = $group['group_name'];
        $group_desc = $group['group_description'];
    } else {
        $group_name = "Unknown Group";
        $group_desc = "No Description Available";
    }
} else {
    echo "Group ID not provided!";
    exit;
}
?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Expense Details</div>
                    <div class="panel-body">
                        <h2 style="text-align:center;">Group: <?php echo $group_name; ?></h2>
                        <p style="text-align:center;"><strong>Description:</strong> <?php echo $group_desc; ?></p>

                        <h4>Add Expense</h4>
                        <form method="POST">
        <label>Expense Title:</label>
        <input type="text" name="expense_title" class="form-control" required><br>

        <label>Expense Amount:</label>
        <input type="number" name="expense_amount" class="form-control" required><br>

        <button type="submit">Add Expense</button>
    </form>
<br>

                      

<?php
session_start();
include 'config.php'; // Database connection

$group_id = $_GET['group_id']; // Assuming group_id is passed in URL
$selected_member = $_SESSION['detsuid']; // Logged-in user's ID

// Fetch group members dynamically along with their names
$membersQuery = "SELECT gm.user_id, u.FullName FROM group_members gm 
                 JOIN tbluser u ON gm.user_id = u.ID 
                 WHERE gm.group_id = ?";
$stmt = $conn->prepare($membersQuery);
$stmt->bind_param("i", $group_id);
$stmt->execute();
$membersResult = $stmt->get_result();

$members = [];
while ($row = $membersResult->fetch_assoc()) {
    $members[$row['user_id']] = $row['FullName']; // Store user ID => Name
}
$total_members = count($members);

// Fetch all expenses for the group
$expensesQuery = "SELECT * FROM expense WHERE group_id = ?";
$stmt = $conn->prepare($expensesQuery);
$stmt->bind_param("i", $group_id);
$stmt->execute();
$expensesResult = $stmt->get_result();

// Initialize balances for all members
$balances = [];
foreach ($members as $m => $m_name) {
    foreach ($members as $n => $n_name) {
        if ($m != $n) {
            $balances[$m][$n] = 0; // Initialize all balances to zero
        }
    }
}

// Process each expense
while ($expense = $expensesResult->fetch_assoc()) {
    $payer = null;
    $total_expense = 0;

    // Identify the payer and the amount
    foreach (array_keys($members) as $index => $member_id) {
        $amount = $expense['expense_member' . ($index + 1)];
        if ($amount > 0) {
            $payer = $member_id;
            $total_expense = $amount;
        }
    }

    if ($payer) {
        $split_amount = $total_expense / $total_members;

        // Calculate balances for each member
        foreach (array_keys($members) as $index => $member_id) {
            if ($member_id != $payer) {
                $balances[$payer][$member_id] += $split_amount; // Payer gets money from others
                $balances[$member_id][$payer] -= $split_amount; // Others owe payer
            }
        }
    }
}

// Display balances for the selected member
echo "<h2>Balance Summary for " . $members[$selected_member] . "</h2>";
echo "<table class='table table-bordered'>";
echo "<thead><tr><th>With Member</th><th>Balance (₹)</th></tr></thead><tbody>";

foreach ($balances[$selected_member] as $other_member_id => $balance) {
    $payer_id = $_SESSION['detsuid']; 
    $payee_id = $other_member_id;

    // Query to get contributions
    $query = "SELECT payer_id, payee_id, SUM(balance) as total_balance 
              FROM expense_contributionss 
              WHERE (payer_id = ? AND payee_id = ?) OR (payer_id = ? AND payee_id = ?) 
              GROUP BY payer_id, payee_id";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiii", $payer_id, $payee_id, $payee_id, $payer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $balance_1_to_2 = 0;
    $balance_2_to_1 = 0;

    while ($row = $result->fetch_assoc()) {
        if ($row['payer_id'] == $payer_id) {
            $balance_1_to_2 = $row['total_balance']; // 1 gives to 2 (negative)
        } else {
            $balance_2_to_1 = $row['total_balance']; // 2 gives to 1 (negative)
        }
    }

    // Compute final balance
    $final_balance = $balance_2_to_1 - $balance_1_to_2;
    $mainbal = $final_balance - $balance;

    echo "<tr>";
    echo "<td>" . $members[$other_member_id] . "</td>"; // Display the member name instead of ID
    echo "<td>₹" . $mainbal . "</td>";
    echo "</tr>";
}

echo "</tbody></table>";
$conn->close();
?>




                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
