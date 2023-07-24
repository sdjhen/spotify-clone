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

// Validate user input functions
function validateUsername($un)
{
}

function validateFirstname($fn)
{
}

function validateLastname($ln)
{
}

function validateEmails($em, $em2)
{
}

function validatePasswords($pw, $pw2)
{
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

    // Call Validate functions
    validateUsername($username);
    validateFirstname($firstName);
    validateLastname($lastName);
    validateEmails($email, $email2);
    validatePasswords($password, $password2);

}
