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

    <link type="text/css" rel="stylesheet" href="../css/build/surl.css" />
</head>
<body>
<div class="full-screen-center">
    <div id = "confirm">
        <div id="header-img">
            <img src="../assets/images/TOSClogo.png" alt="">
        </div>

        <span class ="title bad"> Payment UNSUCCESSFUL </span><br />
            If you feel you did everything correctly, please contact the team immediately.

        <a href = "../dashboard.php">Return to dashboard (automatically in 5s)</a>
    </div>
</div>


</body>
</html>
