<?php
session_start();
if (empty($_SESSION['techid']) || empty($_SESSION['team'])) {
    session_destroy();
    header("Location: index.php");
}

$paid = false;
if (empty($_SESSION['paid'])) {
    // retrieve payment info from db;

    // ready mysql
    require "../../mysql_vars.php";
    $mysqli = new mysqli($hostname, $username, $password, $dbname);
    if (mysqli_connect_errno()) {
        $return['status'] = "error";
        error_log("Connection failed in dashboard: " . mysqli_connect_error());
    }

    // retrieve if paid
    $check_query = "SELECT EXISTS (SELECT 1 FROM tosc WHERE `techid` = ? AND `paid` = 1) AS `payment_done`;";
    if ($check_stmt = $mysqli->prepare($check_query)){
        if (!$check_stmt->bind_param("s", $_SESSION['techid'])){
            error_log("binding check params failed in dashboard");
        }
        if (!$check_stmt->execute()) {
            error_log("check execution failed");
        }
        $check_stmt->bind_result($check_result);
        while ($check_stmt->fetch()) {
            if ($check_result) {
                $paid = true;
            }
        }
    } else {
        error_log("check preparation error: " . $check_stmt->error);
    }
    $check_stmt->close();
    $_SESSION['paid'] = $paid;
} else {
    $paid = $_SESSION['paid'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <meta name = "keywords" content = "TOSC, Dashboard, 2019">
    <meta name = "Description" content = "Dashboard for participants of TOSC 2019">
    <meta name = "theme-color" content = "#103d87">

    <meta name = "theme-color" content = "#103d87">

    <title>TOSC '19 Dashboard</title>

    <!-- External Styles-->
    <link href="assets/icons/fa/css/all.min.css" rel="stylesheet">

    <!-- My Styles -->
    <link href="css/build/dashboard.css" rel="stylesheet">

    <!-- Library Scripts -->
    <script src = "js/jquery-3.2.1.min.js"></script>

    <!-- My Scripts -->
    <script src="js/dashboard/card.js"></script>
    <script src="js/dashboard/back.js"></script>
    <script src="js/dashboard/signout.js"></script>
    <script src="js/dashboard/payment.js"></script>
    <script src="js/dashboard/session.js"></script>

    <link rel="shortcut icon" type="image/x-icon" href="assets/icons/favicon.ico" />

</head>
<body>
    <div id="sidenav" class="open">
        <div class="header">
            <h3>TOSC Dashboard</h3>
        </div>
        <div class="row selected" id="member_details">
            <div class="icon"><i class="fas fa-user-friends"></i></div>
            <span class="desc">Team Details</span>
        </div>
        <div class="row" id="payments">
            <div class="icon"><i class="fas fa-credit-card"></i></div>
            <span class="desc">Payments</span>
        </div>
        <div class="row" id="sign_out">
            <div class="icon"><i class="fas fa-sign-out-alt"></i></div>
            <span class="desc">Sign out</span>
        </div>
        <div class="row" id="back">
            <div class="icon"><i class="fas fa-backward"></i></div>
            <span class="desc">Back to Landing Page</span>
        </div>
    </div>

    <div id = "card-space">
        <!--div id = "test" class = "card-m c_member_details">
            <div class="img-space">
                <img src="assets/images/test.png" alt="" />
            </div>
            <div class="floating-action-button close">
                <i class="fas fa-times"></i>
            </div>
            <div class="card-title">
                really long card header
            </div>
            <div class="card-description">
                brief card description
            </div>
            <div class = "action">
                <button class="btn" type="button"><span>Action</span></button>
            </div>
        </div>

        <div id = "test2" class = "card-m long c_member_details">
            <div class="img-space">
                <img src="assets/images/test.png" alt="" />
            </div>
            <div class="floating-action-button close">
                <i class="fas fa-times"></i>
            </div>
            <div class="card-title">
                long card header
            </div>
            <div class="card-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae est tincidunt, pellentesque nisi nec, scelerisque massa.
                Vivamus sodales elementum nunc at luctus. In varius sem rutrum odio sollicitudin, at vehicula libero tristique
                (a not very brief card description)
            </div>
            <div class = "action">
                <button class="btn" type="button"><span>Action</span></button>
            </div>
        </div>

        <div id = "test3" class = "card-m c_payments">
            <div class="img-space">
                <img src="assets/images/test.png" alt="" />
            </div>
            <div class="floating-action-button close">
                <i class="fas fa-times"></i>
            </div>
            <div class="card-title">
                card header
            </div>
            <div class="card-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae est tincidunt, pellentesque nisi nec, scelerisque massa.
                Vivamus sodales elementum nunc at luctus.
            </div>
            <div class = "action">
                <button class="btn" type="button"><span>Action</span></button>
            </div>
        </div -->
        <div id = "member1" class = "card-s c_member_details padded">
            <div class="card-title">
                <?php echo $_SESSION['name'] ?>
            </div>
            <div class="card-description">
                Parent Name:    <?php echo $_SESSION['parent']  ?> <br/>
                Tech Id:        <?php echo $_SESSION['techid']  ?> <br/>
                School:         <?php echo $_SESSION['school']  ?> <br/>
                Grade:          <?php echo $_SESSION['grade']  ?> <br/>
                Pool:           <?php echo intval($_SESSION['grade']) < 11 ? "A"  : "B" ; ?> <br/>
                Fees Paid:      <?php echo $_SESSION['paid'] ? "yes" : "no" ?> <br/>
            </div>
        </div>
        <div id = "member2" class = "card-s c_member_details padded">
            <div class="card-title">
                <?php echo $_SESSION['name2'] ?>
            </div>
            <?php if ($_SESSION['mem2']): ?>
            <div class="card-description">
                Parent Name:    <?php echo $_SESSION['parent2']  ?> <br/>
                Tech Id:        <?php echo $_SESSION['techid2']  ?> <br/>
                School:         <?php echo $_SESSION['school2']  ?> <br/>
                Grade:          <?php echo $_SESSION['grade2']  ?> <br/>
                Pool:           <?php echo intval($_SESSION['grade2']) < 11 ? "A"  : "B" ; ?> <br/>
                Fees Paid:      <?php echo $_SESSION['paid2'] ? "yes" : "no" ?> <br/>
            </div>
            <?php else: ?>
                Couldn't retrieve teammate's details. Please report this problem
            <?php endif; ?>
        </div>
        <div id = "to_payment" class = "card-l c_payments hidden">
            <div class="img-space">
                <img src="assets/images/payment.jpg" alt="" />
            </div>
            <!--div class="floating-action-button close">
                <i class="fas fa-times"></i>
            </div-->
            <div class="card-title">
                Proceed to payment
            </div>
            <div class="card-description">
                Click on the button below to be redirected to PayU to pay the tosc exam fees
            </div>
            <div class = "action">
                <form action="back/payment_manager.php" method="post">
                    <?php if (! $paid): ?>
                    <input type="submit" id='PAY' class="btn" value="Proceed To Payment"/>
                    <?php else: ?>
                    <br /> Payment already received
                    <?php endif; ?>
                </form>
            </div>
        </div>

    </div>
</body>
</html>

