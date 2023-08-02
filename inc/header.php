<?php
include("inc/config.php");
include("inc/classes/Artist.php");
include("inc/classes/Album.php");

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <title> Welcome | Samify</title>
</head>

<body>

    <main id="mainContainer">
        <div id="topContainer">

            <?php include("inc/navbarContainer.php"); ?>
            <div id="mainViewContainer">

                <div id="mainContent">