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

$query = "SELECT `name`, `psd_hash`, `team`, `techid`, `parent`, `mob`, `school`, `grade`, `paid`, `txnid` FROM `tosc` WHERE `email` = ?;";
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
        $_SESSION["email"]  = $email;
        $_SESSION["team"]   = $team;
        $_SESSION["techid"] = $techid;
        $_SESSION["parent"] = $parent;
        $_SESSION["mob"]    = $mob;
        $_SESSION["school"] = $school;
        $_SESSION["grade"]  = $grade;
        $_SESSION["txnid"]  = $txnid;
        $stmt->close();

        $query2 = "SELECT `name`, `email`, `techid`, `parent`, `mob`, `school`, `grade`, `paid`, `txnid` FROM `tosc` WHERE team = ? AND techid != ?;";
        if ($stmt2 = $mysqli->prepare($query2)) {
            if (!$stmt2->bind_param('ss', $team, $techid)) {
                $return['status'] = "error";
                error_log("binding params failed 2");
                $return['msg'] = "binding params failed 2";
                exit(json_encode($return));
            }

            if (!$stmt2->execute()) {
                $return['status'] = "error";
                error_log("execution failed 2");
                $return['msg'] = "execution failed 2";
                exit(json_encode($return));
            }

            $stmt2->bind_result($name2, $email2, $techid2, $parent2, $mob2, $school2, $grade2, $paid2, $txnid2);

            $_SESSION['mem2'] = false;
            if ($stmt2->fetch()) {
                $_SESSION['mem2'] = true;
                $_SESSION["name2"]   = $name2;
                $_SESSION['email2']  = $email2;
                $_SESSION["techid2"] = $techid2;
                $_SESSION["parent2"] = $parent2;
                $_SESSION["mob2"]    = $mob2;
                $_SESSION["school2"] = $school2;
                $_SESSION["grade2"]  = $grade2;
                $_SESSION["paid"]    = $paid ? true: false;
                $_SESSION["txnid2"]  = $txnid2;
                $_SESSION['paid2'] = $paid2 ? true: false;
            }

            $return['status'] = "success";
            exit(json_encode($return));
        } else {
            $return['status'] = "error";
            error_log("stmt2 preparation error: " . $stmt->error);
            $return['msg'] = "stmt2 preparation error: " . $stmt->error;
            exit(json_encode($return));
        }
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