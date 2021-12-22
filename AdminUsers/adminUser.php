
<?php // sqltest.php
// requirements
require_once '../inc/header.php';
require_once '../../config/logindb.php';
// connection to database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

// deletes semester from semester table
if (isset($_POST['delete']) && isset($_POST['SemID'])) {
    $id   = get_post($conn, 'SemID');
    $query  = "DELETE FROM Semester WHERE SemID='$id'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed<br><br>";
}
// checks if data is set
if (
    isset($_POST['SemID'])   &&
    isset($_POST['SemSemester'])    &&
    isset($_POST['SemYear']) &&
    isset($_POST['SemStart'])     &&
    isset($_POST['SemEnd'])
) {

    $id         = get_post($conn, 'SemID');
    $semsemster   = get_post($conn, 'SemSemester');
    $semyear    = get_post($conn, 'SemYear');
    $semstart = get_post($conn, 'SemStart');
    $semend     = get_post($conn, 'SemEnd');

    //inserts into semester table
    $query    = "INSERT INTO Semester VALUES" .
        "('$id','$semsemster', '$semyear', '$semstart', '$semend')";
    $result   = $conn->query($query);
    if (!$result) echo "INSERT failed<br><br>";
}
// form to input new semester
echo <<<_END
  <div style="width:100%; margin:0px auto">

  <form action="adminUser.php" method="post"><pre>
  <div class="form-group">
    <label for="SemID">Semester Identification Number</label>
    <input type="text" name="SemID"  class="form-control">
    </div>
    <div class="form-group">
   <label for="SemSemester">Semester</label>
    <input type="text" name="SemSemester" class="form-control">
    </div>
    <div class="form-group">
   <label for="SemYear">Year</label>
    <input type="date" name="SemYear" class="form-control">
    </div>
    <div class="form-group">
   <label for="SemStart">Semester Start Date</label>
    <input type="date" name="SemStart" class="form-control">
    </div>
    <div class="form-group">
   <label for="SemEnd">Semester End Date</label>
    <input type="date" name="SemEnd" class="form-control">
    </div>

              <input type="submit" value="ADD SEMESTER INFORMATION">
  </pre></form>


_END;
// queries and displays all semesters
$query  = "SELECT * FROM Semester";
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

    echo <<<_END
  <pre>
    Sem ID        $r0
    Semester $r1
    Semester Year  $r2
    Semester Start Date $r3
    Semester End Date   $r4
    <form action='adminUser.php' method='post'>
      <input type='hidden' name='delete' value='yes'>
      <input type='hidden' name='id' value='$r0'>
      <input type='submit' value='DELETE RECORD'>
    </form>
  </pre>
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
