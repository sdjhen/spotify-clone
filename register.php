<?php
include("inc/config.php");
include("inc/classes/Account.php");
include("inc/classes/Constants.php");

// Instantiate Account class
$account = new Account($con);

include("inc/handlers/register_handler.php");
include("inc/handlers/login_handler.php");

// Remember form values if already set
function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
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
                <?php echo $account->getError(Constants::$username_Characters); ?>
                <?php echo $account->getError(Constants::$username_Taken); ?>
                <label for="username">Username:</label>
                <input id="username" name="username" type="text" placeholder="Username" value="<?php getInputValue('username') ?>" required>
            </p>

            <p>
                <?php echo $account->getError(Constants::$firstname_Characters); ?>
                <label for="firstname">First Name:</label>
                <input id="firstname" name="firstname" type="text" placeholder="First Name" value="<?php getInputValue('firstname') ?>" required>
            </p>

            <p>
                <?php echo $account->getError(Constants::$lastname_Characters); ?>
                <label for="lastname">Last Name:</label>
                <input id="lastname" name="lastname" type="text" placeholder="Last Name" value="<?php getInputValue('lastname') ?>" required>
            </p>

            <p>
                <?php echo $account->getError(Constants::$emails_DoNotMatch); ?>
                <?php echo $account->getError(Constants::$emails_Invalid); ?>
                <label for="email">Email:</label>
                <input id="email" name="email" type="email" placeholder="Email" value="<?php getInputValue('email') ?>" required>
            </p>

            <p>
                <label for="email2"> Confirm Email:</label>
                <input id="email2" name="email2" type="email" placeholder="Email" value="<?php getInputValue('email2') ?>" required>
            </p>

            <p>
                <?php echo $account->getError(Constants::$passwords_DoNotMatch); ?>
                <?php echo $account->getError(Constants::$passwords_NotAlphaNumeric); ?>
                <?php echo $account->getError(Constants::$passwords_Characters); ?>
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