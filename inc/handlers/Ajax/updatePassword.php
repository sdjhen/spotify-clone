<?php
include("../../config.php");

if (!isset($_POST['username'])) {
    echo "ERROR: Could not set username";
    exit();
}

if (!isset($_POST['oldPassword']) || !isset($_POST['newPassword1']) || !isset($_POST['newPassword2'])) {
    echo "Not all passwords have been set.";
    exit();
}

if (($_POST['oldPassword'] == "") || ($_POST['newPassword1'] == "") || ($_POST['newPassword2']) == "") {
    echo "Please fill in all fields.";
    exit();
}

// At this point, user has successfully filled in fields
$username = $_POST['username'];
$oldPassword = $_POST['oldPassword1'];
$newPassword1 = $_POST['newPassword1'];
$newPassword2 = $_POST['newPassword2'];

$old_pwHash = password_hash($oldPassword, PASSWORD_BCRYPT);

$passwordCheck = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$old_pwHash'");
if (mysqli_num_rows($passwordCheck) != 1) {
    echo "Password is incorrect";
    exit();
}

// Verify new passwords match
if ($newPassword1 != $newPassword2) {
    echo "Your new passwords do not match.";
    exit();
}

// Verify password contains acceptable chars
if (preg_match('/[^A-Za-z0-9/]', $newPassword1)) {
    echo "Your password must only contain letters and/ornumbers";
    exit();
}

// Verify password length
if (strlen($newPassword1 > 30 || strlen($newPassword1 < 5))) {
    echo "Your password must be between 5 and 30 characters";
}

// Hash new password in DB
$new_pwHash = password_hash($newPassword1, PASSWORD_BCRYPT);

$query = mysqli_query($con, "UPDATE users SET password='$new_pwHash' WHERE username='$username'");
echo "Updated successful";
