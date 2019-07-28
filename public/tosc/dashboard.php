<?php
// ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../../session'));
session_start();
if (empty($_SESSION['techid'])) {
    session_destroy();
    header("Location: index.php");
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
        <!-- div class="row selected" id="home">
            <div class = "icon"><i class="fas fa-home"></i></div>
            <span class="desc">Home</span>
        </div -->
        <!--div class="row" id="member_details">
            <div class="icon"><i class="fas fa-user-friends"></i></div>
            <span class="desc">Member Details</span>
        </div -->

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
        <div id = "to_payment" class = "card-m c_payments">
            <div class="img-space">
                <img src="assets/images/payment.jpg" alt="" />
            </div>
            <div class="floating-action-button close">
                <i class="fas fa-times"></i>
            </div>
            <div class="card-title">
                Proceed to payment
            </div>
            <div class="card-description">
                Click on the button below to be redirected to PayU to pay the tosc exam fees
            </div>
            <div class = "action">
                <button id = 'PAY' class="btn" type="button"><span>Proceed to Payment</span></button>
            </div>
        </div>

    </div>
</body>
</html>

