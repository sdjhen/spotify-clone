<?php
include("../../config.php");

// Handle Ajax call
if (isset($_POST['songID'])) {
    $songID = $_POST['songID'];
    // Update Songs play count
    $query = mysqli_query($con, "UPDATE Songs SET plays = plays + 1 WHERE id='$songID'");
}
