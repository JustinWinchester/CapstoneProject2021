<?php

function Createdb()
{
    $servername = "localhost";
    $username = "cs09";
    $password = "CUpQdSsj";
    $dbname = "cs09";

    // create connection
    $con = mysqli_connect($servername, $username, $password, $dbname);

    // Check Connection
    if (!$con) {
        die("Connection Failed : " . mysqli_connect_error());
    }

    // create Database
    $sql = "USE $dbname";

    if (mysqli_query($con, $sql)) {
        $con = mysqli_connect($servername, $username, $password, $dbname);

        $sql = "
        CREATE TABLE IF NOT EXISTS students(
                                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                student_name VARCHAR (25) NOT NULL,
                                student_course VARCHAR (40),
                                student_major VARCHAR (40)
                            );

   ";

        if (mysqli_query($con, $sql)) {
            return $con;
        } else {
            echo "Cannot Create table...!";
        }
    } else {
        echo "Error while creating database " . mysqli_error($con);
    }
}
