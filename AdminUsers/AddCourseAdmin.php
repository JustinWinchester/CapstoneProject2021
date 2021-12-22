
<?php // sqltest.php
// requirements
require_once '../inc/header.php';
require_once '../../config/logindb.php';

// database connection
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

// deletes course from table
if (isset($_POST['delete']) && isset($_POST['CrsID'])) {
    $id   = get_post($conn, 'CrsID');
    $query  = "DELETE FROM Course WHERE CrsID='$id'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed<br><br>";
}

// checks if data is set
if (
    isset($_POST['CrsID'])      &&
    isset($_POST['CrsName'])    &&
    isset($_POST['CrsCredits']) &&
    isset($_POST['CrsAbr'])     &&
    isset($_POST['FacID'])      &&
    isset($_POST['MajID'])
) {

    $id              = get_post($conn, 'CrsID');
    $coursename      = get_post($conn, 'CrsName');
    $coursecrds      = get_post($conn, 'CrsCredits');
    $courseabr       = get_post($conn, 'CrsAbr');
    $coursefacultyid = get_post($conn, 'FacID');
    $coursemajid     = get_post($conn, 'MajID');

    //inserts into course table
    $query    = "INSERT INTO Course VALUES" .
        "('$id','$coursename', '$coursecrds', '$courseabr', '$coursefacultyid', '$coursemajid')";
    $result   = $conn->query($query);
    if (!$result) echo "Courld Not Insert The Intended Course Data!<br><br>";
}
// form to input a new course
echo <<<_END
  <div style="width:1000px; margin:0px auto">

  <form action="AddCourseAdmin.php" method="post"><pre>
  <div class="form-group">
    <label for="CrsID">Course Identification Number</label>
    <input type="text" name="CrsID"  class="form-control">
    </div>
    <div class="form-group">
   <label for="CrsName">Course Title</label>
    <input type="text" name="CrsName" class="form-control">
    </div>
    <div class="form-group">
   <label for="CrsCredits">Course Credit Amount</label>
    <input type="text" name="CrsCredits" class="form-control">
    </div>
    <div class="form-group">
   <label for="CrsAbr">Course Title Abbreviation Date</label>
    <input type="text" name="CrsAbr" class="form-control">
    </div>
    <div class="form-group">
   <label for="FacID">Faculty Member Identification Number</label>
    <input type="text" name="FacID" class="form-control">
    </div>
    <div class="form-group">
   <label for="MajID">Major Identification Number</label>
    <input type="text" name="MajID" class="form-control">
    </div>

              <input type="submit" value="ADD NEW! COURSE">
  </pre></form>


_END;

// queries and displays all courses
$query  = "SELECT * FROM Course";
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

    echo <<<_END
  <pre>
    Course ID        $r0
    Course Title $r1
    Course Credits $r2
    Course Abbreviation $r3
    Faculty Member ID   $r4
    Major ID    $r5
  </pre>
  <form action='AddCourseAdmin.php' method='post'>
  <input type='hidden' name='delete' value='yes'>
  <input type='hidden' name='id' value='$r0'>
  <input type='submit' value='DELETE COURSE'></form>
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
