<?php

// Sanitise user input functions
function sanitiseFormPassword($inputText)
{

    $inputText = strip_tags($inputText);
    return $inputText;
}

function sanitiseFormUsername($inputText)
{

    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    return $inputText;
}

function sanitiseFormString($inputText)
{

    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    $inputText = ucfirst(strtolower($inputText));
    return $inputText;
}

// Call sanitise functions on register button click
if (isset($_POST['registerBtn'])) {

    $username = sanitiseFormUsername($_POST['username']);
    $firstname = sanitiseFormString($_POST['firstname']);
    $lastname = sanitiseFormString($_POST['lastname']);
    $email = sanitiseFormString($_POST['email']);
    $email2 = sanitiseFormString($_POST['email2']);
    $password = sanitiseFormPassword($_POST['password']);
    $password2 = sanitiseFormPassword($_POST['password2']);

    // Call register function in Account Class 
    $was_successful = $account->register($username, $firstname, $lastname, $email, $email2, $password, $password2);

    // Redirect to index if login succeeds
    if ($was_successful == true) {
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }
}
