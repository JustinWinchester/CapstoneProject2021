<?php

function Createdb()
{
    $servername = "localhost";
    $username = "cs12";
    $password = "CUaDGKK8";
    $dbname = "cs12";

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
                CREATE TABLE IF NOT EXISTS Student
                (
                  StudID INT NOT NULL AUTO_INCREMENT,
                  StudFirstName VARCHAR(30),
                  StudLastName VARCHAR(30),
                  StudAddress VARCHAR(30),
                  StudCity VARCHAR(30),
                  StudCountry VARCHAR(30),
                  StudPhone VARCHAR(14),
                  StudEmail VARCHAR(30),
                  StudDOB DATE,
                  StudEnrolled DATE,
                  StudPassword VARCHAR(30),
                  StudPin INT,
                  MajID INT NOT NULL,
                  ClassID INT NOT NULL,
                  PRIMARY KEY (StudID),
                  FOREIGN KEY (MajID) REFERENCES Major(MajID),
                  FOREIGN KEY (ClassID) REFERENCES Classification(ClassID)
                );        ";

        if (mysqli_query($con, $sql)) {
            return $con;
        } else {
            echo "Cannot Create table...!";
        }
    } else {
        echo "Error while creating database " . mysqli_error($con);
    }
}
