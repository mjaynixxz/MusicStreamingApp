<?php
    ob_start();
    session_start();

    $timezone = date_default_timezone_set("Europe/London");

    $connection = mysqli_connect('localhost', 'root', '', 'StreamMe');

    if(mysqli_connect_errno()) {
        echo "Failed to Connect: " . mysqli_connect_errno();
    }

?>