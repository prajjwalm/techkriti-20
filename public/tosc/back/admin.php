<?php
// To diasable direct url access
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( $_SERVER["SERVER_PROTOCOL"]." 404 Not Found", TRUE, 404 );
    die( header( 'location: ../ambassador/login.html' ) );
}

date_default_timezone_set('UTC');

require "../../../hash/lib/password.php";
if (!function_exists('boolval')) {
    function boolval($val) {
        return (bool) $val;
    }
}

$name = $_POST['name'];
$psd = $_POST['password'];

if (preg_match('/^[a-zA-Z\x20]{2,32}$/', $name) !== 1) {
    $return['status'] = "wrong";
    $return['msg'] = "incorrect name format";
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

$query = "SELECT `hash`, `tosc_cred` FROM `admin` WHERE `name` = ?";
if ($stmt = $mysqli->prepare($query)) {
    if (!$stmt->bind_param('s', $name)) {
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
    $stmt->bind_result($hash, $cred);
    if (!$stmt->fetch()) {
        $return['status'] = "error";
        $return['msg'] = "couldn't fetch";
        exit(json_encode($return));
    }

    $stmt->close();
    if (password_verify($psd, $hash) || intval($cred) === 2){
        if (!$result = $mysqli->query("SELECT `name`,`team`,`techid`,`email`,`parent`,`dob`,`mob`,`male`,`grade`,
        `school`,`city`,`paid`,`txnid`,`amt`,`payuid` FROM `tosc`")) {
            $return['status'] = "error";
            $return['msg'] = "mysqli query failed: ".$mysqli->error;
            exit(json_encode($return));
        }
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $result->free();
        $return['status'] = "success";
        $return['data'] = $data;
        exit(json_encode($return));
    }

}



?>
