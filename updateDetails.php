<?php
include("inc/includedFiles.php");
?>
<script>
    const updateEmail = (emailClass) => {
        const emailValue = $('.' + emailClass).val();

        $.post('inc/handlers/Ajax/updateEmail.php', {
            email: emailValue,
            username: userLoggedIn,

        }).done(function(response) {
            $('.' + emailClass)
                .nextAll('.message') // update email span with ajax response data
                .text(response);
        });
    };

    const updatePassword = (oldPasswordClass, newPasswordClass1, newPasswordClass2) => {
        const oldPassword = $('.' + oldPasswordClass).val();
        const newPassword1 = $('.' + newPasswordClass1).val();
        const newPassword2 = $('.' + newPasswordClass2).val();
        // Send new Passwords
        $.post('inc/handlers/Ajax/updatePassword.php', {
            oldPassword: oldPassword,
            newPassword1: newPassword1,
            newPassword2: newPassword2,
            username: userLoggedIn,

        }).done(function(response) {
            $('.' + oldPasswordClass)
                .nextAll('.message')
                .text(response);
        });
    }
</script>

<div class="userDetails">
    <div class="container borderBottom">
        <h2>EMAIL</h2>
        <input type="text" class="email" name="email" placeholder="Email address...">
        <span class="message"></span>
        <button class="button" onclick="updateEmail('email')">SAVE</button>
    </div>


    <div class="container">
        <h2>PASSWORD</h2>
        <input type="password" class="oldPassword" name="oldPassword" placeholder="Current Password...">
        <input type="password" class="newPassword1" name="newPassword1" placeholder="New Password...">
        <input type="password" class="newPassword2" name="newPassword2" placeholder="Confirm Password...">
        <span class="message"></span>
        <button class="button" onclick=" updatePassword('oldPasword', 'newPassword1', 'newPassword2')">SAVE</button>
    </div>

</div>