<?php

class User
{
    private $con;
    private $username;


    public function __construct($con, $username)
    {
        $this->con = $con;
        $this->username = $username;
    }

    public function getUsername($con)
    {
        $query = "SELECT username FROM users";
        $result = mysqli_query($con, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row['username'];
        }
    }
}
