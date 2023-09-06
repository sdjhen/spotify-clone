<?php
include("inc/includedFiles.php");
?>

<div class="entityInfo">
    <div class="centerSection">
        <div class="userInfo">
            <h1><?php echo $userLoggedIn->getUserName($con); ?></h1>
        </div>


        <div class="buttonItems logout">
            <button class="button" onclick="openPage('updateDetails.php')">USER DETAILS</button>
            <button class="button" onclick="logout()">LOGOUT</button>
        </div>
    </div>

</div>