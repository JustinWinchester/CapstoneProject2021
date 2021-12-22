
<?php // sqltest.php
//requirements
require_once '../inc/header.php';
require_once '../../config/logindb.php';
// connection to database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

// deletes student from table
if (isset($_POST['delete']) && isset($_POST['StudID'])) {
    $id   = get_post($conn, 'StudID');
    $query  = "DELETE FROM Student WHERE StudID='$id'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed<br><br>";
}

// checks if data is set
if (
    isset($_POST['StudFirstName']) &&
    isset($_POST['StudLastName']) &&
    isset($_POST['StudAddress'])     &&
    isset($_POST['StudCity']) &&
    isset($_POST['StudCountry']) &&
    isset($_POST['StudEmail']) &&
    isset($_POST['StudDOB']) &&
    isset($_POST['StudEnrolled']) &&
    isset($_POST['StudPassword']) &&
    isset($_POST['MajID']) &&
    isset($_POST['ClassID']) &&
    isset($_POST['RoleID']) &&
    isset($_POST['isActive'])
) {
    $studentfname   = get_post($conn, 'StudFirstName');
    $studentlname    = get_post($conn, 'StudLastName');
    $studentaddress = get_post($conn, 'StudAddress');
    $studentcity     = get_post($conn, 'StudCity');
    $studentcountry         = get_post($conn, 'StudCountry');
    $studentphone   = get_post($conn, 'StudPhone');
    $studentemail    = get_post($conn, 'StudEmail');
    $studentdob = get_post($conn, 'StudDOB');
    $studentendate     = get_post($conn, 'StudEnrolled');
    $studentpass   = get_post($conn, 'StudPassword');
    $major = get_post($conn, 'MajID');
    $classification     = get_post($conn, 'ClassID');
    $roleid = get_post($conn, 'RoleID');
    $active     = get_post($conn, 'isActive');


    echo $studentfname;
    echo $studentlname;
    echo $studentfname;
    echo $studentaddress;
    echo $studentcity;
    echo $studentcountry;

    //inserts into student table
    $query    = "INSERT INTO Student VALUES" .
        "('$studentfname', '$studentlname', '$studentaddress', '$studentcity','$studentcountry','$studentphone', '$studentemail', '$studentdob', '$studentendate','$studentpass', '$major', '$classification', '$roleid','$active')";
    $result   = $conn->query($query);
    if (!$result) echo "INSERT failed<br><br>";
}

// form to input new student
echo <<<_END
  <form action="AddStudent.php" method="post"><pre>
       
 Student's First Name <input type="text" name="StudFirstName">
  Student's Last Name <input type="text" name="StudLastName">
      Student Address <input type="text" name="StudAddress">
      Student City <input type="text" name="StudCity">
Student Country <input type="text" name="StudCountry">
     Student Phone <input type="text" name="StudPhone">
  Email <input type="text" name="StudEmail">
      Date Of Birth <input type="text" name="StudDOB">
      Student's Enrollment Date <input type="text" name="StudEnrolled">
     Password <input type="text" name="StudPassword">
        Major ID <input type="text" name="MajID">
      Classification ID <input type="text" name="ClassID">
Role ID <input type="text" name="RoleID">
User Not Active? <input type="checkbox" name="isActive">


           <input type="submit" value="ADD RECORD">
  </pre></form>
_END;

// queries and displays all students
$query  = "SELECT * FROM Student";
$result = $conn->query($query);
if (!$result) die("Database access failed");

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_NUM);

    $r0 = htmlspecialchars($row[0]);
    $r1 = htmlspecialchars($row[1]);
    $r2 = htmlspecialchars($row[2]);
    $r3 = htmlspecialchars($row[3]);
    $r4 = htmlspecialchars($row[4]);
    $r5 = htmlspecialchars($row[5]);
    $r6 = htmlspecialchars($row[6]);
    $r7 = htmlspecialchars($row[7]);
    $r8 = htmlspecialchars($row[8]);
    $r9 = htmlspecialchars($row[9]);
    $r10 = htmlspecialchars($row[10]);
    $r11 = htmlspecialchars($row[11]);
    $r12 = htmlspecialchars($row[12]);
    $r13 = htmlspecialchars($row[13]);
    $r14 = htmlspecialchars($row[14]);
    $r15 = htmlspecialchars($row[15]);
    echo <<<_END
  <pre>
    Student ID        $r0
    Student First Name$r1
    Student Last Name  $r2
    Student Address $r3
    Student City   $r4
    Student Country        $r5
    Student Phone $r6
    Student Email  $r7
    Student Birth Date $r8
    Student Enroll Date   $r9
    Student Password       $r10
    Student PIN $r11
    Student Major ID  $r12
    Student Classification ID $r13
    Student Role ID   $r14
   Student is Active   $r15

  </pre>
  <form action='AddStudent.php' method='post'>
  <input type='hidden' name='delete' value='yes'>
  <input type='hidden' name='id' value='$r0'>
  <input type='submit' value='DELETE RECORD'></form>
_END;
}

$result->close();
$conn->close();

function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}
?>

<?php
include '../inc/footer.php';

?>

