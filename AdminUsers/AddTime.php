
<?php // sqltest.php
// requirements
require_once '../inc/header.php';
require_once '../../config/logindb.php';
// connection to database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

// deletes time from table
if (isset($_POST['delete']) && isset($_POST['TimeID'])) {
    $id   = get_post($conn, 'TimeID');
    $query  = "DELETE FROM Time WHERE TimeID='$id'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed<br><br>";
}

// checks if data is set
if (
    isset($_POST['TimeID'])   &&
    isset($_POST['TimeAbr'])
) {

    $id         = get_post($conn, 'TimeID');
    $timeabrv   = get_post($conn, 'TimeAbr');

    // inserts into time table
    $query    = "INSERT INTO Time VALUES" .
        "('$id','$timeabv')";
    $result   = $conn->query($query);
    if (!$result) echo "INSERT failed<br><br>";
}
// form to input new time
echo <<<_END
  <div style="width:100%; margin:0px auto">

  <form action="AddTime.php" method="post"><pre>
  <div class="form-group">
    <label for="TimeID">Time Identification Number</label>
    <input type="text" name="TimeID"  class="form-control">
    </div>
    <div class="form-group">
   <label for="TimeAbr">Time Abbreviation </label>
    <input type="text" name="TimeAbr" class="form-control">
    </div>

              <input type="submit" value="INSERT TIME RECORD ">
  </pre></form>

_END;
// queries and displays all times
$query  = "SELECT * FROM Time";
$result = $conn->query($query);
if (!$result) die("Database access failed");

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j) {
    $row = $result->fetch_array(MYSQLI_NUM);

    $r0 = htmlspecialchars($row[0]);
    $r1 = htmlspecialchars($row[1]);
    echo <<<_END
  <pre>
    Time ID        $r0
    Time Abbrv $r1 
    <form action='AddTime.php' method='post'>
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
