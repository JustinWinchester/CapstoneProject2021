<?php

require_once ("../../config/db1.php");
require_once ("component2.php");

$con = Createdb();

// create button click
if(isset($_POST['create'])){
    createData();
}
if(isset($_POST['update'])){
    UpdateData();
}

if(isset($_POST['delete'])){
    deleteRecord();
}

if(isset($_POST['deleteall'])){
    deleteAll();

}


function createData(){
    $studentname = textboxValue("student_name");
    $studentcourse = textboxValue("student_course");
    $studentmajor = textboxValue("student_major");

    if($studentname && $studentcourse && $studentmajor){

        $sql = "INSERT INTO students (student_name, student_course, student_major)
                        VALUES ('$studentname','$studentcourse','$studentmajor')";

        if(mysqli_query($GLOBALS['con'], $sql)){
          TextNode("success","Record Successfully Inserted...!");

        }else{
            echo "Error";
        }

    }else{
            TextNode("error","Provide data in the Textbox");
    }
}

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}



//messages
function TextNode($classname,$msg){
  $element="<h6 class='$classname'>$msg</h6>";
  echo $element;
}



//get data form mysql dataBASE!!!YAY!
function getData(){
  $sql= "SELECT * FROM students";
  $result = mysqli_query($GLOBALS['con'],$sql);
  if(mysqli_num_rows($result)>0){
    return $result;
    }
  }
  // update data
  function UpdateData(){
      $studentid = textboxValue("student_id");
      $studentname = textboxValue("student_name");
      $studentcourse = textboxValue("student_course");
      $studentmajor = textboxValue("student_major");

      if($studentname && $studentcourse && $studentmajor){
          $sql = "
                      UPDATE students SET student_name='$studentname', student_course = '$studentcourse', student_major = '$studentmajor' WHERE id='$studentid';
          ";

          if(mysqli_query($GLOBALS['con'], $sql)){
              TextNode("success", "Data Successfully Updated");
          }else{
              TextNode("error", "Enable to Update Data");
          }

      }else{
          TextNode("error", "Select Data Using Edit Icon");
      }


  }


  function deleteRecord(){
      $studentid = (int)textboxValue("student_id");

      $sql = "DELETE FROM students WHERE id=$studentid";

      if(mysqli_query($GLOBALS['con'], $sql)){
          TextNode("success","Record Deleted Successfully...!");
      }else{
          TextNode("error","Unable to Delete Record...!");
      }

  }


  function deleteBtn(){
      $result = getData();
      $i = 0;
      if($result){
          while ($row = mysqli_fetch_assoc($result)){
              $i++;
              if($i > 3){
                  buttonElement("btn-deleteall", "btn btn-danger" ,"<i class='fas fa-trash'></i> Delete All", "deleteall", "");
                  return;
              }
          }
      }
  }


  function deleteAll(){
      $sql = "DROP TABLE students";

      if(mysqli_query($GLOBALS['con'], $sql)){
          TextNode("success","All Record deleted Successfully...!");
          Createdb();
      }else{
          TextNode("error","Something Went Wrong Record cannot deleted...!");
      }
  }


  // set id to textbox
  function setID(){
      $getid = getData();
      $id = 0;
      if($getid){
          while ($row = mysqli_fetch_assoc($getid)){
              $id = $row['id'];
          }
      }
      return ($id + 1);
  }
