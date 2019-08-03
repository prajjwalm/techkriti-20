<?php
// To disable direct url access
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( $_SERVER["SERVER_PROTOCOL"]." 404 Not Found", TRUE, 404 );
    error_log("surl redirect caught by direct access checker");
    die( header( 'location: ../dashboard.php' ) );
}

date_default_timezone_set('UTC');

if (!function_exists('boolval')) {
    function boolval($val) {
        return (bool) $val;
    }
}

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyz') {
    $pieces = [];
    $max = strlen($keyspace) - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[rand(0, $max)];
    }
    return implode('', $pieces);
}

session_start();
if (empty($_SESSION['techid']) || empty($_SESSION['team'])) {
    session_destroy();
    error_log("empty session in surl");
    header("Location: index.php");
}

$_SESSION['payu_return_blob'] = base64_encode(serialize($_POST));
$_SESSION['payu_r'] = $_POST;
$amount = intval($_POST['amount'] - $_POST['discount']);
$ERR = $_POST['status'] == "success" && $amount == 300 ? false : true;
// update database, payment done

// ready mysql
require "../../../mysql_vars.php";
$mysqli = new mysqli($hostname, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    $msg = "Connection failed in surl: " . mysqli_connect_error()
    error_log($msg);
    $ERR = true;
}

// inject
$query = "UPDATE `tosc` SET `payu_return` = ?, `amt` = ?, `payuid` = ? WHERE `team` = ?";
if ($stmt = $mysqli->prepare($query)) {
    if (!$stmt->bind_param('sis', $_SESSION['payu_return_blob'],$amount, $_POST['mihpayid'], $_SESSION['team'])) {
        $ERR = true;
        $msg = "binding params failed: " . $mysqli->error;
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
    error_log($return['msg']);


}

?>

<html lang="en">
    <head>
        <title>Payment Successful</title>

        <script src = "../js/jquery-3.2.1.min.js"></script>
        <script src = "../js/dashboard/session.js"></script>
    </head>
    <body>
    <pre>
        <?php if (! $ERR): ?>
        Payment SUCCESSFUL

        Payment amount : <?php echo $amount; ?>
        Payment Id     : <?php echo $_SESSION['txnid']; ?>
        (please remember this id for future reference)
        <?php else: ?>
        Payment UNSUCCESSFUL
        If you feel you did everything correctly, please contact the team immediately.
        <?php endif; ?>

        <a href = "../dashboard.php">Return to dashboard</a>
    </pre>

    </body>
</html>
