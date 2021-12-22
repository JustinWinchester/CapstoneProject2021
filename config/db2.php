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
        CREATE TABLE IF NOT EXISTS Faculty
                (
                  FacID INT NOT NULL AUTO_INCREMENT,
                  FacFirstName VARCHAR(30),
                  FacLastName VARCHAR(30),
                  FacOfficePhone VARCHAR(14),
                  FacPassword VARCHAR(50),
                  FacLocation VARCHAR(20),
                  FacPhone VARCHAR(14),
                  FacEmail VARCHAR(30),
                  DepID INT NOT NULL,
                  RoleID INT NOT NULL,
                  PRIMARY KEY (FacID),
                  FOREIGN KEY (DepID) REFERENCES Department(DepID),
                  FOREIGN KEY (RoleID) REFERENCES FacRole(RoleID)
                );       ";

        if (mysqli_query($con, $sql)) {
            return $con;
        } else {
            echo "Cannot Create table...!";
        }
    } else {
        echo "Error while creating database ". mysqli_error($con);
    }
}
