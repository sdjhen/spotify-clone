<?php
include("../../config.php");

// Handle Ajax call
if (isset($_POST['songID'])) {
    $songID = $_POST['songID'];
    // Query Songs ID from Songs Table DB
    $query = mysqli_query($con, "SELECT * FROM Songs WHERE id='$songID'");
    // Convert query data to array
    $resultArray = mysqli_fetch_array($query);
    // Covert results to JSON & respond to Ajax call 
    echo json_encode($resultArray);
}
