<?php

// To disable direct url access
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( $_SERVER["SERVER_PROTOCOL"]." 404 Not Found", TRUE, 404 );
    die( header( 'location: ../tosc/index.php' ) );
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

$return = [];

// ready session
session_start();
if (empty($_SESSION['techid'])) {
    session_destroy();
    header("Location: ../tosc/index.php");
}

// ready mysql
require "../../../mysql_vars.php";
$mysqli = new mysqli($hostname, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    $return['status'] = "error";
    error_log("Connection failed: " . mysqli_connect_error());
    $return['msg'] = "Connection failed: " . mysqli_connect_error();
    exit(json_encode($return));
}

// initialise payu data
$payu_data = [];

// generate a unique taxation id
do {
    $proposedTxn = $_SESSION["team"] . random_str(10);
    $chkquery = "SELECT EXISTS (SELECT 1 FROM `tosc` WHERE `txnid` = '$proposedTxn') AS 'present';";

    if ($result = $mysqli->query($chkquery)) {
        $row = $result->fetch_assoc();
        $present = boolval($row['present']);
    } else {
        $return['status'] = "error";
        $return['msg'] = "search query failure: " . $mysqli->error;
        error_log($return['msg']);
        exit(json_encode($return));
    }
    $result->free();
} while ($present);

$payu_data['key'] = "gtKFFx";
$payu_salt = "eCwWELxi";
$payu_data['txnid'] = $proposedTxn;
$payu_data['amount'] = "300";
$payu_data['productinfo'] = "registration amount for tosc19";
$payu_data['firstname'] = $_SESSION['name'];                    // explode(' ', trim($_SESSION['name']))[0];
$payu_data['email'] = $_SESSION['email'];
$payu_data['phone'] = $_SESSION['mob'];
$payu_data['surl'] = "https://tosc.techkriti.org/back/surl.php";
$payu_data['surl'] = "https://tosc.techkriti.org/back/furl.php";
$arr = array($payu_data["key"], $payu_data['txnid'], $payu_data['amount'], $payu_data['productinfo'],
    $payu_data['firstname'], $payu_data['email'], "", "", "", "", "", "", "", "", "", "", $payu_salt);
$payu_data['hash'] = hash("sha512", implode('|', $arr));

// add details to database, and to session; and in surl, check both
$_SESSION['payu_stuff'] = $payu_data;
$payu_db_val = base64_encode(serialize($payu_data));

$query = "UPDATE `tosc` SET `payu_stuff`=? WHERE `techid` = ?;";
if ($stmt = $mysqli->prepare($query)) {
    if (!$stmt->bind_param('bs', $payu_data, $_SESSION['techid'])) {
        $return['status'] = "error";
        $return['msg'] = "binding params failed: " . $mysqli->error;
        error_log($return['msg']);
        exit(json_encode($return));
    }
    if (!$stmt->execute()) {
        $return['status'] = "error";
        $return['msg'] = "execution failed: " . $stmt->error;
        error_log($return['msg']);
        exit(json_encode($return));
    }
    $stmt->close();
} else {
    $return['status'] = "error";
    $return['msg'] = "stmt preparation failed";
    error_log($return['msg']);
    exit(json_encode($return));
}

$return['status'] = "success";
$return['payu_data'] = $payu_data;
exit(json_encode($return));
