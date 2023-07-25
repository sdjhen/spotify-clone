<?php
include("inc/classes/Account.php");

// Instantiate Account class
$account = new Account();

include("inc/handlers/register_handler.php");
include("inc/handlers/login_handler.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotifly | Clone</title>
</head>

<body>
    <div id="inputContainer">
        <form id="loginForm" action="register.php" method="POST">
            <h2>Login to your account.</h2>
            <p>
                <label for="loginUsername">Username:</label>
                <input id="loginUsername" name="loginUsername" type="text" placeholder="Username" required>
            </p>
            <p>
                <label for="loginPassword">Password:</label>
                <input id="loginPassword" name="loginPassword" type="password" placeholder="Password" required>
            </p>
            <button type="submit" name="loginBtn">Log In</button>
        </form>

        <form id="registerForm" action="register.php" method="POST">
            <h2>Create your free account.</h2>
            <p>
                <?php echo $account->getError("Your username must be between 5 and 25 characters"); ?>
                <label for="username">Username:</label>
                <input id="username" name="username" type="text" placeholder="Username" required>
            </p>

            <p>
                <?php echo $account->getError("Your first name should be between 2 and 25 characters"); ?>
                <label for="firstname">First Name:</label>
                <input id="firstname" name="firstname" type="text" placeholder="First Name" required>
            </p>

            <p>
                <?php echo $account->getError("Your last name should be between 2 and 25 characters"); ?>
                <label for="lastname">Last Name:</label>
                <input id="lastname" name="lastname" type="text" placeholder="Last Name" required>
            </p>

            <p>
                <?php echo $account->getError("Your emails don't match!"); ?>
                <?php echo $account->getError("Email is invalid"); ?>
                <label for="email">Email:</label>
                <input id="email" name="email" type="email" placeholder="Email" required>
            </p>

            <p>
                <label for="email2"> Confirm Email:</label>
                <input id="email2" name="email2" type="email" placeholder="Email" required>
            </p>

            <p>
                <?php echo $account->getError("Your passwords don't match!"); ?>
                <?php echo $account->getError("Your password can only contain letters and numbers"); ?>
                <?php echo $account->getError("Your password must be between 6 and 30 characters"); ?>
                <label for="password">Password:</label>
                <input id="password" name="password" type="password" placeholder="Password" required>
            </p>

            <p>
                <label for="password2"> Confirm Password:</label>
                <input id="password2" name="password2" type="password" placeholder=" Confirm Password" required>
            </p>
            <button type="submit" name="registerBtn">Register</button>
        </form>
    </div>
</body>

</html>