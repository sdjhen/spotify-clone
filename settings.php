<?php
include("inc/includedFiles.php");
?>

<div class="entityInfo">
    <div class="centerSection">
        <div class="userInfo">
            <h1><?php echo $userLoggedIn->getUserName($con); ?></h1>
        </div>


        <div class="buttonItems">
            <button class="button">USER DETAILS</button>
            <button class="button">LOGOUT</button>
        </div>
    </div>

</div>