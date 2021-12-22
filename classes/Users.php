<?php

include '../../lib/Database.php';
include_once '../../lib/Session.php';


class Users
{


  // Db Property
  private $db;

  // Db __construct Method
  public function __construct()
  {
    $this->db = new Database();
  }


  // Check Exist Email Address Method
  public function checkExistEmail($email)
  {
    $sql = "SELECT * FROM Emails WHERE email = :email";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }



  // User Registration Method
  public function userRegistration($data)
  {
    $facfname = $data['FacultyFirstName'];
    $faclname = $data['FacultyLastName'];
    $email = $data['FacEmail'];
    $facOphone = $data['FacultyOfficePhone'];
    $roleid = $data['RoleID'];
    $password = $data['FacPassword'];

    $checkEmail = $this->checkExistEmail($email);

    if ($facfname == "" || $faclname == "" || $email == "" || $facOphone == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Please, User Registration field must not be Empty !</div>';
      return $msg;
    } elseif (strlen($faclname) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Last name is too short, at least 3 Characters !</div>';
      return $msg;
    } elseif (filter_var($facOphone, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Enter only Number Characters for Faculty Office number field !</div>';
      return $msg;
    } elseif (strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			 <strong>Error !</strong> Password at least 6 Characters !</div>';
      return $msg;
    } elseif (!preg_match("#[0-9]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
      return $msg;
    } elseif (!preg_match("#[a-z]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
      return $msg;
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Invalid email address !</div>';
      return $msg;
    } elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Email already Exists, please try another Email... !</div>';
      return $msg;
    } else {

      $sql = "INSERT INTO Faculty(FacultyFirstName, FacultyLastName, FacEmail, FacPassword, FacOfficePhone, RoleID) VALUES(:facfname, :faclname, :email, :password, :facOphone, :roleid)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':facfname', $facfname);
      $stmt->bindValue(':faclname', $faclname);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', SHA1($password));
      $stmt->bindValue(':facOphone', $facOphone);
      $stmt->bindValue(':roleid', $roleid);
      $result = $stmt->execute();

      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success !</strong> Wow, you have Registered Successfully !</div>';
        return $msg;
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> Something went Wrong !</div>';
        return $msg;
      }
    }
  }
  // Add New User By Admin
  public function addNewUserByAdmin($data)
  {
    $facfname = $data['FacFirstName'];
    $faclname = $data['FacLastName'];
    $facOphone = $data['FacOfficePhone'];
    $password = $data['FacPassword'];
    $faclocation = $data['FacLocation'];
    $facphone = $data['FacPhone'];
    $email = $data['FacEmail'];
    $depid = $data['DepID'];
    $roleid = $data['RoleID'];
    $isactive = $data['isActive'];

    $checkEmail = $this->checkExistEmail($email);

    if ($facfname == "" || $faclname == "" || $email == "" || $facOphone == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Input fields must not be Empty !</div>';
      return $msg;
    } elseif (strlen($faclname) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Last name is too short, at least 3 Characters !</div>';
      return $msg;
    } elseif (filter_var($facOphone, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Enter only Number Characters for Faculty Office number field !</div>';
      return $msg;
    } elseif (strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Password at least 6 Characters !</div>';
      return $msg;
    } elseif (!preg_match("#[0-9]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
      return $msg;
    } elseif (!preg_match("#[a-z]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
      return $msg;
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Invalid email address !</div>';
      return $msg;
    } elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Email already Exists, please try another Email... !</div>';
      return $msg;
    } else {

      $sql = "INSERT INTO Faculty (FacFirstName, FacLastName, FacOfficePhone, FacPassword, FacLocation, FacPhone,FacEmail,DepID,RoleID,isActive) VALUES(:facfname, :faclname, :facOphone,:password,:faclocation,:facphone,:email,:depid,:roleid,:isactive)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':facfname', $facfname);
      $stmt->bindValue(':faclname', $faclname);
      $stmt->bindValue(':facOphone', $facOphone);
      $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
      $stmt->bindValue(':faclocation', $faclocation);
      $stmt->bindValue(':facphone', $facphone);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':depid', $depid);
      $stmt->bindValue(':roleid', $roleid);
      $stmt->bindValue(':isactive', $isactive);
      $result = $stmt->execute();

      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success !</strong> Wow, you have Registered Successfully !</div>';
        return $msg;
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> Something went Wrong !</div>';
        return $msg;
      }
    }
  }




  // Add New User By Admin
  public function CUENROLL($data)
  {
    $adviserstudentid = $data['StudID'];
    $advisersectid = $data['SectID'];
    $grade = $data['Grade'];

    //  $checkEmail = $this->checkExistEmail($email);

    if ($adviserstudentid == "" || $advisersectid == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> STUDENT & SECTION Input fields must not be Empty ! GRADE (OPTIONAL)</div>';
      return $msg;
    } elseif (strlen($adviserstudentid) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> User Identification Number Is Incorrect Length  !</div>';
      return $msg;
    } elseif (filter_var($advisersectid, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Enter only Numbers for Section Identification field !</div>';
      return $msg;
    } elseif (filter_var($adviserstudentid, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Enter only Numbers for Student Identification Value !</div>';
      return $msg;
    } else {

      $sql = "INSERT INTO History (StudID, SectID, Grade)  VALUES(:adviserstudentid, :advisersectid, :grade)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':adviserstudentid', $adviserstudentid);
      $stmt->bindValue(':advisersectid', $advisersectid);
      $stmt->bindValue(':grade', $grade);

      $result = $stmt->execute();

      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success !</strong> Wow, you have CU Enrolled Successfully !</div>';
        return $msg;
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> OOPS  Something went Wrong !</div>';
        return $msg;
      }
    }
  }

  // add a new applicant
  public function addNewApplicant($data)
  {
    $studfname = $data['FsName'];
    $studlname = $data['LsName'];
    $studaddress = $data['Addrs'];
    $studcity = $data['Cty'];
    $studcountry = $data['CountryC'];
    $studphone = $data['PhNum'];
    $email = $data['EmailE'];

    $studdob = $data['DateOB'];
    $password = $data['password'];
    $classid = $data['Clss'];
    $majid = $data['Majr'];
    $roleid = $data['RoleR'];

    $checkEmail = $this->checkExistEmail($email);

    if ($studfname == "" || $studlname == "" || $email == "" || $studphone == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Input fields must not be Empty !</div>';
      return $msg;
    } elseif (strlen($studlname) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Last name is too short, at least 3 Characters !</div>';
      return $msg;
    } elseif (filter_var($studphone, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Enter only Numbers for Student Phone Number Field !</div>';
      return $msg;
    } elseif (strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Password at least 6 Characters !</div>';
      return $msg;
    } elseif (!preg_match("#[0-9]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
      return $msg;
    } elseif (!preg_match("#[a-z]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Your Password Must Contain At Least 1 Letter !</div>';
      return $msg;
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Invalid email address !</div>';
      return $msg;
    } elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Email already Exists, please try another Email... !</div>';
      return $msg;
    } else {


      $sql = "INSERT INTO Applicant (AppFirstName, AppLastName, AppAddress, AppCity, AppCountry, AppPhone, AppEmail, AppDOB, AppPassword, MajID, ClassID, RoleID, isActive) VALUES(:studfname, :studlname, :studaddress,:studcity,:studcountry,:studphone,:email,:studdob, :password, :majid, :classid,:roleid, 1)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':studfname', $studfname);
      $stmt->bindValue(':studlname', $studlname);
      $stmt->bindValue(':studaddress', $studaddress);
      $stmt->bindValue(':studcity', $studcity);
      $stmt->bindValue(':studcountry', $studcountry);
      $stmt->bindValue(':studphone', $studphone);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':studdob', $studdob);
      $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
      $stmt->bindValue(':majid', $majid);
      $stmt->bindValue(':classid', $classid);
      $stmt->bindValue(':roleid', $roleid);

      $result = $stmt->execute();

      if ($result) {

        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Success !</strong> Wow, you have Registered Successfully !</div>';
        return $msg;
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Error !</strong> Something went Wrong !</div>';
        return $msg;
      }
    }
  }


  // add a new student by admin
  public function addNewStudentUserByAdmin($data)
  {
    $studfname = $data['StudFirstName'];
    $studlname = $data['StudLastName'];
    $studaddress = $data['StudAddress'];
    $studcity = $data['StudCity'];
    $studcountry = $data['StudCountry'];
    $studphone = $data['StudPhone'];
    $email = $data['StudEmail'];
    $studdob = $data['StudDOB'];
    $studenrolled = $data['StudEnrolled'];
    $password = $data['StudPassword'];
    $studpin = $data['StudPin'];
    $majid = $data['MajID'];
    $classid = $data['ClassID'];

    $roleid = $data['RoleID'];
    $isactive = $data['isActive'];

    $checkEmail = $this->checkExistEmail($email);

    if ($studfname == "" || $studlname == "" || $email == "" || $studphone == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Input fields must not be Empty !</div>';
      return $msg;
    } elseif (strlen($studlname) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Last name is too short, at least 3 Characters !</div>';
      return $msg;
    } elseif (filter_var($studphone, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Enter only Numbers for Student Phone Number Field !</div>';
      return $msg;
    } elseif (strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Password at least 6 Characters !</div>';
      return $msg;
    } elseif (!preg_match("#[0-9]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Your Password Must Contain At Least 1 Number !</div>';
      return $msg;
    } elseif (!preg_match("#[a-z]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Your Password Must Contain At Least 1 Letter !</div>';
      return $msg;
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Invalid email address !</div>';
      return $msg;
    } elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Error !</strong> Email already Exists, please try another Email... !</div>';
      return $msg;
    } else {


      $sql = "INSERT INTO Student (StudFirstName, StudLastName, StudAddress, StudCity, StudCountry, StudPhone, StudEmail, StudDOB, StudEnrolled, StudPassword, StudPin, MajID, ClassID, RoleID,isActive) VALUES(:studfname, :studlname, :studaddress,:studcity,:studcountry,:studphone,:email,:studdob, :studenrolled, :password, :studpin, :majid, :classid,:roleid,:isactive)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':studfname', $studfname);
      $stmt->bindValue(':studlname', $studlname);
      $stmt->bindValue(':studaddress', $studaddress);
      $stmt->bindValue(':studcity', $studcity);
      $stmt->bindValue(':studcountry', $studcountry);
      $stmt->bindValue(':studphone', $studphone);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':studdob', $studdob);
      $stmt->bindValue(':studenrolled', $studenrolled);
      $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
      $stmt->bindValue(':studpin', $studpin);
      $stmt->bindValue(':majid', $majid);
      $stmt->bindValue(':classid', $classid);
      $stmt->bindValue(':roleid', $roleid);

      $stmt->bindValue(':isactive', $isactive);
      $result = $stmt->execute();

      if ($result) {

        $student_id_query = "SELECT (StudID)
								   FROM Student
								   WHERE StudEmail = :email";
        $student_id = $this->db->pdo->prepare($student_id_query);
        $student_id->bindValue(':email', $email);
        $student_id->execute();
        $row = $student_id->fetch();
        $the_id = $row['StudID'];

        $insert_to_adviser = "INSERT INTO Adviser (StudID)
				                      VALUES (:studid);";
        $insert = $this->db->pdo->prepare($insert_to_adviser);
        $insert->bindValue(':studid', $the_id);
        $insert_result = $insert->execute();

        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Success !</strong> Wow, you have Registered Successfully !</div>';
        return $msg;
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Error !</strong> Something went Wrong !</div>';
        return $msg;
      }
    }
  }



  // Select All User Method
  public function selectAllUserData()
  {
    $sql = "SELECT * FROM tbl_users ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // Select All User Method
  public function selectAllUserData3()
  {
    $sql = "SELECT * FROM Faculty ORDER BY FacID DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  // Select All User Method
  public function selectAllApplicantData()
  {
    $sql = "SELECT * FROM Applicant ORDER BY isActive DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }



  // Select All Course Method
  public function selectAllCourseData()
  {
    $sql = "SELECT * FROM Course ORDER BY CrsID DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // Select All Course Method
  public function selectAllCourseData2()
  {
    $sql = "SELECT * FROM Schedules ORDER BY StudID DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // Select All Course Method
  public function selectAllCourseCatalogData()
  {
    $sql = "SELECT * FROM CourseCatalog ORDER BY SemYear";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }



  // Select All Course Method
  public function selectAllCourseDataByID($userid)
  {
    $sql = "SELECT * FROM Schedules WHERE StudID = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  // Select All Course Method
  public function selectAllCourseDataByIDFaculty($userid)
  {
    $sql = "SELECT SemSemester, SemYear, SemStart,SemEnd,TimeAbr,RoomLocation,CrsName, CrsCredits, CrsAbr,FacLastName FROM Schedules WHERE FacID = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

    if ($result) {
      return $result;
    } else {
      return false;
    }
  }



  // Select All History Method
  public function selectClassRosters($userid)
  {
    $sql = "SELECT Student.StudID AS id,Student.StudFirstName, Student.StudLastName,Semester.SemSemester, Semester.SemStart, Section.SectID, Semester.SemEnd, Time.TimeAbr, Room.RoomLocation, Course.CrsName,Course.CrsCredits, Course.CrsAbr,Faculty.FacLastName
    FROM ((Student
    INNER JOIN History ON Student.StudID = History.StudID)
    INNER JOIN Section ON Section.SectID = History.SectID
    INNER JOIN Semester ON Semester.SemID = Section.SemID
    INNER JOIN Time ON Time.TimeID = Section.TimeID
    INNER JOIN Room ON Room.RoomID = Section.RoomID
    INNER JOIN Course ON Course.CrsID = Section.CID
    INNER JOIN Faculty ON Faculty.FacID = Course.FacID)
    WHERE Faculty.FacID = :id
    ORDER BY Course.CrsName

    ";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }


  // Select All Course Method
  public function selectAllCourseDataByFacultyID($userid)
  {
    $sql = "SELECT * FROM CourseCatalog WHERE FacID = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }



  // Select All Course Method
  public function selectAdviseeByFacultyID($userid)
  {
    $sql = "SELECT Faculty.FacID, Faculty.FacLastName, Student.StudLastName, Student.StudFirstName,
				Student.StudID, Student.StudPin FROM ((Faculty JOIN Adviser ON Faculty.FacID = Adviser.FacID)
				INNER JOIN Student ON Student.StudID = Adviser.StudID) WHERE Adviser.FacID = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }



  // Select All History Method
  public function selectEnrollmentHistory()
  {
    $sql = "SELECT Student.StudID AS id,Student.StudFirstName, Student.StudLastName,Semester.SemSemester, Semester.SemStart, Section.SectID, Semester.SemEnd, Time.TimeAbr, Room.RoomLocation, Course.CrsName,Course.CrsCredits, Course.CrsAbr,Faculty.FacLastName
FROM ((Student
INNER JOIN History ON Student.StudID = History.StudID)
INNER JOIN Section ON Section.SectID = History.SectID
INNER JOIN Semester ON Semester.SemID = Section.SemID
INNER JOIN Time ON Time.TimeID = Section.TimeID
INNER JOIN Room ON Room.RoomID = Section.RoomID
INNER JOIN Course ON Course.CrsID = Section.CID
INNER JOIN Faculty ON Faculty.FacID = Course.FacID


)";

    $stmt = $this->db->pdo->prepare($sql);
    //$stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }



  // Select All Time Method
  public function selectAllTimeData()
  {
    $sql = "SELECT * FROM Time ORDER BY TimeID DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // Select All Course Method
  public function selectAllRoomData()
  {
    $sql = "SELECT * FROM Room ORDER BY RoomID DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  // Select All User Method
  public function selectSingleUserData($userid)
  {
    $sql = "SELECT * FROM tbl_users WHERE id= :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  // Select All User Method
  public function selectAllUserData2()
  {
    $sql = "SELECT * FROM Student ORDER BY StudID DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // Select All User Method
  public function selectAllUserData4()
  {
    $sql = "SELECT * FROM Student WHERE MajID='1' ORDER BY StudID DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  // Select All User Method
  public function selectAllUserData5()
  {
    $sql = "SELECT * FROM Student WHERE MajID='2' ORDER BY StudID DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  // User login Autho Method
  public function userLoginAutho($email, $password)
  {

    $sql = "SELECT * FROM tbl_users WHERE email = :email  LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    //  $stmt->bindValue(':password', $password);
    $stmt->execute();
    $row = $stmt->fetch();
    $hashedPassword = $row['password'];
    //return $row; //DELETE THIS (only here for testing)<---------------------------

    if (password_verify($password, $hashedPassword)) { //Not working for older passwords
      return $row;
    } else {
      return false;
    }
  }


  // Select All User Method
  public function selectAllAdviserIDData()
  {
    $sql = "SELECT * FROM Adviser ORDER BY FacID ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  // Select All User Method
  public function selectAllAdviserData()
  {
    $sql = "SELECT Student.StudID, Student.StudFirstName, Student.StudLastName, Faculty.FacFirstName, Faculty.FacLastName, Faculty.FacID
			  FROM Student JOIN Adviser ON Student.StudID = Adviser.StudID
			  INNER JOIN Faculty ON Faculty.FacID = Adviser.FacID";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }



  // User login Autho Method Password default

  public function login1($email, $password)
  {
    $sql = "SELECT * FROM tbl_users WHERE email = :email";

    //Bind value
    $this->db->bind(':username', $username);
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);

    $row = $this->db->single();

    $hashedPassword = $row->password;

    if (password_verify($password, $hashedPassword)) {
      return $row;
    } else {
      return false;
    }
  }




  // User login Authorization Method2
  public function userLoginAutho2($email, $password)
  {
    //$password = SHA1($password);
    $sql = "SELECT * FROM tbl_users WHERE email = :email and password = :password LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }




  // User login Authorization Method3
  public function userLoginAutho3($email, $password)
  {
    $password = SHA1($password);
    $sql = "SELECT * FROM Student WHERE StudEmail = :email and StudPassword = :password LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }



  // Check User Account Satatus
  public function CheckActiveUser($email)
  {
    $sql = "SELECT * FROM tbl_users WHERE email = :email and isActive = :isActive LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':isActive', 1);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }




  // User Login Authentication Method
  public function userLoginAuthentication($data)
  {
    $email = $data['email'];
    $password = $data['password'];


    $checkEmail = $this->checkExistEmail($email);

    if ($email == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> Email or Password fields Must not be Empty !</div>';
      return $msg;
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> Invalid email address !</div>';
      return $msg;
    } elseif ($checkEmail == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> The System Did Not Locate Your Email , Apply for registration or contact staff please !</div>';
      return $msg;
    } else {

      $logResult = $this->userLoginAutho($email, $password);
      $chkActive = $this->CheckActiveUser($email);

      if ($chkActive == TRUE) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Error !</strong> Sorry, Your account is Deactivated, Please Contact The Administrator !</div>';
        return $msg;
      } else
        if ($logResult) {

        Session::init();
        Session::set('login', TRUE);
        Session::set('id', $logResult['id']);
        Session::set('roleid', $logResult['roleid']);
        Session::set('firstname', $logResult['firstname']);
        Session::set('email', $logResult['email']);
        Session::set('lastname', $logResult['lastname']);

        Session::set('logMsg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
								  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								  <strong>Success !</strong> You are Logged In Successfully !</div>');

        echo "<script>location.href='index.php';</script>";
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Error !</strong> Invalid Email and Password Combination  !</div>';
        return $msg;
      }
    }
  }



  // Get Single User Information By Id Method
  public function getUserInfoById($userid)
  {
    $sql = "SELECT * FROM tbl_users WHERE id= :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  // Get Single User Information By Id Method
  public function getUserInfoById3($userid)
  {
    $sql = "SELECT * FROM Schedules WHERE StudID= :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }




  // Get Single User Information By Id Method2
  public function getUserInfoById2($userid)
  {
    $sql = "SELECT * FROM Student WHERE StudID = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }



  //
  //   Get Single User Information By Id Method
  public function updateUserByIdInfo($userid, $data)
  {
    $facfname = $data['FacFirstName'];
    $faclname = $data['FacLastName'];
    $email = $data['FacEmail'];
    $facOphone = $data['FacOfficePhone'];
    $roleid = $data['roleid'];



    if ($facfname == "" || $faclname == "" || $email == "" || $facOphone == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> Input Fields must not be Empty !</div>';
      return $msg;
    } elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
      return $msg;
    } elseif (filter_var($mobile, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Error !</strong> Enter only Numbers for Phone number field !</div>';
      return $msg;
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> Invalid email address !</div>';
      return $msg;
    } else {

      $sql = "UPDATE Faculty SET
				FacFirstName = :facfname,
				FacLastName = :faclname,
				FacEmail = :email,
				FacOfficePhone = :facOphone,
				RoleID = :roleid
				WHERE FacID = :id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':facfname', $facfname);
      $stmt->bindValue(':faclname', $faclname);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':facOphone', $facOphone);
      $stmt->bindValue(':roleid', $roleid);
      $stmt->bindValue(':id', $userid);
      $result = $stmt->execute();

      if ($result) {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
							   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							   <strong>Success !</strong> Awesome, Your Information has updated Successfully !</div>');
      } else {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
							   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							   <strong>Error !</strong> Sorry, Malfunction ! Data not inserted !</div>');
      }
    }
  }


  //
  //   Get Single User Information By Id Method2
  public function updateUserByIdInfo2($userid, $data)
  {
    $studfname = $data['StudFirstName'];
    $studlname = $data['StudLastName'];
    $email = $data['StudEmail'];
    $studphone = $data['StudPhone'];
    $roleid = $data['RoleID'];


    if ($studfname == "" || $studlname == "" || $email == "" || $studphone == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> Input Field must not be Empty !</div>';
      return $msg;
    } elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
      return $msg;
    } elseif (filter_var($mobile, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Error !</strong> Enter only Numbers for particular field !</div>';
      return $msg;
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> Invalid email address !</div>';
      return $msg;
    } else {

      $sql = "UPDATE Student SET
				StudFirstName = :studfname,
				StudLastName = :studlname,
				StudEmail = :email,
				StudPhone = :studphone,
				RoleID = :roleid
				WHERE StudID = :id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':studfname', $facfname);
      $stmt->bindValue(':studlname', $faclname);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':studphone', $studphone);
      $stmt->bindValue(':roleid', $roleid);
      $stmt->bindValue(':id', $userid);
      $result =   $stmt->execute();

      if ($result) {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
							   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							   <strong>Success !</strong> Wow, Your Information updated Successfully !</div>');
      } else {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
							   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							   <strong>Error !</strong> Data not inserted !</div>');
      }
    }
  }



  // Delete User by Id Method
  public function deleteUserById($remove)
  {
    $sql = "DELETE FROM Faculty WHERE FacID = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();

    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Success !</strong> User account Deleted Successfully !</div>';
      return $msg;
    } else {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Error !</strong> Data not Deleted !</div>';
      return $msg;
    }
  }
  // Delete User by Id Method2
  public function deleteUserById2($remove)
  {
    $sql = "DELETE FROM Students WHERE StudID = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();

    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Success !</strong> User account Deleted Successfully !</div>';
      return $msg;
    } else {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Error !</strong> Data not Deleted !</div>';
      return $msg;
    }
  }

  // User Deactivated By Admin
  public function userDeactiveByAdmin($deactive)
  {
    $sql = "UPDATE Faculty SET
			  isActive=:isActive
			  WHERE FacID = :id";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 1);
    $stmt->bindValue(':id', $deactive);
    $result = $stmt->execute();

    if ($result) {
      echo "<script>location.href='index.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
							   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							   <strong>Success !</strong> User account Deactivated Successfully !</div>');
    } else {
      echo "<script>location.href='index.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
							   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						       <strong>Error !</strong> Data not Deactivated !</div>');

      return $msg;
    }
  }


  // User activated By Admin
  public function userActiveByAdmin($active)
  {
    $sql = "UPDATE Faculy SET
			  isActive=:isActive
			  WHERE FacID = :id";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 0);
    $stmt->bindValue(':id', $active);
    $result =   $stmt->execute();

    if ($result) {
      echo "<script>location.href='index.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
							   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							   <strong>Success !</strong> User account activated Successfully !</div>');
    } else {
      echo "<script>location.href='index.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
							   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							   <strong>Error !</strong> User Account activated !</div>');
    }
  }





  // User activated By Admin
  public function userActiveByAdmin2($active)
  {
    $sql = "UPDATE Student SET
				  isActive=:isActive
				  WHERE StudID = :id";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 0);
    $stmt->bindValue(':id', $active);
    $result =   $stmt->execute();
    if ($result) {
      echo "<script>location.href='index.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
								   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								   <strong>Success !</strong> User account activated Successfully !</div>');
    } else {
      echo "<script>location.href='index.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
								   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								   <strong>Error !</strong> User Account activated !</div>');
    }
  }
  // User activated By Admin
  public function userActivateByAdminApplicant($active)
  {
    $sql = "UPDATE Applicant SET
				  isActive=:isActive
				  WHERE AppID = :id";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 0);
    $stmt->bindValue(':id', $active);
    $result =   $stmt->execute();
    if ($result) {
      echo "<script>location.href='ViewApplicantsAdmin.php';</script>"; //"<script>location.href='index.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
								   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								   <strong>Success !</strong> User account Registered Successfully !</div>');
    } else {
      echo "<script>location.href='ViewApplicantsAdmin.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
								   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								   <strong>Error !</strong> User Not Registered !</div>');
    }
  }

  // User Deactivated By Admin
  public function userDeactivateByAdminApplicant($deactive)
  {
    $sql = "UPDATE Applicant SET
			  isActive=:isActive
			  WHERE AppID = :id";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 1);
    $stmt->bindValue(':id', $deactive);
    $result = $stmt->execute();

    if ($result) {
      echo "<script>location.href='ViewApplicantsAdmin.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
							   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							   <strong>Success !</strong> User account Deactivated Successfully !</div>');
    } else {
      echo "<script>location.href='ViewApplicantsAdmin.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
							   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						       <strong>Error !</strong> Data not Deactivated !</div>');

      return $msg;
    }
  }




  // User Deactivated By Admin
  public function userDeactiveByAdmin2($active)
  {
    $sql = "UPDATE Student SET
			  isActive=:isActive
			  WHERE StudID = :id";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 1);
    $stmt->bindValue(':id', $active);
    $result = $stmt->execute();

    if ($result) {
      echo "<script>location.href='index.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
							   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							   <strong>Success !</strong> User account has been De-Activated Successfully !</div>');
    } else {
      echo "<script>location.href='index.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
							   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						       <strong>Error !</strong> User Account Not De-Activated !</div>');
    }
  }




  // Check Old password method
  public function CheckOldPassword($userid, $old_pass)
  {
    $old_pass = password_hash($old_pass, PASSWORD_DEFAULT);
    $sql = "SELECT FacPassword FROM Faculty WHERE FacPassword = :password AND FacID =:id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':password', $old_pass);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  // Check Old password method2
  public function CheckOldPassword2($userid, $old_pass)
  {
    $old_pass = password_hash($old_pass, PASSWORD_DEFAULT);
    $sql = "SELECT StudPassword FROM Student WHERE StudPassword = :password AND StudID =:id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':password', $old_pass);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }



  // Change User pass By Id
  public  function changePasswordBysingelUserId($userid, $data)
  {

    $old_pass = $data['old_password'];
    $new_pass = $data['new_password'];


    if ($old_pass == "" || $new_pass == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> Password field must not be Empty !</div>';
      return $msg;
    } elseif (strlen($new_pass) < 6) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> New password must be at least 6 character !</div>';
      return $msg;
    }

    $oldPass = $this->CheckOldPassword($userid, $old_pass);
    if ($oldPass == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				   <strong>Error !</strong> Old password did not Matched !</div>';
      return $msg;
    } else {
      $new_pass = password_hash($password, PASSWORD_DEFAULT);
      $sql = "UPDATE Faculty SET
				   FacPassword=:password
                   WHERE FacID = :id";

      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':password', $new_pass);
      $stmt->bindValue(':id', $userid);
      $result1 = $stmt->execute();

      if ($result1) {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
							     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								 <strong>Success !</strong> Great news, Password Changed successfully !</div>');
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error !</strong> Password did not changed !</div>';
        return $msg;
      }
    }
  }


  // Change User pass By Id2
  public  function changePasswordBysingelUserId2($userid, $data)
  {

    $old_pass = $data['old_password'];
    $new_pass = $data['new_password'];


    if ($old_pass == "" || $new_pass == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> Password field must not be Empty !</div>';
      return $msg;
    } elseif (strlen($new_pass) < 6) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error !</strong> New password must be at least 6 character !</div>';
      return $msg;
    }

    $oldPass = $this->CheckOldPassword($userid, $old_pass);
    if ($oldPass == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
				   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				   <strong>Error !</strong> Old password did not Matched !</div>';
      return $msg;
    } else {
      $new_pass = SHA1($new_pass);
      $sql = "UPDATE Student SET
				   StudPassword=:password
				   WHERE StudID = :id";

      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':password', $new_pass);
      $stmt->bindValue(':id', $userid);
      $result1 = $stmt->execute();

      if ($result1) {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
								 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								 <strong>Success !</strong> Great news, Password Changed successfully !</div>');
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error !</strong> Password did not changed !</div>';
        return $msg;
      }
    }
  }
}
