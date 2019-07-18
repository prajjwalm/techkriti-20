<?php
    // To diasable direct url access
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        header( $_SERVER["SERVER_PROTOCOL"]." 404 Not Found", TRUE, 404 );
        die( header( 'location: ../ambassador/login.html' ) );
    }

    date_default_timezone_set('UTC');

    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyz') {
        $pieces = [];
        $max = strlen($keyspace) - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[rand(0, $max)];
        }
        return implode('', $pieces);
    }

    $return = [];
    // compulsory inputs
    if ( array_key_exists("name_input", $_POST)
        && array_key_exists("parent_name_input", $_POST)
        && array_key_exists("dob_input", $_POST)
        && array_key_exists("mob_input", $_POST)
        && array_key_exists("email_input", $_POST)
        && array_key_exists("gender1", $_POST)
        && array_key_exists("grade1", $_POST)
        && array_key_exists("name_input2", $_POST)
        && array_key_exists("parent_name_input2", $_POST)
        && array_key_exists("dob_input2", $_POST)
        && array_key_exists("mob_input2", $_POST)
        && array_key_exists("email_input2", $_POST)
        && array_key_exists("gender2", $_POST)
        && array_key_exists("grade2", $_POST)
        && array_key_exists("addr1_input", $_POST)
        && array_key_exists("school_name_input", $_POST)
        ) {
        $name1 = $_POST["name_input"];
        $parent_name1 = $_POST["parent_name_input"];
        $dob1 = $_POST ["dob_input"];
        $mob1 = $_POST["mob_input"];
        $email1 = $_POST["email_input"];
        $gender1 = $_POST["gender1"];
        $grade1 = $_POST["grade1"];
        $name2 = $_POST["name_input2"];
        $parent_name2 = $_POST["parent_name_input2"];
        $dob2 = $_POST ["dob_input2"];
        $mob2 = $_POST["mob_input2"];
        $email2 = $_POST["email_input2"];
        $gender2 = $_POST["gender2"];
        $grade2 = $_POST["grade2"];
        $addr = $_POST["addr1_input"];
        $school = $_POST["school_name_input"];
        $team = $_POST["team_name_input"];
    } else {
        $return['status'] = "wrong";
        $err = [];
        if (!array_key_exists('name_input', $_POST)) array_push($err, '#name_input');
        if (!array_key_exists('parent_name_input', $_POST)) array_push($err, '#parent_name_input');
        if (!array_key_exists('dob_input', $_POST)) array_push($err, '#dob_input');
        if (!array_key_exists('mob_input', $_POST)) array_push($err, '#mob_input');
        if (!array_key_exists('email_input', $_POST)) array_push($err, '#email_input');
        if (!array_key_exists('name_input2', $_POST)) array_push($err, '#name_input2');
        if (!array_key_exists('parent_name_input2', $_POST)) array_push($err, '#parent_name_input2');
        if (!array_key_exists('dob_input2', $_POST)) array_push($err, '#dob_input2');
        if (!array_key_exists('mob_input2', $_POST)) array_push($err, '#mob_input2');
        if (!array_key_exists('email_input2', $_POST)) array_push($err, '#email_input2');
        if (!array_key_exists('team_name_input', $_POST)) array_push($err, '#team_name_input');
        if (!array_key_exists('school_name_input', $_POST)) array_push($err, '#school_name_input');
        if (!array_key_exists('addr1_input', $_POST)) array_push($err, '#addr1_input');
        $return['msg'] = "Params missing";
        $return['erring_elmts_id'] = implode(', ', $err);
        exit(json_encode($return));
    }

    // optional inputs
    if (array_key_exists("addr2_input", $_POST)) {
        $addr .= $_POST["addr2_input"];
    }

    // regex checks, wherever applicable; note: this is not used as a substitute for parameter binding
    $err = [];
    if (preg_match('/^[a-zA-Z0-9\'\-\.\x20&]{2,32}$/', $name1) !== 1) {
        array_push($err, '#name_input');
    }
    if (preg_match('/^[a-zA-Z0-9\'\-\.\x20&]{2,32}$/', $name2) !== 1) {
        array_push($err, '#name_input2');
    }
    if (preg_match('/^[a-zA-Z0-9\'\-\.\x20&]{2,32}$/', $parent_name1) !== 1) {
        array_push($err, '#parent_name_input');
    }
    if (preg_match('/^[a-zA-Z0-9\'\-\.\x20&]{2,32}$/', $parent_name2) !== 1) {
        array_push($err, '#parent_name_input2');
    }
    if (preg_match('/^[a-zA-Z0-9\'\-\.\x20&]{2,32}$/', $team) !== 1) {
        array_push($err, '#team_name_input');
    }
    if (preg_match('/^[a-zA-Z0-9\'\-\.\x20&]+$/', $school) !== 1) {
        array_push($err, '#school_name_input');
    }
    if (preg_match('/^(\+?\d{1,4}[- ]?)?\d{10}$/', $mob1) !== 1) {
        array_push($err, '#mob_input');
    }
    if (preg_match('/^(\+?\d{1,4}[- ]?)?\d{10}$/', $mob2) !== 1) {
        array_push($err, '#mob_input2');
    }
    if (! filter_var($email1, FILTER_VALIDATE_EMAIL)) {
        array_push($err, '#email_input');
    }
    if (! filter_var($email2, FILTER_VALIDATE_EMAIL)) {
        array_push($err, '#email_input2');
    }
    $dob1 = strtotime($dob1);
    if ($dob1) {
        $dob1 = date('Y-m-d', $dob1);
    } else {
        array_push($err, '#dob_input');
    }
    $dob2 = strtotime($dob2);
    if ($dob2) {
        $dob2 = date('Y-m-d', $dob2);
    } else {
        array_push($err, '#dob_input2');
    }
    if (is_numeric($grade1) && is_numeric(($grade2))) {
        $grade1 = intval($grade1);
        $grade2 = intval($grade2);
        if ($grade1 < 9 || $grade1 > 12 || $grade2 < 9 || $grade2 > 12) {
            array_push($err, "!radios");
        }
    }
    if (($gender1 != "M" && $gender1 != "F") || ($gender2 != "M" && $gender2 != "F")){
        array_push($err, "!radios");
    }
    $isMale1 = $gender1 == "M" ? 1 : 0;
    $isMale2 = $gender2 == "M" ? 1 : 0;
    // check: school, school addr
    $addr = substr($addr, 0, 255);

    if (! empty($err)) {
        $return['status'] = "wrong";
        $return['msg'] = "Params missing";
        $return['erring_elmts_id'] = implode(', ', $err);
        exit(json_encode($return));
    }

    // loading unto mysql db
    require "../../../mysql_vars.php";

    $mysqli = new mysqli($hostname, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        $return['status'] = "error";
        error_log("Connection failed: " . mysqli_connect_error());
        $return['msg'] = "Connection failed: " . mysqli_connect_error();
        exit(json_encode($return));
    }

    // check if user already present
    $check_query = "SELECT EXISTS(SELECT 1 FROM `tosc` WHERE `email` = ? OR `email` = ? OR `team` = ?) AS 'present'";
    $present = false;
    if ($check_stmt = $mysqli->prepare($check_query)){
        if (!$check_stmt->bind_param("sss", $email1, $email2, $team)){
            $return['status'] = "error";
            error_log("binding check params failed");
            $return['msg'] = "binding check params failed";
            exit(json_encode($return));
        }
        if (!$check_stmt->execute()) {
            $return['status'] = "error";
            error_log("check execution failed");
            $return['msg'] = "check execution failed";
            exit(json_encode($return));
        }
        $check_stmt->bind_result($check_result);
        while ($check_stmt->fetch()) {
            if ($check_result) {
                $present = true;
            }
        }
    } else {
        $return['status'] = "error";
        error_log("check preparation error: " . $check_stmt->error);
        $return['msg'] = "check preparation error: " . $check_stmt->error;
        exit(json_encode($return));
    }
    $check_stmt->close();
    if ($present) {
        $return['status'] = "already present";
        $return['team'] = $team;
        $return['email1'] = $email1;
        $return['email2'] = $email2;
        exit(json_encode($return));
    }

    // else add users
    $query = "INSERT INTO `tosc` (`name`, `team`, `email`, `parent`, `dob`, `mob`, `male`, `grade`, `school`, `school_addr`, `paid`) VALUES
              (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0), (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";
    if ($stmt = $mysqli->prepare($query)) {
        if (!$stmt->bind_param("ssssssiissssssssiiss", $name1, $team, $email1, $parent_name1, $dob1, $mob1, $isMale1, $grade1,
            $school, $addr, $name2, $team, $email2, $parent_name2, $dob2, $mob2, $isMale2, $grade2, $school, $addr)) {
            $return['status'] = "error";
            error_log("binding params failed");
            $return['msg'] = "binding params failed";
            exit(json_encode($return));
        }
        if (!$stmt->execute()) {
            $return['status'] = "error";
            error_log("execution failed");
            $return['msg'] = "execution failed". $stmt->error;
            exit(json_encode($return));
        }
        $stmt->close();

    } else {
        $return['status'] = "error";
        error_log("preparation error: " . $stmt->error);
        exit(json_encode($return));
    }

    // finishing
    $return['status'] = "success";
    $return['team'] = $team;
    $return['name1'] = $name1;
    $return['name2'] = $name2;
    $return['techid2'] = $mysqli->insert_id;
    $return['techid1'] = $mysqli->insert_id - 1;

    $mysqli->close();
    exit(json_encode($return));
?>