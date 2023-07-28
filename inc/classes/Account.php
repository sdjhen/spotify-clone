<?php

class Account
{
    private $con;
    private $errorArray;

    public function __construct($con)
    {
        $this->con = $con;
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
            return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
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

    private function insertUserDetails($un, $fn, $ln, $em, $pw)
    {
        $encrypted_pw = password_hash($pw, PASSWORD_BCRYPT);
        $profile_pic = "assets/img/profilepics/profile.png";
        $date = date("Y-m-d");
        $result = mysqli_query($this->con, "INSERT INTO users (username, firstname, lastname, email, password, registerdate, profilepic) VALUES ('$un', '$fn', '$ln', '$em', '$encrypted_pw', '$date', '$profile_pic')");

        return $result;
    }


    private function validateUsername($un)
    {
        if (strlen($un) > 25 || strlen($un) < 5) {
            array_push($this->errorArray, Constants::$username_Characters);
            return;
        }

        $check_UsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE usernname = '$un'");
        if (mysqli_num_rows($check_UsernameQuery) != 0) {
            array_push($this->errorArray, Constants::$username_Taken);
            return;
        }
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

        $check_EmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email = '$em'");
        if (mysqli_num_rows($check_EmailQuery) != 0) {
            array_push($this->errorArray, Constants::$email_Taken);
            return;
        }
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
