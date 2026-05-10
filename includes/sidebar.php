<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>


<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic">
               
            </div>
            <div class="profile-usertitle">
                <?php
$uid=$_SESSION['detsuid'];
$ret=mysqli_query($con,"select FullName from tbluser where ID='$uid'");
$row=mysqli_fetch_array($ret);
$name=$row['FullName'];

?>
                <div class="profile-usertitle-name"><?php echo $name; ?></div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        
        <ul class="nav menu">
            <li class="active"><a href="dashboard.php" style="font-size:14px;"><em class="fa fa-dashboard">&nbsp;</em> Personal Dashboard</a></li>
             <li class="active"><a href="group_dashboard.php"><em class="fa fa-users">&nbsp;</em> Group Dashboard</a></li>
            
           
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em>Personal Expenses <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li><a class="" href="add-expense.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Add Expenses
                    </a></li>
                    <li><a class="" href="manage-expense.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Manage Expenses
                    </a></li>
                    
                </ul>

            </li>

               <li class="parent "><a data-toggle="collapse" href="#sub-item-9">
                <em class="fa fa-navicon">&nbsp;</em>Group Expenses
                 <span data-toggle="collapse" href="#sub-item-9" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-9">
                    <li><a class="" href="create-group.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Create Group 
                    </a></li>
                    <li><a class="" href="manage-group.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Manage Group 
                    </a></li>
                  <li><a class="" href="Received-Balance.php">
                        <span class="fa fa-arrow-right">&nbsp;</span>  Received Balance
                    </a></li>
                    
                </ul>

            </li>
           
  <li class="parent "><a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-navicon">&nbsp;</em>Expense Report 
                <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-2">
                    <li><a class="" href="expense-datewise-reports.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Daywise Expenses
                    </a></li>
                    <li><a class="" href="expense-monthwise-reports.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Monthwise Expenses
                    </a></li>
                    <li><a class="" href="expense-yearwise-reports.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Yearwise Expenses
                    </a></li>
                    
                </ul>
            </li>




            
            <li><a href="user-profile.php"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
             

        </ul>
    </div>