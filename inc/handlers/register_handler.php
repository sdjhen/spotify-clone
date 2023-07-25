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

    $username = sanitiseFormUsername($_POST['userName']);
    $firstName = sanitiseFormString($_POST['firstName']);
    $lastName = sanitiseFormString($_POST['lastName']);
    $email = sanitiseFormString($_POST['email']);
    $email2 = sanitiseFormString($_POST['email2']);
    $password = sanitiseFormPassword($_POST['password']);
    $password2 = sanitiseFormPassword($_POST['password2']);
}

// Call Account Class 
$was_successful = $account->register($username, $firstName, $lastName, $email, $email2, $password, $password2);

// Redirect to index if login succeeds
if ($was_successful == true) {
    header("Location: index.php");
}
