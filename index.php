<?php
include("inc/config.php");

// Set session variable
if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    // Redirect to registration page if not set
    header("Location: register.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Welcome | Spotify Clone</title>
</head>

<body>
    <h1>Hello!</h1>
</body>

</html>