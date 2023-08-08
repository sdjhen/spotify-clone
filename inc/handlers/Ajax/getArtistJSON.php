<?php
include("../../config.php");

// Handle Ajax call
if (isset($_POST['artistID'])) {
    $artistID = $_POST['artistID'];
    // Query Songs ID from Songs Table DB
    $query = mysqli_query($con, "SELECT * FROM artists WHERE id='$artistID'");
    // Convert query data to array
    $resultArray = mysqli_fetch_array($query);
    // Covert results to JSON & respond to Ajax call 
    echo json_encode($resultArray);
}
