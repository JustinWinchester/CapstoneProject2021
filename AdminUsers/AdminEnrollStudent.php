
<?php // sqltest.php
// requirements
require_once '../inc/header.php';
require_once '../../config/logindb.php';
// connection to database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

// deletes student from history table
if (isset($_POST['delete']) && isset($_POST['StudID'])) {
    $id   = get_post($conn, 'StudID');
    $query  = "DELETE FROM History WHERE StudID='$id'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed<br><br>";
}
// checks if data is set
if (
    isset($_POST['StudID'])   &&
    isset($_POST['SectID'])     &&
    isset($_POST['Grade'])
) {

    $id         = get_post($conn, 'StudID');
    $sectid   = get_post($conn, 'SectID');
    $grade   = get_post($conn, 'Grade');
    // inserts into history table
    $query    = "INSERT INTO History VALUES" .
        "('$id','$sectid')";
    $result   = $conn->query($query);
    if (!$result) echo "INSERT failed<br><br>";
}
// form to enroll a student into section
echo <<<_END
  <div style="width:600px; margin:0px auto">

  <form action="AdminEnrollStudent.php" method="post"><pre>
  <div class="form-group">
    <label for="StudID">Student Identification Number</label>
    <input type="text" name="StudID"  class="form-control">
    </div>
    <div class="form-group">
   <label for="SectID">Section Identification Number</label>
    <input type="text" name="SectID" class="form-control">
    </div>
    <label for="Grade">Student Course Grade</label>
     <input type="text" name="Grade" class="form-control">
     </div>


              <input type="submit" value="ENROLL STUDENT/ADD GRADE ">
  </pre></form>
_END;
// queries and displays all history
$query  = "SELECT * FROM History";
$result = $conn->query($query);
if (!$result) die("Database access failed");

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_NUM);

    $r0 = htmlspecialchars($row[0]);
    $r1 = htmlspecialchars($row[1]);
    $r2 = htmlspecialchars($row[2]);
    echo <<<_END
  <pre>
    StudID ID        $r0
    Section ID $r1
    Grade $r2
      </pre>
  <form action='AdminEnrollStudent.php' method='post'>
  <input type='hidden' name='delete' value='yes'>
  <input type='hidden' name='id' value='$r0'>
  <input type='submit' value='DELETE ENROLLMENT RECORD'></form>
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
