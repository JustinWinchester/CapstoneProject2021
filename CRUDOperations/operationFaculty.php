<?php
// requirments
require_once('../../config/db2.php');
require_once("component2.php");

// connection to database
$con = Createdb();

// create button click
if (isset($_POST['create'])) {
    createData();
}
if (isset($_POST['update'])) {
    UpdateData();
}

if (isset($_POST['delete'])) {
    deleteRecord();
}

if (isset($_POST['deleteall'])) {
    deleteAll();
}

// inserts a faculty member into the faculty table
function createData()
{
    // initialize and set data variables
    $facultyFname = textboxValue("FacFirstName");
    $facultyLname = textboxValue("FacLastName");
    $facultyOphone = textboxValue("FacOfficePhone");
    $facultypass = textboxValue("FacPassword");
    $facultylocation = textboxValue("FacLocation");
    $facultyphone = textboxValue("FacPhone");
    $facultyemail = textboxValue("FacEmail");
    $facultydepid = textboxValue("DepID");
    $facultyroleid = textboxValue("RoleID");

    // checks for any unset values
    if ($facultyFname && $facultyLname && $facultyOphone && $facultypass && $facultyemail && $facultydepid && $facultyroleid) {

        $sql = "INSERT INTO FacultyStaff (FacFirstName, FacLastName, FacOfficePhone,FacPassword,FacLocation,FacPhone,FacEmail,DepID,RoleID)
                        VALUES ('$facultyFname','$facultyLname','$facultyOphone','$facultypass','$facultylocation','$facultyphone','$facultyemail',$facultydepid,$facultyroleid)";

        if (mysqli_query($GLOBALS['con'], $sql)) {
            TextNode("success", "Record Successfully Inserted...!");
        } else {
            // error inserting into faculty table
            echo "Error";
        }
    } else {
        // unset values produces an error
        TextNode("error", "Provide data in the Textbox");
    }
}

// trims the inputed text value and returns
function textboxValue($value)
{
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if (empty($textbox)) {
        return false;
    } else {
        return $textbox;
    }
}



//messages
function TextNode($classname, $msg)
{
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}



//get data from mysql dataBASE!!!YAY!
function getData()
{
    $sql = "SELECT * FROM Faculty";
    $result = mysqli_query($GLOBALS['con'], $sql);
    if (mysqli_num_rows($result) > 0) {
        return $result;
    }
}

// update data
function UpdateData()
{
    $facultyid = textboxValue("faculty_id");
    $facultyFname = textboxValue("FacFirstName");
    $facultyLname = textboxValue("FacLastName");
    $facultyOphone = textboxValue("FacOfficePhone");
    $facultypass = textboxValue("FacPassword");
    $facultylocation = textboxValue("FacLocation");
    $facultyphone = textboxValue("FacPhone");
    $facultyemail = textboxValue("FacEmail");
    $facultydepid = textboxValue("DepID");
    $facultyroleid = textboxValue("RoleID");

    if ($facultyFname && $facultyLname && $facultyOphone && $facultypass && $facultylocation && $facultyphone && $facultyemail && facultydepid && facultyroleid) {
        $sql = "
                      UPDATE Faculty SET FacFirstName='$facultyFname', FacLastName = '$facultyLname', FacOfficePhone = '$facultyOphone', FacPassword = '$facultypass', FacLocation = '$facultylocation',FacPhone = '$facultyphone', FacEmail = '$facultyemail' DepID = '$facultydepid' RoldID = '$facultyroleid' WHERE FID='$facultyid';
          ";

        if (mysqli_query($GLOBALS['con'], $sql)) {
            TextNode("success", "Data Successfully Updated");
        } else {
            TextNode("error", "Unable to Update Data");
        }
    } else {
        TextNode("error", "Select Data Using Edit Icon");
    }
}


function deleteRecord()
{
    $facultyid = (int)textboxValue("faculty_id");

    $sql = "DELETE FROM Faculty WHERE FacID=$facultyid";

    if (mysqli_query($GLOBALS['con'], $sql)) {
        TextNode("success", "Record Deleted Successfully...!");
    } else {
        TextNode("error", "Unable to Delete Record...!");
    }
}


function deleteBtn()
{
    $result = getData();
    $i = 0;
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $i++;
            if ($i > 3) {
                buttonElement("btn-deleteall", "btn btn-danger", "<i class='fas fa-trash'></i> Delete All", "deleteall", "");
                return;
            }
        }
    }
}


function deleteAll()
{
    $sql = "DROP TABLE Faculty";

    if (mysqli_query($GLOBALS['con'], $sql)) {
        TextNode("success", "All Record deleted Successfully...!");
        Createdb();
    } else {
        TextNode("error", "Something Went Wrong Record cannot deleted...!");
    }
}


// set id to textbox
function setID()
{
    $getid = getData();
    $id = 0;
    if ($getid) {
        while ($row = mysqli_fetch_assoc($getid)) {
            $id = $row['FacID'];
        }
    }
    return ($id + 1);
}
