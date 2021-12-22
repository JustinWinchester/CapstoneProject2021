
<?php // sqltest.php
// requirements
require_once '../inc/header.php';
require_once '../../config/logindb.php';
// connection to database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

// deletes section from table
if (isset($_POST['delete']) && isset($_POST['SectID'])) {
    $id   = get_post($conn, 'CrsID');
    $query  = "DELETE FROM Section WHERE SectID='$id'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed, ERROR! PLEASE RE-ATTEMPT ENTRY<br><br>";
}

// checks if data is set
if (
    isset($_POST['SectID'])   &&
    isset($_POST['SectMaxStud'])    &&
    isset($_POST['CID']) &&
    isset($_POST['SemID'])     &&
    isset($_POST['TimeID']) &&
    isset($_POST['RoomID'])
) {

    $id         = get_post($conn, 'SectID');
    $sectionmaxstuds  = get_post($conn, 'SectMaxStud');
    $sectioncourseid    = get_post($conn, 'CID');
    $sectionsemesterid = get_post($conn, 'SemID');
    $sectiontimeid     = get_post($conn, 'TimeID');
    $sectionroomid     = get_post($conn, 'RoomID');
    // inserts into section table
    $query    = "INSERT INTO Section VALUES" .
        "('$id','$sectionmaxstuds', '$sectioncourseid', '$sectionsemesterid', '$sectiontimeid', '$sectionroomid')";
    $result   = $conn->query($query);
    if (!$result) echo "Could Not Insert Section Error!<br><br>";
}
// form to input new section
echo <<<_END
  <div style="width:1000px; margin:0px auto">

  <form action="AddNewSectionAdmin.php" method="post"><pre>
  <div class="form-group">
    <label for="SectID">Section Identification Number</label>
    <input type="text" name="SectID"  class="form-control">
    </div>
    <div class="form-group">
   <label for="SectMaxStud">Maximum Student Amount</label>
    <input type="text" name="SectMaxStud" class="form-control">
    </div>
    <div class="form-group">
   <label for="CID">Course Identification Number</label>
    <input type="text" name="CID" class="form-control">
    </div>
    <div class="form-group">
   <label for="SemID">Semester Identification Number</label>
    <input type="text" name="SemID" class="form-control">
    </div>
    <div class="form-group">
   <label for="TimeID">Time Identification Number</label>
    <input type="text" name="TimeID" class="form-control">
    </div>
    <div class="form-group">
   <label for="RoomID">Room Identification Number</label>
    <input type="text" name="RoomID" class="form-control">
    </div>

              <input type="submit" value="ADD NEW! SECTION">
  </pre></form>


_END;

// queries and displays all sections
$query  = "SELECT * FROM Section";
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
    SECTION ID        $r0
    MAXIMUM STUDENTS $r1
    COURSE ID $r2
    SEMESTER ID$r3
    TIME ID   $r4
    ROOM ID    $r5
  </pre>
  <form action='AddNewSectionAdmin.php' method='post'>
  <input type='hidden' name='delete' value='yes'>
  <input type='hidden' name='id' value='$r0'>
  <input type='submit' value='DELETE SECTION'></form>
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
