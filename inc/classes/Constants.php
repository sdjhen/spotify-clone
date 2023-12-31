<?php
class Constants
{
    // Register Error Messages

    public static $passwords_DoNotMatch = "Your passwords don't match!";

    public static $passwords_NotAlphaNumeric = "Your password can only contain letters and numbers";

    public static $passwords_Characters = "Your password must be between 6 and 30 characters";

    public static $emails_Invalid = "Email is invalid";

    public static $emails_DoNotMatch = "Your emails don't match!";

    public static $email_Taken = "An account has already been registered with this email";

    public static $firstname_Characters = "Your first name should be between 2 and 25 characters";

    public static $lastname_Characters = "Your last name should be between 2 and 25 characters";

    public static $username_Characters = "Your username must be between 5 and 25 characters";

    public static $username_Taken = " This username already exists";

    //Login Error Messages

    public static $login_Failed = " Your username or password was incorrect";
}
