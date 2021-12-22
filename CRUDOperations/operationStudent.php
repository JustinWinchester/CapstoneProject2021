<?php
// requirments
require_once("../../config/db.php");
require_once("component2.php");

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


function createData()
{
    $studentFname = textboxValue("StudFirstName");
    $studentLname = textboxValue("StudLastName");
    $studentaddress = textboxValue("StudAddress");
    $studentcity = textboxValue("StudCity");
    $studentcountry = textboxValue("StudCountry");
    $studentphone = textboxValue("StudPhone");
    $studentemail = textboxValue("StudEmail");
    $studentdob = textboxValue("StudDOB");
    $studentenrolled = textboxValue("StudEnrolled");
    $studentpass = textboxValue("StudPassword");
    $studentPIN = textboxValue("StudPin");
    $studentmajid = textboxValue("MajID");
    $studentclassid = textboxValue("ClassID");



    if ($studentFname && $studentLname && $studentaddress && $studentcity && $studentcountry && $studentphone && $studentemail && $studentdob && $studentenrolled && $studentpass && $studentPIN && $studentmajid && $studentclassid) {

        $sql = "INSERT INTO Student (StudFirstName, StudLastName, StudAddress,StudCity,StudCountry,StudPhone,StudEmail,StudDOB,StudEnrolled,StudPassword,StudPin,MajID,ClassID)
                        VALUES ('$studentFname','$studentLname','$studentaddress','$studentcity','$studentcountry','$studentphone','$studentemail','$studentdob','$studentenrolled','$studentpass','$studentPIN','$studentmajid','$studentclassid')";

        if (mysqli_query($GLOBALS['con'], $sql)) {
            TextNode("success", "Record Successfully Inserted...!");
        } else {
            echo "Error";
        }
    } else {
        TextNode("error", "Provide data in the Textbox");
    }
}

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
    $sql = "SELECT * FROM Student";
    $result = mysqli_query($GLOBALS['con'], $sql);
    if (mysqli_num_rows($result) > 0) {
        return $result;
    }
}
// update data
function UpdateData()
{
    $studentsid = textboxValue("students_id");
    $studentFname = textboxValue("StudFirstName");
    $studentLname = textboxValue("StudLastName");
    $studentaddress = textboxValue("StudAddress");
    $studentcity = textboxValue("StudCity");
    $studentcountry = textboxValue("StudCountry");
    $studentphone = textboxValue("StudPhone");
    $studentemail = textboxValue("StudEmail");
    $studentdob = textboxValue("StudDOB");
    $studentenrolled = textboxValue("StudEnrolled");
    $studentpass = textboxValue("StudPassword");
    $studentPIN = textboxValue("StudPin");
    $studentmajid = textboxValue("MajID");
    $studentclassid = textboxValue("ClassID");
    if ($studentFname && $studentLname && $studentaddress && $studentcity && $studentcountry && $studentphone && $studentemail && $studentdob && $studentenrolled && $studentpass && $studentPIN && $studentfid && $studentmid) {
        $sql = "
                      UPDATE Student SET StudFirstName='$studentFname', StudLastName = '$studentLname', StudAddress = '$studentaddress', StudCity = '$studentcity', StudCountry = '$studentcountry',StudPhone = '$studentphone', StudEmail = '$studentemail', StudDOB = '$studentdob', StudEnrolled = '$studentenrolled',StudPassword = '$studentpass', StudPin = '$studentPIN', MajID = '$studentmajid', ClassID = '$studentclassid' WHERE StudID='$studentsid';
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

// delete a specific student
function deleteRecord()
{
    $studentsid = (int)textboxValue("students_id");

    $sql = "DELETE FROM Student WHERE StudID=$studentsid";

    if (mysqli_query($GLOBALS['con'], $sql)) {
        TextNode("success", "Record Deleted Successfully...!");
    } else {
        TextNode("error", "Unable to Delete Record...!");
    }
}

// button to delete all
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

// drops the student table
function deleteAll()
{
    $sql = "DROP TABLE Student";

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
            $id = $row['StudID'];
        }
    }
    return ($id + 1);
}
