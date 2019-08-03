<?php
// To disable direct url access
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( $_SERVER["SERVER_PROTOCOL"]." 404 Not Found", TRUE, 404 );
    error_log("surl redirect caught by direct access checker");
    die( header( 'location: ../dashboard.php' ) );
}

date_default_timezone_set('UTC');

session_start();
if (empty($_SESSION['techid']) || empty($_SESSION['team'])) {
    session_destroy();
    error_log("empty session in surl");
    header("Location: ../index.php");
}

$_SESSION['payu_return_blob'] = base64_encode(serialize($_POST));
$_SESSION['payu_r'] = $_POST;
$amount = intval($_POST['amount'] - $_POST['discount']);
$ERR = $_POST['status'] == "success" && $amount == 150 ? false : true;
// update database, payment done

// ready mysql
require "../../../mysql_vars.php";
$mysqli = new mysqli($hostname, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    $msg = "Connection failed in surl: " . mysqli_connect_error();
    error_log($msg);
    $ERR = true;
}


// Complete this if you wish to verify the payu hash. TODO
//if (empty($_SESSION['payu_stuff'])) {
//    $pquery = "SELECT `payu_stuff` FROM `tosc` WHERE `techid` = ?";
//    if ($pstmt = $mysqli->prepare($pquery)) {
//        if (!$pstmt->bind_param('s', $_SESSION['techid'])) {
//            $ERR = true;
//            error_log("binding params failed in surl, data: " . implode(',', $_POST));
//        } if (!$pstmt->execute()) {
//            $ERR = true;
//            error_log("exec failed in surl, data: ".implode(',', $_POST));
//        }
//        $pstmt->bind_result($payu_data);
//
//        if ($pstmt->fetch()) {
//            $ERR = true;
//            error_log("user not found, data: ".implode(',', $_POST));
//        }
//        $pstmt->close();
//    } else {
//        $ERR = true;
//    }
//} else {
//    $payu_data = $_SESSION['payu_stuff'];
//}

// inject
$query = "UPDATE `tosc` SET `payu_return` = ?, `paid` = 1, `amt` = ?, `payuid` = ? WHERE `techid` = ?";
if ($stmt = $mysqli->prepare($query)) {
    if (!$stmt->bind_param('siss', $_SESSION['payu_return_blob'],$amount, $_POST['mihpayid'], $_SESSION['techid'])) {
        $ERR = true;
        $msg = "binding params failed: " . $mysqli->error.", data: ". implode(',' ,$_POST);
        error_log($msg);
    }
    if (!$stmt->execute()) {
        $msg = "execution failed: " . $stmt->error;
        $ERR = true;
        error_log($msg);
    }
    $stmt->close();
} else {
    $ERR = true;
    $msg = "surl stmt preparation failed";
    error_log($msg);


}

?>

<html lang="en">
<head>
    <title>Payment Successful</title>

    <script src = "../js/jquery-3.2.1.min.js"></script>
    <script src = "../js/dashboard/session.js"></script>
    <script>
        $(function () {
            window.setTimeout(function () {
                window.location.href = '../dashboard.php';
            }, 5000);
        });

    </script>

    <link type="text/css" rel="stylesheet" href="../css/build/surl.css"? />
</head>
<body>
<div class="full-screen-center">
    <div id = "confirm">
        <div id="header-img">
            <img src="../assets/images/TOSClogo.png" alt="">
        </div>
        <?php if (! $ERR): ?>
            <span class ="title good"> Payment SUCCESSFUL </span><br />

            Payment amount : <?php echo $amount; ?><br />
            Payment Id     : <?php echo $_POST['txnid']; ?>
            <span>(please remember this id for future reference)</span><br />
        <?php else: ?>
            Payment ERROR<br />
            This is probably a server/connection error. If you feel you did everything correctly,
            please contact the team immediately. We will let you know your payment status
        <?php endif; ?>

        <a href = "../dashboard.php">Return to dashboard (automatically in 5s)</a>
    </div>
</div>


</body>
</html>
