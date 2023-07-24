<?php

// Functions to sanitise user input
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

// Call functions on register button click
if (isset($_POST['registerBtn'])) {

    $username = sanitiseFormUsername($_POST['userName']);
    $firstName = sanitiseFormString($_POST['firstName']);
    $lastName = sanitiseFormString($_POST['lastName']);
    $email = sanitiseFormString($_POST['email']);
    $email2 = sanitiseFormString($_POST['email2']);
    $password = sanitiseFormPassword($_POST['password']);
    $password2 = sanitiseFormPassword($_POST['password2']);
}
