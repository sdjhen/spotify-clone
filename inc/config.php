<?php
error_reporting(E_ALL & ~(E_NOTICE | E_STRICT));

ob_start();

// Set Timezone
$timezone = date_default_timezone_set("Europe/London");

// Start User Session
session_start();

// session_destroy();

// Create Connection
$con = mysqli_connect("localhost", "root", "", "spotifyclone");

// Check Connection
if (mysqli_connect_errno()) {
    echo "Failed to connect" . mysqli_connect_errno();
}
