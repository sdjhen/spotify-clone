<?php

class Account
{

    private $errorArray;

    public function __construct()
    {
        $this->errorArray = array();
    }

    public function register($un, $fn, $ln, $em, $em2, $pw, $pw2)
    {
        // Call Validate functions
        $this->validateUsername($un);
        $this->validateFirstname($fn);
        $this->validateLastname($ln);
        $this->validateEmails($em, $em2);
        $this->validatePasswords($pw, $pw2);

        if (empty($this->errorArray) == true) {
            // Insert into DB
            return true;
        } else {
            return false;
        }
    }

    public function getError($error)
    {
        if (!in_array($error, $this->errorArray)) {
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }


    private function validateUsername($un)
    {
        if (strlen($un) > 25 || strlen($un) < 5) {
            array_push($this->errorArray, Constants::$username_Characters);
            return;
        }

        //TODO: Check if username exists
    }

    private function validateFirstname($fn)
    {
        if (strlen($fn) > 25 || strlen($fn) < 2) {
            array_push($this->errorArray, Constants::$firstname_Characters);
            return;
        }
    }

    private function validateLastname($ln)
    {
        if (strlen($ln) > 25 || strlen($ln) < 2) {
            array_push($this->errorArray, Constants::$lastname_Characters);
            return;
        }
    }

    private function validateEmails($em, $em2)
    {
        if ($em != $em2) {
            array_push($this->errorArray, Constants::$emails_DoNotMatch);
            return;
        }
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emails_Invalid);
            return;
        }

        // if () {
        //     //TODO: Check username hasn't been used
        // }

    }

    private function validatePasswords($pw, $pw2)
    {
        if ($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwords_DoNotMatch);
            return;
        }

        if (preg_match('/[^A-Za-z0-9]/', $pw)) {
            array_push($this->errorArray, Constants::$passwords_NotAlphaNumeric);
            return;
        }

        if (strlen($pw) > 30 || strlen($pw) < 6) {
            array_push($this->errorArray, Constants::$passwords_Characters);
            return;
        }
    }
}
