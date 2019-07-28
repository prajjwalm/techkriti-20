<?php
// To disable direct url access
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( $_SERVER["SERVER_PROTOCOL"]." 404 Not Found", TRUE, 404 );
    die( header( 'location: ../tosc/login.html' ) );
}

require "../../../hash/lib/password.php";

date_default_timezone_set('UTC');

if ( array_key_exists("email", $_POST) && array_key_exists("password", $_POST)) {
    $email = $_POST["email"];
    $psd = $_POST["password"];
} else {
    $return['status'] = "wrong";
    $return['msg'] = "Params missing";
    exit(json_encode($return));
}

if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $return['status'] = "wrong";
    $return['msg'] = "incorrect email format";
    exit(json_encode($return));
}

require "../../../mysql_vars.php";

$mysqli = new mysqli($hostname, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    $return['status'] = "error";
    error_log("Connection failed: " . mysqli_connect_error());
    $return['msg'] = "Connection failed: " . mysqli_connect_error();
    exit(json_encode($return));
}

// get user details
// ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../../session'));
session_start();

$query = "SELECT `name`, `psd_hash`, `team`, `techid`, `parent`, `mob`, `school`, `grade`, `paid`, `txnid` 
FROM `tosc` WHERE `email` = ?;";
if ($stmt = $mysqli->prepare($query)){
    if (!$stmt->bind_param("s", $email)){
        $return['status'] = "error";
        error_log("binding params failed");
        $return['msg'] = "binding params failed";
        exit(json_encode($return));
    }
    if (!$stmt->execute()) {
        $return['status'] = "error";
        error_log("execution failed");
        $return['msg'] = "execution failed";
        exit(json_encode($return));
    }
//    $result = $stmt->get_result();
//    if ($retrieve_row = $result->fetch_array()) {
//
//        $hash = $retrieve_row["psd_hash"];
//        if (!password_verify($password, $hash)) {
//            $return['status'] = "wrong";
//            $return['msg'] = "user not registered";
//            exit(json_encode($return));
//        }
//        $_SESSION["name"]   = $retrieve_row["name"];
//        $_SESSION["team"]   = $retrieve_row["team"];
//        $_SESSION["techid"] = $retrieve_row["techid"];
//        $_SESSION["email"]  = $retrieve_row["email"];
//        $_SESSION["parent"] = $retrieve_row["parent"];
//        $_SESSION["mob"]    = $retrieve_row["mob"];
//        $_SESSION["school"] = $retrieve_row["school"];
//        $_SESSION["grade"]  = $retrieve_row["grade"];
//        $_SESSION["paid"]   = $retrieve_row["paid"];
//        $_SESSION["txnid"]  = $retrieve_row["txnid"];
//        $return['status'] = "success";
//        exit(json_encode($return));
//
//    } else {
//        $return['status'] = "wrong";
//        $return['msg'] = "user not registered";
//        exit(json_encode($return));
//    }
    $stmt->bind_result($name, $hash, $team, $techid, $parent, $mob, $school, $grade, $paid, $txnid);

    if ($stmt->fetch()) {
        if (!password_verify($psd, $hash)) {
            $return['psd'] = $psd;
            $return['hash'] = $hash;
            $return['verify'] = password_verify($psd, $hash);
            $return['status'] = "wrong";
            $return['msg'] = "user not registered";
            exit(json_encode($return));
        }
        $_SESSION["name"]   = $name;
        $_SESSION["team"]   = $team;
        $_SESSION["techid"] = $techid;
        $_SESSION["parent"] = $parent;
        $_SESSION["mob"]    = $mob;
        $_SESSION["school"] = $school;
        $_SESSION["grade"]  = $grade;
        $_SESSION["paid"]   = $paid;
        $_SESSION["txnid"]  = $txnid;
        $return['status'] = "success";
        exit(json_encode($return));

    } else {
        $return['status'] = "wrong";
        $return['msg'] = "user not registered";
        exit(json_encode($return));
    }

    } else {
    $return['status'] = "error";
    error_log("stmt preparation error: " . $stmt->error);
    $return['msg'] = "stmt preparation error: " . $stmt->error;
    exit(json_encode($return));
}